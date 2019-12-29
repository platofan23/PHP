<?php
$availablePages = array('header.php', 'Aufgabe.php');
if (file_exists('header.php') and in_array('header.php', $availablePages) and file_exists('Aufgabe.php') and in_array('Aufgabe.php', $availablePages)) {
	require 'header.php';
	require 'Aufgabe.php';
}
?>
<div class="wrapperFormular">
	<!-- Formular mit Aktion zur Suchen zeigen -->
	<form action="Suchen_Zeigen.php" style="background-color:white;" method="post">
		<!-- Div zum stylen -->
		<div class="row">
			<ul>
				<li>
					<input type="radio" name="ausgabe" value="Datum" id="f-option" required>
					<label for="f-option">Datum</label>
					<div class="check"></div>
				</li>
				<li>
					<input type="radio" name="ausgabe" value="AnzahlStunden" id="s-option">
					<label for="s-option">Stunden</label>
					<div class="check">
						<div class="inside"></div>
					</div>
				</li>
				<li>
					<input type="radio" name="ausgabe" value="Anfang" id="t-option">
					<label for="t-option">Anfang</label>
					<div class="check">
						<div class="inside"></div>
					</div>
				</li>
				<li>
					<input type="radio" name="ausgabe" value="Ende" id="r-option">
					<label for="r-option">Ende</label>
					<div class="check">
						<div class="inside"></div>
					</div>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-25">
				<label for="fname">Suche</label>
			</div>
			<div class="col-75">
				<input name="input" type="text" placeholder="Suchwert" required>
			</div>
		</div>
		<div class="row">
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
</div>
</body>

</html>