<?php
//Whitelist prüfen, ob die Webseiten vorhanden und in der Whitelist sind
$availablePages = array('header.php', 'Aufgabe.php');
if (file_exists('header.php') and in_array('header.php', $availablePages) and file_exists('Aufgabe.php') and in_array('Aufgabe.php', $availablePages)) {
	//Nachladen der Dateien
	require 'header.php';
	require 'Aufgabe.php';
}
?>
<!-- Formular mit Weiterleitung -->
<form method="post" action="Aendern_Machen.php" style="background-color:white;">
	<!-- Divs für das Styling des Formulars -->
	<div class="row">
		<div class="col-25">
			<label for="fname">Datum</label>
		</div>
		<div class="col-75">
			<input name="Datum" type="date" required><br>
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