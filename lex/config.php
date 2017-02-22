<?php
/*
$filename = 'ajax/options.txt';
$config = array();
if(is_file($filename))
{
$file = file_get_contents($filename);
$ar = explode(';',$file);

for($a=0;$a<=count($ar)-2;$a++){
    $infa[$a] = explode(':',$ar[$a]);
}

for($z=0;$z<=count($infa)-1;$z++)
{
    for($a=0;$a<=2;$a++)
    {
        $config[trim($infa[$z][0])] = $infa[$z][1];
    }
}
}*/


// database config
$dbhost = 'localhost';
$dbport = '';
$dbname = 'friiw_npc';
$dbuser = 'friiw_npc';
$dbpasswd = 'e5e05ce65120';

// for images etc...
$img_cache_directory = dirname(__FILE__).'/img/';
// api cache directory
$api_cache_directory = dirname(__FILE__).'/apicache/';

// api keys used to fetch api
$config_keys_eve = array(
 
	'key1' => array( 
			'keyID' => '2655870',
			'characterID' => '',
			'userID' => '',
            'vCode' => '6poHTTl16oBa3LyebPIZd6uGClVmspWCxyIlDMlGgIBAG7Pf2U1k7SzIlhc6RIs7',
            'corp_id' => '175862913',	
		),
);

$nalog = array(
    'use'=>'1',
    'word'=>'налог',
);

$filter_msg = '';

function filter_nalog($pref,$nalog)
{
if($nalog['use_word'] == '1')
{
    return 'AND LOWER('.$pref.'.`reason`) LIKE LOWER("'.$nalog['word'].'%")';
}else{
    return '';
}
}


// list of password to get access, 
// id of array is password, and value is corp_id in db ( same as in eve-api)
$pswConfig = array(
	// password => corp_id
	'test_password' => '175862913', // .EE 
);

// web urls for images
define('rats_img_url','npc/%d.png');

define('char_port_img_url','cache.php?getcharimg=%d&usecache=true');

// define eve-api url
$eve_api = 'https://api.eveonline.com';
$corpNalog = 150000000;
define('body_font_color_common','#333333');
define('body_link_color_common','#0000FF');



function _google_viststat() {
	/* place your stat code here, echo it simply */
}


// do not change, init db object 
$db = new mysqli( $dbhost, $dbuser, $dbpasswd,  $dbname, ( !$dbport ? null : $dbport ) );
$db->set_charset("utf8");

	 
if ($db->connect_error) {
	error_log( "ratter db error, msg: ".$db->connect_error.", code: ".$db->connect_errno );
	die("database error, check logs for more!");
}
