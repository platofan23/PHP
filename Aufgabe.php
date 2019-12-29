<?php
//Funktion definieren
function gebeAufgabe() {
//Aktuelle Zeit in Session speichern
$_SESSION['spamprotect_time2'] = time();
//Aufgaben
$aufg=array(
array('Zwölf plus Zwei',14),
array('Zehn minus Fünf',5),
array('Vierzehn geteilt durch Zwei',7)
);
//Über Zufallszahl die Aufgabe bestimmen
$max = count($aufg) - 1;
$i = rand(0, $max);
$aufgabe = $aufg[$i][0];
$result = $aufg[$i][1];
//Ergebnis Aufgabe in Session speichern
$_SESSION['result'] = $result;
//Zurückgeben
return $aufgabe;
}
?>