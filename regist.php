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
	<section id="main" class="column"><?php
	if($_GET['debug'] == "on")
	{
	echo '<h4 class="alert_info"><b>DEBUG MODE ON</b><br />';
if(function_exists('ImageCreateFromPNG')) {
echo "ImageCreateFromPNG function is enabled<br />";
}
else {
echo "ImageCreateFromPNG is not enabled<br />";
}

if(function_exists('ImageColorAllocate')) {
echo "ImageColorAllocate function is enabled<br />";
}
else {
echo "ImageColorAllocate is not enabled<br />";
}

if(function_exists('imagettftext')) {
echo "imagettftext function is enabled<br />";
}
else {
echo "imagettftext is not enabled<br />";
}

if(function_exists('imagepng')) {
echo "imagepng function is enabled<br />";
}
else {
echo "imagepng is not enabled<br />";
}

if(function_exists('imagedestroy')) {
echo "imagedestroy function is enabled<br />";
}
else {
echo "imagedestroy is not enabled<br />";
}

	echo '</h4>';
	
	}
	
	
if($_POST['regist'])
{

$username = $_POST["username"];
$email = $_POST['email'];

if(empty($_POST['handy'])){ $handy = "0162123456"; }else{ $handy = $_POST['handy']; }

if($username == "" OR $email == "" OR isset($_SESSION['captcha_spam']) AND $_POST["sicherheitscode"] != $_SESSION['captcha_spam'])
    {
echo '<h4 class="alert_error">Eingabefehler, bitte alle Felder ausf&uuml;llen oder Captcha eingabe falsch!</h4>';
    }else{
unset($_SESSION['captcha_spam']);
$passwort = generatePW();
$passwort2 = md5($passwort);

$result = sprintf("SELECT * FROM user WHERE username LIKE '%s'",
            mysql_real_escape_string($username)
);
$menge = mysql_num_rows(mysql_query($result));

$result2 = sprintf("SELECT * FROM user WHERE email LIKE '%s'",
            mysql_real_escape_string($email)
);
$menge2 = mysql_num_rows(mysql_query($result));

if($menge == 0 AND $menge2 == 0)
    {

$eintrag = sprintf("INSERT INTO user (username, password, email, admin, handy) VALUES ('%s', '%s', '%s', 0, '%s')",
            mysql_real_escape_string($username),
            mysql_real_escape_string($passwort2),
            mysql_real_escape_string($email),
            mysql_real_escape_string($handy)
);

    $eintragen = mysql_query($eintrag);
$absendername = $mail['absender_name'];
$absendermail = $mail['absender_mail'];
$mail['text_regist'] = str_replace("{pw}", $passwort, $mail['text_regist']);
mail($email, $mail['betreff_regist'], $mail['text_regist'], "From: $absendername <$absendermail>");
    if($eintragen == true)
        {
echo '<h4 class="alert_success">Die Registrierung war erfolgreich! Du hast eine E-Mail mit deinem Passwort erhalten, dies kannst du im Userbereich �ndern! - <a href="index.php">Zum Login</a></h4>';
        }
    else
        {
echo '<h4 class="alert_error">Fehler beim speichern vom Benutzer '.$username.'!</h4>';        }


    }

else
    {
echo '<h4 class="alert_error">Benutzername oder E-Mail Adresse ist bereits im System Registriert!</h4>';    }
}

}else{
echo '<h4 class="alert_info">Neu Registrieren!</h4>';
}

?>
<form id="form1" name="form1" method="post" action="" class="box login">

	<fieldset class="boxBody">
	  <input type="text" value="<?php echo $_POST["username"]; ?>" tabindex="1" placeholder="Username" name="username" required>
	  <input type="text" value="<?php echo $_POST["email"]; ?>" tabindex="1" placeholder="E-Mail" name="email" required>
<center><img src="captcha.php" border="0" title="Sicherheitscode"></center><input tabindex="1" type="text" name="sicherheitscode" size="10" required>
	</fieldset>


	</footer>
	  <input type="submit" class="btnLogin" name="regist" value="Registrieren" tabindex="4">

</form>
</div>
<footer id="main">
  <a href="http://wwww.cssjunction.com">Simple Login Form (HTML5/CSS3 Coded) by CSS Junction</a> | <a href="http://www.premiumpixels.com">PSD by Premium Pixels</a>
</footer>
</secion>
</body>
</html>