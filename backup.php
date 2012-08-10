<?php
temp_header("Backup erstellen");
?>
<form name="form1" method="post" action=""><table width="100%" border="0">
  <tr>
    <td colspan="2">Hier kannst du ein Backup deines Servers erstellen!</td>
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
echo '<option value="'.$row->id.'">'.$row->port.'</option>';
   }  
?>
    </select></td>
  </tr>
  <tr>
    <td>Code:</td>
    <td><label>
      <input type="text" value="<?php if(empty($_GET['c'])){ echo ""; }else{ echo $_GET['c']; } ?>" name="code">
    </label></td>
  </tr>
    <tr>
    <td></td>
    <td>
      <label>
      <input type="submit" name="erstellen" value="Erstellen">
      </label></td>
  </tr>
</table></form>

<?php
if($_POST['erstellen'])
{
	if($_POST['server'] == "nothing")
	{
	echo '<h4 class="alert_error">W&auml;hle deinen Server!</h4>';
	}else{
$timestamp = time();
$sid = $_POST['server'];
$abf5 = "SELECT * FROM leih WHERE id = '$sid'";
$erg5 = mysql_query($abf5);
$row = mysql_fetch_object($erg5);

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
		echo '<h4 class="alert_success">Backup erstellt!</h4>';
		}
	}
	}
}
temp_footer();
?>