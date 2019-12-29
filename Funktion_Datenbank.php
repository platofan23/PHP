<?php
//Funktion definieren
function logDatenFehl($Grund)
{
    //Verbindungsaufbau zum Datenbankserver
    if ($_SESSION['con']->connect_error) {
        //Zum Login
        header("Location: Login.php");
        exit();
    } else {
        //Datum erstellen
        $Datum = date('Y-m-d H:i:s');
        //SQL-Anweisung als Prepare-Statement
        $sql = $_SESSION['con']->prepare("INSERT INTO loginfe (DatumZeit,Benutzer,IPAdresse,Grund) VALUES (?,?,?,?)");
        //Werte binden
        $sql->bind_param("ssss", $Datum, $_SESSION['user'], $_SESSION['IP'], $Grund);
        //Ausführen
        $sql->execute();
        //Prepared-Statement beenden
        $sql->close();
        //Fehlversuche Logins in Datenbank erhöhen
        erhoeheFehl();
    }
}
//Funktion definieren
function logDatenErfolg($Grund)
{
    //Verbindungsaufbau zum Datenbankserver
    if ($_SESSION['con']->connect_error) {
        //Zum Login
        header("Location: Login.php");
        exit();
    } else {
        //Datum erstellen
        $Datum = date('Y-m-d H:i:s');
        //SQL-Anweisung als Prepare-Statement
        $sql = $_SESSION['con']->prepare("INSERT INTO loginer (DatumZeit,Benutzer,IPAdresse,Grund) VALUES (?,?,?,?)");
        //Werte binden
        $sql->bind_param("ssss", $Datum, $_SESSION['user'], $_SESSION['IP'], $Grund);
        //Ausführen
        $sql->execute();
        //Prepared-Statement beenden
        $sql->close();
    }
}
//Funktion definieren
function regDatenFehl($Grund)
{
    //Verbindungsaufbau zum Datenbankserver
    if ($_SESSION['con']->connect_error) {
        //Zum Login
        header("Location: Login.php");
        exit();
    } else {
        $Datum = date('Y-m-d H:i:s');
        //SQL-Anweisung als Prepare-Statement
        $sql = $_SESSION['con']->prepare("INSERT INTO registerfe (DatumZeit,Benutzer,IPAdresse,Grund) VALUES (?,?,?,?)");
        //Werte binden
        $sql->bind_param("ssss", $Datum, $_SESSION['user'], $_SESSION['IP'], $Grund);
        //Ausführen
        $sql->execute();
        //Prepared-Statement beenden
        $sql->close();
    }
}
//Funktion definieren
function regDatenErfolg($Grund)
{
    //Verbindungsaufbau zum Datenbankserver
    if ($_SESSION['con']->connect_error) {
        //Zum Login
        header("Location: Login.php");
        exit();
    } else {
        //Datum erstellen
        $Datum = date('Y-m-d H:i:s');
        //SQL-Anweisung als Prepare-Statement
        $sql = $_SESSION['con']->prepare("INSERT INTO registerer (DatumZeit,Benutzer,IPAdresse,Grund) VALUES (?,?,?,?)");
        //Werte binden
        $sql->bind_param("ssss", $Datum, $_SESSION['user'], $_SESSION['IP'], $Grund);
        //Ausführen
        $sql->execute();
        //Prepared-Statement beenden
        $sql->close();
    }
}
//Funktion definieren
function CRSFFail($token)
{
    //Verbindungsaufbau zum Datenbankserver
    if ($_SESSION['con']->connect_error) {
        //Zum menü
        header("Location: Menu.php");
        exit();
    } else {
        $Grund = 'Falsches CRSF-Token';
        $Datum = date('Y-m-d H:i:s');
        //SQL-Anweisung als Prepare-Statement
        $sql = $_SESSION['con']->prepare("INSERT INTO crsffe (DatumZeit,Benutzer,IPAdresse,Grund,Token) VALUES (?,?,?,?,?)");
        //Werte binden
        $sql->bind_param("sssss", $Datum, $_SESSION['user'], $_SESSION['IP'], $Grund, $token);
        //Ausführen
        $sql->execute();
        //Prepared-Statement beenden
        $sql->close();
    }
}
//Funktion definieren
function CRSFErfolg($token)
{
    //Verbindungsaufbau zum Datenbankserver
    if ($_SESSION['con']->connect_error) {
        //Zum Menü
        header("Location: Menu.php");
        exit();
    } else {
        $Grund = 'Richtiges CRSF-Token';
        //Datum erstellen
        $Datum = date('Y-m-d H:i:s');
        //SQL-Anweisung als Prepare-Statement
        $sql = $_SESSION['con']->prepare("INSERT INTO crsfef (DatumZeit,Benutzer,IPAdresse,Grund,Token) VALUES (?,?,?,?,?)");
        //Werte binden
        $sql->bind_param("sssss", $Datum, $_SESSION['user'], $_SESSION['IP'], $Grund, $token);
        //Ausführen
        $sql->execute();
        //Prepared-Statement beenden
        $sql->close();
    }
}
//Funktion definieren
function Botgefunden($Grund)
{
    //Verbindungsaufbau zum Datenbankserver
    if ($_SESSION['con']->connect_error) {
        //Zum Login
        header("Location: Login.php");
        exit();
    } else {
        //Datum erstellen
        $Datum = date('Y-m-d H:i:s');
        //SQL-Anweisung als Prepare-Statement
        $sql = $_SESSION['con']->prepare("INSERT INTO bot (DatumZeit,Benutzer,IPAdresse,Grund) VALUES (?,?,?,?)");
        //Werte binden
        $sql->bind_param("ssss", $Datum, $_SESSION['user'], $_SESSION['IP'], $Grund);
        //Ausführen
        $sql->execute();
        //Prepared-Statement beenden
        $sql->close();
    }
}
//Funktion definieren
function fehlerhafeEingabe($Grund, $Eingabe)
{
    //Verbindungsaufbau zum Datenbankserver
    if ($_SESSION['con']->connect_error) {
        //Zum menü
        header("Location: Menu.php");
        exit();
    } else {
        //Datum erstellen
        $Datum = date('Y-m-d H:i:s');
        //SQL-Anweisung als Prepare-Statement
        $sql = $_SESSION['con']->prepare("INSERT INTO fehlerhafteingabe (DatumZeit,Benutzer,IPAdresse,Grund,Eingabe) VALUES (?,?,?,?,?)");
        //Werte binden
        $sql->bind_param("sssss", $Datum, $_SESSION['user'], $_SESSION['IP'], $Grund, $Eingabe);
        //Ausführen
        $sql->execute();
        //Prepared-Statement beenden
        $sql->close();
    }
}
//Funktion definieren
function zeitSpam($Grund, $Eingabe)
{
    //Verbindungsaufbau zum Datenbankserver
    if ($_SESSION['con']->connect_error) {
        //Zum Menü
        header("Location: Menu.php");
        exit();
    } else {
        //Datum erstellen
        $Datum = date('Y-m-d H:i:s');
        //SQL-Anweisung als Prepare-Statement
        $sql = $_SESSION['con']->prepare("INSERT INTO zeitspam (DatumZeit,Benutzer,IPAdresse,Grund,Eingabe) VALUES (?,?,?,?,?)");
        //Werte binden
        $sql->bind_param("sssss", $Datum, $_SESSION['user'], $_SESSION['IP'], $Grund, $Eingabe);
        //Ausführen
        $sql->execute();
        //Prepared-Statement beenden
        $sql->close();
    }
}
//Funktion definieren
function fehlLogin()
{
    //Verbindungsaufbau zum Datenbankserver
    if ($_SESSION['con']->connect_error) {
        //Zum Login
        header("Location: Login.php");
        exit();
    } else {
        $FehlVersuche = 0;
        //SQL-Anweisung als Prepare-Statement
        $sql = $_SESSION['con']->prepare("SELECT FehlgeschlageneVersuche  FROM benutzer where Benutzername= ?");
        //Werte binden
        $sql->bind_param("s", $_SESSION['user']);
        //Ausführen
        $sql->execute();
        //Result binden
        $sql->bind_result($FehlVersuche);
        //Reinschreiben
        $sql->fetch();
        //Prepared-Statement beenden
        $sql->close();
        //Schauen ob Fehlversuche kleiner als 5 sind
        if ($FehlVersuche >= 5) {
            //Protokollieren zu viele Fehlversuche
            logDatenFehl($_SESSION['user'], $_SESSION['IP'], 'Zu viele Fehlversuche!');
            //Zum Login
            header('Location: Login.php');
            exit();
        }
    }
}
//Funktion definieren
function erhoeheFehl()
{
    //Verbindungsaufbau zum Datenbankserver
    $versuche = 0;
    $FehlVersuche = 0;
    if ($_SESSION['con']->connect_error) {
        //Zum Login
        header("Location: Login.php");
        exit();
    } else {
        //SQL-Anweisung als Prepare-Statement
        $sql = $_SESSION['con']->prepare("SELECT FehlgeschlageneVersuche FROM benutzer where Benutzername=?");
        //Werte binden
        $sql->bind_param("s", $_SESSION['user']);
        //Ausführen
        $sql->execute();
        //Result binden
        $sql->bind_result($FehlVersuche);
        $sql->fetch();
        //Prepared-Statement beenden
        $sql->close();
        //versuche um 1 erhöhen
        $versuche = $FehlVersuche + 1;
    }
    if ($_SESSION['con']->connect_error) {
        header("Location: Login.php");
        exit();
    } else {
        //SQL-Anweisung als Prepare-Statement
        $sql = $_SESSION['con']->prepare("UPDATE benutzer set FehlgeschlageneVersuche = ? where Benutzername =?");
        //Werte binden
        $sql->bind_param("is", $versuche, $_SESSION['user']);
        //Ausführen
        $sql->execute();
        //Prepared-Statement beenden
        $sql->close();
    }
}
//Funktion definieren
function resetFehl()
{
    //Verbindungsaufbau zum Datenbankserver
    if ($_SESSION['con']->connect_error) {
        //Zum Login
        header("Location: Login.php");
        exit();
    } else {
        //SQL-Anweisung als Prepare-Statement
        $sql = $_SESSION['con']->prepare("UPDATE benutzer set FehlgeschlageneVersuche = 0 where Benutzername = ?");
        //Werte binden
        $sql->bind_param("s", $_SESSION['user']);
        //Ausführen
        $sql->execute();
        //Prepared-Statement beenden
        $sql->close();
    }
}
//Funktion definieren
function einmalCodeErzeugen()
{
    $code = bin2hex(random_bytes(8));
    //Verbindungsaufbau zum Datenbankserver
    if ($_SESSION['con']->connect_error) {
        //Zum Menü
        header("Location: Menu.php");
        exit();
    } else {
        //SQL-Anweisung als Prepare-Statement
        $sql = $_SESSION['con']->prepare("UPDATE benutzer set  EinCode = ? where Benutzername = ?");
        //Werte binden
        $sql->bind_param("ss", $code, $_SESSION['user']);
        //Ausführen
        $sql->execute();
        //Prepared-Statement beenden
        $sql->close();
    }
}
//Funktion definieren
function einmalCodePrüfen($code)
{
    $Ergebnisse = " ";
    $Back = " ";
    $bool = false;
    //Verbindungsaufbau zum Datenbankserver
    if ($_SESSION['con']->connect_error) {
        //Zum Login
        header("Location: Login.php");
        exit();
    } else {
        //SQL-Anweisung als Prepare-Statement
        $sql = $_SESSION['con']->prepare("SELECT EinCode FROM benutzer where Benutzername= ?");
        //Werte binden
        $sql->bind_param("s", $_SESSION['user']);
        //Ausführen
        $sql->execute();
        //Result binden
        $sql->bind_result($Ergebnisse);
        //Reinschreiben
        $sql->fetch();
        //Prepared-Statement beenden
        $sql->close();
        //Wert umschreiben
        $Back = $Ergebnisse;
    }
    //Testen ob Code stimmt
    if ($Back === $code) {
        $bool = true;
    } else {
        $bool = false;
    }
    //zrückgeben
    return $bool;
}
//Funktion definieren
function downupdir($Grund, $verzeichnis)
{
    //Verbindungsaufbau zum Datenbankserver
    if ($_SESSION['con']->connect_error) {
        //Zum Menü
        header("Location: Menu.php");
        exit();
    } else {
        //Datum erstellen
        $Datum = date('Y-m-d H:i:s');
        //SQL-Anweisung als Prepare-Statement
        $sql = $_SESSION['con']->prepare("INSERT INTO downupdir (DatumZeit,Benutzer,IPAdresse,Grund,Verzeichnis_Datei) VALUES (?,?,?,?,?)");
        //Werte binden
        $sql->bind_param("sssss", $Datum, $_SESSION['user'], $_SESSION['IP'], $Grund, $verzeichnis);
        //Ausführen
        $sql->execute();
        //Prepared-Statement beenden
        $sql->close();
    }
}
