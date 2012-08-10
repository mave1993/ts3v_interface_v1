<?php
temp_header("Neuen token");
?>
<form name="form1" method="post" action=""><table width="100%" border="0">
  <tr>
    <td colspan="2">Hier kannst du einen neuen Server Admin Token erstellen. W&auml;hle dazu deinen Port aus und gebe den Code ein, den du bei der Erstellung des Servers erhalten hast!<br /><br /></td>
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
      <input type="submit" name="erstellen" value="erstellen">
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
$id = $_POST['server'];
$abf5 = "SELECT * FROM leih WHERE id = '$id'";
$query = sprintf("SELECT * FROM leih WHERE id = '%s'",
            mysql_real_escape_string($id)
);

$erg5 = mysql_query($abf5);
$row = mysql_fetch_object($erg5);
if($_POST['code'] == $row->kill_code)
{


$ts3 = new ts3admin($allg['ts3ip'], $allg['ts3qport']);
if ($ts3->getElement('success', $ts3->connect()))
{
	$ts3->login($allg['ts3user'], $allg['ts3passwort']);
$ts3->selectServer($row->port);
$list = $ts3->serverGroupList();
    foreach($list['data'] as $as => $ad) {
if($ad['name']!='Server Admin')

{
echo '';
}else{
if($ad['type']!="1")
{
echo '';
}else{
	$sgid = $ad['sgid'];
    }
}
}}
$admingroup = "$sgid";
$tooken = $ts3->tokenAdd("0", "$admingroup", "0", "new Token");
$tokenp =  $tooken['data']['token']; 
echo '<table width="100%" border="0">
<tr>
    <td>Admin Token:</td>
    <td><input name="token" id="token" value="'.$tokenp.'" readonly="readonly" class="disabled" onclick="this.focus(); this.select();" type="text"></td>
  </tr></table>';

}else{
echo '<h4 class="alert_error">Der Code passt leider nicht zum Server!</h4>';
}



}
}
temp_footer();
?>