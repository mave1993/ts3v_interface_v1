<?php
temp_header("Mail Config");
if(!is_admin())
{
echo '<h4 class="alert_error">Du hast leider keine Rechte ;)</h4>';
}else{
?>
<h4 class="alert_info">Schreibbarkeit der mail_config.php: <?php if ( @is_writeable ( 'include/mail_config.php' ) ) { echo '<font color="#40aa00"><b>Schreibbar</b></font>'; } else { echo '<font color="#FF0000"><b>nicht Schreibbar</b>, &auml;nderungen im Editor haben keinen Sinn!</font>'; } ?></h4>
<?php
// set file to read
$filename = "include/mail_config.php";
  
$newdata = $_POST['newd'];

if ($newdata != '') {

// open file 
$fw = fopen($filename, 'w') or die('Could not open file!');
// write to file
// added stripslashes to $newdata
$fb = fwrite($fw,stripslashes($newdata)) or die('Could not write 
to file');
// close file
fclose($fw);
}

// open file
  $fh = fopen($filename, "r") or die("Could not open file!");
// read file contents
  $data = fread($fh, filesize($filename)) or die("Could not read file!");
// close file
  fclose($fh);
// print file contents
 echo "<h3>Contents of File</h3>
<form action='$_SERVER[php_self]' method= 'post' >
<textarea name='newd' cols='68' rows='45'> $data </textarea>
<br />
<input type='submit' value='Speichern'>
</form>";
}
temp_footer();
?> 