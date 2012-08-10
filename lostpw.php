<!DOCTYPE HTML>
<html>
<head>
<title>Ts3Verleih Interface</title>
<meta charset="UTF-8" />
<meta name="Designer" content="PremiumPixels.com">
<meta name="Author" content="$hekh@r d-Ziner, CSSJUNTION.com">
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/structure.css">
</head>

<body>
	<section id="main" class="column">
<?php
if($_POST['send'])
{
$username = $_POST["username"];
$email = $_POST["email"];
$abfrage = sprintf("SELECT * FROM user WHERE username = '%s' LIMIT 1",
            mysql_real_escape_string($username));
$ergebnis = mysql_query($abfrage);
$row = mysql_fetch_object($ergebnis);

if($row->email == $email AND !empty($username) AND !empty($email))
    {
$pw = generatePW();
$md5pw = md5($pw);
$email = $row->email;
$absendername = $mail['absender_name'];
$absendermail = $mail['absender_mail'];
$mail['text_lostpw'] = str_replace("{pw}", $pw, $mail['text_lostpw']);
$mail['text_lostpw'] = str_replace("{name}", $username, $mail['text_lostpw']);
mail($email, $mail['betreff_lostpw'], $mail['text_lostpw'], "From: $absendername <$absendermail>");
echo '<h4 class="alert_success">Du erh&auml;lst nun eine E-Mail mit dem neuen Passwort</h4>
                </div>
';
$iid = $row->id;
$aendern = "UPDATE user Set password = '$md5pw'  WHERE id = '$iid'";
$update = mysql_query($aendern);
}else{
echo '<h4 class="alert_error">Benutzername und/oder Email falsch!</h4>';
    } 
}
?>
<form id="form1" name="form1" method="post" action="" class="box login">
	<fieldset class="boxBody">
	  <label>Username</label>
	  <input type="text" tabindex="1" placeholder="Username" name="username" required>
	  <input type="text" name="email" placeholder="E-Mail" tabindex="2" required>
	</fieldset>
	<footer>

	  <input type="submit" class="btnLogin" name="send" value="Senden" tabindex="4">
	</footer>
</form>
<footer id="main">
  <a href="http://wwww.cssjunction.com">Simple Login Form (HTML5/CSS3 Coded) by CSS Junction</a> | <a href="http://www.premiumpixels.com">PSD by Premium Pixels</a>
</footer>
</secion>
</body>
</html>

