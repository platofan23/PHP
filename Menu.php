<?php
//Whitelist prüfen, ob die Webseiten vorhanden und in der Whitelist sind
$availablePages = array('header.php');
if (file_exists('header.php') and in_array('header.php', $availablePages)) {
	//Nachladen der Dateien
	require 'header.php';
}
?>
<!-- Menü anzeigen -->
<div class="form">
	<div class="menuZeigen">
		<p>
			<a href="Anzeigen.php">Datenbank anzeigen</a>
			<p>
				<a href="Aendern.php">Datenbank ändern</a>
				<p>
					<a href="Eintragen.php">Datenbank eintragen</a>
					<p>
						<a href="Suchen.php">Datenbank suchen</a>
						<p>
							<a href="Dir_Anzeigen.php">Directory</a>
							<p>
								<a href="Upload.php">Upload</a>
								<p>
									<a href="Download.php">Download</a>
	</div>
</div>
</div>
</body>
</html>