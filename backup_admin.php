<?php
temp_header("Erstellte Backups");
if(!is_admin())
{
echo '<h4 class="alert_error">Du hast leider keine Rechte ;)</h4>';
}else{
?>
<table width="100%" class="tablesorter" border="0">
  <tr>
    <td width="200"><b>E-Mail</b></td>
    <td width="200"><b>Port</b></td>
    <td width="200"><b>Datum</b></td>
  </tr>
<?php
$abfrage = "SELECT * FROM backup";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
   {
   
   echo '  <tr>
    <td valign="top">'.$row->email.'</td>
    <td valign="top">'.$row->port.'</td>
    <td valign="top">'.date('d.n.Y', $row->datum)." um ".date('H:i:s', $row->datum).'</td>
  </tr>';
   }
?>


</table>
<?php
}
temp_footer();
?>