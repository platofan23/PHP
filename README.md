 Im Programm sind alle Dateien zum PHP betrieb enthalten. 
 Dazu gehören PHP Seiten, 
die Datenbank als Datei zum importieren,
benötigte Bilder, 
Textdateien und
Schriftarten.

 Auch enhalten ist ein ChatClient, eine App mit Chat und Abholen des Einmalcodes sowie auch der Server zum Abrufen und Chatten. Hier müssen jedoch noch die Adressen eingetragen werden. Einfach downloaden, anpassen und ausführen.

Das ganze kann auf einem RPI unter Apache2 zwei laufen lassen. Wichtig ist es am Ende noch den Webserver sowie auch PHP selbst und auch Zusatzprogramme wie PHPmyadmin ausreichend abzusichern. Ein kleine Anregung meine Conf-Dateien und meine HTACCESS die man über Pastebin (https://pastebin.com/u/platofan23) ansehen kann. Zusätzlich gut ist ein Firewall-Programm wie UFW, den RPI aktuell zu halten, ein  SSL-Zertifikat und Benutzungsrechte mit Chmod am RPI anzupassen.
Meine Festlegungen sind:

Im das Programm bzw. die Skripte dann noch öffentlich zugänglich zu machen ist die Portfreischaltung und ein DynDns-Service unerlässlich. Anleitungen dazu findet man in Google oder YouTube.

# Viel Spaß mit den Dateien.
