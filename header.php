<?php
//Whitelist prüfen, ob die Webseiten vorhanden und in der Whitelist sind
$availablePages = array('SessionSafe.php', 'Funktion_Crsf.php', 'Funktion_Datenbank.php', 'Funktion_Session.php', 'Funktion_Validate.php', 'DB.php', 'SpamFilter.php');
if ((file_exists('SessionSafe.php') and in_array('SessionSafe.php', $availablePages))
  and (file_exists('Funktion_Crsf.php') and in_array('Funktion_Crsf.php', $availablePages))
  and (file_exists('Funktion_Datenbank.php') and in_array('Funktion_Datenbank.php', $availablePages))
  and (file_exists('Funktion_Session.php') and in_array('Funktion_Session.php', $availablePages))
  and (file_exists('Funktion_Validate.php') and in_array('Funktion_Validate.php', $availablePages))
  and (file_exists('DB.php') and in_array('DB.php', $availablePages))
  and (file_exists('SpamFilter.php') and in_array('SpamFilter.php', $availablePages))
) {
  //Einbinden der Dateien
  include 'SessionSafe.php';
  include 'Funktion_Crsf.php';
  include 'Funktion_Datenbank.php';
  include 'Funktion_Session.php';
  include 'Funktion_Validate.php';
  include 'DB.php';
  include 'SpamFilter.php';
}
//Session starten
SessionManager::sessionStart("Local", 0, "/", "localhost", false);
//Datenbankverbindung in Session speichern
$_SESSION['con'] = $con;
//Prüfen ob Session UserID ein Wert hat
if (!isset($_SESSION["userid"])) {
  //Zum Login
  header("Location: Login.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<!-- Metadaten -->
<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8" />
<head>
  <!-- Titel -->
  <title>Datenbankverwaltung</title>
  <!-- CSS Dateien -->
  <link href="CSS/Login.css" rel="stylesheet" type="text/css">
  <link href="CSS/Header.css" rel="stylesheet" type="text/css">
  <link href="CSS/Input.css" rel="stylesheet" type="text/css">
  <link href="CSS/Radiobutton.css" rel="stylesheet" type="text/css">
  <link href="CSS/Tabelle.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet2" href="https://www.w3schools.com/w3css/4/w3.css">
  <!-- Scripte -->
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
  <header>
    <div> <a class="logo" href="Menu.php">Home</a></div>
    <!-- Navigationsleiste -->
    <nav>
      <ul>
        <li><a href="Anzeigen.php">Anzeigen</a></li>
        <li><a href="PWAnzeigen.php">PWAnzeigen</a></li>
        <li><a href="Aendern.php">Ändern</a></li>
        <li><a href="Eintragen.php">Eintragen</a></li>
        <li><a href="Suchen.php">Suchen</a></li>
        <li><a href="Dir_Anzeigen.php">Directory</a></li>
        <li><a href="Upload.php">Upload</a></li>
        <li><a href="Download.php">Download</a></li>
        <li><a href="Logout.php">Logout</a></li>
        <?php if (!isset($_SESSION['userid'])) {
          echo '<li><a href="Login.php">Login</a></li>';
        } ?>
      </ul>
    </nav>
    <div class="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></div>
  </header>
  <!-- Script für Login,Register und Icon anklicken -->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.menu-toggle').click(function() {
        $('nav').toggleClass('active')
      })
      $('ul li').click(function() {
        $(this).siblings().removeClass('active');
        $(this).toggleClass('active');
      })
      $('.message a').click(function() {
        $('form').animate({
          height: "toggle",
          opacity: "toggle"
        }, "slow");
      });
    })
  </script>