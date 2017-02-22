<?php
$file1 = 'codw.txt';
$pass = file_get_contents($file1);


function cookie_chek($pass)
{
    if(isset($_COOKIE['sifrr']) && !empty($_COOKIE['sifrr']))
    {
     if($_COOKIE['sifrr'] == $pass)
     {
     return 'true';
     }else{
    setcookie("sifrr", '', 0);
    return 'false';}
    }elseif(isset($_POST['sifrr']) && empty($_COOKIE['sifrr']))
    {add_cook($pass);}
}

function add_cook($pass)
{
    if($_POST['sifrr'] == $pass)
    {
    setcookie("sifrr", $pass, time()+3600*168);
    unset($_POST['sifrr']);
    echo '<meta http-equiv="refresh" content="0;URL='.$_SERVER['http_host'].'">';
    return 'true';
    }else{
    unset($_POST['sifrr']);        
    echo '<meta http-equiv="refresh" content="0;URL='.$_SERVER['http_host'].'">';           
    return 'false';}
}