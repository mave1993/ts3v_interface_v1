<?php
temp_header("Kontakt");
if(!is_admin())
{
echo '<h4 class="alert_error">Du hast leider keine Rechte ;)</h4>';
}else{
?><table width="300" border="0">
  <tr>
    <td><p class="text7">M&ouml;chtest du die Kontaktanfrage wirklich l&ouml;schen?</p>
      <form id="form1" name="form1" method="post" action="">
        <label>
          <input type="submit" name="ja" value="Jetzt sofort l&ouml;schen!" />
        </label>
    </form>      <p>&nbsp; </p></td>
  </tr>
</table>
<?php

if($_POST['ja'])
{
$id = $_GET['id'];
$loeschen = "DELETE FROM kontakt WHERE id = '$id'";
$loesch = mysql_query($loeschen);
if($loesch)
{
echo '<h4 class="alert_success">Erfolgreich gel&ouml;scht - <a href="index.php?page=kontakt_admin">Zur&uuml;ck</a></h4>';
}
}
}
temp_footer();
?>