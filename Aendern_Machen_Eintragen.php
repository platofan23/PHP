<?php
//Whitelist prüfen, ob die Webseiten vorhanden und in der Whitelist sind
$availablePages = array('header.php', 'Aufgabe.php');
if (file_exists('header.php') and in_array('header.php', $availablePages) and file_exists('Aufgabe.php') and in_array('Aufgabe.php', $availablePages)) {
	//Nachladen der Dateien
	require 'header.php';
	require 'Aufgabe.php';
}
//Methode Prüfung des Crsf-Tokens gegen Cross-Site-Script-Reforgery d.h. man kann nicht einfach Skripte in der Adresszeile des Browser ausführen
//Die Eingaben werden gleich mit validiert
crsfValidate(validateForm($_POST['_csrf_token'] ?? null), validateForm($_POST['token'] ?? null));
//Methode Prüfung ob das Feld vorher im Formular leer ist, sonst wird man als Bot aussortiert
//Auch wird das Datum abeprüft und die Werte werden validiert
noBot(validateForm($_POST['bot']), $_POST['result'], $_POST['aufgabe']);
//Suchen und Werte validieren
validateSearch($_POST["Datum"], 'Datum');
$Datum = validateFormDatenbank($_POST["Datum"]);
validateSearch($_POST["AnzahlStunden"], 'AnzahlStunden');
$AnzahlStunden = validateFormDatenbank($_POST["AnzahlStunden"]);
validateSearch($_POST["Anfang"], 'Anfang');
$Anfang = validateFormDatenbankZeit($_POST["Anfang"]);
validateSearch($_POST["Ende"], 'Ende');
$Ende = validateFormDatenbankZeit($_POST["Ende"]);
//Verbindungsaufbau zum Datenbankserver
if ($_SESSION['con']->connect_error) {
	//Zum Menü
	header("Location: Menu.php");
	exit();
} else {
	//SQL-Anweisung als Prepare-Statement
	$sql = $_SESSION['con']->prepare("update arbeitszeit set
		AnzahlStunden=?,
		Anfang=?,
		Ende=?
		WHERE Datum = ?;");
	//Wert binden
	$sql->bind_param("isss", $AnzahlStunden, $Anfang, $Ende, $Datum);
	//Ausführen
	$sql->execute();
	//Prepared Statement beenden
	$sql->close();
	//Verbindung beenden
	mysqli_close($_SESSION['con']);
}
//Crsf-Token erneuern
regenerateSession();
//Zum Menü
header("Location: Menu.php");
exit();
?>
</body>
</html>