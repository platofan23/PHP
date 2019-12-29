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
$groeßteID = 0;
$userBool = FALSE;
//Verbindungsaufbau zum Datenbankserver
if ($_SESSION['con']->connect_error) {
	header("Location: Menu.php");
exit();
} else {
	//SQL-Anweisung als Prepare-Statement
	$sql = $_SESSION['con']->prepare("SELECT Datum FROM arbeitszeit;");
	//Ausführen
	$sql->execute();
	//Wert binden
	$sql->bind_result($Date);
	//Suche validieren
	validateSearch($_POST["Datum"], 'Datum');
	//Datum validieren
	$Datum = validateFormDatenbank($_POST["Datum"]);
	//Läuft solange wie viele Werte aus der Datenbank kommen
	while ($sql->fetch()) {
		//Prüfung ob die ID vorhanden ist, wenn ja ist das Datum vorhanden und man kann es ändern
		$ID = $Date;
		if ($ID == $Datum) {
			$userBool = TRUE;
		}
	}
	//Prepared-Statement beenden
	$sql->close();
	//Prüfen ob die Prüfung aufs Datum true ist
	if ($userBool == true) {
		//Datum validieren
		$usrID = validateFormDatenbank($_POST["Datum"]);
		//Verbindungsaufbau
		if ($_SESSION['con']->connect_error) {
			//Zum Menü
			header("Location: Menu.php");
			exit();
		} else {
			//SQL-Anweisung
			$sql = $_SESSION['con']->prepare("SELECT * FROM arbeitszeit WHERE Datum=?");
			//Wert binden
			$sql->bind_param("s", $usrID);
			//Ausführen
			$sql->execute();
			//Result binden
			$sql->bind_result($Datum1, $AnzahlStunden1, $Anfang1, $Ende1);
			//Läuft solange es Werte gibt
			while ($sql->fetch()) {
				$Datum = $Datum1;
				$AnzahlStunden = $AnzahlStunden1;
				$Anfang = $Anfang1;
				$Ende = $Ende1;
			}
			//Prepared-Statement beenden
			$sql->close();
			//Verbindung beenden
			mysqli_close($_SESSION['con']);
		}
		//Wenn die Prüfung falsch war zum Menü zurück
	} else {
		header("Location: Menu.php");
		//Programm beenden
		exit();
	}
	//Crsf-Token erneuern
	regenerateSession();
}
?>
<!-- Formular mit Aktion zur Änderung eintragen -->
<form method="post" action="Aendern_Machen_Eintragen.php" style="background-color:white;">
	<!-- Div zum stylen -->
	<div class="row">
		<div class="col-25">
			<label for="fname">Datum</label>
		</div>
		<div class="col-75">
			<input name="Datum" type="date" value="<?php echo $Datum ?>">
		</div>
	</div>
	<div class="row">
		<div class="col-25">
			<label for="fname">Anzahl Stunden</label>
		</div>
		<div class="col-75">
			<!-- Werte, die vorhanden waren werden in die Inputs geschrieben -->
			<input name="AnzahlStunden" type="double" required value="<?php echo $AnzahlStunden ?>">
		</div>
	</div>
	<div class="row">
		<div class="col-25">
			<label for="fname">Anfang</label>
		</div>
		<div class="col-75">
			<!-- Werte die vorhanden waren werden in die Inputs geschrieben -->
			<input name="Anfang" type="time" required value="<?php echo $Anfang ?>">
		</div>
	</div>
	<div class="row">
		<div class="col-25">
			<label for="fname">Ende</label>
		</div>
		<div class="col-75">
			<!-- Werte die vorhanden waren werden in die Inputs geschrieben -->
			<input name="Ende" type="time" required value="<?php echo $Ende ?>">
		</div>
	</div>
	<div class="row">
		<div class="col-25">
			<label for="fname">Aktuelles Datum</label>
		</div>
		<div class="col-75">
			<!-- Feld zur Eingabe aktuelles Datum zur Überprüfung, dass man kein Bot ist -->
			<input type="text" name="result" value="" required />
		</div>
	</div>
	<div class="row">
		<div class="col-25">
			<label for="fname">Aufgabe </label>
		</div>
		<div class="col-75">
			<!-- Rechenaufgabe anzeigen -->
			<?= gebeAufgabe(); ?><input type="text" name="aufgabe" value="" required />
		</div>
	</div>
	<div class="row">
		<!-- Submit-Button -->
		<input type="submit" value="OK">
	</div>
	<!-- Crsf-Token normal -->
	<input type="hidden" name="_csrf_token" value="<?php echo $_SESSION['_csrf_token']; ?>">
	<!-- Crsf-Token gehasht -->
	<input type="hidden" name="token" value="<?php echo $_SESSION['hash']; ?>">
	<!-- Feld muss leer bleiben, sonst wird man als Bot aussortiert -->
	<input type="hidden" name="bot">
</form>
</body>
</html>