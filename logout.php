<?php
if(session_destroy())
{
echo '<h4 class="alert_success">Erfolgreich ausgeloggt! - <a href="index.php">Weiter in 2 Sekunden</a></h4>
               
 <meta http-equiv="refresh" content="2; URL=index.php">
';
}else{
echo '<h4 class="alert_error">Fehler beim ausloggen! - <a href="index.php">Zur&uuml;ck</a></h4>
';
}
?>