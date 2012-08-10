<?php
temp_header("User Daten");
if(!is_admin())
{
echo '<h4 class="alert_error">Du hast leider keine Rechte ;)</h4>';
}else{
?><table width="600" class="text7" border="0">
  <tr>
    <td>E-Mail</td>
    <td>Datum - Uhrzeit</td>
    <td>Port</td>
    <td><a href="index.php?page=userdata_del_all">Alle l&ouml;schen</a></td>
  </tr>
<?php
$abfrage = "SELECT * FROM userdata";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
   {
   
   echo '  <tr>
    <td>'.$row->email.'</td>
    <td>'.$row->datum.'</td>
    <td>'.$row->port.'</td>
    <td><a href="index.php?page=userdata_del&id='.$row->id.'">L&ouml;schen</a></td>
  </tr>';
   }
?>


</table>
<?php
}
temp_footer();
?>

