<?php
temp_header("Verliehen");
if(!is_admin())
{
echo '<h4 class="alert_error">Du hast leider keine Rechte ;)</h4>';
}else{
?>
<table width="900" class="tablesorter" class="text7" border="0">
  <tr>
    <td align="center"><b>IP : Port</b></td>
    <td align="center"><b>E-Mail</b></td>

    <td align="center"><b>Server Name</b></td>
    <td align="center"><b>User</b></td>
    <td align="center"><b>Channel</b></td>
    <td align="center"><b>Traffic Up / Down</b></td>
    <td align="center"><b>Ende</b></td>
    <td align="center"><b> </b></td>


  </tr>
<?php
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
$usersonline = $info['data']['virtualserver_clientsonline']-1;
$jetzigedown = binary_multiples($info['data']['connection_bytes_received_total']);
$jetzigeup = binary_multiples($info['data']['connection_bytes_sent_total']);
   echo '  <tr>
    <td align="center">'.$allg['ts3ip'].' : '.$row->port.'</td>
    <td align="center">'.$row->email.'</td>

    <td align="center">'.$info['data']['virtualserver_name'].'</td>
    <td align="center">'.$usersonline.' / '.$info['data']['virtualserver_maxclients'].'</td>
    <td align="center">'.$info['data']['virtualserver_channelsonline'].'</td>
    <td align="center">'.$jetzigeup.' / '.$jetzigedown.'</td>
    <td align="center">'.date('d.n.Y', $row->ende)." um ".date('H:i:s', $row->ende).'</td>
    <td align="right"><a href="index.php?page=kill&id='.$row->id.'&c='.$row->kill_code.'">Beenden</a></td>
  </tr>';
}
   }
?>


</table>
<?php
}
temp_footer();
?>