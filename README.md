Installation:
###############

-> Im Ordner "include" die Datei "config.php" anpassen.
-> Im Ordner "include" die Datei "mail_config.php" anpassen.

-> Die Datei "cron.sh" die Rechte 777 geben.
-> Die Datei "backup_cron.sh" die Rechte 777 geben.
-> Die Datei "erinnerung.sh" die Rechte 777 geben.
-> Die Datei "maxclients.sh" die Rechte 777 geben.

-> Im Ordner "include" die Datei "config.php" die Rechte 777 geben.
-> Im Ordner "include" die Datei "mail_config.php" die Rechte 777 geben.
-> Den Ordner "backup" die Rechte 777 geben.

-> Die Datei "install.php" im Browser aufrufen.

-> Geben Sie bei "Admin Username" Ihren gewünschten Benutzername ein.
-> Bei "Admin Passwort" müssen Sie Ihr gewünschtes Passwort eingeben.
-> Ihre E-Mail müssen Sie im Feld "Admin E-Mail" eingeben.

-> Nun klicken Sie auf den Button "Installieren".

-> Löschen Sie die Dateien "install.php" und "install.sql".

= >  F E R T I G   I S T   D I E   I N S T A L L A T I O N  < =


--------------------------------------------------



Konfiguration - Stunden / Minuten:
####################
1. ändern von $allg['zeit_angabe'] = 2; //1 = Minuten, 2 = Stunden
2. Die Zeit Angaben in folgenden Variablen in Stunden:

$allg['zeit_schritt'] = 1; // Abstand zwischen den Zeit-auswahl Menu
$allg['zeit_min'] = 1; // Minimal auswaehlbare Zeit
$allg['zeit_max'] = 4; // Maximal auswaehlbare Zeit

$allg['laenger_zeit_schritt'] = 1;// Abstand zwischen den Verlaengerungs-auswahl Menu
$allg['laenger_zeit_min'] = 1; // Minimal auswaehlbare Zeit bei verlaengerung
$allg['laenger_zeit_max'] = 2; // Maximal auswaehlbare Zeit bei verlaengerung

Oder für Minuten:

$allg['zeit_schritt'] = 30; // Abstand zwischen den Zeit-auswahl Menu
$allg['zeit_min'] = 30; // Minimal auswaehlbare Zeit
$allg['zeit_max'] = 180; // Maximal auswaehlbare Zeit

$allg['laenger_zeit_schritt'] = 30;// Abstand zwischen den Verlaengerungs-auswahl Menu
$allg['laenger_zeit_min'] = 30; // Minimal auswaehlbare Zeit bei verlaengerung
$allg['laenger_zeit_max'] = 60; // Maximal auswaehlbare Zeit bei verlaengerung

--------------------------------------------------

Design bearbeiten:
####################

Das Design kann beliebig editiert werden!

Am Anfang der "index.php" muss folgender Code stehen:

<?php

session_start();
include ('include/mysqlcon.php');
include ('include/functions.php');
include ('include/mail_config.php');
include ('include/ts3admin.class.php');

?>


Wo der Inhalt stehen soll nutzen Sie diesen Code:


<?php

if (empty($_GET['page'])) {
    include('leih.php');
} else {
    if (file_exists($_GET['page'] . '.php')) {
        include($_GET['page'] . '.php');
    } else {
        include('leih.php');
    }
}

?>



Danke an Jan Hoffmeister für die Readme