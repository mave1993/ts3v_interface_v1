<?php
$timestamp = time();include("include/mysqlcon.php");

$abfrage = "SELECT * FROM leih";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
   {
echo "Server ".$row->port." l&auml;uft am ".date('d.n.Y', $row->ende)." um ".date('H:i:s', $row->ende)." ab!<br />";
$send_code = $row->kill_code;
$time_r = $allg['note']*60;
$time_re = $row->ende-$time_r;
if($row->note_msg == 1)
{
echo "->Nachricht bereits gesendet<br />";
}else{
if($time_re < $timestamp)
{
$port = $row->port;
$id = $row->id;


$ts3 = new ts3admin($allg['ts3ip'], $allg['ts3qport']);
if ($ts3->getElement('success', $ts3->connect()))
{

	$ts3->login($allg['ts3user'], $allg['ts3passwort']);
		$getsid = $ts3->serverIdGetByPort($port);
			$sid = $getsid['data']['server_id'];
			$ts3->selectServer($port);
$ts3->sendMessage(3, "$sid", $allg['note_msg']);
echo "->Nachricht gesendet!<br />";	
$aendern = sprintf("UPDATE leih Set note_msg = '1' WHERE id = '%s'",
            mysql_real_escape_string($row->id)
);
$update = mysql_query($aendern);	

//MAIL SENDEN
if($mail['stats_note'] == 1)
{
$absendername = $mail['absender_name'];
$absendermail = $mail['absender_mail'];
$kill_link_re = 'http://'.$_SERVER['SERVER_NAME'].''.$_SERVER['PHP_SELF'].'?page=kill&c='.$kill_code.'&id='.mysql_insert_id().'';
$ver_link = 'http://'.$_SERVER['SERVER_NAME'].''.$_SERVER['PHP_SELF'].'?page=verlaengern&c='.$kill_code.'';
$mail['text_note'] = str_replace("{verlaengern}", $ver_link, $mail['text_note']);
$mail['text_note'] = str_replace("{port}", $row->port, $mail['text_note']);
$mail['text_note'] = str_replace("{ip}", $allg['ts3ip'], $mail['text_note']);
$mail['text_note'] = str_replace("{time}", $allg['note'], $mail['text_note']);
$mail['text_note'] = str_replace("{code}", $send_code, $mail['text_note']);
mail($row->email, $mail['betreff_note'], $mail['text_note'], "From: $absendername <$absendermail>");
echo "<!-- Mail gesendet -->";
}else{ echo "<!-- Mail fuer diese Funktion ausgeschaltet! -->"; }
//MAIL SENDEN

}
}
}

if($row->ende < $timestamp)
{


$port = $row->port;
$id = $row->id;

$ts3 = new ts3admin($allg['ts3ip'], $allg['ts3qport']);
if ($ts3->getElement('success', $ts3->connect()))
{


$loeschen = "DELETE FROM leih WHERE id = '$id'";
$loesch = mysql_query($loeschen);
	$ts3->login($allg['ts3user'], $allg['ts3passwort']);
		$getsid = $ts3->serverIdGetByPort($port);
			$sid = $getsid['data']['server_id'];

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
		echo "Es wurde noch ein Backup erstellt, dies kannst du beim n&auml;chsten mal wieder verwenden!<br />";
		}

				$ts3->serverDelete($sid);
//MAIL SENDEN
if($mail['stats_cron'] == 1)
{
$absendername = $mail['absender_name'];
$absendermail = $mail['absender_mail'];
mail($row->email, $mail['betreff_cron'], $mail['text_cron'], "From: $absendername <$absendermail>");
echo "<!-- Mail gesendet -->";
}else{ echo "<!-- Mail fuer diese Funktion ausgeschaltet! -->"; }
//MAIL SENDEN
}
echo "->Server $port ist abgelaufen!<br />";
}


   }

?>