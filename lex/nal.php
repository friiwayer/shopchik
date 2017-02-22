<?php

require_once 'config.php';
require_once 'fun.php';
 

$file_basename = basename( __FILE__ );

$corp_id = false;


$rm_addr = @$_SERVER['REMOTE_ADDR'];

$psw_value = $pswConfig['test_password'];
$corp_id = $psw_value;

$file = $file_basename.'?pswc='.rawurlencode($psw_value);

$keyid = '';
$vcode = '';

$char = '';
$word_ = '';
if(isset($_COOKIE['login']))
{
    $btw = get_id($_COOKIE['login'],$_COOKIE['password']);
    $char_ = explode(':',$btw);
    $char = $char_[0];
    $word_ = $char_[1];
}

$time = 4;
if(isset($_POST['remember']))
{
    $time = 24*3;
}

if(log_in(($_POST['ips_username']), $_POST['ips_password']))
{
    if(!$_COOKIE['login'] || $_COOKIE['password']){
    setcookie('login',$_POST['ips_username'],time()+3600*$time);
    setcookie('password',$_POST['ips_password'],time()+3600*$time);
    setcookie('pas_in',"1",time()+3600*$time);
    setcookie('charid',$char,time()+3600*$time);}
    unset($_POST['ips_username']);
    unset($_POST['ips_password']);
    unset($_POST['submit']);
    echo '<meta http-equiv="refresh" content="0;URL='.$_SERVER['http_host'].'">';        
}elseif($_POST['ips_username'] == $config['login'] && $_POST['ips_password']==$config['pass'])
{
    
}

if(isset($_POST['logout']))
{
    setcookie("login", "", time()-3600);
    setcookie("password", "", time()-3600);
    setcookie("pas_in", "", time()-3600);
    unset($_POST['logout']);
    header('Refresh: 0;URL='.$_SERVER['http_host']);    
}
if(isset($_POST['char_n']))
{
    $sql = 'DELETE FROM `eve_online_pilots` WHERE `Char_name` = "'.$_POST['char_n'].'"';
    exec_query($sql);
    unset($_POST['char_n']);
}

$corpName = fetch_one( 'SELECT `corp` FROM `eve_online_wallet` WHERE `corpid` = '.$corp_id , 'corp' );

$period_filter = '';

if(isset($_GET['from']) && isset($_GET['tomuch']))
{
    $period_filter = ' AND w.`date` BETWEEN STR_TO_DATE("'.$_GET['from'].' 00:00:00", "%Y-%m-%d %H:%i:%s") AND STR_TO_DATE("'.$_GET['tomuch'].' 23:59:59", "%Y-%m-%d %H:%i:%s")';
}

$charid = null;
if( !empty($_GET['char']) ) {
	$str = "SELECT `charid` FROM `eve_online_wallet` WHERE `char` LIKE '".addslashes($_GET['char'])."' LIMIT 1 ";
	$charid = (int)fetch_one( $str , 'charid' );
	if( !$charid ) {
		$charid = 1;
	}	
	$period_filter .= " AND w.`charid` = '".$charid."' ";	
} 

if($_POST['members_display_name'] && $_POST['EmailAddress'] && $_POST['secret_word'] == $config['sec_word'] && 
strtolower($_POST['members_display_name']) != 'admin')
{
    $rnd_w = generateRandomString();
    $name = (string)trim($_POST['members_display_name']);
    $mail = $_POST['EmailAddress'];
    if(find_dbl($rnd_w) && mail_check($mail))
    {
    $sql = 'INSERT INTO `eve_online_pilotki` 
    (`pilot_name`,`pass`,`email`, `pers_word`)VALUES
    ("'.$_POST['members_display_name'].'", "'.$_POST['PassWord'].'", "'.$_POST['EmailAddress'].'", "'.$rnd_w.'")';
    $exec = exec_query($sql);
    }
    unset($_POST['members_display_name']);
    unset($_POST['EmailAddress']);
    unset($_POST['secret_word']);
    unset($_POST['PassWord']);
}

function generateRandomString($length = 5){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function find_dbl($word)
{
    $pilot = $name==''?'':'AND `pilot_name`='.$name;
    $slovo = $word==''?'':'AND `pers_word`="'.$word;
    $sql = 'SELECT `id` FROM `eve_online_pilotki` WHERE 1 '.$slovo;
    $do = fetch_all($sql);
    if(count($do)>0)
    {
        return false;
    }
    else{
        return true;
    }
}

function mail_check($mail=''){
    $sql = 'SELECT `id` FROM `eve_online_pilotki` WHERE 1 AND `email` = "'.$mail.'"';
    $zo = fetch_all($sql);
    if(count($zo)==1)
    {return false;}
    else{return true;}    
}

$sql = "SELECT MAX( w.`date` ) AS maxdate, MIN( w.`date` ) AS mindate
	FROM eve_online_wallet w
	WHERE 1 {$period_filter} AND `corpid` = '{$corp_id}' ";
$date_filter_res = array( 'maxdate' => 'none', 'mindate' => 'none' );	

$date_filter_res = fetch_one($sql);

$month = '';
if(isset($_GET['m']))
{
    $month = 'AND MONTH(w.`date`) = '.trim($_GET['m']).' ';
}

$filter_msg = filter_nalog('w',$config);
$str = "SELECT w.`char` AS _charName, SUM(w.`amount`) AS _ratBountys, w.`date` AS _date, w.`charid` as _charid, w.`reason` as _reason, e.`keyid` AS _keyid, e.`vcode` AS _vcode,
    DATE_FORMAT(w.`date`, '%M') as _month
	FROM `eve_online_nalog` w
    INNER JOIN `eve_online_pilots` e ON (e.`Char_id` = w.`charid`) 
	WHERE 1 {$filter_msg} {$period_filter} {$month} AND w.`corpid` = '{$corp_id}'
    GROUP BY _charid,_month
    ORDER BY _month DESC";
	
$ratting_all = fetch_all($str);
	foreach( $ratting_all as &$day ) {
        $day['charName'] = $day['_charName'];	   
		$unixtime = strtotime( $day['_date'] );
		$day['date'] = rusDate(date( 'm-Y' , $unixtime ));
		
		$day['ratBountys'] = $day['_ratBountys'];
        $day['Desc'] = $day['_reason'];
        $keyid['keyid'] = $day['_keyid'];
        $vcode['vcode'] = $day['_vcode'];
	}
$chr_id_fltr = ' ';
if($char != '')
{
    $chr_id_fltr = "INNER JOIN `eve_online_pilots` e ON (e.`id_main` = '".$char."')";   
}
$filter_msg = ''; //filter_nalog('w',$config);
$str = "SELECT w.`char` AS _charName, SUM(w.`amount`) AS _ratBountys, w.`date` AS _date, w.`charid` as _charid, w.`reason` as _reason, e.`keyid` AS _keyid, e.`vcode` AS _vcode,
    DATE_FORMAT(w.`date`, '%M') as _month, e.`Corp_dolg` AS _Corp_dolg
	FROM `eve_online_nalog` w 
    {$chr_id_fltr}      
	WHERE 1 {$filter_msg} {$period_filter} {$month} AND w.`corpid` = '{$corp_id}' AND w.`charid` = e.`Char_id`
    GROUP BY _charid,_month
    ORDER BY _month DESC";
	
$ratting_one = fetch_all($str);
	foreach($ratting_one as &$day) {
        $day['charName'] = $day['_charName'];	   
		$unixtime = strtotime( $day['_date'] );
		$day['date'] = rusDate(date( 'm-Y' , $unixtime ));	   
		$day['ratBountys'] = $day['_ratBountys'];
        $keyid['keyid'] = $day['_keyid'];
        $vcode['vcode'] = $day['_vcode'];
		$day['Corp_dolg'] = $day['_Corp_dolg']; 
	}

$str = "SELECT w.`Char_name` as _Char_name, w.`Char_id` as _charid, w.`id_main` as _idparent, w.`id_main` as _id_main, w.`if_main` as _main
	FROM `eve_online_pilots` w
    INNER JOIN `eve_online_pilotki` p ON (p.`id` = {$char}) 
    WHERE 1 AND w.`Corp_id` =  '{$corp_id}' AND w.`id_main` = p.`id`
    ORDER BY w.`data` DESC
    ";
	
$_pilot = fetch_all($str);
	foreach($_pilot as &$day)
    {
        $day['Char_name'] = $day['_Char_name'];
        $day['smain'] = $day['_main']==1?'мейн':'альт';        
    }

if( @$_GET['show_xml'] == 'true' ) {
	include 'class.domdoc.php';
	
	$xmlBuilder = new domdoc();
	$feed_body = $xmlBuilder->createElement('iskfarmers');
	$feed_body->setAttribute('period', $_GET['period'] );
	
	foreach($ratting_all as $row ) {
		$row['char_name'] = $row['charName'];
		$row['eve_char_id'] = $row['_charid'];
		$row['rat_bountys'] = $row['ratBountys'];
		$build_cons = array(
			'useonly' 	 => array( 'char_name' , 'eve_char_id' , 'rat_bountys' ),
		);
		$feed_body->appendChild( $xmlBuilder->createblock( 'farmer', $row , $build_cons ) );
	}
	$xmlBuilder->appendChild($feed_body);
	
	$xmlBuilder->setHeader();
	$xmlBuilder->formatoutput();
	exit(0);
}

#print $str_2; die;
		
#print $str; #die;
#$mission_agents = fetch_all( $str );


#print_r2(  $mission_agents , true );
#print_r2(  $mission_agents_list_unq , true );
#print_r2(  $mission_agent_whomake , true );

$gutrats = array(
	'Domination%',
	'Dread Guristas%',
	'Shadow Serpentis%',
	'Dark Blood%',
	'True Sansha%',
//	"Jorun \'Red Legs\' Greaves"
);

$officers = array(
	'Gotan Kreiss', 'Hakim Stormare', 'Mizuro Cybon', 'Tobias Kruzhor', // angel
	'Ahremen Arkah', 'Draclira Merlonne', 'Raysere Giant', 	'Tairei Namazoth', // blood raiders
	'Estamel Tharchon', 'Kaikka Peunato', 'Thon Eney', 	'Vepas Minimala', // guristas
	'Brokara Ryver', 'Chelm Soran', 'Selynne Mardakar', 'Vizan Ankonin',  // sansha
	'Brynn Jerdola', 'Cormack Vaaja', 'Setele Schellan', 'Tuvan Orth', // serpentis
#	'Angel Malakim',
#	'Domination War General',
);

$show_rats_bounty_bigger = 2500000;
$show_max_fancy_kills = 20;


$domi_where = ''; 
$domi_where_arr = array();
foreach($gutrats as $ratf ) {
	$domi_where_arr [] = " (ei.typeName LIKE '{$ratf}') ";
}
foreach($officers as $ratf ) {
	$domi_where_arr [] = " (ei.typeName LIKE '{$ratf}') ";
}

if( count($domi_where_arr) ) {
	$domi_where = " (".join(' OR ',$domi_where_arr).") ";
}
#print $domi_where;

$str = "SELECT w.char AS charName, w.`charid` as _charid, ei.typeName AS ratName, /* w.corp AS corpName,*/ 
	IFNULL(rb.valueInt,0) as ratBouny, IFNULL(ri.graphicId,0) as _ratImgId, ei.description as _description,
	w.`system` AS `systemName`, evr.reg_name as regionName, es.sys_sec as truesec, w.`date`, er.`ratid` as _ratid
	,e.kills_30days as _kb_kills_30days
	, unix_timestamp(w.`date`) as `_date_unixtime`
	FROM `eve_online_wallet` w
	INNER JOIN `eve_online_ratkills` er ON er.`refID` = w.`refID`
	INNER JOIN evedump_invtypes ei ON ei.typeID = er.`ratid`
	INNER JOIN evedump_systems es ON es.sys_eve_id = w.`system_id`
	INNER JOIN evedump_constellations ec ON es.sys_con_id = ec.`con_id`
	INNER JOIN evedump_regions evr ON ec.`con_reg_id` = evr.`reg_id`
	LEFT JOIN evedump_rats_bountys rb ON rb.typeID = er.`ratid` 
	LEFT JOIN evedump_rats_imgs ri ON ri.typeID = er.`ratid` 
	LEFT JOIN (

	SELECT ex.`api_characterID` , xxx.`kills_all_time` , xxx.`kills_30days` , xxx.`kills_7days`
	FROM `eve_online` ex
	LEFT JOIN (

	SELECT sum( `kills_all_time` ) AS `kills_all_time` , sum( `kills_7days` ) `kills_7days` , sum( `kills_30days` ) `kills_30days` , `forum_user_id`
	FROM `eve_online`
	GROUP BY `forum_user_id`
	) AS xxx ON xxx.`forum_user_id` = ex.`forum_user_id`
	)e ON e.api_characterID = w.`charid` 
	WHERE ( {$domi_where} OR {$show_rats_bounty_bigger} < IFNULL(rb.valueInt,0) )
	{$period_filter} AND `corpid` = '{$corp_id}'
	ORDER BY w.`date` desc
	LIMIT ".(string)($show_max_fancy_kills*3)." ";
	
$domi_kills2 = fetch_all( $str );

$index_old = $index_new = 0;
$domi_kills = array();

$time_dif_as_same = 25*60; // 25min

#print_r2( $domi_kills2 );


while( isset($domi_kills2[$index_old]) ) {	

	$current = $domi_kills2[$index_old];
	if( isset( $current['dublicate'] ) ) {
		$index_old++;
		continue;
	}
	
	$_chars = array( 
			array( 
					'charName'	=>	$current['charName'] ,
					'_charid'	=>	$current['_charid'],
					'_kb_kills_30days' => $current['_kb_kills_30days'],
				) 
		);
	
	
	$next_index_old = $index_old+1;
	while( isset($domi_kills2[$next_index_old]) && true ) {
		$_current = $domi_kills2[$next_index_old];
		
		if( isset( $_current['dublicate'] ) ) {
			$next_index_old++;
			continue;
		}
		
		if( $current['_ratid']==$_current['_ratid'] && $current['systemName']==$_current['systemName']
				&& $current['_date_unixtime']+$time_dif_as_same>$_current['_date_unixtime']
				&& $current['_date_unixtime']-$time_dif_as_same<$_current['_date_unixtime']
			) {
			$_chars[] = array( 
							'charName'	=>	$_current['charName'] ,
							'_charid'	=>	$_current['_charid'],
							'_kb_kills_30days' => $_current['_kb_kills_30days'],
						);
			$domi_kills2[$next_index_old]['dublicate'] = true;
		} else {
			break;
		}
		$next_index_old++;
	}
	
	if( count($_chars) > 1 ) {
		$current['_chars'] = $_chars;
	}
	
	$domi_kills[$index_new] = $current;
	$index_new++;
	
	$index_old++;
	if( $index_new>= $show_max_fancy_kills ) {
		break;
	}
}

#print_r2( $domi_kills );

/*
$str = "SELECT w.char AS charName, w.`charid` as _charid, ei.typeName AS ratName, 
	IFNULL(rb.valueInt,0) as ratBounty, 
	w.`system` AS `systemName`, evr.reg_name as regionName, es.sys_sec as truesec, w.`date`, er.`ratid` as _ratid
	FROM `eve_online_wallet` w
	INNER JOIN `eve_online_ratkills` er ON er.`refID` = w.`refID`
	INNER JOIN evedump_invtypes ei ON ei.typeID = er.`ratid`
	INNER JOIN evedump_systems es ON es.sys_eve_id = w.`system_id`
	INNER JOIN evedump_constellations ec ON es.sys_con_id = ec.`con_id`
	INNER JOIN evedump_regions evr ON ec.`con_reg_id` = evr.`reg_id`
	LEFT JOIN evedump_rats_bountys rb ON rb.typeID = er.`ratid` 
	WHERE 1 {$period_filter} AND `corpid` = '{$corp_id}'
	ORDER BY IFNULL(rb.valueInt,0) desc
	LIMIT 50 ";
$bounty_list = fetch_all( $str );
print_r2( $bounty_list );

$str = "SELECT ei.typeName AS ratName,      
    ei.description as _description, er.`ratid` as _ratid, count(er.amount) as totalRatKills, IFNULL(rb.valueInt,0) as ratBounty, SUM( er.amount * IFNULL(rb.valueInt,0) ) AS max_ratBountys,
	IFNULL(ri.graphicId,0) as _ratImgId 
	FROM `eve_online_wallet` w 
	INNER JOIN `eve_online_ratkills` er ON er.`refID` = w.`refID` 
	INNER JOIN evedump_invtypes ei ON ei.typeID = er.`ratid` 
	LEFT JOIN evedump_rats_bountys rb ON rb.typeID = er.`ratid` 
	LEFT JOIN evedump_rats_imgs ri ON ri.typeID = er.`ratid` 
	WHERE 1 {$period_filter} AND `corpid` = '{$corp_id}'
    GROUP BY er.`ratid`
    ORDER BY ".$order_valid." DESC, ei.typeName ASC
	LIMIT 50
	";
*/

$orders_ratting_by_rattype = array('max_ratountys','ratBouny','totalRatKills');
$order_valid = in_array(@$_GET['order'] , $orders_ratting_by_rattype);
if( !$order_valid ) {
	$_GET['order'] = 'ratBouny';
} 
$str = "SELECT ei.typeName AS ratName,      
    ei.description as _description, er.`ratid` as _ratid, count(er.amount) as totalRatKills, IFNULL(rb.valueInt,0) as ratBouny, IFNULL(rb.valueInt,0) AS max_ratountys,
	IFNULL(ri.graphicId,0) as _ratImgId 
	FROM `eve_online_wallet` w 
	INNER JOIN `eve_online_ratkills` er ON er.`refID` = w.`refID` 
	INNER JOIN evedump_invtypes ei ON ei.typeID = er.`ratid` 
	LEFT JOIN evedump_rats_bountys rb ON rb.typeID = er.`ratid` 
	LEFT JOIN evedump_rats_imgs ri ON ri.typeID = er.`ratid` 
	WHERE 1 {$period_filter} AND `corpid` = '{$corp_id}'
    GROUP BY er.`ratid`
    ORDER BY er.amount DESC , ei.typeName ASC
	LIMIT 100
	";
    
$ratting_by_rattype = fetch_all( $str );
	foreach( $ratting_by_rattype as &$all ) {
		$all['max_ratountys'] = $all['totalRatKills'] * $all['ratBouny'];
	}
    
if($_GET['keyid'] && $_GET['vcode'])
{
    $sql = "SELECT w.`char` AS _charName, w.`amount` AS _nalog, w.`date` AS _date, w.`charid` as _charid, w.`reason` as _reason,
    DATE_FORMAT(w.`date`, '%M') as _month
	FROM `eve_online_nalog` w
	WHERE w.`corpid` = '{$corp_id}' AND w.`charid` = (SELECT `Char_id` FROM `eve_online_pilots` WHERE `keyid` = ".$_GET['keyid'].")
    ORDER BY _month DESC";
    $filter_char = fetch_all($sql);
    	foreach( $filter_char as &$day ) {
        $day['charName'] = $day['_charName'];	   
		$unixtime = strtotime( $day['_date'] );
		$day['date'] = rusDate(date( 'm-Y' , $unixtime ));
		$day['nalog'] = $day['_nalog'];
        $day['Desc'] = $day['_reason'];
    }
}
/*$player_ratting_by_day = array();
if( $charid ) {
	$str = "SELECT `date` as _date,  YEAR( `date` ) AS _year, SUM( w.`amount2` ) - SUM(w.`amount`) AS ratBountys,
     SUM(w.`amount`) AS taxBountys, MONTH( `date` ) as _month, DAY( `date` ) as _day 
		FROM `eve_online_wallet` w
		WHERE 1 {$period_filter} AND `corpid` = '{$corp_id}'
		GROUP BY YEAR( `date` ) , MONTH( `date` ) , DAY( `date` ) 
		ORDER BY `date` DESC 
		LIMIT 100 ";
		
	$player_ratting_by_day = fetch_all( $str );
	foreach( $player_ratting_by_day as &$day ) {
		$unixtime = strtotime( $day['_date'] );
		$day['date'] = date( 'd.M Y, l ' , $unixtime );
		$day['_date'] = sprintf('%s-%s-%s',$day['_year'],add_zero($day['_month']),add_zero($day['_day']));
		

	}
}*/

$player_ratting_by_day = array();
if( $charid ) {
	$str = "SELECT SUM( w.`amount2` - w.`amount`) AS _ratBountys, YEAR( `date` ) AS _year , MONTH( `date` ) as _month , DAY( `date` ) as _day, `date` as _date,
    SUM(w.`amount`) AS _taxBountys
		FROM `eve_online_wallet` w
		WHERE 1 {$period_filter} AND `corpid` = '{$corp_id}'
		GROUP BY YEAR( `date` ) , MONTH( `date` ) , DAY( `date` )
		ORDER BY `date` DESC 
		LIMIT 100 ";
		
	$player_ratting_by_day = fetch_all( $str );
	foreach( $player_ratting_by_day as &$day ) {
		$unixtime = strtotime( $day['_date'] );
		$day['date'] = date( 'd.M Y, l ' , $unixtime );
		$day['_date'] = sprintf('%s-%s-%s',$day['_year'],add_zero($day['_month']),add_zero($day['_day']));
		
		$day['ratBountys'] = $day['_ratBountys'];
        $day['taxBountys'] = $day['_taxBountys'];
	}
}

$filter_msg = '';//filter_nalog('w',$config);
$str = "SELECT w.`char` AS _charName, SUM(w.`amount`) AS _ratBountys, w.`charid` as _charid, e.`keyid` AS _keyid, e.`vcode` AS _vcode,
    e.`Corp_dolg` AS _Corp_dolg, w.`corpid` AS _corpd
	FROM `eve_online_nalog` w
    INNER JOIN `eve_online_pilots` e ON (e.`Char_id` = w.`charid`) 
	WHERE 1 {$filter_msg} AND w.`corpid` = '{$corp_id}'
    GROUP BY _charid
    ORDER BY _charName ASC";
	
$manage_it = fetch_all($str);
	foreach( $manage_it as &$day ) {
        $day['charNam'] = $day['_charName'];	   
		$day['ratBountys'] = $day['_ratBountys'];
        $keyid['keyid'] = $day['_keyid'];
        $vcode['vcode'] = $day['_vcode'];
		$day['Corp_dolg'] = $day['_Corp_dolg'];        
	}    
  

$player_ratting_by_day_all = null;
if( !( $charid || ($_GET['period']=='last24h') ) ):
		$str = "SELECT SUM( w.`amount2` ) AS _ratBountys, YEAR( `date` ) AS _year , MONTH( `date` ) as _month , DAY( `date` ) as _day, `date` as _date, w.`char` as charName, w.`charid` as _charid
		,e.kills_30days as _kb_kills_30days
		FROM `eve_online_wallet` w
		LEFT JOIN (
			SELECT ex.`api_characterID` , xxx.`kills_all_time` , xxx.`kills_30days` , xxx.`kills_7days`
			FROM `eve_online` ex
			LEFT JOIN (
				SELECT sum( `kills_all_time` ) AS `kills_all_time` , sum( `kills_7days` ) `kills_7days` , sum( `kills_30days` ) `kills_30days` , `forum_user_id`
				FROM `eve_online`
				GROUP BY `forum_user_id`
			) AS xxx ON xxx.`forum_user_id` = ex.`forum_user_id`
		)e ON e.api_characterID = w.`charid` 
		WHERE 1 {$period_filter} AND `corpid` = '{$corp_id}'
		GROUP BY YEAR( `date` ) , MONTH( `date` ) , DAY( `date` ), w.`charid`
		ORDER BY SUM( w.`amount2` ) DESC 
		LIMIT 25 ";
		
	$player_ratting_by_day_all = fetch_all( $str );
	foreach( $player_ratting_by_day_all as &$day ) {
		$unixtime = strtotime( $day['_date'] );
		$day['date'] = date( 'd.M Y, l ' , $unixtime );
		$day['_date'] = sprintf('%s-%s-%s',$day['_year'],add_zero($day['_month']),add_zero($day['_day']));
		
		$day['ratBountys'] = $day['_ratBountys'];
	}
#print_r2( $player_ratting_by_day );
endif;

$str = "Select w.`balance` FROM `eve_online_nalog` w  ".
	" WHERE w.`id` = (SELECT MAX(`id`) FROM eve_online_nalog) AND w.`corpid` = '{$corp_id}' ";
$total_ratting_selected_filter = fetch_one($str, 'balance');
?><html>
<head>
<title><?= htmlspecialchars(trim($corpName)) ?> EveOnline статистика корпорации по баунти и налогам</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>  
<script src="js/jquery.ui.datepicker-ru.js"></script>
<script type="text/javascript" src="overlib.js"></script>
<script>
  $(function() {
    $( "#from" ).datepicker( $.datepicker.regional[ "ru" ] );
    $( "#locale" ).change(function() {
      $( "#from" ).datepicker( "option",
        $.datepicker.regional[ $( this ).val() ] );
    });
    $( "#tomuch" ).datepicker( $.datepicker.regional[ "ru" ] );
    $( "#locale" ).change(function() {
      $( "#tomuch" ).datepicker( "option",
        $.datepicker.regional[ $( this ).val() ] );
    });    
});
</script>
<style type="text/css">

a {
	text-decoration: none;
	color:#537BAC;
}
a:hover {
    color:#fbf80a;
	
} /*
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}  */

table {
	border-collapse:collapse;
}

.row_officer td, .row_officer td a {
	font-weight: bold;
	color: red;
	background-color: #FFFF00;
}
</style>
<link type="text/css" href="css/style.css" rel="stylesheet" />
<link type="text/css" href="css/datepicker.css" rel="stylesheet" />
<script type="text/javascript" src="js/smartmodel.js"></script>
<script type="text/javascript">
$(document).ready(function() {
// Create two variable with the names of the months and days in an array
var monthNames = [ "Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря" ]; 
var dayNames= ["Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота"]

// Create a newDate() object
var newDate = new Date();
// Extract the current date from Date object
newDate.setDate(newDate.getDate());
// Output the day, date, month and year    
$('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

setInterval( function() {
   // Create a newDate() object and extract the seconds of the current time on the visitor's
   var seconds = new Date().getSeconds();
   // Add a leading zero to seconds value
   $("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
   },1000);
   
setInterval( function() {
   // Create a newDate() object and extract the minutes of the current time on the visitor's
   var minutes = new Date().getMinutes();
   // Add a leading zero to the minutes value
   $("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
    },1000);
   
setInterval( function() {
   // Create a newDate() object and extract the hours of the current time on the visitor's
   var hours = new Date().getHours();
   // Add a leading zero to the hours value
   $("#hours").html(( hours < 10 ? "0" : "" ) + hours);
    }, 1000);   
}); 
</script>
<script type="text/javascript" src="js/jquery.dropdown.js"></script>
<link type="text/css" rel="stylesheet" href="css/jquery.dropdown.css" />
</head>
<body>

<center>
<div class="wrapper">
<? if($_COOKIE['login']) :?>
<p style="color:#fff; font-size:18px; font-family:verdana;"><span>Здравствуйте,  <?= $_COOKIE['login'];?></span></p>
<br />
<? endif; ?>
<div class="clock">
   <div id="Date"></div>
   <ul>
      <li id="hours"></li>
      <li id="point">:</li>
      <li id="min"></li>
      <li id="point">:</li>
      <li id="sec"></li>
   </ul>
</div>
<? if(!$_COOKIE['login']) :?>
<div id="user_navigation" class="not_logged_in">
                    
                    <ul class="ipsList_inline">
                        <li style="width:50%;">
                            <span class="services">     
                            </span>
                            <a href="#" title="Вход" id="sign_in" style="margin-left: 50px;" onclick="open_popup('.b-overlayz');"><div class="login"></div> Вход</a>
                            <div class="b-overlayz" style="display: none; margin-bottom:15px;">
                            <div id="sign_in_popup_popup" class="popupWrapper" style="z-index: 10001; position: absolute;"><div id="sign_in_popup_inner" class="popupInner" style="width: 680px; max-height: 883px;"><div id="inline_login_form" class="ipbfs_login" style="">
                            		<form action="" method="post" id="login" onsubmit="location.reload();">
                            			<h3>Войти</h3>
                                        <div class="ipbfs_login_row">
                                            <div class="ipbfs_login_col">
                                                
                                        		<strong><label for="ips_username">Имя пользователя:</label></strong>
                                                <div class="ipsField_content">
                                                	<input id="ips_username" onfocus="this.className = 'input_text_b ipbfs_login_input ipbfs_luser';" onblur="this.className = 'input_text ipbfs_login_input ipbfs_luser';" type="text" class="input_text ipbfs_login_input ipbfs_luser" name="ips_username" size="30" tabindex="1"/>
                                                </div>
                                            </div>
                                            <div class="ipbfs_login_col">
                                                <strong><label for="ips_password">Пароль</label></strong>
                                                <div class="ipsField_content">
                                                    <input id="ips_password" type="password" onfocus="this.className = 'input_text_b ipbfs_login_input ipbfs_lpassword';" onblur="this.className = 'input_text ipbfs_login_input ipbfs_lpassword';" class="input_text ipbfs_login_input ipbfs_lpassword" name="ips_password" size="30" tabindex="2"/><br/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix">
                                        </div>
                                        <input type="checkbox" name="remember" id="cp" value="1"/><label for="cp"><span></span>запомнить на 3 дня</label>
                                        <div class="ipsForm_submit ipsForm_center clear">
                                            <input type="submit" class="input_submit" name="submit" value="Войти"/>
                                        </div>
                            		</form>
                           	</div></div><div id="sign_in_popup_close" class="popupClose clickable" onclick="close_popup('.b-overlayz');"><img src="http://forum.eve-ru.com/public/style_images/eve_ru/close_popup.png" alt="x"></div></div>           
                            </div>
                            <div id="background"></div>
                        </li>
                        <li>
                            <a href="#" title="Регистрация" style="margin-left: 20px;" id="register_link" onclick="open_popup('.b-overlay');"><div class="xyu"></div> Регистрация</a>
                            <div class="b-overlay" style="display:none; margin-bottom:15px;">
                            <div id="sign_in_popup_popup" class="popupWrapper" style="z-index: 10001; position: absolute;"><div style="width: 600px; max-height: 883px;" id="sign_in_popup_inner" class="popupInner"><div id="inline_login_form" class="ipbfs_login" style="">
                            <div class="popupClose" onclick="close_popup('.b-overlay');">
                            <img src="http://forum.eve-ru.com/public/style_images/eve_ru/close_popup.png" alt="x"/></div>
                            <b>
                            <h3>Регистрация пилота</h3></b>
                    <form id="r_api" style="margin-bottom:0;" method="post">
                    <fieldset>
					<ul class="ipsForm ipsForm_horizontal">
						<li class="ipsField clear ">
							<label for="display_name" class="ipsField_title">Имя пользователя <span class="ipsForm_required">*</span></label>
							<p class="ipsField_content">
								<input type="text" class="input_text" onchange="if_empty(this);" id="display_name" size="45" maxlength="26" value="" name="members_display_name" tabindex="1">&nbsp;<span id="display_name_msg" class="reg_msg reg_error" style=""><img src="http://forum.eve-ru.com/public/style_images/eve_ru/exclamation.png" alt=""> ✗ Поле является обязательным</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
								<span class="desc primary lighter">
								</span>
							</p>
						</li>
						<li class="ipsField clear ">
							<label for="email_1" class="ipsField_title">Email адрес <span class="ipsForm_required">*</span></label>
							<p class="ipsField_content">
								<input type="text" onchange="if_empty(this);" id="email_1" class="input_text email" size="45" maxlength="150" name="EmailAddress" value="" tabindex="2">&nbsp;<span id="email_1_msg" class="reg_msg reg_error" style=""><img src="http://forum.eve-ru.com/public/style_images/eve_ru/exclamation.png" alt=""> ✗ E-mail адрес неправильный</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
							</p>
						</li>		
						<li class="ipsField clear ">
							<label for="password_1" class="ipsField_title">Пароль <span class="ipsForm_required">*</span></label>
							<p class="ipsField_content">
								<input type="password" id="password_1" class="input_text password" size="45" onchange="if_empty(this);" maxlength="32" value="" name="PassWord" tabindex="3"/><br>
							</p>
						</li>
						<li class="ipsField clear">
							<label for="password_2" class="ipsField_title">Подтвердите пароль <span class="ipsForm_required">*</span></label>
							<p class="ipsField_content">
								<input type="password" id="password_2" onchange="if_empty(this);" class="input_text password" size="45" maxlength="32" value="" name="PassWord_Check" tabindex="4"/><br>
							</p>
						</li>
                        <li class="ipsField clear ipsField_input">
									<label for="cprofile_1" class="ipsField_title">EVE Ingame</label>
									<div class="ipsField_content">
										<input type="text" id="field_1" size="40" class="input_text" name="field_1" value="" tabindex="6"/>
										<br/><span class="desc lighter">Имя main чара в EVE-online</span>
									</div>
                        </li>
                        <li class="ipsField clear ipsField_input">
									<label for="cprofile_2" class="ipsField_title">Corp</label>
									<div class="ipsField_content">
										<input type="text" id="field_2" size="40" class="input_text" name="field_2" value="" tabindex="6"/>
										<br/><span class="desc lighter">Корп тикет или название</span>
									</div>
						</li>                        
                        <li class="ipsField clear ipsField_input">
									<label for="cprofile_1" class="ipsField_title">Секретное слово <span class="ipsForm_required">*</span></label>
									<div class="ipsField_content">
										<input type="text" id="field_1" size="40" onchange="if_empty(this);" class="input_text" name="secret_word" tabindex="6"/>
										<br/><span class="desc lighter">Инвайт</span>
									</div>
						</li>                                                 
					</ul>
				</fieldset>
                <div class="ipsForm_submit ipsForm_center clear">
                                <input class="input_submit" style="margin-left: 223px;" type="submit" value="регистрация"/>
                </div>
                </form>      
                            <div id="call_back"></div>
                            </div>            
                            </div>
                            <div id="background"></div>
                        </li>
                    </ul>
                </div>
                </div>
                </div>
                <? endif; ?>
<? if($_COOKIE['pas_in'] && $_COOKIE['login']) :?>
<br />
<ul id="center">
<li><a href="?m=01">Янв.</a> | </li>
<li><a href="?m=02"> Февр. </a> | </li>
<li><a href="?m=03"> Март </a> | </li>
<li><a href="?m=04"> Апр. </a> | </li>
<li><a href="?m=05"> Май </a> | </li>
<li><a href="?m=06"> Июнь </a> | </li>
<li><a href="?m=07"> Июль </a> | </li>
<li><a href="?m=08"> Авг. </a> | </li>
<li><a href="?m=09"> Сент. </a> | </li>
<li><a href="?m=10"> Окт. </a> | </li>
<li><a href="?m=11"> Нояб. </a> | </li>
<li><a href="?m=12"> Дек. </a></li>
</ul>
<br />
<a class="input_submit" onclick="open_popup('.add_pilot');"><span style="margin-top:10px;"><img src="img/add.png" style="line-height:15px; vertical-align:middle;" /></span>добавить пилота</a>
<a id="delo" class="input_submit"><span style="margin-top:10px;"><img src="img/dell.png" style="line-height:15px; vertical-align:middle;" onclick="return false;" id="delle" /></span>удалить пилота</a>
<a id="ne_pizdi" class="input_submit" onclick="return false;">выйти</a>
<form method="post" id="out" name="logoff"><input type="hidden" name="logout" value="1" /></form>
</div>

<div class="add_pilot">
<div id="sign_in_popup_popup" class="popupWrapper" style="z-index: 10001; position: absolute;"><div id="sign_in_popup_inner" class="popupInner" style="width: 680px; max-height: 883px;">
<div id="inline_login_form" class="ipbfs_login" style="">
                            		<form action="" method="post" id="r_apid" onsubmit="return false;">
                            			<h3>Добавить пилота</h3>
                                        <div class="ipbfs_login_row">
                                            <div class="ipbfs_login_col">
                                            <input type="hidden" name="pid" value="<?= $char ?>" />
                                            <input type="hidden" value="<?= $corp_id; ?>" name="corpid" />
                                            <input type="hidden" value="<?= $_COOKIE['login']; ?>" name="login_name" />
                                                <span class="right desc lighter blend_links"></span>
                                        		<strong><label for="ips_username" style="color:white;">KeyID</label></strong>
                                                <div class="ipsField_content">
                                                	<input id="ips_username" onfocus="this.className = 'input_text_b ipbfs_login_input ipbfs_luser';" onblur="this.className = 'input_text ipbfs_login_input ipbfs_luser';" type="text" class="input_text ipbfs_login_input ipbfs_luser" name="id_char" size="30" tabindex="1"/>
                                                </div>
                                            </div>
                                            <div class="ipbfs_login_col">
                                                <span class="right desc lighter blend_links"></span>
                                                <strong><label for="ips_password" style="color:white;">Vcode</label></strong>
                                                <div class="ipsField_content">
                                                    <input id="ips_password" type="text" onfocus="this.className = 'input_text_b ipbfs_login_input ipbfs_lpassword';" onblur="this.className = 'input_text ipbfs_login_input ipbfs_lpassword';" class="input_text ipbfs_login_input ipbfs_lpassword" name="Vcode" size="30" tabindex="2"/><br>
                                                </div>
                                            </div>
                                            <select name="main_f" style="display: none;">
                                            <option value="1"></option>
                                            <option value="0"></option>
                                            </select>
                                            <input type="checkbox" name="main" id="cc" value="1" onclick="" /> <label for="cc"><span></span>главный персонаж (main) *</label>
                                        </div>
                                        <div class="clearfix">
                                        </div>
                                        <div class="ipsForm_submit ipsForm_center clear">
                                            <input type="submit" class="input_submit" value="Добавить"/>
                                        </div>
                            		</form>
</div></div><div id="sign_in_popup_close" class="popupClose clickable" onclick="close_popup('.add_pilot');"><img src="http://forum.eve-ru.com/public/style_images/eve_ru/close_popup.png" alt="x"/></div></div>
</div>	
<!--<div style="width:500px;">
<form action="" method="get" id="filtr" >
<span>дата с :</span>
<? if($_GET['pswc']): ?><input name="pswc" type="hidden" value="<?= $_GET['pswc'] ?>" /><? endif; ?>
<? if($_GET['char']): ?><input name="char" type="hidden" value="<?= $_GET['char'] ?>" /><? endif; ?>
<input type="text" readonly="readonly" name="from" id="from" value="<? echo $_GET['from']; ?>" /> <span> по: </span> <input name="tomuch" type="text" id="tomuch" readonly="readonly" value="<? echo $_GET['tomuch']; ?>" /> - 
<button form="filtr" type="submit">показать</button></form>
</div>--!>
<? if($_COOKIE['login'] == 'admin') :?>
<div class="fri"> Баланс основного счета: <span style="color:red;font-weight:bold;"><? if(is_array($total_ratting_selected_filter)){echo 'нет данных';} else echo isknf($total_ratting_selected_filter); ?></span> ISK,
 корпорации <b><?= $corpName; ?></b> 
</div>
<? endif; ?>
<br />
<? if(isset($_COOKIE['pass_in'])) :?>
<a href="#" id="">Редактировать данные</a>
<? endif;?>
<div style="margin-bottom:10px;">
<?
$url_start1 = $file.'&period='.$_GET['period']; //.'&order=';
if( !empty($_GET['char']) ) { 
	$url_start1 .= '&char='.urlencode($_GET['char']);
}

$url_start = $url_start1.'&order=';


?>
<form id="main_na" method="post">
<input type="hidden" name="idc" value="" id="idc" />
<input type="hidden" name="nammo" id="nammo" />
</form>

<? if( !$charid && $ratting_all && $_COOKIE['admin'] ) : ?>
<div id="body1">
<div id="top_b"></div>
<div id="mid_b">
<?= build_table($ratting_all,'Отчет по налогам ','ratting',true,0,true,$taxRate) ?>
</div>
<div id="bot_b"></div>
</div>
<? endif; ?>
</div>

<br />
<? if( !$charid && $_COOKIE['login'] && $_COOKIE['login'] != 'admin' ) : ?>
<p style="color:#fff; font-size:18px; font-family:verdana;">
<span>Ваше личное слово для налога:
<?= $word_ ?>
</span></p>
<br />
<div id="body1">
<form id="dellete" method="post">
<div id="top_b"></div>
<div id="mid_b">
<?= build_table($_pilot,'Персонажы '.$_COOKIE['login'],'ratting',true,0,true,$taxRate) ?>
</div>
<div id="bot_b"></div>
</form>
</div>
<?= $time; ?>
<br />
<div id="body1">
<div id="top_b"></div>
<div id="mid_b">
<?= build_table($ratting_one,'Отчет по налогам '.$_COOKIE['login'],'ratting',true,0,true,$taxRate) ?>
</div>
<div id="bot_b"></div>
</div>
<br />
<?= $_COOKIE['charid'] ?>

<? endif; ?>
<? if( $_GET['vcode'] && $_GET['keyid'] != $config['login'] ): ?>
<br />
<a class="" href="nal.php">закрыть X</a>
<div id="body1">
<div id="top_b"></div>
<div id="mid_b">
<?= build_table($filter_char,'Лог оплат налога пилота','ratting',true,0,true) ?>
</div>
<div id="bot_b"></div>
</div>
<? endif; ?>
<br />
<? if($_COOKIE['login'] == 'admin') :?>
<div id="admin" style="display:;">
<div id="body1">
<div id="top_b"><label style="color:white;">Сумма корп. налога</label><input name="nal" value="<?= $config['nalog'] ?>" class="nal" /></div>
<div id="mid_b">
<form name="admin" id="manage">
<?= build_table($manage_it,'Администрирование','ratting',true,0,true) ?>
</form>
</div>
<div id="bot_b"></div>
</div>
</div>
<? endif; ?>
<div id="dropdown-1" class="dropdown dropdown-tip">
        		<ul class="dropdown-menu">
        			<li><a href="#1">мейн</a></li>
        			<li><a href="#0">альт</a></li>
        		</ul></div>
                <div id="dropdown-2" class="dropdown dropdown-tip">
        		<ul class="dropdown-menu">
        			<li><a href="#1">мейн</a></li>
        			<li><a href="#0">альт</a></li>
        		</ul>
</div>
<? if($_COOKIE['pas_in']) :?>
<div class="everythere"></div>
<? endif; ?>
<!--
<a href="">faction rats kills</a> || <a href="">higgest bounty rats kills</a>
<br> --> 
</center>
<? endif; ?>
</body>
</html>