<?php

/*$filename = 'time.txt';
$file = file_get_contents($filename);
$ar = explode('*',$file);

for($a=0;$a<=count($ar)-1;$a++){
    $systems[$a] = explode(':',$ar[$a]);
}


function add_system($systems,$systema)
{
$gmt = 3600*-0;
$cur_h = gmdate("H", time() + $gmt);
$cur_m = gmdate("i", time() + $gmt);
$cur_d = gmdate("d", time() + $gmt);
$cur_s = gmdate("s", time() + $gmt);
            $aray = array($cur_d,$cur_h,$cur_m,$cur_s,$systema);
            
            @array_push($systems[count($systems)-1] = $aray);
            //unset($systems[count($systems)]);
            var_dump($aray);
}

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}

function construct($systems)
{   $fname='time.txt';
    for($z=0;$z<=count($systems)-1;$z++)
    {
        $to_file .= $systems[$z][0].":".$systems[$z][1].":".$systems[$z][2].":".$systems[$z][3].":".$systems[$z][4]."*";
    }
    $stroka = $to_file;
    
    if (is_writable($fname)) {
    if (!$handle = fopen($fname, 'w')) {
         echo "Не могу открыть файл ($fname)";
         exit;
    }
    if (fwrite($handle, $stroka) === FALSE) {
        echo "Не могу произвести запись в файл ($fname)";
        exit;
    }
    }
}

if(!in_array_r('4b-yd1',$systems)){add_system($systems,'4b-yd1');}else{echo 'ddd';}*/
/*$gmt = 3600*-1;
$cur_h = gmdate("H", time() + $gmt);
$cur_m = gmdate("i", time() + $gmt);
echo $cur_h;*/
$text = 'false';
if($text)
{
    echo 'works';
}else{
    echo 'don"t';
}