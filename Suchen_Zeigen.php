<?php
//Whitelist prüfen, ob die Webseiten vorhanden und in der Whitelist sind
$availablePages = array('header.php', 'Aufgabe.php');
if (file_exists('header.php') and in_array('header.php', $availablePages) and file_exists('Aufgabe.php') and in_array('Aufgabe.php', $availablePages)) {
	//Nachladen der Dateien
	require 'header.php';
	require 'Aufgabe.php';
}
?>
<div class="wrapperTabelle">
	<?php
	//Methode Prüfung des Crsf-Tokens gegen cross-site-script-reforgery d.h. man kann nicht einfach Skripte in der Adresszeile des Browser ausführen
	//Die Eingaben werden gleich mit validiert
	crsfValidate(validateForm($_POST['_csrf_token'] ?? null), validateForm($_POST['token'] ?? null));
	//Methode Prüfung ob das Feld vorher im Formular leer ist, sonst wird man als Bot aussortiert
	//Auch wird das Datum abeprüft und die Werte werden validiert
	noBot(validateForm($_POST['bot']), $_POST['result'], $_POST['aufgabe']);
	//Suche validieren
	validateSearch($_POST["input"], $_POST["ausgabe"]);
	$radiobutton = validateFormDatenbank($_POST["ausgabe"]);
	$input = validateFormDatenbank($_POST["input"]);
	//Verbindungsaufbau zum Datenbankserver
	if ($_SESSION['con']->connect_error) {
		die("Fail" . $_SESSION['con']->connect_error);
	} else {
		//SQL-Anweisung als Prepare-Statement
		$sql = $_SESSION['con']->prepare("SELECT * FROM arbeitszeit where $radiobutton=?");
		//Wert binden
		$sql->bind_param("s", $input);
		//Ausführen
		$sql->execute();
		//result bekommen
		$result = $sql->get_result();
		$finfo = $result->fetch_fields();
		//Prepared-Statement beenden
		$sql->close();
	}
	regenerateSession();
	?>
	<!--Ausgabe als Tabelle -->
	<div class="divTable">
		<!--Ausgabe als Kopfzeile -->
		<div class="headRow">
			<?php foreach ($finfo as $val) : ?>
				<div class="divCell"><?= $val->name ?></div>
			<?php endforeach; ?>
		</div>
		<!--Ausgabe als Tabellenkörper -->
		<?php while ($row = mysqli_fetch_assoc($result)) : ?>
			<div class="divRow">
				<?php foreach ($row as $value) : ?>
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