<?php
temp_header("Kontakt");
?><form id="form1" name="form1" method="post" action=""><table width="100%" border="0">
  <tr>
    <td>Dein Name: </td>
    <td><input type="text" name="name" value="<?php echo $_POST['name']; ?>" /></td>
  </tr>
  <tr>
    <td>Deine E-Mail Adresse </td>
    <td><label>
      <input type="text" name="email" value="<?php echo $_SESSION['email']; ?>" value="<?php echo $_POST['email']; ?>" />
    </label></td>
  </tr>
  <tr>
    <td valign="top">Inhalt:</td>
    <td><textarea name="inhalt" cols="40" rows="4"><?php echo $_POST['inhalt']; ?></textarea></td>
  </tr>
  <tr>
    <td>Captcha Abfrage: </td>
    <td><img src="captcha.php" border="0" title="Sicherheitscode"><br /><input type="text" name="sicherheitscode" size="10"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label>
      <input type="submit" name="kontakt" value="Eintragen" />
    </label></td>
  </tr>
</table>
</form>
<?php
if($_POST['kontakt'])
{
if(isset($_SESSION['captcha_spam']) AND $_POST["sicherheitscode"] == $_SESSION['captcha_spam']){
unset($_SESSION['captcha_spam']);
$timestamp = time();
$query = sprintf("INSERT INTO kontakt (email, name, datum, text)
VALUES
('%s', '%s', '%s', '%s')",
            mysql_real_escape_string($_POST['email']),
            mysql_real_escape_string($_POST['name']),
            mysql_real_escape_string($timestamp),
            mysql_real_escape_string($_POST['inhalt'])
);
$eintragen = mysql_query($query);
echo '<h4 class="alert_success">Erfolgreich abgesendet.</h4>';

}else{
echo '<h4 class="alert_error">Leider ist die Captcha Eingabe falsch!</h4>'; 
}
}
temp_footer();
?>