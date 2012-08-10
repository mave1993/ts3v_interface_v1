<?php
$username = $_SESSION['username'];
$abfrage = sprintf("SELECT * FROM user WHERE username = '%s'",
            mysql_real_escape_string($username)
);
$ergebnis = mysql_query($abfrage);
$row = mysql_fetch_object($ergebnis);
if($_POST['bearbeiten'])
{
$email = $_POST['email'];
$handy = $_POST['handy'];
$name = $_POST['name'];
$vorname = $_POST['vorname'];
$strasse = $_POST['strasse'];
$plz = $_POST['plz'];
$ort = $_POST['ort'];
$passwort = $_POST["passwort"];
$passwort2 = $_POST["passwort2"];
$ein = 1;
if(!empty($passwort) AND $passwort != $passwort2)
{
echo '<h4 class="alert_info">Passw&ouml;rter stimmen nict &uuml;berein! Andere &auml;nderungen &uuml;bernommen!</h4>
                </div>';
}else{
$passwortmd = md5($passwort);
if(empty($passwort)){ $password = ""; }else{$password = "password = '$passwortmd',"; }
}




$aendern = "UPDATE user Set
$password
email = '$email',
name = '$name',
vorname = '$vorname',
strasse = '$strasse',
plz = '$plz',
ort = '$ort',
handy = '$handy' WHERE username = '$username'";
$update = mysql_query($aendern);	

if($update == true)
{
echo '<h4 class="alert_success">Erfolgreich bearbeitet! - <a href="index.php">Zur&uuml;ck</a></h4>';
}else{
echo '<h4 class="alert_error">Fehler beim bearbeiten! '.mysql_error().'</h4>';
}
}

$abfrage = sprintf("SELECT * FROM user WHERE username = '%s'",
            mysql_real_escape_string($username)
);
$ergebnis = mysql_query($abfrage);
$row = mysql_fetch_object($ergebnis);
?>              
		<article class="module width_full">
			<header><h3>Profil bearbeiten</h3></header>
			<div class="module_content">
<div class="table">
<form id="form1" name="form1" method="post" action="">
<table class="listing" width="100%" border="0">
  <tr>
    <td><b>Angaben zum Profil</b></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>E-Mail</td>
    <td><input type="text" value="<?php echo $row->email; ?>" size="24" maxlength="100"
name="email"></td>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><b>Angaben zur Person</b></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Name</td>
    <td><input type="text" value="<?php echo $row->name; ?>" size="24" maxlength="100"
name="name"></td>
  </tr>
  <tr>
    <td>Vorname</td>
    <td><input type="text" value="<?php echo $row->vorname; ?>" size="24" maxlength="100"
name="vorname"></td>
  </tr>
  <tr>
    <td>Strasse</td>
    <td><input type="text" value="<?php echo $row->strasse; ?>" size="24" maxlength="100"
name="strasse"></td>
  </tr>
  <tr>
    <td>Ort</td>
    <td><input type="text" value="<?php echo $row->plz; ?>" size="10" maxlength="100"
name="plz"> <input type="text" value="<?php echo $row->ort; ?>" size="24" maxlength="100"
name="ort"></td>
  </tr>
  <tr>
    <td>Handy Nummer ( Format 0162123456 )</td>
    <td><input type="text" value="<?php echo $row->handy; ?>" size="24" maxlength="100"
name="handy"></td>
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