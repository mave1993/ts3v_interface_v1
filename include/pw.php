<?php
    //QUELLE: http://www.inside-php.de/scripte/PHP-Code%20Ausschnitte-18/Erweiterter-Passwort-Generator.html
    // Generate a random password
     
    function generatePW($length=8)
    {
     
    $dummy	= array_merge(range('0', '9'), range('a', 'z'), range('A', 'Z'));
     
    // shuffle array
     
    mt_srand((double)microtime()*1000000);
    for ($i = 1; $i <= (count($dummy)*2); $i++)
    {
    $swap	= mt_rand(0,count($dummy)-1);
    $tmp	= $dummy[$swap];
    $dummy[$swap]	= $dummy[0];
    $dummy[0]	= $tmp;
    }
     
    // get password
     
    return substr(implode('',$dummy),0,$length);
     
    }

    ?> 