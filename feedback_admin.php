<?php
temp_header("Feedback");
if(!is_admin())
{
echo '<h4 class="alert_error">Du hast leider keine Rechte ;)</h4>';
}else{
?>
<table width="100%" class="tablesorter" border="0">
  <tr>
    <td width="200"><b>E-Mail</b></td>
    <td width="200"><b>Name</b></td>
    <td><b>Feed</b></td>
    <td></td>
  </tr>
<?php
$abfrage = "SELECT * FROM feedback";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
   {
   
   echo '  <tr>
    <td valign="top">'.$row->email.'</td>
    <td valign="top">'.$row->name.'</td>
    <td>'.$row->text.'<br /><br /><br /></td>
    <td valign="top"><a href="index.php?page=feedback_del&id='.$row->id.'">L&ouml;schen</a></td>
  </tr>';
   }
?>


</table>
<?php
}
temp_footer();

?>