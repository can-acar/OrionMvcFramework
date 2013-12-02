<?php
function Hex2Bin($h) { 
    if (!is_string($h)) return null; 
    $r = array(); 
    for ($a=0; ($a*2)<strlen($h); $a++) { 
        $ta = hexdec($h[2*$a]); 
        $tb = hexdec($h[(2*$a+1)]); 
        $r[$a] = (int) (($ta << 4) + $tb); 
    } 
    return $r; 
} 
?>