<?php
function time_check($time)
{
$file = file_get_contents($time);
$ar = explode(':',$file);
$email = 'adfsdfhgfghkjfgd@gmail.com';
$cur_h =  date('H');
$cur_m =  date('i');
$cur_d =  date('d');
$curr_dat = $cur_d.ad_zero($cur_h).ad_zero($cur_m);
$date_d = $ar[0].ad_zero($ar[1]).ad_zero($ar[2]);
$dif = $date_d-$curr_dat;
if($dif <= 60 && $dif > 0){
    sent($dif,$email);     
}else{
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
{$message = 'Время 10/10 истекает через '.$time.' минут';
 mail($email, "Суко", $message,
 "From: ccp@eveonline.com\r\n"
."X-Mailer: PHP/" . phpversion());
}

function er_sent()
{mail('adfsdfhgfghkjfgd@gmail.com', "Суко", 'путь не верен',
 "From: ccp@eveonline.com\r\n"
."X-Mailer: PHP/" . phpversion());
}

$file = 'time.txt';
$llo  = '/home/l/luhta/eve-hulk.ru/public_html/10/time.txt';
if(file_exists($llo))
{
    time_check($llo);
}else{
    er_sent();
}