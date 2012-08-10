<?php
temp_header("User");
if(!is_admin())
{
echo '<h4 class="alert_error">Du hast leider keine Rechte ;)</h4>';
}else{
?>
                  <table cellpadding="0" class="tablesorter" cellspacing="0">
                       <thead> <tr>
                            <th>NAME</th>
                            <th>E-MAIL</th>
                            <th></th>
                        </tr></thead><tbody>

<?php
$abfrage = "SELECT * FROM user";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
   {
echo '<tr>
                            <td class="style1">'.$row->username.'</td>
                            <td>'.$row->email.'</td>
                            <td><a href="index.php?page=userdelete&id='.$row->id.'"><img src="images/ledicons/cancel.png" width="16" height="16" alt="add" /></a> <a href="index.php?page=useredit&id='.$row->id.'"><img src="images/ledicons/pencil.png" width="16" height="16" alt="" /></a></td>
                        </tr>';
   }

?>
</tbody>
                </table>
                    <div class="select">
                    <strong>Eingetragen: <?php $count = mysql_num_rows(mysql_query("SELECT * FROM user")); echo $count; ?></strong></div>
              </div>
<?php
temp_footer();
?>
<?php
if($_POST['eintragen'])
{
$username = $_POST["username"];
$passwort = $_POST["passwort"];
$passwort2 = $_POST["passwort2"];
$email = $_POST['email'];

if($passwort != $passwort2 OR $username == "" OR $passwort == "" OR $email == "")
    {
echo '<h4 class="alert_error">Eingabefehler, bitte alle Felder ausf&uuml;llen!</h4>';
    }
$passwort = md5($passwort);

$result = mysql_query("SELECT id FROM user WHERE username LIKE '$username'");
$menge = mysql_num_rows($result);

if($menge == 0)
    {
$admin = $_POST['admin'];

    $eintrag = "INSERT INTO user (username, password, admin, email) VALUES ('$username', '$passwort', '$admin', '$email')";
    $eintragen = mysql_query($eintrag);

    if($eintragen == true)
        {
echo '<h4 class="alert_success">Benutzername '.$username.' wurde angelegt!</h4>';
$sid = $_POST['server'];
$aendern = "UPDATE instanzen Set
admin = '$username' WHERE id = '$sid'";
$update = mysql_query($aendern);
        }
    else
        {
echo '<h4 class="alert_error">Fehler beim speichern vom Benutzer '.$username.'!</h4>';        }


    }

else
    {
echo '<h4 class="alert_error">Benutzername '.$username.' ist bereits vorhanden. Bitte w&auml;hle einen anderen!</h4>';    }
}
?>
<?php
temp_header("Neuen User");
?>
<form id="form1" name="form1" method="post" action="">
<table class="listing" width="100%" border="0">
  <tr>
    <td>Username</td>
    <td><input type="text" size="24" maxlength="100"
name="username"></td>
  </tr>
  <tr>
    <td>E-Mail</td>
    <td><input type="text" size="24" maxlength="100"
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
    <td><input type="submit" name="eintragen" value="Eintragen"></td>
  </tr>
</table>
</form>
<?php
}
temp_footer();
?>