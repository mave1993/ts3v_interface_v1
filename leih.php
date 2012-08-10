<?php
temp_header("Server leihen");
$vergeben = mysql_num_rows(mysql_query("SELECT * FROM leih"));
if($vergeben > $allg['max_server'] OR $vergeben == $allg['max_server'])
{
$query=mysql_query('SELECT * FROM leih ORDER BY ende DESC');
$row=mysql_fetch_array($query);
echo '<h4 class="alert_info">Leider ist die Zahl zu leihender Server auf '.$allg['max_server'].' beschr&auml;nkt, dieses Limit wurde bereits erreicht. Versuche es sp&auml;ter erneut!';
echo "<br />N&auml;chste Server ist frei am ".date('d.n.Y', $row['ende'])." um ".date('H:i:s', $row['ende'])."</h4>";
}else{

$abf5 = "SELECT * FROM leih";
$erg5 = mysql_query($abf5);
while($rowip = mysql_fetch_object($erg5))
   {
if($rowip->userip == $_SERVER['REMOTE_ADDR']){ $ipchecktrue = "yes"; }else{ $ipchecktrue = "no"; }
   }
if($ipchecktrue == "yes")
{
echo '<h4 class="alert_error">Du hast bereits einen Server geliehen. Warte bis er ausl&auml;uft oder Kille ihn sofort!</h4>';
}else{
?>
<table align="center" width="500" border="0">
  <tr>
    <td valign="top"><center><font style="font-size:16px;"><img src="images/de.png" /> <?php echo $allg['ts3ip']; ?></font></center> 
        <br>
-<b>Teamspeak3</b><br>
-iPhone und Android App<br>
        -Staunende 3D Effekte<br>
        -Top Qualit&auml;t
        <br />
    </td>
    <td><img src="images/Teamspeak3_logo.png" /></td>
  </tr>
</table>
<br />
<form name="form1" method="post" action=""><table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>
      <label>
        <input type="submit" name="leihen" value="Leihen">
        </label>    </td>
  </tr>
  <tr>
    <td>E-Mail Adresse: </td>
    <td><label>
      <input type="text" value="<?php echo $_SESSION['email']; ?>" name="email" />
    </label></td>
  </tr>
  <tr>
    <td>Leihzeit:</td>
    <td><label>
      <select name="zeit">
<?php
for($i = $allg['zeit_min']; $i < $allg['zeit_max']+1; $i = $i +$allg['zeit_schritt'])
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
echo '<option value="'.$i.'">'.$i.' '.$angabe.'</option>';
}
?>
      </select>
    </label></td>
  </tr>
  <tr>
    <td>Slots:</td>
    <td>
<label>
      <select name="slots">
<?php
for($i = $allg['slot_min']; $i < $allg['slot_max']+1; $i = $i +$allg['slot_schritt'])
{
echo '<option value="'.$i.'">'.$i.' Slots</option>';
}
?>
      </select>
    </label></td>
  </tr>
  <tr>
    <td>Server Passwort: </td>
    <td><label>
      <input type="text" name="passwort" /> (Leer f&uuml;r Public)
    </label></td>
  </tr>
</table>    
</form>
<?php
if($_POST['leihen'])
{
$kill_code = codegen();
$email = $_POST['email'];
$passwort = $_POST['passwort'];
if($_POST['slots'] > $allg['slot_max'] OR $_POST['zeit'] > $allg['zeit_max'])
{
echo '<h4 class="alert_error">Es geht nicht, das die Slots oder die Zeit gr&ouml;&szlig;er als die Max. Slots oder Max. Zeit ist!</h4>';
}else{
if(empty($email) OR !checkEmail($email) OR checkwegwerf($email))
{
echo '<h4 class="alert_error">Die E-Mail Adresse ist ein Pflichfeld. Bitte f&uuml;lle Sie Ordnungsgem&auml;&szlig; aus! Bestimmte Domains werden wegen Wegwerf Services nicht unterst&uuml;tzt</h4>';
}else{



$ts3 = new ts3admin($allg['ts3ip'], $allg['ts3qport']);
if (!$ts3->getElement('success', $ts3->connect()))
{
echo '<h4 class="alert_error">Connection Error @ Ts3admin.class</h4>';
}else{

//Port bestimmen:
$abfrage = "SELECT * FROM port";
$ergebnis = mysql_query($abfrage);
$row = mysql_fetch_object($ergebnis);

$result = sprintf("SELECT * FROM port WHERE port_an LIKE '%s'",
            mysql_real_escape_string($row->port_an)
);
$menge = mysql_num_rows(mysql_query($result));

if($menge > 0)
{
$port = $row->port_an+1;
$result = sprintf("SELECT * FROM port WHERE port_an LIKE '%s'",
            mysql_real_escape_string($port)
);
$menge = mysql_num_rows(mysql_query($result));
if($menge > 0)
{
$portdel = $port+1;
$port = $portdel;
}else{
$port = $row->port_an;
}
}else{
$port = $row->port_an;
}


//Port +1
$new_port = $port+1;
if($new_port > $allg['max_port'])
{
$new_port2 = $allg['start_port'];
}else{
$new_port2 = $new_port;
}

$aendern = "UPDATE port Set port_an = '$new_port2'";
$update = mysql_query($aendern);

$zeit = $_POST['zeit'];
$zeit_start = time();
//ZEIT BERECHNEN
if($allg['zeit_angabe'] == 1)
{
$timeadd = $zeit*60;
$zeit_stop = $zeit_start+$timeadd;
}
if($allg['zeit_angabe'] == 2)
{
$timeadd2 = $zeit*60;
$timeadd = $timeadd2*60;
$zeit_stop = $zeit_start+$timeadd;
}
if($allg['zeit_angabe'] == 3)
{
$timeadd2 = $zeit*60;
$timeadd3 = $timeadd2*60;
$timeadd = $timeadd3*24;
$zeit_stop = $zeit_start+$timeadd;
}
//Eintrag erstellen
$userip = $_SERVER['REMOTE_ADDR'];
$timestamp = time();
$query = sprintf("INSERT INTO leih (email, port, ende, userip, kill_code, verlaengern, note_msg)
VALUES
('%s', '%s', '%s', '%s', '%s', '0', '0')",
            mysql_real_escape_string($email),
            mysql_real_escape_string($port),
            mysql_real_escape_string($zeit_stop),
            mysql_real_escape_string($userip),
            mysql_real_escape_string($kill_code)
);
$eintragen = mysql_query($query);
$insertid = mysql_insert_id();
$userip = $_SERVER['REMOTE_ADDR'];
$uhr = date("H:i:s");
$datum = date("d.m.Y");
$date_kom = $datum." um ".$uhr;

$eintragu = sprintf("INSERT INTO userdata (ip, email, datum, port)

VALUES
('%s', '%s', '%s', '%s')", mysql_real_escape_string($userip), mysql_real_escape_string($email), mysql_real_escape_string($date_kom), mysql_real_escape_string($port));
$eintragenu = mysql_query($eintragu);



	$ts3->login($allg['ts3user'], $allg['ts3passwort']);
if(!empty($passwort)) { $data['virtualserver_password'] = $passwort; }
                $data['virtualserver_name'] = "Teamspeak3Server";
                $data['virtualserver_port'] = $port;
		  $data['virtualserver_welcomemessage'] = $allg['ts3_welcomemsg'];
                $data['virtualserver_maxclients'] = $_POST['slots'];
			if($eintragen == true){

$server = $ts3->serverCreate($data);


//MAIL SENDEN
if($mail['stats_verleih'] == 1)
{
$absendername = $mail['absender_name'];
$absendermail = $mail['absender_mail'];
$kill_link_re = 'http://'.$_SERVER['SERVER_NAME'].''.$_SERVER['PHP_SELF'].'?page=kill&c='.$kill_code.'&id='.mysql_insert_id().'';
$mail['text_verleih'] = str_replace("{port}", $port, $mail['text_verleih']);
$mail['text_verleih'] = str_replace("{ip}", $allg['ts3ip'], $mail['text_verleih']);
$mail['text_verleih'] = str_replace("{qport}", $allg['ts3qport'], $mail['text_verleih']);
$mail['text_verleih'] = str_replace("{code}", $kill_code, $mail['text_verleih']);
$mail['text_verleih'] = str_replace("{token}", $server['data']['token'], $mail['text_verleih']);
$mail['text_verleih'] = str_replace("{kill_link}", $kill_link_re, $mail['text_verleih']);
mail($email, $mail['betreff_verleih'], $mail['text_verleih'], "From: $absendername <$absendermail>");
echo "<!-- Mail gesendet -->";
}else{ echo "<!-- Mail fuer diese Funktion ausgeschaltet! -->"; }
//MAIL SENDEN

echo '<br /><br /><table width="100%" border="0">
  <tr>
    <td colspan="2"><center><font style="font-size:16px;"><img src="images/de.png" /> '.$allg['ts3ip'].':'.$port.' (Query-Port: '.$allg['ts3qport'].')</font>
</center></td>
  </tr>
  <tr>
    <td>Admin Token:</td>
    <td><input name="token" id="token" value="'.$server['data']['token'].'" readonly="readonly" class="disabled" onclick="this.focus(); this.select();" type="text"></td>
  </tr>
';
if(!empty($passwort))
{
echo ' <tr>
    <td>Server Passwort:</td>
    <td><input name="passwort" id="passwort" value="'.$passwort.'" readonly="readonly" class="disabled" onclick="this.focus(); this.select();" type="text"></td>
  </tr>';
}
echo '
  <tr>
    <td>Sofort-Kill Link:</td>
    <td><input name="kill" id="kill" value="http://'.$_SERVER['SERVER_NAME'].''.$_SERVER['PHP_SELF'].'?page=kill&c='.$kill_code.'&id='.$insertid.'" readonly="readonly" class="disabled" onclick="this.focus(); this.select();" type="text"></td>
  </tr>
  <tr>
    <td>Code:<br />(wird z.B. f&uuml;r neuen Token ben&ouml;tigt, oder um die Zeit zu verl&auml;ngern, also unbedingt <b>Notieren!</b>)</td>
    <td><input name="code" id="code" value="'.$kill_code.'" readonly="readonly" class="disabled" onclick="this.focus(); this.select();" type="text"></td>
  </tr>
  <tr>
    <td></td>
    <td><a href="ts3server://'.$allg['ts3ip'].'?port='.$port.'&amp;nickname=none&amp;password='.$passwort.'&amp;token='.$server['data']['token'].'"><img src="images/ts3.png" alt="TeamSpeak3" title="Connect to TS3">Connect to Ts3</a></td>
  </tr>
</table>';
}else{
echo '<h4 class="alert_error">Es gab einen Fehler!</h4>';
}
}
}
}
}
}
}
temp_footer();
?>