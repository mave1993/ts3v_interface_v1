<?php
$mail['absender_name'] = "Rent-a-Ts3";
$mail['absender_mail'] = "mave1993@hotmail.de";

//Variablen: {ip}, {port}, {token}, {code}, {kill_code}, {qport}
$mail['stats_verleih'] = 1;
$mail['text_verleih'] = "Dein Server wurde gestartet\n Er hat die IP {ip}:{port}\n\nDein Server-Admin-Token lautet: {token}\n\nUm deine Zeit zu verlдngern oder um einen neuen Server-Admin-Token anzufordern benцtigst du einen Code, dieser lautet: {code}\n\nUm den Server sofort zu beenden klicke auf folgenden Link: {kill_link}\n\n Viel Spaя mit deinem Server!\n Dein Rent-a-Ts3 Team!";
$mail['betreff_verleih'] = "Rent-a-Ts3";

//Variablen: none
$mail['stats_cron'] = 1;
$mail['text_cron'] = "Dein Server ist abgelaufen.\n\nLiebe Grьяe dein Rent-a-Ts3 Team";
$mail['betreff_cron'] = "Rent-a-Ts3: abgelaufen";

//Variablen: {ip}, {port}, {code}, {time}
$mail['stats_note'] = 1;
$mail['text_note'] = "Dein Server wird in {time} heruntergefahren. Gehe auf http://".$_SERVER['SERVER_NAME']."/index.php?page=verlaengern und gebe deinen Code ein.\nDein Code lautet {code}.\n\nLiebe Grьяe dein Rent-a-Ts3 Team";
$mail['betreff_note'] = "Rent-a-Ts3: endet bald!";


$mail['absender_name'] = "Ts3Info.de";
$mail['absender_mail'] = "support@mave1993.de";
$mail['text_regist'] = "Guten Tag\nDein Passwort lautet {pw} \nDu kannst dich nun Einloggen und es dort wechseln!";
$mail['betreff_regist'] = "Neue Registrierung";

$mail['text_offline'] = "Guten Tag\nDeine Instanz {ip}:{qport} ist Offline";
$mail['betreff_offline'] = "Instanz Offline";

$mail['text_offline_sms'] = "Guten Tag. Deine Instanz {ip}:{qport} ist Offline. Schaue jetzt auf ts3info.de vorbei!";

$mail['text_lostpw'] = "Guten Tag {name}\n\nDein neues Passwort lautet: {pw} \n\nMelde dich nun damit auf http://ts3info.de an!";
$mail['betreff_lostpw'] = "Passwort Recovery";

$mail['text_lostpw_sms'] = "Hallo {name} - Dein neues Passwort lautet {pw} - Logge dich jetzt auf Ts3Info.de ein!";

?>