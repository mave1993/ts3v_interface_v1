<?php
temp_header("Backup einspielen");
?>
<form name="form1" method="post" action=""><table width="100%" border="0">
  <tr>
    <td colspan="2">Hier kannst du alle mit deiner E-Mail erstellten Backups Problemlos in den Server einspielen.</td>
  </tr>
  <tr>
    <td>Port:</td>
    <td><select name="server">
<?php
echo '<option value="nothing">----Please Select your Port----</option>';
$abf5 = "SELECT * FROM leih";
$erg5 = mysql_query($abf5);
while($row = mysql_fetch_object($erg5))
   {
echo '<option value="'.$row->id.'" ';
if($_POST['server'] == $row->id){ echo 'selected'; }
echo '>'.$row->port.'</option>';
   }  
?>
    </select></td>
  </tr>
  <tr>
    <td>Code:</td>
    <td><label>
      <input type="text" value="<?php if(empty($_POST['code'])){ echo ""; }else{ echo $_POST['code']; } ?>" name="code">
    </label></td>
  </tr>
    <tr>
    <td></td>
    <td>
      <label>
      <input type="submit" name="erstellen" value="Weiter">
      </label></td>
  </tr>
</table>

<?php
if($_POST['erstellen'])
{
	if($_POST['server'] == "nothing")
	{
	echo '<h4 class="alert_error">W&auml;hle deinen Server!</h4>';
	}else{
$checkid = $_POST['server'];
$query = sprintf("SELECT * FROM leih WHERE id = '%s'",
            mysql_real_escape_string($checkid)
);

$erg7 = mysql_query($query);
$rowcheck = mysql_fetch_object($erg7);
if($_POST['code'] != $rowcheck->kill_code)
{
echo '<h4 class="alert_error">Der Code passt nicht zum Server!</h4>';
}else{
$timestamp = time();
$sid = $_POST['server'];
$abf5 = "SELECT * FROM leih WHERE id = '$sid'";
$erg5 = mysql_query($abf5);
$row2 = mysql_fetch_object($erg5);
?>
W&auml;hle das Backup, das du einspielen m&ouml;chtest, auf deinen Aktuellen Server. Dir wird der Port und das Datum vom stand des Backups angezeigt!<br />
<table width="100%" border="0">
  <tr>
    <td>Backup:</td>
    <td><select name="backup">
<?php
echo '<option value="nothing">----Please Select your Backup----</option>';
$email = $row2->email;
$abf6 = "SELECT * FROM backup WHERE email = '$email'";
$erg6 = mysql_query($abf6);
while($row = mysql_fetch_object($erg6))
   {
echo '<option value="'.$row->id.'">Port: '.$row->port.' - Datum: '.date('d.n.Y', $row->datum)." um ".date('H:i:s', $row->datum).'</option>';
   }  
?>
    </select></td>
  </tr>
    <tr>
    <td></td>
    <td>
      <label>
      <input type="submit" name="erstellen2" value="Weiter">
      </label></td>
  </tr>
</table></form>

<?php
}
}
}
if($_POST['erstellen2'])
{
$sid = $_POST['server'];
$bid = $_POST['backup'];
$abf5 = "SELECT * FROM leih WHERE id = '$sid'";
$erg5 = mysql_query($abf5);
$row = mysql_fetch_object($erg5);

$abf6 = "SELECT * FROM backup WHERE id = '$bid'";
$erg6 = mysql_query($abf6);
$row2 = mysql_fetch_object($erg6);

$ts3 = new ts3admin($allg['ts3ip'], $allg['ts3qport']);
if ($ts3->getElement('success', $ts3->connect()))
{
	$ts3->login($allg['ts3user'], $allg['ts3passwort']);
	$ts3->selectServer($row->port);
	$getsid = $ts3->serverIdGetByPort($port);
	$serverid = $getsid['data']['server_id'];

$ts3->serverStop($serverid);
$handler=file("backup/".$row2->port."-".$row2->datum.".txt");
	$snapshot_deploy=$ts3->serverSnapshotDeploy($handler[0]);
	if($snapshot_deploy['success']===false)
		{
		for($i=0; $i+1==count($snapshot_deploy['errors']); $i++)
			{
			echo $snapshot_deploy['errors'][$i]."<br />";
			}
		}else{
echo '<h4 class="alert_success">Backup wurde erfolgreich eingespielt</h4>';
}
$ts3->serverStart($serverid);
}
}
temp_footer();
?>