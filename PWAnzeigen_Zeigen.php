<?php
//Whitelist prüfen, ob die Webseiten vorhanden und in der Whitelist sind
$availablePages = array('header.php', 'Aufgabe.php');
if (file_exists('header.php') and in_array('header.php', $availablePages) and file_exists('Aufgabe.php') and in_array('Aufgabe.php', $availablePages)) {
	//Nachladen der Dateien
	require 'header.php';
	require 'Aufgabe.php';
}
?>
<!-- Div für Tabellen -->
<div class="wrapperTabelle">
	<?php
	//Methode Prüfung des Crsf-Tokens gegen cross-site-script-reforgery d.h. man kann nicht einfach Skripte in der Adresszeile des Browser ausführen
	//Die Eingaben werden gleich mit validiert
	crsfValidate(validateForm($_POST['_csrf_token'] ?? null), validateForm($_POST['token'] ?? null));
	//Methode Prüfung ob das Feld vorher im Formular leer ist, sonst wird man als Bot aussortiert
	//Auch wird das Datum abeprüft und die Werte werden validiert
	noBot(validateForm($_POST['bot']), $_POST['result'], $_POST['aufgabe']);
	//Verbindungsaufbau zum Datenbankserver
	if ($_SESSION['con']->connect_error) {
		//Zum Menü
		header("Location: Menu.php");
		exit();
	} else {
		//Sortierwert validieren
		$sortieren = validateFormDatenbank($_POST["ausgabe"]);
		//SQL-Anweisung als Prepare-Statement
		$sql = $_SESSION['con']->prepare("SELECT * FROM passwoerter ORDER BY (?);");
		//Werte binden
		$sql->bind_param("s", $sortieren);
		//Ausführen
		$sql->execute();
		//Result bekommen
		$result = $sql->get_result();
		//result speichern
		$finfo = $result->fetch_fields();
		//Prepared-Statement beenden
		$sql->close();
	}
	//Crsf-Token erneuern
	regenerateSession();
	?>
	<!--Div für Tabelle -->
	<div class="divTable">
		<!-- Div für die Kopfzeile der Tabelle -->
		<div class="headRow">
			<!-- Ausgabe Kopfzeile durch Schleife -->
			<?php foreach ($finfo as $val) : ?>
				<!-- Div Zelle Tabelle -->
				<div class="divCell"><?= $val->name ?></div>
			<?php endforeach; ?>
		</div>
		<!-- Ausgabe Tabellenkörper -->
		<?php while ($row = mysqli_fetch_assoc($result)) : ?>
			<div class="divRow">
				<?php foreach ($row as $value) : ?>
					<!-- Div Zelle Tabelle -->
					<div class="divCell"><?= $value ?></div>
				<?php endforeach; ?>
			</div>
		<?php endwhile; ?>
	</div>
</div>
</body>
</html>
<?php
//Verbindung beenden
mysqli_close($_SESSION['con']);
?>