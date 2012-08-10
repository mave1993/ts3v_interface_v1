<?php
function binary_multiples($size, $praefix=true, $short= true)
{

    if($praefix === true)
    {
        if($short === true)
        {
            $norm = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 
                          'EB', 'ZB', 'YB');
        }
        else
        {
            $norm = array('Byte', 
                          'Kilobyte', 
                          'Megabyte', 
                          'Gigabyte', 
                          'Terabyte', 
                          'Petabyte', 
                          'Exabyte', 
                          'Zettabyte', 
                          'Yottabyte'
                         );
        }
        
        $factor = 1000;
    }
    else
    {
        if($short === true)
        {
            $norm = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 
                          'EiB', 'ZiB', 'YiB');
        }
        else
        {
            $norm = array('Byte', 
                          'Kibibyte', 
                          'Mebibyte', 
                          'Gibibyte', 
                          'Tebibyte', 
                          'Pebibyte', 
                          'Exbibyte', 
                          'Zebibyte', 
                          'Yobibyte'
                         );
        }
        
        $factor = 1024;
        
    }
    
    $count = count($norm) -1;
    
    $x = 0;
    while ($size >= $factor && $x < $count) 
    { 
        $size /= $factor; 
        $x++;
    } 
  
  $size = sprintf("%01.2f", $size) . ' ' . $norm[$x];

    return $size; 

}
?>