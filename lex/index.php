<?php

require_once 'config.php';
require_once 'functions.php';
 

$file_basename = basename( __FILE__ );

$corp_id = false;


$rm_addr = @$_SERVER['REMOTE_ADDR'];


$psw_value = $pswConfig['test_password'];
$corp_id = $psw_value;

$file = $file_basename.'?pswc='.rawurlencode($psw_value);





$corpName = fetch_one( 'SELECT `corp` FROM `eve_online_wallet` WHERE `corpid` = '.$corp_id , 'corp' );

$period_filter = '';
switch( @$_GET['period'] ) {
	case 'last24h':
		$period_filter = ' AND w.`date` > DATE_SUB(NOW(),INTERVAL 24 HOUR) ';
		break;

	case 'last12h':
		$period_filter = ' AND w.`date` > DATE_SUB(NOW(),INTERVAL 12 HOUR) ';
		break;

	case 'last90days':
		$period_filter = ' AND w.`date` > DATE_SUB(NOW(),INTERVAL 90 DAY) ';
		break;
		
	case 'last30days':
		$period_filter = ' AND w.`date` > DATE_SUB(NOW(),INTERVAL 30 DAY) ';
		break;

	case 'last14days':
		$period_filter = ' AND w.`date` > DATE_SUB(NOW(),INTERVAL 14 DAY) ';
		break;

	case 'last25days':
		$period_filter = ' AND w.`date` > DATE_SUB(NOW(),INTERVAL 25 DAY) ';
		break;                
        		
	case 'alltime':
		$_GET['period'] = 'alltime';
		break;
		

	case 'last7days':
		$_GET['period'] = 'last7days';
		$period_filter = ' AND w.`date` > DATE_SUB(NOW(),INTERVAL 7 DAY) ';
		break;
	
	default:
	case 'month':
		$_GET['period'] = 'month';
		$period_filter = ' AND w.`date` > DATE_SUB(NOW(),INTERVAL 7 DAY) ';
		break;
}

if(isset($_GET['from']) && isset($_GET['tomuch']))
{
    $period_filter = ' AND w.`date` BETWEEN STR_TO_DATE("'.$_GET['from'].' 00:00:00", "%Y-%m-%d %H:%i:%s") AND STR_TO_DATE("'.$_GET['tomuch'].' 23:59:59", "%Y-%m-%d %H:%i:%s")';
}


$str = "SELECT w.`char`, w.`charid`, w.`corp` FROM `eve_online_wallet` w ".
	" WHERE 1 {$period_filter} AND `corpid` = '{$corp_id}' ".
	" GROUP BY w.`charid` ".
	" ORDER BY w.`char` ASC ";
$chars = fetch_all( $str );

$charid = null;
if( !empty($_GET['char']) ) {
	$str = "SELECT `charid` FROM `eve_online_wallet` WHERE `char` LIKE '".addslashes($_GET['char'])."' LIMIT 1 ";
	$charid = (int)fetch_one( $str , 'charid' );
	if( !$charid ) {
		$charid = 1;
	}	
	$period_filter .= " AND w.`charid` = '".$charid."' ";	
} 


$sql = "SELECT MAX( w.`date` ) AS maxdate, MIN( w.`date` ) AS mindate
	FROM eve_online_wallet w
	WHERE 1 {$period_filter} AND `corpid` = '{$corp_id}' ";
$date_filter_res = array( 'maxdate' => 'none', 'mindate' => 'none' );	

$date_filter_res = fetch_one($sql);

$str = "SELECT w.`char` as charName, w.`charid` as _charid,  /* w.`corp` as corpName,*/ SUM( w.`amount2` ) AS ratBountys
	FROM `eve_online_wallet` w
	WHERE 1 {$period_filter} AND `corpid` = '{$corp_id}'
	GROUP BY `charid`
	ORDER BY SUM( w.`amount2` ) DESC";
#print $str;


if($_GET['period'] == 'month')
{
    $a_date = date("Y-m-01");
    $todata = date("Y-m-t", strtotime($a_date));
    $period_filter = ' AND w.`date` BETWEEN STR_TO_DATE("'.$a_date.' 00:00:00", "%Y-%m-%d %H:%i:%s") AND STR_TO_DATE("'.$todata.' 23:59:59", "%Y-%m-%d %H:%i:%s")';
}

if($_GET['char'] && $_GET['period'] == 'month')
{
    $a_date = date("Y-m-01");
    $todata = date("Y-m-t", strtotime($a_date));    
    $period_filter = ' AND w.`date` BETWEEN STR_TO_DATE("'.$a_date.' 00:00:00", "%Y-%m-%d %H:%i:%s") AND STR_TO_DATE("'.$todata.' 23:59:59", "%Y-%m-%d %H:%i:%s") AND w.`charid` = '.$charid;
}

$not = '';
if(!$_GET['boss'] && file_exists($ban))
{
    foreach( $ban_album_names as $names )
    $banned = $banned . "'" . $names . "', ";
        
    $not = "AND w.`char` NOT IN ( ".rtrim($banned, ', ') . " )";
}
$str = "SELECT w.`char` AS charName, w.`charid` as _charid, SUM( w.`amount2` ) - SUM(w.`amount`) AS ratBountys, SUM( w.`amount`) AS taxBountys
	FROM `eve_online_wallet` w
	WHERE 1 {$period_filter} AND w.`corpid` = '{$corp_id}' {$not}
	GROUP BY w.`charid`
	ORDER BY SUM( w.`amount2` ) DESC
	";
	
$ratting_all = fetch_all($str);

if( @$_GET['show_xml'] == 'true' ) {
	include 'class.domdoc.php';
	
	$xmlBuilder = new domdoc();
	$feed_body = $xmlBuilder->createElement('iskfarmers');
	$feed_body->setAttribute('period', $_GET['period'] );
	
	foreach( $ratting_all as $row ) {
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

$str = "SELECT w.`char` AS charName, w.`charid` as _charid, SUM( w.`amount2` ) AS mission_rewards
	FROM `eve_online_wallet` w
	WHERE w.agent_name IS NOT NULL 
	{$period_filter} AND w.`corpid` = '{$corp_id}'
	GROUP BY w.`charid`
	ORDER BY SUM( w.`amount2` ) DESC
	";
	
$mission_all = fetch_all( $str );

$str_1 = "SELECT w.agent_name, COUNT(w.refID) as missions 
		FROM `eve_online_wallet` w
		WHERE w.agent_name IS NOT NULL 
		{$period_filter} AND w.`corpid` = '{$corp_id}'
		AND `w`.`reason` LIKE '%|refID:33|%' 
		GROUP BY w.`agent_id` ";
		
$str_2 = "SELECT w.agent_name, w.charid as char_id, COUNT(w.refID) as missions 
		FROM `eve_online_wallet` w
		WHERE w.agent_name IS NOT NULL 
		{$period_filter} AND w.`corpid` = '{$corp_id}'
		AND `w`.`reason` LIKE '%|refID:33|%' 
		GROUP BY w.`agent_id`, w.charid ";

#print $str_2; die;
		
$str = "SELECT w.agent_name, w.agent_id as _agent_id
		,ag.level, ag.quality, ag.locate, ag.factionName as faction
		,ag.systemName, ag.systemSecurity as truesec, ag.regionName
/*		, w.`system` AS `systemName`, evr.reg_name as regionName, es.sys_sec as truesec */
		, ms.missions
		, SUM( w.`amount2` ) AS mission_rewards 
		FROM `eve_online_wallet` w
		
		LEFT JOIN evedump_agents ag ON ag.agentName = w.agent_name
		LEFT JOIN ({$str_1}) AS ms ON ms.agent_name = w.agent_name
/*		
		INNER JOIN evedump_systems es ON es.sys_eve_id = w.`system_id`
		INNER JOIN evedump_constellations ec ON es.sys_con_id = ec.`con_id`
		INNER JOIN evedump_regions evr ON ec.`con_reg_id` = evr.`reg_id`
*/	
		WHERE w.agent_name IS NOT NULL 
		{$period_filter} AND w.`corpid` = '{$corp_id}'
		GROUP BY w.`agent_id`
		ORDER BY SUM( w.`amount2` ) DESC
		LIMIT 50
	";
#print $str; #die;
#$mission_agents = fetch_all( $str );

$mission_agents_list_unq = $mission_agent_whomake = array();
foreach( fetch_all( $str ) as $agent ) {
	$mission_agents_list_unq[$agent['_agent_id']] = $agent['_agent_id'];
	$mission_agent_whomake[$agent['_agent_id']] = array();
	
	$agent['_whomade'] = array();
	$mission_agents[$agent['_agent_id']] = $agent;
}
if( count($mission_agents_list_unq) ) {

$str = "SELECT `char`, charid as _charid, ms.missions, SUM( w.`amount2` ) AS mission_rewards, /*w.agent_name,*/ w.agent_id AS _agent_id
FROM `eve_online_wallet` w
LEFT JOIN evedump_agents ag ON ag.agentName = w.agent_name
LEFT JOIN ({$str_2}) AS ms ON ms.agent_name = w.agent_name AND ms.char_id = w.charid
WHERE `agent_id` IN ( '".join("', '",$mission_agents_list_unq)."' )
AND w.agent_name IS NOT NULL
{$period_filter} AND w.`corpid` = '{$corp_id}'
GROUP BY w.`charid` , w.`agent_id`
ORDER BY SUM( w.`amount2` ) DESC
LIMIT 10000 "; // just to make sure we don't get some killing all dataset


foreach( fetch_all( $str ) as $row ) {
	$mission_agent_whomake[$row['_agent_id']][] = $row;
#	foreach( $mission_agents as &$_row ) {
	
	if( isset($mission_agents[$row['_agent_id']]) ) {
		$mission_agents[$row['_agent_id']]['_whomade'][$row['_charid']] = $row;
	}

}

}

#print_r2(  $mission_agents , true );
#print_r2(  $mission_agents_list_unq , true );
#print_r2(  $mission_agent_whomake , true );

$str = "SELECT w.`char` as charName, w.`charid` as _charid,  /* w.`corp` as corpName,*/ SUM( w.`amount2` ) AS ratBountys
	FROM `eve_online_wallet` w
	INNER JOIN evedump_systems es ON es.sys_eve_id = w.`system_id`
	WHERE 1 {$period_filter} AND `corpid` = '{$corp_id}'
	AND es.sys_sec > 0.41
	GROUP BY `charid`
	ORDER BY SUM( w.`amount2` ) DESC";
	
$str = "SELECT w.`char` AS charName, w.`charid` as _charid, SUM( w.`amount2` ) AS ratBountys
	FROM `eve_online_wallet` w
	INNER JOIN evedump_systems es ON es.sys_eve_id = w.`system_id`
	WHERE 1 {$period_filter} AND w.`corpid` = '{$corp_id}'
	AND es.sys_sec > 0.41
	GROUP BY w.`charid`
	ORDER BY SUM( w.`amount2` ) DESC
	";
	
$highseconly = fetch_all( $str );


$str = "SELECT w.`system` AS systemName, evr.reg_name as regionName, es.sys_sec as truesec, SUM( w.`amount2` ) - SUM(w.`amount`) AS ratBountys,SUM(w.`amount`) AS taxBountys
		FROM `eve_online_wallet` w
		INNER JOIN evedump_systems es ON es.sys_eve_id = w.`system_id`
		INNER JOIN evedump_constellations ec ON es.sys_con_id = ec.`con_id`
		INNER JOIN evedump_regions evr ON ec.`con_reg_id` = evr.`reg_id`
		WHERE 1 {$period_filter} AND `corpid` = '{$corp_id}' {$not}
		GROUP BY `system_id`
		ORDER BY SUM( `amount2` ) DESC
		LIMIT 100 ";
$ratting_by_system = fetch_all( $str );



$str = "SELECT /* w.`system` AS systemName, */ evr.reg_name as regionName, avg(es.sys_sec) as avg_truesec, SUM( w.`amount2` ) - SUM(w.`amount`) AS ratBountys, SUM(w.`amount`) AS taxBountys
		FROM `eve_online_wallet` w
		INNER JOIN evedump_systems es ON es.sys_eve_id = w.`system_id`
		INNER JOIN evedump_constellations ec ON es.sys_con_id = ec.`con_id`
		INNER JOIN evedump_regions evr ON ec.`con_reg_id` = evr.`reg_id`
		WHERE 1 {$period_filter} AND `corpid` = '{$corp_id}' {$not}
		GROUP BY evr.`reg_id`
		ORDER BY SUM( `amount2` ) DESC
		LIMIT 100 ";
$ratting_by_region = fetch_all( $str );

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
	WHERE 1 {$period_filter} AND `corpid` = '{$corp_id}' {$not}
    GROUP BY er.`ratid`
    ORDER BY er.amount DESC , ei.typeName ASC
	LIMIT 100
	";
    
$ratting_by_rattype = fetch_all( $str );
	foreach( $ratting_by_rattype as &$all ) {
		$all['max_ratountys'] = $all['totalRatKills'] * $all['ratBouny'];
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
		WHERE 1 {$period_filter} AND `corpid` = '{$corp_id}' {$not}
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

$str = "Select SUM( IFNULL(w.`amount`,00) ) AS corptax, SUM( IFNULL(w.`amount2`,00)) AS ratBountys FROM eve_online_wallet w  ".
	" WHERE 1 $period_filter AND w.`corpid` = '{$corp_id}' ";
$total_ratting_selected_filter = fetch_one($str , 'ratBountys');
$total_ratting_selected_filter_corptax = fetch_one( $str , 'corptax' );

?><html>
<head>
	<title><?= htmlspecialchars(trim($corpName)) ?> EveOnline статистика корпорации по баунти и налогам</title>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="js/jquery-ui.js"></script>  
  <script src="js/jquery.ui.datepicker-ru.js"></script>
<script language="JavaScript" src="overlib.js"></script>
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
* {
	color: <?= body_font_color_common ?>;
}

a {
	text-decoration: none;
	color:#537BAC;
}
a:hover {
	border-bottom:1px dotted;
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

</head>
<body><center>
	<? if($_GET['period']!='alltime'): ?><a href="<?= $file ?>&period=alltime<? if( $charid ): ?>&char=<?= htmlspecialchars($_GET['char']) ?><? endif; ?>">за все время</a><? else: ?><span style="color:red;"><b>за все время</b></span><? endif; ?> | 
    <? if($_GET['period']!='last90days'): ?><a href="<?= $file ?>&period=last90days<? if( $charid ): ?>&char=<?= htmlspecialchars($_GET['char']) ?><? endif; ?>">за 3 месяца</a><? else: ?><span style="color:red;"><b>за 3 месяца</b></span><? endif; ?> |
	<? if($_GET['period']!='last30days'): ?><a href="<?= $file ?>&period=last30days<? if( $charid ): ?>&char=<?= htmlspecialchars($_GET['char']) ?><? endif; ?>">за 30 дней</a><? else: ?><span style="color:red;"><b>за 30 дней</b></span><? endif; ?> |
    <? if($_GET['period']!='last25days'): ?><a href="<?= $file ?>&period=last25days<? if( $charid ): ?>&char=<?= htmlspecialchars($_GET['char']) ?><? endif; ?>">за 25 дней</a><? else: ?><span style="color:red;"><b>за 25 дней</b></span><? endif; ?> |
    <? if($_GET['period']!='last14days'): ?><a href="<?= $file ?>&period=last14days<? if( $charid ): ?>&char=<?= htmlspecialchars($_GET['char']) ?><? endif; ?>">за 14 дней</a><? else: ?><span style="color:red;"><b>за 14 дней</b></span><? endif; ?> |
	<? if($_GET['period']!='last7days'): ?><a href="<?= $file ?>&period=last7days<? if( $charid ): ?>&char=<?= htmlspecialchars($_GET['char']) ?><? endif; ?>">за 7 дней</a><? else: ?><span style="color:red;"><b>за 7 дней</b></span><? endif; ?> |
	<? if($_GET['period']!='last24h'): ?><a href="<?= $file ?>&period=last24h<? if( $charid ): ?>&char=<?= htmlspecialchars($_GET['char']) ?><? endif; ?>">за 24 часа</a><? else: ?><span style="color:red;"><b>за 24 часа</b></span><? endif; ?> |
    <? if($_GET['period']!='last12h'): ?><a href="<?= $file ?>&period=last12h<? if( $charid ): ?>&char=<?= htmlspecialchars($_GET['char']) ?><? endif; ?>">за 12 часов</a><? else: ?><span style="color:red;"><b>за 12 часов</b></span><? endif; ?>    
<hr/>
<div class="fri">Отчет с баунти пилотов за период с <b><?= $date_filter_res['mindate'] ?></b> по <b><?= $date_filter_res['maxdate'] ?>
</b> корпорация "<b style="color:#fbf80a;"><?= htmlspecialchars($corpName) ?></b>" <? if($charid): ?> и пилот "<b><?= htmlspecialchars($_GET['char']) ?></b>
"[<a href="<?= $file ?>&period=<?= $_GET['period'] ?>">remove</a>] <? endif; ?>
<br/> <i style="color:#bbbaba;">Статистика обновляется каждые 2-3 часа</i></div>
<br/> 
<? if( !$charid ): ?>	<a href="#ratting">Баунти по пилотам</a> | 	<? endif; ?>
	<a href="#system">Фильтр по системам</a> | 
	<a href="#region">Фильтр по регионам</a>
<? if( $charid ): ?>	<a href="#playerrattingbyday">За день</a> |  	<? endif; ?>
<? if( $player_ratting_by_day_all ): ?>
	<a href="#playerrattingbyday_all">Топ карибасов за день</a> | 
<? endif; ?>
	

	
	
<br> <span style="color:white;">по пилоту:</span> <select id="charselect" onchange="document.location='<?= $file ?>&period=<?= $_GET['period'] ?>&char='+document.getElementById('charselect').options[document.getElementById('charselect').selectedIndex].value;"><option></option><option<? if(is_null($charid)): ?> selected="selected" <? endif; ?> value="">все пилоты (<?= htmlspecialchars($corpName) ?>)</option><? foreach($chars as $char): ?><option<? if($charid==$char['charid']): ?> selected="selected" <? endif; ?> value="<?= htmlspecialchars($char['char']) /*(int)($char['charid']) */ ?>"><b><?= htmlspecialchars($char['char']) ?></b>  (<?= htmlspecialchars($char['corp']) ?>)</option><? endforeach; ?></select>

<? if( @$_GET['pswc'] == 'ee_hide_bountys' ): ?>

<br><div class="fri">Общее количество баунти: <span style="color:red;font-weight:bold;"><i>hidden</i></span> ISK ( такса корпы <span style="color:red;font-weight:bold;"><i>hidden</i></span> ISK )</div>
<br><br>

<? else: ?>
<br><div class="fri"> Общее количество баунти: <span style="color:red;font-weight:bold;"><? if(is_array($total_ratting_selected_filter)){echo 'нет данных';} else echo isknf($total_ratting_selected_filter); ?></span> ISK ( такса корпы <span style="color:red;font-weight:bold;"><? if(is_array($total_ratting_selected_filter_corptax)){echo 'нет данных';} else echo isknf($total_ratting_selected_filter_corptax) ?></span> ISK )</div>

<? endif; ?>

<br />
<div style="width:500px;">
<form action="" method="get" id="filtr" >
<span>дата с :</span>
<? if($_GET['pswc']): ?><input name="pswc" type="hidden" value="<?= $_GET['pswc'] ?>" /><? endif; ?>
<? if($_GET['char']): ?><input name="char" type="hidden" value="<?= $_GET['char'] ?>" /><? endif; ?>
<input type="text" readonly="readonly" name="from" id="from" value="<? echo $_GET['from']; ?>" /> <span> по: </span> <input name="tomuch" type="text" id="tomuch" readonly="readonly" value="<? echo $_GET['tomuch']; ?>" /> - 
<button form="filtr" type="submit">отправить</button></form>
</div>

 
<?
$url_start1 = $file.'&period='.$_GET['period']; //.'&order=';
if( !empty($_GET['char']) ) { 
	$url_start1 .= '&char='.urlencode($_GET['char']);
}

$url_start = $url_start1.'&order=';


?>


<? if( !$charid && $ratting_all ) : ?>
<div id="body1">
<div id="top_b"></div>
<div id="mid_b">
	<?= build_table($ratting_all,'Баунти по пилотам</u> (<a href="'.$url_start1.'&show_xml=true" target="_blank">как xml</a>)<u>','ratting',true,0,true,$taxRate) ?>
    </div>
<div id="bot_b"></div>
</div>
<? endif; ?>
</div>
<br />
<div id="body1">
<div id="top_b"></div>
<div id="mid_b">
<?= build_table($ratting_by_system,'Фильтр по системам (максимум 100)','system') ?>
</div>
<div id="bot_b"></div>
</div>
<br />
<div id="body1">
<div id="top_b"></div>
<div id="mid_b">
<?= build_table($ratting_by_region,'Фильтр по региону','region') ?>
</div>
<div id="bot_b"></div>
</div>
<br />
<? if( $charid ): ?>
<div id="body1">
<div id="top_b"></div>
<div id="mid_b">
	<?= build_table($player_ratting_by_day,'пилот "'.htmlspecialchars($_GET['char']).'" баунти за день <i>(макс 100 дней)</i>','playerrattingbyday',false) ?>
    </div>
<div id="bot_b"></div>
</div>
<? endif; ?>
<br />
<div id="body1">
<div id="top_b"></div>
<div id="mid_b">
<?= build_table($ratting_by_rattype , 'Баунти по NPC <i>(макс 100)</i>' , 'npc', true, $ext_order) ?> 
    </div>
<div id="bot_b"></div>
</div>

<? if( $player_ratting_by_day_all ): ?>
	<?= build_table($player_ratting_by_day_all,'top25 <i>(max)</i> carebears by day','playerrattingbyday_all') ?>
<? endif; ?>
<!--
<a href="">faction rats kills</a> || <a href="">higgest bounty rats kills</a>
<br> -->









 
</center>
<? _google_viststat(); ?>
<?= $_GET['period'] ?>
</body>
</html>