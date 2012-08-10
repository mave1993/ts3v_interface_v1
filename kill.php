<?php
temp_header("Server killen");
$id = $_GET['c'];
$id2 = $_GET['id'];
$query = sprintf("SELECT * FROM leih WHERE kill_code = '%s' AND id = '%s'", mysql_real_escape_string($id), mysql_real_escape_string($id2));
$ergebnis = mysql_query($query);
$row = mysql_fetch_object($ergebnis);
$port = $row->port;
$ts3 = new ts3admin($allg['ts3ip'], $allg['ts3qport']);
if ($ts3->getElement('success', $ts3->connect()))
{
$loeschen = "DELETE FROM leih WHERE id = '$id2'";
$loesch = mysql_query($loeschen);
if($loesch == true)
{
	$ts3->login($allg['ts3user'], $allg['ts3passwort']);

$ts3->selectServer($port);
$timestamp = time();
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
		echo '<h4 class="alert_success">Es wurde noch ein Backup erstellt, dies kannst du beim n&auml;chsten mal wieder verwenden!<br /></h4>';
		}
		$getsid = $ts3->serverIdGetByPort($port);
			$sid = $getsid['data']['server_id'];
$ts3->serverStop($sid);
				$ts3->serverDelete($sid);
}else{
echo '<h4 class="alert_error">Code falsch!!</h4>';
}
}
echo '<h4 class="alert_success">Danke das du den Server anderen freigibst :)!</h4>';
temp_footer();
?>