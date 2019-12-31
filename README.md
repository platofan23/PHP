Im Programm sind alle Dateien zum PHP betrieb enthalten. 
Dazu gehören PHP Seiten, 
die Datenbank als Datei zum importieren,
benötigte Bilder, 
Textdateien und
Schriftarten.

Auch enhalten ist ein ChatClient, eine App mit Chat und Abholen des Einmalcodes sowie auch der Server zum Abrufen und Chatten. Hier müssen jedoch noch die Adressen eingetragen werden. Auch ist die Datenbank mit benötigten Tabellen vorhanden, die einfach importiert werden kann. Einfach downloaden, anpassen und ausführen.

Das ganze kann auf einem RPI unter Apache2 zwei laufen lassen. Wichtig ist es am Ende noch den Webserver sowie auch PHP selbst und auch Zusatzprogramme wie PHPmyadmin ausreichend abzusichern. Ein kleine Anregung sind meine Conf-Dateien und meine HTACCESS die man über Pastebin (https://pastebin.com/u/platofan23) ansehen kann. Zusätzlich gut ist ein Firewall-Programm wie UFW, den RPI aktuell zu halten, ein  SSL-Zertifikat und Benutzungsrechte mit Chmod am RPI anzupassen.
Meine Festlegungen sind:
Für .htaccess 644
Für Ordner wo niemand reinschauen soll: 700
Für PHP-Dateien: 700
Für den Upload Ordner: 755

Im das Programm bzw. die Skripte dann noch öffentlich zugänglich zu machen ist die Portfreischaltung und ein DynDns-Service unerlässlich. Anleitungen dazu findet man in Google oder YouTube.

Das Programm ist im Prinzip kann aus Datenbanktabellen lesen, in schreiben und auch Werte updaten. 
Desweiteren gibt es einen funktionierenden Dateiupload sowie Download und auch Anzeige eines Verzeichnises. 
Das ganze ist abgesichert durch eine ganze Session-Klasse (Quelle: https://blog.teamtreehouse.com/how-to-create-bulletproof-sessions), einem Captcha beim Login (Quelle: http://www-coding.de/so-gehts-eigenes-captcha-mit-php/) 
und einem Spamfilter (Quelle: https://github.com/IQAndreas/php-spam-filter). 

Die Eingaben werden validiert und überprüft. Cross-Site-Scripting, Code-Injektion und SQL-Injektionen werden ebenfalls verhindert. Desweiteren gibt es noch eine Zeitliche Überprüfung sowie auch eine Aufgaben-Verfizierung, ob man auch kein Bot ist. Der Login ist zusätzlich durch ein Einmalcode und eine Rechteprüfung abgesichert. Ab 5 Loginversuchen wird man automatisch gesperrt. Beim Registrieren wird das Passwort getestet. Beim Upload werden die Dateiarten geprüft und können nur in einen bestimmten Ordner geladen werden.

Jeder Fehlschlag wird am Ende noch in der Datenbank dokumentiert.
# Viel Spaß mit den Dateien.
