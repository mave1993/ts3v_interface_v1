Installation:
----------------------------------
1. include/config.php anpassen
2. http://deineurl.de/install.php aufrufen!
3. install.php und install.sql löschen oder umbenennen!

Login erfolgt mit
Username: admin
Passwort: test


Konfiguration - Stunden / Minuten:
-----------------------------------
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