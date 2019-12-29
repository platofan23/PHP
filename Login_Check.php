<?php
//Whitelist prüfen, ob die Webseiten vorhanden und in der Whitelist sind
$availablePages = array('header_Login.php');
if (file_exists('header_Login.php') and in_array('header_Login.php', $availablePages)) {
	//Nachladen der Dateien
	require 'header_Login.php';
}
//IP bestimmen
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	//ip from share internet
	$IP = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	//ip pass from proxy
	$IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
	$IP = $_SERVER['REMOTE_ADDR'];
}
$nutzername = valEmail($_POST["username"]);
//Session wenn nötig nochmal starten
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
//In Session Speichern
$_SESSION['con'] = $con;
$_SESSION['user'] = $nutzername;
$_SESSION['IP'] = $IP;
$password = validateForm($_POST["password"]);
$einmalcode=validateForm($_POST['einmalcode']);
//Auf Bot testen
noBotLogin(validateForm($_POST['bot']), validateForm($_POST['result']));
//Auf spam prüfen
noSpam(validateForm($_POST['result']));
//In Session speichern
$_SESSION['spamprotect_time'] = time();
$_SESSION['spamprotect_count'] = 1;
//Captcha überrüfen
if ($_POST['captcha_code'] == $_SESSION['captcha_spam']) {
	//Datenbankverbindung zum Server aufbauen
	if ($_SESSION['con']->connect_error) {
		 //Zum Login
		 header("Location: Login.php");
		 exit();
	} else {
		//SQL-Anweisung als Prepare-Statement
		$sql = $_SESSION['con']->prepare("SELECT Passwort,permissionlvl,sessionID FROM benutzer where Benutzername= ?");
		//Wert binden
		$sql->bind_param("s", $nutzername);
		//Ausführen
		$sql->execute();
		//Result binden
		$sql->bind_result($result, $permissionlvl, $sessionID);
		//Werte reinschreiben
		if ($sql->fetch())
		 {
			 //Prepared-Statement beenden
			$sql->close();
			//Fehlversuche testen
			fehlLogin();
			//Passwort vergleichen
			if (password_verify($password, $result)) {
				//Einmalcode testen
				if (einmalCodePrüfen($einmalcode)===true) {
					//Rechte vergleichen
					if ($permissionlvl == 2) {
						//Fehlversuche Reseten
						resetFehl();
						//Protokollieren Erfolg Login
						logDatenErfolg('Erfolgreich eingeloggt!');
						//UserID in Session speichern
						$_SESSION['userid'] = $sessionID;
						//Session Setzen
						setSession();
						//Neuer Einmalcode erzeugen
						einmalCodeErzeugen();
						//Zum Menü
						header('Location: Menu.php');
						exit();
					} else {
						//Protokollieren Fehlende Rechte
						logDatenFehl('Fehlende Rechte!');
					}
				} else {
					//Protokollieren Falscher Einmalocde
					logDatenFehl('Falscher Einmalcode!');
				}
			} else {
				//Protokollieren Falsches Passwort
				logDatenFehl('Falsches Passwort!');
			}
		} else {
			//Protokollieren Ungültiger Nutzername
			logDatenFehl('Ungültiger Nutzername');
		}
	}
} else {
	//Protokollieren Falsches Captcha
	logDatenFehl('Falsche Captcha!');
}
//Verbindung beenden
mysqli_close($_SESSION['con']);
//Zum Login
header("Location: Login.php");
exit();
?>
</body>
</html>