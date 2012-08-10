#!/usr/bin/php5
<?php
$timestamp = time();
include("include/mysqlcon.php");
 include("include/functions.php");
 include("include/ts3admin.class.php");
$abfrage = "SELECT * FROM leih";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
   $ts3 = new ts3admin($allg['ts3ip'], $allg['ts3qport']);
if ($ts3->getElement('success', $ts3->connect()))
{

	$ts3->login($allg['ts3user'], $allg['ts3passwort']);
			$ts3->selectServer($row->port);
		$getsid = $ts3->serverIdGetByPort($row->port);
			$sid = $getsid['data']['server_id'];
$zeit = date('d.n.Y', $row->ende)." um ".date('H:i:s', $row->ende);

$ts3->sendMessage(3, "$sid", "[Voice-Sponsor.de] Dein Server lauft am $zeit aus!");
$ts3->sendMessage(3, "$sid", "[Voice-Sponsor.de] Verlaengere ihn jetzt auf http://www.voice-sponsor.de/?page=verlaengern !");
$ts3->sendMessage(3, "$sid", "[Voice-Sponsor.de] Du kannst ihn schon 48 Stunden vor auslauf verlaenger!");
$ts3->sendMessage(3, "$sid", "[Voice-Sponsor.de] Du hast deinen Code vergessen? Kein Problem: http://voice-sponsor.de/index.php?page=forgetcode");
$ts3->sendMessage(3, "$sid", "[Voice-Sponsor.de] Jetzt noch schnell Backup erstellen: http://voice-sponsor.de/index.php?page=backup");



}
}
?>