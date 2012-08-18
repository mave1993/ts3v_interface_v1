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
if($_POST['login'])
{
$username = $_POST["username"];
$passwort = md5($_POST["password"]);
$abfrage = sprintf("SELECT * FROM user WHERE username = '%s' LIMIT 1",
            mysql_real_escape_string($username));
$ergebnis = mysql_query($abfrage);
$row = mysql_fetch_object($ergebnis);
if($_POST['save'] == 1)
{
session_set_cookie_params('43200'); // 12 hours
session_regenerate_id(true); 
}
if($row->password == $passwort)
    {
    $_SESSION["username"] = $row->username;
    $_SESSION["userid"] = $row->id;
    $_SESSION["email"] = $row->email;

$_SESSION["adminstats"] = $row->admin;
$_SESSION['ssh2pw'] = "";
if(empty($row->lastlogin))
{
$lastlogin = time();
}else{
$lastlogin = $row->lastlogin;
}
$_SESSION["lastlogin"] = $lastlogin;

$ll = time();
$iid = $row->id;
$aendern = "UPDATE user Set lastlogin = '$ll'  WHERE id = '$iid'";
$update = mysql_query($aendern);

echo '<h4 class="alert_success">Erfolgreich eingeloggt! - <a href="index.php">Weiter in 2 Sekunden</a></h4>
 <meta http-equiv="refresh" content="2; URL=index.php">
';
    }
else
    {
echo '<h4 class="alert_error">Benutzername und/oder Passwort falsch! <a href="index.php?page=lostpw">Passwort Vergessen?</a></h4>';
    } 
}else{
echo '<h4 class="alert_info">Bitte Logge dich zuerst ein!</h4>';
}
?>

<form id="form1" name="form1" method="post" action="" class="box login">
	<fieldset class="boxBody">
	  <label>Username</label>
	  <input type="text" tabindex="1" placeholder="Username" name="username" required>
	  <label><a href="index.php?page=lostpw" class="rLink" tabindex="5">Forget your password?</a>Password</label>
	  <input type="password" name="password" tabindex="2" required>
	</fieldset>
	<footer>

	  <input type="submit" class="btnLogin" name="login" value="Login" tabindex="4">
<br />
<a href="index.php?page=regist">Registrieren</a>
	</footer>
</form>
<footer id="main">
  <a href="http://www.cssjunction.com">Simple Login Form (HTML5/CSS3 Coded) by CSS Junction</a> | <a href="http://www.premiumpixels.com">PSD by Premium Pixels</a>
</footer>
</secion>
</body>
</html>

