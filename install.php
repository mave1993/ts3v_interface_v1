	<title>Ts3-Verleih Interface Installation</title>
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]--><br /><br /><br />
<center><form name="form1" method="post" action=""><table width="450" border="0">
  <tr>
    <td>Schreibrechte /include/config.php</td>
    <td><?php if ( @is_writeable ( 'include/config.php' ) ) { echo '<font color="#40aa00"><b>Schreibbar</b></font>'; } else { echo '<font color="#FF0000"><b>nicht Schreibbar</b>'; } ?></td>
  </tr>
  <tr>
    <td>Schreibrechte /include/mail_config.php</td>
    <td><?php if ( @is_writeable ( 'include/mail_config.php' ) ) { echo '<font color="#40aa00"><b>Schreibbar</b></font>'; } else { echo '<font color="#FF0000"><b>nicht Schreibbar</b>'; } ?></td>
  </tr>
  <tr>
    <td>Ausf&uuml;hrbarkeit cron.sh</td>
    <td><?php if ( @is_executable ( 'cron.sh' ) ) { echo '<font color="#40aa00"><b>Ausf&uuml;hrbar</b></font>'; } else { echo '<font color="#FF0000"><b>nicht Ausf&uuml;hrbar</b>'; } ?></td>
  </tr>
  <tr>
    <td>Ausf&uuml;hrbarkeit backup_cron.sh</td>
    <td><?php if ( @is_executable ( 'backup_cron.sh' ) ) { echo '<font color="#40aa00"><b>Ausf&uuml;hrbar</b></font>'; } else { echo '<font color="#FF0000"><b>nicht Ausf&uuml;hrbar</b>'; } ?></td>
  </tr>
  <tr>
    <td>Ausf&uuml;hrbarkeit erinnerung.sh</td>
    <td><?php if ( @is_executable ( 'erinnerung.sh' ) ) { echo '<font color="#40aa00"><b>Ausf&uuml;hrbar</b></font>'; } else { echo '<font color="#FF0000"><b>nicht Ausf&uuml;hrbar</b>'; } ?></td>
  </tr>
  <tr>
    <td>Ausf&uuml;hrbarkeit maxclients.sh</td>
    <td><?php if ( @is_executable ( 'maxclients.sh' ) ) { echo '<font color="#40aa00"><b>Ausf&uuml;hrbar</b></font>'; } else { echo '<font color="#FF0000"><b>nicht Ausf&uuml;hrbar</b>'; } ?></td>
  </tr>
  <tr>
    <td>Schreibrechte /backup/ Ordner </td>
    <td><?php if ( @is_writeable ( 'backup/' ) ) { echo '<font color="#40aa00"><b>Schreibbar</b></font>'; } else { echo '<font color="#FF0000"><b>nicht Schreibbar</b>'; } ?></td>
  </tr>
  <tr>
    <td>Admin Username </td>
    <td><label>
      <input type="text" name="user" />
    </label></td>
  </tr>
  <tr>
    <td>Admin Passwort </td>
    <td><input type="text" name="pw" /></td>
  </tr>
  <tr>
    <td>Admin E-Mail </td>
    <td><input type="text" name="email" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
        <input type="submit" name="install" value="Installieren">    </td>
  </tr>
</table>    
</form></center>
<?php
if($_POST['install'])
{
include("include/config.php");
include("include/mysqlcon.php");

$sql_file = implode('',file('install.sql'));
$sql_file = preg_replace ("/(\015\012|\015|\012)/", "\n", $sql_file);
$sql_statements = explode(";\n",$sql_file);
foreach ( $sql_statements as $sql_statement ) {
  if ( trim($sql_statement) != '' ) {
    mysql_query($sql_statement);
	}
}
$username = $_POST['user'];
$passwort2 = md5($_POST['pw']);
$email = $_POST['email'];
$eintrag = sprintf("INSERT INTO user (username, password, email, admin) VALUES ('%s', '%s', '%s', 1)",
            mysql_real_escape_string($username),
            mysql_real_escape_string($passwort2),
            mysql_real_escape_string($email)
);
echo '<h4 class="alert_success">Installation wurde erfolgreich gel&ouml;scht!</h4>';
}
?>