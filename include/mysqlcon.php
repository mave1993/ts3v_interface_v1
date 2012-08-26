<?php
include("config.php");
include("functions.php");
include("class.shell2.php");
include("mail_config.php");
include("pw.php");
include("ts3admin.class.php");





$verbindung = mysql_connect ($allg['mysqlhost'],
$allg['mysqluser'], $allg['mysqlpasswort'])
or die ("keine Verbindung möglich.
 Benutzername oder Passwort sind falsch");

mysql_select_db($allg['mysqldb'])
or die ("Die Datenbank existiert nicht.");

echo "<!-- Connected -->";

?>