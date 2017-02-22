<?php
/*
 Ratter by Siim Tiilen aka Baron Holbach <eritikass@gmail.com> is licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License.
 http://creativecommons.org/licenses/by-sa/3.0/us/
 
 all isk donations welcome in eve
 
 All Eve Related Materials are Property Of CCP Games (  http://www.ccpgames.com/ )
*/


require_once 'config.php';
require_once 'functions.php';

if( !empty($_GET['getapi']) ) {
	header ("content-type: text/xml;");
	print getXml( $eve_api.$_GET['getapi'], @$_GET['cache'], true );
}


if( isset($_GET['getcharimg']) && is_numeric($_GET['getcharimg']) ) {
	$char_img_url = sprintf('http://image.eveonline.com/Character/%s_128.jpg',(int)$_GET['getcharimg']); 
	$char_img_url_old = sprintf('http://oldportraits.eveonline.com/Character/%s_128.jpg',(int)$_GET['getcharimg']); 

	$char_img_local = $img_cache_directory.'EveCharPortrait_'.(int)$_GET['getcharimg'].'.jpeg';
	

    // Getting headers sent by the client.
    $headers = apache_request_headers();

    // Checking if the client is validating his cache and if it is current.
    if (file_exists($char_img_local) && isset($headers['If-Modified-Since']) && (strtotime($headers['If-Modified-Since']) == filemtime($char_img_local)) ) {
        // Client's cache IS current, so we just respond '304 Not Modified'.
        header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($char_img_local)).' GMT', true, 304);
    } else {
	
		if( !file_exists($char_img_local) ) {
			file_put_contents( $char_img_local , file_get_contents($char_img_url) );
			chmod($char_img_local, 0644);
		} 
		
		// validate image, just to be sure!
		if( !getimagesize( $char_img_local ) ) {
			unlink( $char_img_local );
			exit( "bad-image" );
		}
	
        // Image not cached or cache outdated, we respond '200 OK' and output the image.
        header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($char_img_local)).' GMT', true, 200);
		header('Content-Length: '.filesize($char_img_local));
		header('Content-Type: image/jpeg');
		print file_get_contents($char_img_local);
    }
	die;

}