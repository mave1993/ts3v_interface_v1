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


$result = mysql_query("show columns from leih");  
if (mysql_num_rows($result) > 0)
{
echo "<!-- Spalte Leih Existiert -->";
}

$result = mysql_query("show columns from port"); 
if (mysql_num_rows($result) > 0)
{
echo "<!-- Spalte Port Existiert -->";
}

$result = mysql_query("show columns from userdata");
if (mysql_num_rows($result) > 0)
{
echo "<!-- Spalte Userdata Existiert -->";
}

$result = mysql_query("show columns from user");
if (mysql_num_rows($result) > 0)
{
echo "<!-- Spalte user Existiert -->";
}

$result = mysql_query("show columns from backup");
if (mysql_num_rows($result) > 0)
{
echo "<!-- Spalte backup Existiert -->";
}

$result = mysql_query("show columns from feedback");
if (mysql_num_rows($result) > 0)
{
echo "<!-- Spalte feedback Existiert -->";
}

$result = mysql_query("show columns from kontakt");
if (mysql_num_rows($result) > 0)
{
echo "<!-- Spalte kontakt Existiert -->";
}
?>