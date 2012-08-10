 <?php
$allg['admin'] = "mave1993@hotmail.de"; // E-Mail Adresse des Administrators

$allg['ts3user'] = "serveradmin"; // Server Admin Query User
$allg['ts3passwort'] = "Lmv1byoT"; // Server Admin Query User Passwort
$allg['ts3qport'] = 10011; // Teamspeak3 Server Query Port
$allg['ts3ip'] = "95.223.219.223"; // Teamspeak3 Server IP

$allg['mysqluser'] = "cswi"; // Mysql User
$allg['mysqlpasswort'] = "sr6asnp2"; // Mysql Passwort
$allg['mysqldb'] = "cswi"; // Mysql Datenbank
$allg['mysqlhost'] = "localhost"; // Mysql Host

$allg['zeit_schritt'] = 2; // Abstand zwischen den Zeit-auswahl Menu
$allg['zeit_min'] = 2; // Minimal auswaehlbare Zeit
$allg['zeit_max'] = 10; // Maximal auswaehlbare Zeit

$allg['zeit_angabe'] = 1; //1 = Minuten, 2 = Stunden, 3 = Tage

$allg['laenger_zeit_schritt'] = 2;// Abstand zwischen den Verlaengerungs-auswahl Menu
$allg['laenger_zeit_min'] = 2; // Minimal auswaehlbare Zeit bei verlaengerung
$allg['laenger_zeit_max'] = 4; // Maximal auswaehlbare Zeit bei verlaengerung

$allg['laenger_max'] = 2; // Anzahl der verlaengerungen, die gemacht werden koennen!

$allg['z_v_a'] = 1; // Zeit vor ablauf ab wann verlaengert werden kann ( Muss in Stunden sein! - 1440 Minuten = 24 Stunden = 1 Tag ) Anzeige erfolgt in Stunden!

$allg['slot_schritt'] = 2; // Abstand zwischen den Slot-auswahl Menu
$allg['slot_min'] = 10;  // Minimal auswaehlbare Slots
$allg['slot_max'] = 32;  // Maximal auswaehlbare Slots

//Info: Wenn 10 Server vergeben werden, muessen min. 11 Ports verwendbar sein!!
$allg['start_port'] = 20960; // Start Port der Server
$allg['max_port'] = 20980; // Ende der Ports der Server, nach dem Port wird wieder bei start_port gestartet!

$allg['max_server'] = 1; // Anzahl der Server, die verliehen werden k�nnen!

$allg['ts3_welcomemsg'] = "Dieser Server wurde ausgeliehen von ".$_SERVER['SERVER_NAME'].""; // Die Welcome Message der Server, die ausgeliehen werden!

$allg['note'] = 120; // Zeit in Minuten bevor die Nachricht gesendet wird
$allg['note_msg'] = "Dein Server wird in ".$allg['note']." Minuten heruntergefahren!"; // Nachricht vor dem herunterfahren des Servers

$allg['no_mail'] = array();
$allg['no_mail'] = array("10minutemail.com", "bofthew.com", "jnxjn.com", "klzlk.com", "nepwk.com", "nwldx.com", "owlpic.com", "pjjkp.com", "prtnx.com", "rppkn.com", "rtrtr.com", "tyldd.com", "uggsrock.com", "0clickemail.com", "noclickemail.com", "12houremail.com", "12minutemail.com"); // Verbotene Domain Namen in E-Mail Adressen, mit, "fjeoijfe.tld"
?>   