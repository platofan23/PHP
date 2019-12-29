<?php
//Whitelist prüfen, ob die Webseiten vorhanden und in der Whitelist sind
$availablePages = array('header.php', 'Aufgabe.php');
if (file_exists('header.php') and in_array('header.php', $availablePages) and file_exists('Aufgabe.php') and in_array('Aufgabe.php', $availablePages)) {
	//Nachladen der Dateien
	require 'header.php';
	require 'Aufgabe.php';
}
//Methode Prüfung des Crsf-Tokens gegen cross-site-script-reforgery d.h. man kann nicht einfach Skripte in der Adresszeile des Browser ausführen
//Die Eingaben werden gleich mit validiert
crsfValidate(validateForm($_POST['_csrf_token'] ?? null), validateForm($_POST['token'] ?? null));
//Methode Prüfung ob das Feld vorher im Formular leer ist, sonst wird man als Bot aussortiert
//Auch wird das Datum abeprüft und die Werte werden validiert
noBot(validateForm($_POST['bot']), $_POST['result'], $_POST['aufgabe']);
//Verzeichnis zusammenbauen
$target_path = '/var/www/html/';
$path = validateForm($_POST['ordner']);
$target_path .= $path;
$target_path .= "/";
//Download zusammenbauen
$target_path = $target_path . basename($_FILES['Datei']['name']);
//Download machen
if (move_uploaded_file($_FILES['Datei']['tmp_name'], $target_path)) {
	echo "The file " .  basename($_FILES['Datei']['name']) .
		" has been uploaded to" . $target_path;
	//Protokollieren Download Erfolg
	downupdir($_SESSION['user'], $_SESSION['IP'], 'Upload Erfolg!', $target_path);
} else {
	//Protokollieren Download Fehlschlag
	downupdir($_SESSION['user'], $_SESSION['IP'], 'Upload Fail!', $target_path);
}
//Verbindung beenden
mysqli_close($_SESSION['con']);
//Crsf-Token erneuern
regenerateSession();
//Zum Menü
header('Location: Menu.php');
exit();
?>
</body>
</html>
