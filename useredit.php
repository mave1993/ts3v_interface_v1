<?php
$username = $_SESSION['username'];
$abfrage = "SELECT * FROM user WHERE username = '$username'";
$ergebnis = mysql_query($abfrage);
$row = mysql_fetch_object($ergebnis);
if(!is_admin())
{
echo '<h4 class="alert_error">Du hast leider keine Rechte ;)</h4>';
}else{
$id = $_GET['id'];
if($_POST['bearbeiten'])
{
$email = $_POST['email'];
$handy = $_POST['handy'];
$admin = $_POST['admin'];
$passwort = $_POST["passwort"];
$passwort2 = $_POST["passwort2"];

if($passwort != $passwort2)
{
echo '<h4 class="alert_error">Passw&ouml;rter stimmen nict &uuml;berein! Andere &auml;nderungen &uuml;bernommen!</h4>';
$password = "";
}else{
$passwortmd = md5($passwort);
if(empty($passwort)){ $password = ""; }else{$password = "password = '$passwortmd',"; }
}




$aendern = "UPDATE user Set
email = '$email',
$password
admin = '$admin',
handy = '$handy' WHERE id = '$id'";
$update = mysql_query($aendern);	

if($update == true)
{
echo '<h4 class="alert_success">Erfolgreich bearbeitet! - <a href="index.php?page=user">Zur&uuml;ck</a></h4>';
}else{
echo '<h4 class="alert_error">Fehler beim bearbeiten! '.mysql_error().'</h4>';
}
}


$abfrage = "SELECT * FROM user WHERE id = '$id'";
$ergebnis = mysql_query($abfrage);
$row = mysql_fetch_object($ergebnis);
?>              
		<article class="module width_full">
			<header><h3>User</h3></header>
			<div class="module_content">
<div class="table">
<form id="form1" name="form1" method="post" action="">
<table class="listing" width="100%" border="0">
  <tr>
    <td>E-Mail</td>
    <td><input type="text" value="<?php echo $row->email; ?>" size="24" maxlength="100"
name="email"></td>
  </tr>
  <tr>
    <td>Handy</td>
    <td><input type="text" value="<?php echo $row->handy; ?>" size="24" maxlength="100"
name="handy"></td>
  </tr>
  <tr>
    <td>Passwort</td>
    <td><input type="password" size="24" maxlength="50"
name="passwort"></td>
  </tr>
  <tr>
    <td>Passwort wiederholen</td>
    <td><input type="password" size="24" maxlength="50"
name="passwort2"></td>
  </tr>
   <tr>
    <td>Admin</td>
    <td><label>
<input type="radio" name="admin" value="1" <?php if($row->admin == 1){ echo "checked"; } ?>>
</label>Admin
<label>
<input type="radio" name="admin" value="0" <?php if($row->admin == 0){ echo "checked"; } ?>>
</label>Normaler User

</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="bearbeiten" value="Bearbeiten"></td>
  </tr>
</table>
</form>
</div>
			  <div class="clear"></div>
		  </div>
		</article><!-- end of stats article -->
<?php
}
?>