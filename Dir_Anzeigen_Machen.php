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
//Der Punkt steht für das Verzeichnis, in der auch dieses
//PHP-Programm gespeichert ist
//Validieren Ordner
$ordner = validateForm($_POST["verzeichnis"]);
//Verzeichnis vervollständigen
$verzeichnis = "/var/www/html/" . $ordner;
//Ausgeben
echo $verzeichnis;
//Liste staten
echo "<ol>";
// Test, ob es sich um ein Verzeichnis handelt
if (is_dir($verzeichnis)) {
    // öffnen des Verzeichnisses
    if ($handle = opendir($verzeichnis)) {
        //Protokoll Erfolg öffnen
        downupdir('Anzeigen Erfolg!', $verzeichnis);
        //Einlesen der Verzeichnisses
        while (($file = readdir($handle)) !== false) {
            //Ausgabe Verzeichnis
            echo "<li>Dateiname: ";
            echo $file;
            echo "</li></ul>\n";
        }
        //Schließen Verzeichnis
        closedir($handle);
    } else {
        //Protokollieren Fehler + Zurück zum Menü
        downupdir('Anzeigen Fail!', $verzeichnis);
        header("Location: Menu.php");
        exit();
    }
}
//Ende Liste
echo "</ol>";
//Verbindung beenden
mysqli_close($_SESSION['con']);
//Crsf-Token erneuern
regenerateSession();
?>
</body>
</html>
