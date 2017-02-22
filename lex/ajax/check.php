<?php

$filename = 'options.txt';
$config = array();
if(is_file($filename))
{
$file = file_get_contents($filename);
$ar = explode(';',$file);

for($a=0;$a<=count($ar)-1;$a++){
    $infa[$a] = explode(':',$ar[$a]);
}

for($z=0;$z<=count($infa)-1;$z++)
{
    $cfg[trim($infa[$z][0])] = $infa[$z][1];
}
}
require_once '../config.php';
require_once '../functions.php';
if($_POST['keyID'] && $_POST['vCode'] && $_POST['corpid'])
{

    $link = 'https://api.eveonline.com/char/CharacterSheet.xml.aspx?keyID='.$_POST['keyID'].'&vCode='.$_POST['vCode'];
    $xml = @(array)getXml($link,2);
    if($xml['result'])
    {
        if($xml['result']->corporationID == $_POST['corpid'])
        {
        if(check_id($xml['result']->characterID) == 0)
        {     
        $month = date('m');
        if($_POST['main'] == '1')
        {$sql = 'INSERT INTO `eve_online_pilots` '.
        '(`Char_id`, `Char_name`, `Corp_id`, `data`, `month`, `id_main`) VALUES'.
        '("'.$xml['result']->characterID.'", "'.$xml['result']->name.'", "'.$xml['result']->corporationID.'", "'.$xml['result']->DoB.'", "'.$month.'",
        "'.$xml['result']->characterID.'"
        )';}else{
        $sql = 'INSERT INTO `eve_online_pilots` '.
        '(`Char_id`, `Char_name`, `Corp_id`, `data`, `month`, `id_main`) VALUES'.
        '("'.$xml['result']->characterID.'", "'.$xml['result']->name.'", "'.$xml['result']->corporationID.'", "'.$xml['result']->DoB.'", "'.$month.'",
        "'.$_POST['mainid'].'"
        )';            
        }
        if(exec_query($sql))
        {
            
                $up = 'UPDATE `eve_online_pilotki` SET `id_main` = "'.$_POST['keyID'].'"';
            
            echo 'Новый пилот '.$xml['result']->name.' зарегистрирован';
        }
        }else{
            $sql = 'UPDATE `eve_online_pilots` z SET z.`vcode` = "'.$_POST['vCode'].'", z.`keyid` = "'.$_POST['keyID'].'" z.`corp_dolg` = "150000000" WHERE z.`Char_id` = '.$xml['result']->characterID;
            $fet = exec_query($sql);
            echo 'пилот '.$xml['result']->name.' уже есть в базе '."\n".'Секюр код добавлен!';
        }
        }else{
            echo 'Ошибка, вы с другой корпорации'."\n".'ID корпорации не совпадают';         
        }
    }
    else
    {
        echo 'Ошибка, не верно введенные данные или api сервис не работает ';
    }
}

if(isset($_POST['act']) && isset($_POST['cdolg']))
{
    if($_POST['act'] == 'up')
    {
        $sql = 'UPDATE `eve_online_pilots` d SET d.`Corp_dolg` = "'.$_POST['cdolg'].'" WHERE d.`Corp_id` = "'.$_POST['corp'].'" 
        AND d.`Char_id` = "'.$_POST['charid'].'"';
        $ret = exec_query($sql);
        echo $ret;
    }
    elseif($_POST['act'] == 'dell')
    {
        $sql = 'DELETE eve_online_pilots, eve_online_nalog FROM `eve_online_pilots` INNER JOIN `eve_online_nalog` ON eve_online_nalog.charid = eve_online_pilots.Char_id'.
        ' WHERE eve_online_pilots.Char_id = "'.$_POST['charid'].'" AND eve_online_nalog.charid = "'.$_POST['charid'].'" AND 
        eve_online_pilots.Corp_id = "'.$_POST['corp'].'" AND eve_online_nalog.corpid = "'.$_POST['corp'].'"
        ';
       $ret = exec_query($sql);
       echo $ret;
    }
}

if($_GET['nala'])
{
    $cfg['nalog'] = $_GET['nala'];
    $fname='options.txt';
    foreach($cfg as $key=>$val)
    {   
        $to_file .= $key.':'.$val.';';
    }
    
    echo $to_file;
    
    $stroka = $to_file;
    
    if(strpos($stroka,'\xEF\xBB\xBF')=== TRUE)
    {
        $stroka = str_replace($stroka, '','\xEF\xBB\xBF');
    }
    
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

function check_id($id)
{
    $sql = 'SELECT `Char_id` FROM `eve_online_pilots` WHERE `Char_id` = "'.$id.'"';
    $res = fetch_all($sql);
    return count($res);
}