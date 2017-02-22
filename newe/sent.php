<?php
function time_check($time)
{
$file = file_get_contents($time);
$ar = explode('*',$file);

for($a=0;$a<=count($ar)-1;$a++){
    $systems[$a] = explode(':',$ar[$a]);
}

$email = 'dristzapor@gmail.com';
$gmt = 3600*-0;
$cur_h = gmdate("H", time() + $gmt);
$cur_m = gmdate("i", time() + $gmt);
$cur_d = gmdate("d", time() + $gmt);

$curr_dat = ad_zero($cur_d).ad_zero($cur_h).ad_zero($cur_m);

for($x=0;$x<=count($systems)-2;$x++)
{
$date_d = $systems[$x][0].ad_zero($systems[$x][1]).ad_zero($systems[$x][2]);
$dif = $date_d-$curr_dat;
if($dif <= 60 && $dif > 0)
{$report .= $systems[$x][4]."|".$dif." ";  
}
}

if(!empty($report))
{
    sent($report,$email);
}
}

function ad_zero($mins)
{
    if(strlen($mins) == 1)
    {
        return '0'.$mins;
        
    }else
    {
        return $mins;
    }
}

function sent($time,$email)
{$message = 'До закрытия 10/10 в '.$time.' минут';
 mail($email, "Суко", $message,
 "From: suchka@evjopa.com\r\n"
."X-Mailer: PHP/" . phpversion());
}

function er_sent()
{mail('dristzapor@gmail.com', "Суко", 'путь не верен епта',
 "From: suchka@evjopa.com\r\n"
."X-Mailer: PHP/" . phpversion());
}

$file = 'time.txt';
$llo  = '/home/f/friiw/test.kino-smena.ru/public_html/exp/time.txt';
if(file_exists($llo))
{
    time_check($llo);
}else{
    time_check($file);
}