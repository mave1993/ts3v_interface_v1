<?php

$username = $_SESSION['username'];
$abfrage = "SELECT * FROM user WHERE username = '$username'";
$ergebnis = mysql_query($abfrage);
$row = mysql_fetch_object($ergebnis);
if(!is_admin())
{
echo '<h4 class="alert_error">Du hast leider keine Rechte ;)</h4>';
}else{
?>
<?php

if($_POST['ja'])
{
$id = $_GET['id'];
$loeschen = "DELETE FROM user WHERE id = '$id'";
$loesch = mysql_query($loeschen);
if($loesch)
{
echo '<h4 class="alert_success">Erfolgreich gel&ouml;scht - <a href="index.php?page=user">Zur&uuml;ck</a></h4>';
}
}
?>
<?php
temp_header("L&ouml;Schen");
?>
<p>Soll der User wirklich gel&ouml;scht werden?</p>
<table width="300" border="0">
  <tr>
    <td></p>
      <form id="form1" name="form1" method="post" action="">
        <label>
          <input type="submit" name="ja" value="Jetzt sofort l&ouml;schen!" />
        </label>
    </form>      <p>&nbsp; </p></td>
  </tr>
</table>

<?php
temp_footer();
}
?>