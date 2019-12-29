<?php
//Funktion definieren
function validateFormDatenbank($arg)
{
    //Schauen ob leer oder nicht
    if (!isset($arg)) {
        //Protkollieren Wert leer
        fehlerhafeEingabe('Variablen leer', $arg);
        //Zum Login
        header("Location: Login.php");
        exit();
    } else {
        //Escape String
        $arg = mysqli_real_escape_string($_SESSION['con'], $arg);
        //Trim
        $arg = trim($arg);
        //HTML-Tags entfernen
        $arg = strip_tags($arg);
        //Sonderzeichen entfernen
        $arg = htmlentities($arg);
        //Slashes entfernen
        $arg = stripslashes($arg);
        //Filtern auf Code
        $arg = filter_var($arg, FILTER_SANITIZE_ENCODED);
        //String filter
        $arg = filter_var($arg, FILTER_SANITIZE_STRING);
        //Sonderzeichen Filter
        $arg = filter_var($arg, FILTER_SANITIZE_SPECIAL_CHARS);
        //Sonderzeichen Filter
        $arg = filter_var($arg, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //Auf Spam testen
        validateSpam($arg);
        //Rückgabe
        return $arg;
    }
}
//Funktion definieren
function validateFormDatenbankZeit($arg)
{
    //Schauen ob leer oder nicht
    if (!isset($arg)) {
        //Protkollieren Wert leer
        fehlerhafeEingabe('Variablen leer', $arg);
        //Zum Login
        header("Location: Login.php");
        exit();
    } else {
        //Escape String
        $arg = mysqli_real_escape_string($_SESSION['con'], $arg);
        //Trim
        $arg = trim($arg);
        //HTML-Tags entfernen
        $arg = strip_tags($arg);
        //Sonderzeichen entfernen
        $arg = htmlentities($arg);
        //Slashes entfernen
        $arg = stripslashes($arg);
        //String filter
        $arg = filter_var($arg, FILTER_SANITIZE_STRING);
        //Sonderzeichen Filter
        $arg = filter_var($arg, FILTER_SANITIZE_SPECIAL_CHARS);
        //Sonderzeichen Filter
        $arg = filter_var($arg, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //Auf Spam testen
        validateSpam($arg);
        //Rückgabe
        return $arg;
    }
}
//Funktion definieren
function validateSpam($text)
{   //Alle Blacklists
    $blacklists = array(
        'blacklist-misc.txt',
        'blacklist-medication.txt',
        'blacklist-gambling.txt',
        'blacklist-hosting.txt',
        'blacklist-injection.txt',
        'blacklist-merchandise.txt',
        'blacklist-polish.txt',
        'blacklist-services.txt',
        'blacklist-software.txt',
        'blacklist-trading.txt',
        'blacklist-urls.txt'
    );
    //Filter Klasse
    $filter = new SpamFilter($blacklists);
    //Checken ob Spam oder nicht
    $result = $filter->check_text($text);
    //Wer prüfen
    if ($result) {
        //Spam protokollieren
        zeitSpam('Spam', $text);
        //Zum Login
        header("Location: Login.php");
        exit();
    }
}
//Funktion definieren
function validateForm($arg)
{
    if (!isset($arg)) {
         //Schauen ob leer oder nicht
        fehlerhafteingabe('Variablen leer', $arg);
        //Zum Login
        header("Location: Login.php");
        exit();
    } else {
        //Trim
        $arg = trim($arg);
        //HTML-Tags entfernen
        $arg = strip_tags($arg);
        //Sonderzeichen entfernen
        $arg = htmlentities($arg);
        //Slashes entfernen
        $arg = stripslashes($arg);
        //String filter
        $arg = filter_var($arg, FILTER_SANITIZE_STRING);
        //Sonderzeichen Filter
        $arg = filter_var($arg, FILTER_SANITIZE_SPECIAL_CHARS);
        //Sonderzeichen Filter
        $arg = filter_var($arg, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //Auf Spam testen
        validateSpam($arg);
        //Rückgabe
        return $arg;
    }
}
//Funktion definieren
function validateDate($date, $format = 'Y-m-d')
{   //Datum erzeugen
    $d = DateTime::createFromFormat($format, $date);
    //auf Spam testen
    validateSpam($date);
    //Rückgabe wenn format des Datums stimmt
    return $d && $d->format($format) === $date;
}
//Funktion definieren
function valiDatum($date)
{   //Prüfen Datum
    if (!validateDate($date, $format = 'Y-m-d')) {
        //Protokollieren Fehlerhaftes Datum
        fehlerhafeEingabe('Fehlerhaftes Datum', $date);
        //Zum Menü
        header("Location: Menu.php");
        exit();
    }
    //Spam prüfem
    validateSpam($date);
}
//Funktion definieren
function valEmail($email)
{
    //Email filtern
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    //Prüfen Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         //Protokollieren Fehlerhafte Email
        fehlerhafeEingabe('Ungültige Email-Adresse', $email);
        //Zum Menü
        header("Location: Menu.php");
        exit();
    }
    validateSpam($email);
    return $email;
}
//Funktion definieren
function valiTime($time)
{
    //Zeit-Format
    $format = "H:i";
    //zeit erstellen
    $d = DateTime::createFromFormat("Y-m-d $format", "2017-12-01 $time");
    //auf Spam testen
    validateSpam($time);
    //Rückgabe ob das Format der Zeit stimmt
    return $d && $d->format($format) == $time;
}
//Funktion definieren
function validateNumber($arg)
{   
    //Prüfen, ob der Wert numerisch ist
    if (!is_numeric($arg)) {
        //Protokollieren keine Nummer
        fehlerhafeEingabe('Keine Nummer', $arg);
        //Zum Login
        header("Location: Menu.php");
        exit();
    }
    validateSpam($arg);
}
//Funktion definieren
function validateSearch($suche, $kategorie)
{   //Kategorie herausfinden
    if ($kategorie == 'Datum') {
        //Datum validieren
        valiDatum($suche);
    }
    //Kategorie herausfinden
    if ($kategorie == 'AnzahlStunden') {
        //Nummer validieren
        validateNumber($suche);
    }
    //Kategorie herausfinden
    if ($kategorie == 'Anfang') {
        //Zeit validieren
        if (!valiTime($suche)) {
            fehlerhafeEingabe('Keine Zeit', $suche);
        }
    }
    //Kategorie herausfinden
    if ($kategorie == '$Ende') {
        //Zeit validieren
        if (!valiTime($suche)) {
            fehlerhafeEingabe('Keine Zeit', $suche);
        }
    }
    //Auf Spam testen
    validateSpam($suche);
}
//Funktion definieren
function erstellePasswort($password)
{
    //Großbuchstaben vorhanden?
    $uppercase = preg_match('@[A-Z]@', $password);
    //Kleinbuchstaben vorhanden?
    $lowercase = preg_match('@[a-z]@', $password);
    //Nummern vorhanden?
    $number    = preg_match('@[0-9]@', $password);
    //Sonderzeichen vorhanden?
    $specialChars = preg_match('@[^\w]@', $password);
    //Prüfen ob alle Bedingunen vorhanden sind
    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 16) {
        return false;
    } else {
        return true;
    }
}
//Funktion definieren
function noBot($field, $result, $aufgabe)
{    //Schauen ob leer oder nicht
    if (!isset($field)) {
        //Bot gefunden protokollieren
        Botgefunden("Feld ausgefüllt");
        //Zum Login
        header("Location: Login.php");
        exit();
    } else {
        //Auf Spam testen
        noSpam(validateForm($result));
        //Aufgabe überprüfen
        spamProtect(validateForm($aufgabe));
    }
}
//Funktion definieren
function noBotLogin($field,  $result)
{    //Schauen ob leer oder nicht
    if (!isset($field)) {
        //Zum Login
        header("Location: Login.php");
        exit();
    } else {
        //Auf Spam testen
        noSpam(validateForm($result));
    }
}
//Funktion definieren
function noSpam($date)
{   
    //Datum definieren
    $Datum = date('Y-m-d');
    //Datum überprüfen
    if ($Datum != $date) {
        Botgefunden('Datum in Form falsch');
        header("Location: Login.php");
        exit();
    }
}
//Funktion definieren
function spamProtect($aufgabe)
{   //Zeitdifferenz
    $diff2 = time() - $_SESSION['spamprotect_time2'];
    //Unter 15 Sekunden
    if (15 > $diff2) {
        //Protokollieren zu Schnell
        zeitSpam('Zu schnell unter 15 Sekunden!', $diff2);
        //Zum Menü
        header("Location: Menu.php");
        exit();
    }
    //Zeitdifferenz
    $diff = time() - $_SESSION['spamprotect_time'];
    //Erhöhen
    $_SESSION['spamprotect_count']++;
    //Erhöhung reinschreiben
    $count = $_SESSION['spamprotect_count'];
    //Unter 30 Sekunden
    if (($diff / $count) < 15) {
         //Protokollieren zu Schnell
        zeitSpam('Zu schnell unter 15 Sekunden!', $diff / $count);
        //Zum Menü
        header("Location: Menu.php");
        exit();
    }
    //Aufgabe überprüfen
    aufgabe($aufgabe);
}
//Funktion definieren
function aufgabe($var)
{
    $var = validateForm($var);
    //Aufgabe überprüfen
    if (empty($var) or (!empty($var) && $var != $_SESSION['result'])) {
        //Fehlerhafte Aufgabe protokollieren
        fehlerhafeEingabe('Aufgabe Ungültig', $var);
        //Zum Menü
        header("Location: Menu.php");
        exit();
    }
}
