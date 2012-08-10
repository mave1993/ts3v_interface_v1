#!/usr/bin/php5
<?php
echo "\n\n\n\n\n";
echo "Cron File Ts3 Verleih Interface\n";
echo "Created and Copyright by Patrick Hassmann\n\n";
include("include/mysqlcon.php");
 include("include/functions.php");
 include("include/ts3admin.class.php");



$timestamp = time();
$abf5 = "SELECT * FROM leih";
$erg5 = mysql_query($abf5);
while($row = mysql_fetch_object($erg5))
{

$ts3 = new ts3admin($allg['ts3ip'], $allg['ts3qport']);
if ($ts3->getElement('success', $ts3->connect()))
{
	$ts3->login($allg['ts3user'], $allg['ts3passwort']);
	$ts3->selectServer($row->port);
$serversnapshot = $ts3->serverSnapshotCreate();
	if($serversnapshot['success']!==false)
		{
		$handler=fopen("backup/".$row->port."-".$timestamp.".txt", "a+");
		fwrite($handler, $serversnapshot['data']);
		fclose($handler);
$eintragu = sprintf("INSERT INTO backup (email, datum, port)
VALUES
('%s', '%s', '%s')", mysql_real_escape_string($row->email), mysql_real_escape_string($timestamp), mysql_real_escape_string($row->port));
$eintragenu = mysql_query($eintragu);
		echo "Backup erstellt!<br />";
		}
	}
}
?>