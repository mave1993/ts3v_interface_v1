#!/usr/bin/php5
<?php
echo "\n\n\n\n\n";
echo "Cron File Ts3 Verleih Interface\n";
echo "Created and Copyright by Patrick Hassmann\n\n";
include("include/mysqlcon.php");
 include("include/functions.php");
 include("include/ts3admin.class.php");
include("include/umrechnung.php");
$abfrage = "SELECT * FROM leih";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
   {
   $ts3 = new ts3admin($allg['ts3ip'], $allg['ts3qport']);
if ($ts3->getElement('success', $ts3->connect()))
{

	$ts3->login($allg['ts3user'], $allg['ts3passwort']);
			$ts3->selectServer($row->port);

$info = $ts3->serverInfo();
if($info['data']['virtualserver_maxclients'] > $allg['slot_max'])
{
$data = array();
 $data['virtualserver_maxclients'] = $allg['slot_max'];
echo "Changed on Port: ".$row->port."<br />";
$ts3->serverEdit($data);
}else{
echo "Not Changed on Port: ".$row->port."\n";
}

}
   }
?>