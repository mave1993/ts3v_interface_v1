<?php
temp_header("Verl&auml;ngern");
?>
<form name="form1" method="post" action=""><table width="100%" border="0">
  <tr>
    <td colspan="2">Hier kannst du die Leihzeit verl&auml;ngern. Achtung, dies ist nur <?php echo $allg['laenger_max']; ?> m&ouml;glich! W&auml;hle dazu deinen Port aus und gebe den Code ein, den du bei der Erstellung des Servers erhalten hast!<br /><br />Du kannst den Server erst <b><?php $zve = $allg['z_v_a']; echo $zve; ?> Stunden</b> vor auslauf verl&auml;ngern!<br /><br /></td>
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
    <td>Verl&auml;ngerungszeit:</td>
    <td><select name="laenger">
<?php
for($i = $allg['laenger_zeit_min']; $i < $allg['laenger_zeit_max']+1; $i = $i +$allg['laenger_zeit_schritt'])
{
if($allg['zeit_angabe'] == 1)
{
$angabe = "Minuten";
}
if($allg['zeit_angabe'] == 2)
{
$angabe = "Stunden";
}
if($allg['zeit_angabe'] == 3)
{
$angabe = "Tage";
}
echo '<option value="'.$i.'">'.$i.' '.$angabe.'</option>';}
?>
    </select></td>
  </tr></td>
  </tr>
    <tr>
    <td></td>
    <td>
      <label>
      <input type="submit" name="erstellen" value="Verl&auml;ngern">
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
if($row->verlaengern > $allg['laenger_max'] OR $row->verlaengern == $allg['laenger_max'])
{
echo '<h4 class="alert_error">Du hast deinen Server bereits verl&auml;ngert, dies ist leider nur '.$allg['laenger_max'].' mal m&ouml;glich.</h4>';
}else{
$zva = $allg['z_v_a']*60;
$zva2 = $allg['z_v_a']*24;
$checktime = $row->ende-$zva2;
$timestamp = time();
if($timestamp > $checktime){
$laenger = $row->verlaengern+1;


if($allg['zeit_angabe'] == 1)
{
$zeit = $row->ende;
$zeit_ad = $_POST['laenger']*60;
$zeit_add = $zeit+$zeit_ad;
}
if($allg['zeit_angabe'] == 2)
{
$zeit = $row->ende;
$zeit_ad2 = $_POST['laenger']*60;
$zeit_ad = $zeit_ad2*60;
$zeit_add = $zeit+$zeit_ad;
}
if($allg['zeit_angabe'] == 3)
{
$zeit = $row->ende;
$zeit_ad2 = $_POST['laenger']*60;
$zeit_ad = $zeit_ad2*60;
$zeit_ad3 = $zeit_ad*24;
$zeit_add = $zeit+$zeit_ad3;
}
$aendern = sprintf("UPDATE leih Set verlaengern = '%s', ende = '%s', note_msg = '0' WHERE id = '%s'",
            mysql_real_escape_string($laenger),
            mysql_real_escape_string($zeit_add),
            mysql_real_escape_string($row->id)
);
$update = mysql_query($aendern);
if($update){ echo '<h4 class="alert_success">Erfolgreich verl&auml;ngert!</h4>'; }else{ echo '<h4 class="alert_error">Es gab einen Fehler!</h4>'; }
}else{ 
echo '<h4 class="alert_error">Dieser Server kann nocht nicht verl&auml;ngert werden! '.$allg['z_v_a'].' Stunden vor ablauf ist ein verl&auml;ngern erst m&ouml;glich!</h4>';
}
}
}else{
echo '<h4 class="alert_error">Der Code passt leider nicht zum Server!</h4>';
}



}
}
?>