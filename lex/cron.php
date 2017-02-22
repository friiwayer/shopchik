<?php  

require_once 'config.php';
require_once 'functions.php';



function fetch_wallet($nalog,$corpNalog,$corpId,$apiKey,$userID,$beforeRefID=null) {
	global $db, $eve_api;
	
	if( !check_api_online(true) ) {
		return false;
	}

	$add_wallet_rows = 0;
	
	$charData = $eve_api.'/corp/CorporationSheet.xml.aspx?corporationID='.$corpId;
	$xml = (array)getXML( $charData, 2 ); // simplexml_load_string(file_get_contents($charData));
	$corpName = (string)$xml['result']->corporationName;
#var_dump($corpName); var_dump($corpId);

	$corpData = $charData;

	$xml = (array)getXML( $corpData, 2 );

	$corpTax   = (float)$xml['result']->taxRate; 

	$wallet_page = $eve_api."/corp/WalletJournal.xml.aspx?keyID={$apiKey}&vCode={$userID}";
	
	if( $beforeRefID ) {
		$wallet_page .= sprintf('&beforeRefID=%s',$beforeRefID);
	}

	$wallet_xml = getXML( $wallet_page, 'auto' );

	 
#	print_r2( $corpTax );
	$xml = (array)$wallet_xml->result->rowset;
#	print_r2($wallet_xml);
		
	$cnt = 0;
	$RefIDs = null;
	$dates = $dates1 = array();
	foreach((array)@$xml['row'] as $row ) {
		$cnt++;
		
		$tmp = array();
		foreach($row->attributes() as $a => $b) {
			$tmp[$a] = (string)$b;
		#	echo $a,'="',$b,"\"\n";
		}#die;
		$row = $tmp;
		
	#	$row = (array)$row;
	#	$row = $row['@attributes']; 
	
		$dates[strtotime((string)$row['date'])] = strtotime((string)$row['date']); 
		$dates1[strtotime((string)$row['date'])] = (string)$row['date']; 

        // nalog wallet
        if( in_array( $row['refTypeID'] , array(10)) && $row['ownerName2'] == $corpName) {	  
            $balance = $row['balance'];
            $wow = word_array();
			if(add_nalog_wallet($wow,$nalog,$row,$corpName,$corpId,$corpTax,$balance,$row['reason'])) {
				$add_wallet_rows++;
			}
            $char_d = wie();
            if(!empty($char_d))
            {
            foreach($char_d as $char)
            {
            if(!in_array($char['Char_id'],array($row['ownerID1'])))
            {
            add_new_piloka($row,$corpName,$corpId,$nalog);
            }
            }
            }else
            {
            add_new_piloka($row,$corpName,$corpId,$nalog);
            }
		}
        $char_d = wie();
        foreach($char_d as $char)
        {
            add_nalog($corpNalog,$char['Char_id'],$char_d);
        }
        minus_nalog(filter_nalog('',$nalog));	       
		// npc kills
		if( $row['ownerName1'] == 'CONCORD') {	  
			if( add_wallet_npckills($row,$corpName,$corpId,$corpTax) ) {
				$add_wallet_rows++;
			}
		}

		// missioning
		if( in_array( $row['refTypeID'] , array(33,34,7,28) ) ) {
			if( add_wallet_mission($row,$corpName,$corpId,$corpTax) ) {
				$add_wallet_rows++;
			}
		}
		
		$RefIDs[] = $row['refID'];
	}
	
	$cachedUntil = (string)$wallet_xml->cachedUntil;
	$currentTime = (string)$wallet_xml->currentTime;
	
	print "<b>".$corpName." [ $corpId ] ($corpTax %) "." - $add_wallet_rows / $cnt  (beforeRefID: {$beforeRefID}) </b>
	<i>	<br> * [cachedUntil={$cachedUntil} (time-api-taken: {$currentTime}]) ]  
		<br> * wallet.dates = ( ".$dates1[ min($dates) ]." to ".$dates1[ max($dates) ]." ) \n<br>\n
	</i>	";

	$ret = array( 
		'min' => null, //@min( $RefIDs ) , 
		'max' => null, //@max( $RefIDs ) ,  
		'cnt' => count($RefIDs) , 
		'currentTime' => (string)$wallet_xml->currentTime , 
		'cachedUntil' => $cachedUntil ,
	);
	
	if( $ret['cnt'] ) {
		$ret['min'] = min( $RefIDs );
		$ret['max'] = max( $RefIDs );
	}
	
	return $ret;
}

function add_wallet_mission($row,$corpName,$corpId,$corpTax) {
	
	$amount2 = (int) ($row['amount']/$corpTax*100);

//	$db->sql_query("DELETE FROM `eve_online_wallet` WHERE `refID` = '".$row['refID']."' ");
	
	$sql = "INSERT IGNORE `eve_online_wallet` ".
		" (`refID`, `char`, `charid`, `system`, `system_id`, ".
		" `corp`, `corpid`, `reason`, ".
		" `agent_name`, `agent_id`, ".
		" `amount`, `amount2`, `date`) ".
		" VALUES ".
		" ('".$row['refID']."', '".addslashes($row['ownerName2'])."', '".$row['ownerID2']."', '".addslashes($row['argName1'])."', '".$row['argID1']."', ".
		" '".addslashes($corpName)."', '".$corpId."', '".addslashes($row['reason'].'|refID:'.$row['refTypeID'].'|')."', ".
		" '".addslashes($row['ownerName1'])."', '".(int)$row['ownerID1']."', ".
		" '".$row['amount']."', '".$amount2."', '".$row['date']."')";
		
//	print $sql; die;	
		
	$res = exec_query($sql);
    if($res)
    {
        $up = 'UPDATE `eve_online_nalog` SET `balance` = "'.$row['balance'].'" WHERE `id` = MAX(`id`)';
        exec_query($up);
    }
	return( $res );
}

function add_wallet_npckills($row,$corpName,$corpId,$corpTax) {
	global $db;

	$rats_tmp = explode( ',' , $row['reason'] );
	$rats = array();
	foreach( $rats_tmp as $d ) {
		$d_tmp = explode( ':' , $d );
		
		if( isset($d_tmp['0']) && isset($d_tmp['1']) 
			&& is_numeric($d_tmp['0']) && is_numeric($d_tmp['1']) ) {

			$sql = "INSERT IGNORE `eve_online_ratkills` ".
				" (`refID`, `ratid`, `amount`) ".
				" VALUES ".
				" ('".$row['refID']."', '".$d_tmp['0']."', '".$d_tmp['1']."');";
				
			exec_query($sql);
			
		}
	}
	
	$amount2 = (int) ($row['amount']/$corpTax*100);

	$sql = "INSERT IGNORE `eve_online_wallet` ".
		" (`refID`, `char`, `charid`, `system`, `system_id`, ".
		" `corp`, `corpid`, ".
		" `reason`, `amount`, `amount2`, `date`) ".
		" VALUES ".
		" ('".$row['refID']."', '".addslashes($row['ownerName2'])."', '".$row['ownerID2']."', '".addslashes($row['argName1'])."', '".$row['argID1']."', ".
		" '".addslashes($corpName)."', '".$corpId."', '".addslashes($row['reason'])."', ".
		" '".$row['amount']."', '".$amount2."', '".$row['date']."')";
		
	$res = exec_query($sql);
	return ( $res );
	
}

function add_nalog_wallet($wow=array(),$nalog,$row,$corpName,$corpId,$corpTax,$balance,$desc) {
	global $db;
    $desc = trim($desc);
    $descr = $desc;

if (strposa($desc, $wow))
	{$sql = "INSERT IGNORE `eve_online_nalog` ".
		" (`refID`, `char`, `charid`, ".
		" `corp`, `corpid`,".
		" `reason`, `amount`, `amount2`, `date`, `balance`) ".
		" VALUES ".
		" ('".$row['refID']."', '".addslashes($row['ownerName1'])."', '".$row['ownerID1']."', ".
		" '".addslashes($corpName)."', '".$corpId."', '".$descr."', ".
		" '".$row['amount']."', '".$amount2."', '".$row['date']."', '".$row['balance']."' )";
		
	$res = exec_query($sql);
    return ( $res );}
}

function strposa($haystack, $needles=array(), $offset=0) {
        $chr = array();
        foreach($needles as $needle) {
                $res = strpos($haystack, $needle, $offset);
                if ($res !== false) $chr[$needle] = $res;
        }
        if(empty($chr)) return false;
        return min($chr);
}

function add_new_piloka($row,$corpName,$corpId,$nalog)
{
	global $db;
    $sql = 'INSERT IGNORE `eve_online_pilots` '.
    ' (`Char_id`, `Char_name`, `Corp_id`, `data`, `month`) '.
    'VALUES '.
    ' ("'.$row['ownerID1'].'", "'.addslashes($row['ownerName1']).'", "'.$corpId.'", "'.date('Y-m-d').'", "'.date('m').'")';
    $echo = exec_query($sql);
}

function add_nalog($corpNalog,$charid,$chk)
{
    $today = date('d');
    if($today == '01')
    {
    $sql = 'UPDATE `eve_online_pilots` e SET e.`Corp_dolg` = ';
    if(count($chk))
    {
        foreach ($chk as $row)
        {
            if($row['Char_id'])
            {
                $nal = $row['Corp_dolg'] + $corpNalog;
                exec_query($sql.' "'.$nal.'", e.`month` = "'.date('m').'" WHERE e.`Char_id` = "'.$row['Char_id'].'" AND e.`month` <> "'.date('m').'"');
            }
        }
    }
    }
}
//DATE_FORMAT(e.`date`, "%M") as _month

function minus_nalog($nalog)
{
    $select = "SELECT SUM(`amount`) AS nal, `charid` FROM `eve_online_nalog` WHERE 1 {$nalog} AND `pay_not`='0' GROUP BY `charid`";
    $summ = fetch_all($select);
    foreach($summ as $key)
    {
    $up = 'UPDATE eve_online_pilots LEFT JOIN eve_online_nalog ON eve_online_nalog.charid = eve_online_pilots.Char_id 
    SET eve_online_pilots.Corp_dolg = eve_online_pilots.Corp_dolg - '.$key['nal'].', eve_online_nalog.pay_not = "1" WHERE eve_online_nalog.pay_not="0" 
    AND eve_online_pilots.Char_id = '.$key['charid'];
    exec_query($up);        
    }
}

function wie()
{
    $sql = 'SELECT * FROM `eve_online_pilots` ';
    $dop = fetch_all($sql);
    return $dop;
}

if( !check_api_online(true) ) { 
	print "api offline!!!";
	die;
}

$cnt_rm = clear_directory_files_older($api_cache_directory,(60*60*24*10),'xml');
if( $cnt_rm ) {
	print "<br><b>{$cnt_rm}</b> old file(s) deleted in api cache directory<br>";
}


print " EVE_ONLINE_CURRENTTIME = ".EVE_ONLINE_CURRENTTIME."<br>\n";
foreach( $config_keys_eve as $i => $d ) {

	print "<hr><b>$i</b><br>";
	if( isset($d['bad']) && ($d['bad']==true) ) {
		print "--skip--";
		continue;
	}

	$more = true;
	$beforeRefID = null;
 	while( $more ) {
		$data = fetch_wallet($config,(int)$config['nalog'], $d['corp_id'], $d['keyID'], $d['vCode'], $beforeRefID );
		$more = ($data['cnt']==250);
		$beforeRefID = $data['min'];
		/*print_r2( $data );
		print $d['apiKey'].' = '.$beforeRefID;*/
	}
} 