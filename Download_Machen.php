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
//Verzeichnis validieren
$verzeichnis = validateForm($_POST["verzeichnis"]);
//Datei validieren
$datei = validateForm($_POST["datei"]);
//File bauen
$file = '/var/www/html/Arbeitszeit/Uploads/' . $verzeichnis . '/' . $datei;
//Asugeben
echo $file;
//Testen ob existiert + bei Erfolg der Download
if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
    //Protokoll Download Erflog
    downupdir('Download Erfolg!',$file);
} else {
    //Protokoll Download Fail
    downupdir('Download Fail!', $file);
}
//Verbindung beenden
mysqli_close($_SESSION['con']);
//Crsf-Token erneuern
regenerateSession();
//Zum Menü
header("Location: Menu.php");
exit();
?>
</body>
</html>
