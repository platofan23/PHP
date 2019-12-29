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
$nutzername = validateFormDatenbank($_POST["username"]);
$nutzername = valEmail($_POST["username"]);
$password = validateFormDatenbank($_POST["password"]);
//Auf Bot testen
noBotLogin(validateForm($_POST['bot']), validateForm($_POST['result']));
//Auf spam prüfen
noSpam(validateForm($_POST['result']));
//Session wenn nötig nochmal starten
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
//In Session Speichern
$_SESSION['user'] = $nutzername;
$_SESSION['IP'] = $IP;
$_SESSION['con'] = $con;
//Captcha überrüfen
if ($_POST['captcha_code'] == $_SESSION['captcha_spam']) {
	//Passwort testen
	if (erstellePasswort($password) == false) {
		//Protokollieren Passwort unzulässig
		regDatenFehl('Passwort unzulässig!');
	} else {
		//Passwort hashen
		$hash = "" . password_hash($password, PASSWORD_DEFAULT) . "";
		$plvl = 1;
		$sessionID = bin2hex(random_bytes(32));
		//Datenbankverbindung zum Server aufbauen
		if ($_SESSION['con']->connect_error) {
			 //Zum Login
			 header("Location: Login.php");
			 exit();
		} else {
			//SQL-Anweisung als Prepare-Statement
			$sql = $_SESSION['con']->prepare("SELECT * FROM benutzer where Benutzername=?");
			//Wert binden
			$sql->bind_param("s", $nutzername);
			//Ausführen
			$sql->execute();
			//Result binden
			$result = $sql->get_result();
			//Werte reinschreiben
			$row = $result->fetch_object();
			//Prepared-Statement beenden
			$sql->close();
			//Test Nutzername schon vorhanden
			if (mysqli_num_rows($result) > 0) {
				//Protokollieren Nutzername schon vhorhanden
				regDatenFehl('Nutzername schon vorhanden!');
			} else {
				//Datenbankverbindung zum Server aufbauen
				if ($_SESSION['con']->connect_error) {
					 //Zum Login
					 header("Location: Login.php");
					 exit();
				} else {
					//Protokollieren Erfolreich registriert
					regDatenErfolg('Erfolgreich registriert!');
					$code = bin2hex(random_bytes(8));
					//SQL-Anweisung als Prepare-Statement
					$sql = $_SESSION['con']->prepare("INSERT INTO benutzer (Benutzername,Passwort,permissionlvl,SessionID,EinCode) VALUES (?,?,?,?,?)");
					//Wert binden
					$sql->bind_param("ssiss", $nutzername, $hash, $plvl, $sessionID,$code);
					//Ausführen
					$sql->execute();
					//Prepared-Statement beenden
					$sql->close();
					//Verbindung beenden
					mysqli_close($_SESSION['con']);
				}
			}
		}
	}
} else {
	//Protokollieren Captcha Falsch
	regDatenFehl($con, $nutzername, $IP, 'Captcha falsch!');
}
//Zum Login
header("Location: Login.php");
exit();
?>
</body>

</html>