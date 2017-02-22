<?php

if (!function_exists('file_put_contents')) {
    function file_put_contents($filename, $data) {
        $f = @fopen($filename, 'w');
        if (!$f) {
            return false;
        } else {
            $bytes = fwrite($f, $data);
            fclose($f);
            return $bytes;
        }
    }
}

if (!function_exists('fetch_url')) {
	function fetch_url($url) {
		if( function_exists('curl_init') ) {
			$ch = curl_init();
			$timeout = 5;             
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);             
			$data = curl_exec($ch);
			curl_close($ch);
			return $data;
		 } else {
			return file_get_contents($url);
		 }
	
	}
}

function simple_xml($xml)
{
    $exit = new SimpleXMLElement($xml);
    $return = $exit->eveapi->result['serverOpen'];
    return $exit;
}

function kill_cache($url) {
	global $api_cache_directory;
	
	$md5 = md5($url);

	$filename = $api_cache_directory."{$md5}.xml";
	
	if( file_exists($filename) ) {
		unlink($filename);
	}
}

$appi_request_count = $appi_request_cache_use = 0;
function getXml($url,$cache_liftetime_h=0,$returnXML=false) {
	global $appi_request_count, $appi_request_cache_use, $api_cache_directory;
	
	if( $cache_liftetime_h != 'auto' ) {
		$cache_liftetime_h = (int)$cache_liftetime_h;
	}
		
	$appi_request_count++;
	$md5 = md5($url);

	$filename = $api_cache_directory."{$md5}.xml";
	
	if( ($cache_liftetime_h == 'auto') && file_exists($filename) ) {
		$xmlSource = file_get_contents($filename);
		
		try {
			$arrayTmp = simplexml_load_string($xmlSource);
			$cachedUntil = $arrayTmp->cachedUntil;
			if( !check_api_online() ) {
				$cache_liftetime_h = 9999;
			} else {
				$time_Current = strtotime( EVE_ONLINE_CURRENTTIME );
				$time_Cached = strtotime( $cachedUntil );
				
				if( $time_Current > $time_Cached ) {
					$cache_liftetime_h = 0;
				} else {
					$left = ($time_Cached - $time_Current) ;
					if( $left > 0 ) {
						$cache_liftetime_h = 0;
					} else {
						$cache_liftetime_h = 9999;
					}
				}
			}
			
		} catch( Exception $e ) {
			$cache_liftetime_h = 0;
		}
		
	}
	
	if( $cache_liftetime_h > 24 ) {
		$cache_liftetime_h = 24;
	}

	$xmlSource = '';
	if( file_exists($filename) ) {
		if( (filemtime($filename)+($cache_liftetime_h*60*60)) > time() || !check_api_online() ) {
			$appi_request_cache_use++;
			$xmlSource = file_get_contents($filename);
		} else {
			@unlink($filename);
		}
	}
	
	if( empty($xmlSource) ) {
		if( check_api_online() ) {
			$xmlSource = fetch_url($url);
			if( !file_put_contents($filename,$xmlSource) ) {
				@unlink($filename);
			} else {
				chmod($filename,0666);
			}
		} else {
			return null;
		}
	}

	if( $returnXML ) {
		return $xmlSource;
	}
	
	return simplexml_load_string($xmlSource);
	
//	return strlen($xmlSource);
	
}

if( !isset($appi_request_count) ) {
	$appi_request_count = 0;
}

function check_api_online() { 
	global $eve_api, $appi_request_count;
	$serverstatus_url = $eve_api.'/server/ServerStatus.xml.aspx';
	if( !defined('API_ONLINE') ) {
		$online = false;
		if( $XmlSource = fetch_url($serverstatus_url) ) {
			$appi_request_count++;
			$xml = simplexml_load_string($XmlSource);
			define( 'EVE_ONLINE_CURRENTTIME' , $xml->currentTime );
			if(strtolower($xml->result->serverOpen) == 'true'){
				$online = true;
			}
		}
		define('API_ONLINE',$online);
	}
	return API_ONLINE;
}

function getAttr(&$data,$attr_name) {
	$arr = get_object_vars($data);
	if( $arr['@attributes'] && $arr['@attributes'][$attr_name] ) {
		return $arr['@attributes'][$attr_name];
	}
	return false;
}

function dotland_link($name,$type='alliance') {
	return "http://evemaps.dotlan.net/$type/".str_replace(' ','_',$name);
}

function print_r2($data,$die=false) {
	printf("<pre>%s</pre>",print_r($data,1));
	if($die){die;}
}

function hsc($text) {
	return htmlspecialchars($text);
}

function esc_js($str)
{
	return str_replace(array("\\", "\r\n", "\r", "\n", "'", '"'), array("\\\\", "\\r\\n", "\\r", "\\n", "\\'", '\\"'), ($str));
}



function rand_it($len=20, $full = false)
{
	$pos_chars	= $full ?
		'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789' :
		'ABCDEFGHIJKMNPQRSTUVWXYZ2346789';
	$num_of_chars	= strlen($pos_chars) - 1;
	$res		= '';

	while($len--)
		$res .= $pos_chars[mt_rand(0, $num_of_chars)];

	return $res;
}


function fetch_one($sql,$column=null) {
	global $db;
	try {
		$ret = false;
		if( $result = $db->query($sql) ) {
			if ( $row2 = $result->fetch_assoc() ) {
				if( isset($row2[$column]) ) {
					$ret = $row2[$column];
				} else {
					$ret = $row2;
				}
			}
			$result->close();
		}
		return $ret;
	} catch (Exception $e) {
		error_log("db-error: ". $e->getMessage());
		return null;
	}
}

function exec_query($sql) {
	global $db;
	try {
		$db->query($sql);
		return ( $db->affected_rows );
	} catch (Exception $e) {
		return 0;
	}
}


function fetch_all($sql,$ret=array()) {
	global $db;
	try {
		if( $result = $db->query($sql) ) {
			while ( $row2 = $result->fetch_assoc() ) {
				$ret[] = $row2;
			}
		} 
		return $ret;
	} catch (Exception $e) {
		error_log("db-error: ". $e->getMessage());
		return array();
	}
}





function isknf($number,$no_hide=false) {
	if( defined('HIDE_ISK') && !$no_hide ) {
		return 'hidden';
	}	
	return number_format($number,0, ',', '.');
}

function build_table($data,$title=null,$ancor=null,$add_rank=true,$ext_comment=null,$print_output=true) {
	global $file, $officers;
	global $users;
    global $keyid,$vcode;
	
	$chars_colors = $main_names = $bgColors = array();
	if( isset($users) ) {
		foreach( $users as $_name => $_usr ) {
			foreach( $_usr['chars'] as $_charname ) {
				if( !empty($_usr['color']) ) {
					$chars_colors[ strtolower($_charname) ] = $_usr['color'];
				}
				$main_names[ strtolower($_charname) ] = $_name;
				if( !empty($_usr['bgColor']) ) {
					$bgColors[ strtolower($_charname) ] = $_usr['bgColor'];
				}
			}
		}
	}
	
	
	$print_out = '';
	
	$highlight = array();
	if( isset($_GET['highlight']) ) {
		if( is_array($_GET['highlight']) ) {
			$highlight = (array)$_GET['highlight'];
		} else {
			$highlight =  array( (string)$_GET['highlight'] );
		}
	}
	
	if( $ancor ) {
		$print_out .=   '<a name="'.$ancor.'"></a>';
	}
	if( $title ) {
		$print_out .=   "\n<b><u>$title</u></b>";
	}
	if( $ext_comment ) {
		$print_out .=   "<br><i>$ext_comment</i>";
	}
	if( !count($data) ) {
		$print_out .=   "<div style='padding-top:20px;'><b><span id='unknow'>Нет данных по текущему <!--TIME--> фильтру!</span></b></div><br>";
	}	else {
	   $print_out .=   "\n<table style='' border='1' >";
       
       
		$top1 = true;
		$cnt = 1;
		foreach( $data as $row1 ) {
			$bg_color = '';
			
			if( isset( $row1['charName'] )&& isset($bgColors[strtolower($row1['charName'])]) ) {
				$bg_color = $bgColors[strtolower($row1['charName'])];
			}
            
            if(isset($row1['charNam']))
            {
                $form = sprintf('
                <div class="forma hide">
                <input type="hidden" name="corpid" value="%s" disabled="" />
                <input name="id_char" type="hidden" value="%s" disabled="" />
                <input type="text" name="corp_dolg" value="%s" />
                <button onclick="return false;" id="upit">обновить</button>
                <button style="float:right;" id="dellit" onclick="return false;">del</button>
                </div>',
                $row1['_corpd'],$row1['_charid'],$row1['Corp_dolg']);
            }			
			
			$is_officer = (isset( $row1['ratName'] )&&in_array($row1['ratName'],$officers));
			
			if( $top1 ) {
				$print_out .=   "\n<tr>";
				if( $add_rank ) {
					$print_out .=   "\n<td align='center'>#</td>";
				}
				foreach( $row1 as $title => $data ) {
					$highlight_this = in_array( $title , $highlight );
				
					if( substr($title,0,1) == '_' ) continue; 
				
					$print_out .=   "\n<td>"; 
					if( $highlight_this ) { $print_out .=   '<span style="color:red;">'; }
					$print_out .=   htmlspecialchars($title);
					if( $highlight_this ) { $print_out .=   '</span>'; }
					$print_out .=   "</td>";
				}
				$print_out .=   "\n</tr>";
			}
			$top1 = false;
			
			
			
			$print_out .=  "\n<tr".($is_officer?' class="row_officer"':'')." ".($bg_color ? ' style="background-color:'.$bg_color.';" ': '' )." >";	
			
			if( $add_rank ) {
				$print_out .=  "\n<td align='center'>".$cnt."</td>";
			}
			foreach( $row1 as $title => $data ) {
				$highlight_this = in_array( $title , $highlight );
				if( substr($title,0,1) == '_' ) continue; 
			
				$align = 'left';
				$htmlspecialchars = true;
				#if( $title == 'ratBountys' || $title == 'ratBounty' || $title == 'totalRatKills' ) {

				if( in_array($title,array('date')) ) {
					$htmlspecialchars = false;
					$data = $data;
                    $align = 'left';
					
			#		if( @$_GET['pswc'] == 'ee_hide_bountys' ) {
			#			$data = '<i>hidden</i>';
			#		}
				}				    
                    
				if( in_array($title,array('ratBountys', 'mission_rewards')) ) {
					$align = 'right';
					$htmlspecialchars = false;
					$data = '<span>'.isknf($data, ($title=='ratBounty') ).'</span>';
					
					if( $title == 'ratBouny' || $title == 'totalRatKills' ) {
						$data = trim(trim($data,'<b>'),'</b>');
					}
			#		if( @$_GET['pswc'] == 'ee_hide_bountys' ) {
			#			$data = '<i>hidden</i>';
			#		}
				}

				if( in_array($title,array('max_ratountys')) ) {
					$align = 'right';
					$htmlspecialchars = false;
					$data = '<span>'.isknf($data, ($title=='max_ratountys') ).'</span>';
					
					if( $title == 'ratBouny' || $title == 'totalRatKills' ) {
						$data = trim(trim($data,'<b>'),'</b>');
					}
			#		if( @$_GET['pswc'] == 'ee_hide_bountys' ) {
			#			$data = '<i>hidden</i>';
			#		}
				}
                
				if( in_array($title,array('totalRatKills')) ) {
					$align = 'right';
					$htmlspecialchars = false;
					$data = isknf($data, ($title=='totalRatKills') );
					
					if( $title == 'totalRatKills' ) {
						$data = trim(trim($data,'<b>'),'</b>');
					}
			#		if( @$_GET['pswc'] == 'ee_hide_bountys' ) {
			#			$data = '<i>hidden</i>';
			#		}
				}

				if( in_array($title,array('amount')) ) {
					$align = 'right';
					$htmlspecialchars = false;
					$data = isknf($data, ($title=='amount') );
					
					if( $title == 'amount' ) {
						$data = trim(trim($data,'<b>'),'</b>');
					}
			#		if( @$_GET['pswc'] == 'ee_hide_bountys' ) {
			#			$data = '<i>hidden</i>';
			#		}
				}

				if( in_array($title,array('nalog')) ) {
					$align = 'right';
					$htmlspecialchars = false;
					$data = isknf($data, ($title=='nalog') );
					
					if( $title == 'nalog' ) {
						$data = trim(trim($data,'<b>'),'</b>');
					}
			#		if( @$_GET['pswc'] == 'ee_hide_bountys' ) {
			#			$data = '<i>hidden</i>';
			#		}
				}
                
                
				if( in_array($title,array('ratBouny')) ) {
					$align = 'right';
					$htmlspecialchars = false;
					$data = isknf($data, ($title=='ratBouny') );
					
					if( $title == 'ratBouny' ) {
						$data = trim(trim($data,'<b>'),'</b>');
					}
			#		if( @$_GET['pswc'] == 'ee_hide_bountys' ) {
			#			$data = '<i>hidden</i>';
			#		}
				}                                 
				if( in_array($title,array('taxBountys')) ) {
					$align = 'right';
					$htmlspecialchars = false;
					$data = '<span class="jopa">'.isknf($data, ($title=='ratBouny') ).'</span>';
					
					if( $title == 'ratBouny' || $title == 'totalRatKills' ) {
						$data = trim(trim($data,''),'');
					}
			#		if( @$_GET['pswc'] == 'ee_hide_bountys' ) {
			#			$data = '<i>hidden</i>';
			#		}
				}

				if( in_array($title,array('Corp_dolg')) ) {
					$align = 'right';
					$htmlspecialchars = false;
					$data = '<span style="color:red;">'.isknf($data, ($title=='Corp_dolg')).$form.'</span>';
			#		if( @$_GET['pswc'] == 'ee_hide_bountys' ) {
			#			$data = '<i>hidden</i>';
			#		}
				}
                
                
				if( ($title == 'truesec' || $title == 'avg_truesec') && trim($data)!='' ) {
					$align = 'right';
					
					$sec_level = 'high-sec';
					$sec_color = 'green';
					if( ( (float)$data ) < 0.45 ) {
						$sec_color = '#CC9933';
						$sec_level = 'low-sec';
					}

					if( ( (float)$data ) < 0.05 ) {
						$sec_color = 'red';
						$sec_level = 'nullsec';
					}
					
					$data = '<span title="security-level: '.$sec_level.' ('.number_format($data, 3, ',', ' ').')" style="color:'.$sec_color.';">'.number_format($data, 3, ',', ' ').'</span>'; // not isk
					$htmlspecialchars = false;
				}
				if( $title == 'systemName' && trim($data)!='' ) {
				
					$htmlspecialchars = false;
					$data = sprintf('<a target="_blank" href="http://evemaps.dotlan.net/system/%s">%s</a>',str_replace(' ','_',$data),htmlspecialchars($data));
					
					if( isset($row1['regionName']) ) {
						$data .= sprintf('<sup>[<a title="show in map" target="_blank" href="http://evemaps.dotlan.net/map/%s/%s">m</a>]</sup>'
								,str_replace(' ','_',$row1['regionName'])
								,str_replace(' ','_',$row1['systemName'])
							);
					}
					
				}
				if($title == 'agent_name' && isset($row1['_agent_id']) ) {
					$htmlspecialchars = false;
					
					$overlib_html = $overlib = '';
					if( !empty($row1['_whomade']) ) {
						$overlib_html = build_table( $row1['_whomade'], null, null, true, null, false );
					}
					if( $overlib_html ) {
						$overlib  = ' onmouseover="return overlib(\'<center>'.esc_js($overlib_html).'</center>\');" ';
						$overlib .= ' onmouseout="return nd();" ';		
					}
				#	print_r2( $row1 );
					
					$data = sprintf('<a target="_blank" %s href="http://www.eveiverse.com/agents/%s">%s</a>',$overlib,(int)$row1['_agent_id'],htmlspecialchars($data));

				}
				
				if( $title == 'regionName' && trim($data)!='' ) {
					$htmlspecialchars = false;
					$data = sprintf('<a target="_blank" href="http://evemaps.dotlan.net/region/%s">%s</a>',str_replace(' ','_',$data),htmlspecialchars($data));
				}
				
				if( $title == 'locate' && trim($data)!='' ) {
					if($data==1) {
						$data='yes';
					} else {
						$data='no';
					}
				}
		if($title == 'charNam' && isset($row1['_charid'])){
				
					$css = $mainName = '';
					
					
					if( isset( $chars_colors[ strtolower($row1['charName']) ] ) ) {	
						if( !empty( $chars_colors[ strtolower($row1['charName']) ] ) ) {
							$css .= 'color:'.$chars_colors[ strtolower($row1['charName']) ];
						}
						$mainName = $main_names[ strtolower($row1['charName']) ];
					}	
				
					if( isset($row1['_chars']) && is_array($row1['_chars']) && count($row1['_chars'])>1 ) {
						
						$data = ''; // '<UL>';
						$char_arr_list = array();
						foreach( $row1['_chars'] as $_char ) {
						
	//////////////////////////"""""""""""""""""""""""""""""########################
						$overlib_html = '<br><b>'.htmlspecialchars($_char['charName']).'</b>';
							
					#if( isset($tmp['kb_kills_30days']) ):
					/*
						if( !isset($_char['_kb_kills_30days']) || (int)@$_char['_kb_kills_30days']==0 ) {
							$overlib_html .= "<i>i'm hopless carebear or just slacker!</i><br>";
						} else {
							$overlib_html .= "<i>i kill stuff too, in last 30 days i'm scored <b style='color:red'>".(int)@$_char['_kb_kills_30days']."</b> kills! !</i><br>";
						}
					*/	
					#endif;
					
						$css = '';
						
						if( isset( $chars_colors[ strtolower($_char['charName']) ] ) ) {	
							$css .= 'color:'.$chars_colors[ strtolower($_char['charName']) ];
						}						
						
                        
                        if(isset($_GET['period']) && !$_GET['from'])
						{$data2 = sprintf('<input type="checkbox" />%s',$_char['charName']);}
                        elseif($_GET['from'])
                        {
                        $data2 = sprintf('<input type="checkbox" />%s',$_char['charName']);
                        }
	//////////////////////////"""""""""""""""""""""""""""""########################
						
						#	$data .= empty( $data ) ? '' : '<br>';
						#	$data .= "<!-- * -->{$data2} \n";
							$char_arr_list[$_char['charName']] = "<!-- * -->{$data2} \n";
						}
                        
                        
                        
						#$data .= '';
						$s_array = array_keys($char_arr_list);
						sort( $s_array , SORT_STRING );
						foreach(  $s_array as $char__ ) {
							if( isset($char_arr_list[$char__]) ) {
								$data .= empty( $data ) ? '' : '<br>';
								$data .= "<!-- * -->".$char_arr_list[$char__]." \n";
							}
						}
						
						#$data = join( $char_arr_list , '<br>' );
						
						$htmlspecialchars = false;
						
					} else {
		
						$overlib_html = '<br><b>'.htmlspecialchars($data).'</b>';
						if( defined('char_port_img_url') && isset($row1['_charid']) ) {
						$overlib_html ='<br><img src='.sprintf(char_port_img_url,$row1['_charid']).'>'.$overlib_html.'<br>';
						}
						
						$tmp = $row1;
			
					#if( isset($tmp['kb_kills_30days']) ):
					
					
#						if( !isset($tmp['kb_kills_30days']) || (int)@$tmp['kb_kills_30days']==0 ) {
#							$overlib_html .= "<i>i'm hopless carebear or just slacker!</i><br>";
#						} else {
#							$overlib_html .= "<i>i kill stuff too, in last 30 days i'm scored <b style='color:red'>".(int)@$tmp['kb_kills_30days']."</b> kills! !</i><br>";
#						}

						if( $mainName ) {
							$overlib_html .= " my main is <b>{$mainName}</b> ";
						}
					#endif;
										
                        
						$data = sprintf('%s',$data);
					}
					
					$htmlspecialchars = false;
					
				}				
				if($title == 'charName' && isset($row1['_charid'])){
				
					$css = $mainName = '';
					
					
					if( isset( $chars_colors[ strtolower($row1['charName']) ] ) ) {	
						if( !empty( $chars_colors[ strtolower($row1['charName']) ] ) ) {
							$css .= 'color:'.$chars_colors[ strtolower($row1['charName']) ];
						}
						$mainName = $main_names[ strtolower($row1['charName']) ];
					}	
				
					if( isset($row1['_chars']) && is_array($row1['_chars']) && count($row1['_chars'])>1 ) {
						
						$data = ''; // '<UL>';
						$char_arr_list = array();
						foreach( $row1['_chars'] as $_char ) {
						
	//////////////////////////"""""""""""""""""""""""""""""########################
						$overlib_html = '<br><b>'.htmlspecialchars($_char['charName']).'</b>';
						if( defined('char_port_img_url') && isset($_char['_charid']) ) {
							$overlib_html ='<br><img src='.sprintf(char_port_img_url,$_char['_charid']).'>'.$overlib_html.'<br>';
						}
							
					#if( isset($tmp['kb_kills_30days']) ):
					/*
						if( !isset($_char['_kb_kills_30days']) || (int)@$_char['_kb_kills_30days']==0 ) {
							$overlib_html .= "<i>i'm hopless carebear or just slacker!</i><br>";
						} else {
							$overlib_html .= "<i>i kill stuff too, in last 30 days i'm scored <b style='color:red'>".(int)@$_char['_kb_kills_30days']."</b> kills! !</i><br>";
						}
					*/	
					#endif;
					
						$css = '';
						
						if( isset( $chars_colors[ strtolower($_char['charName']) ] ) ) {	
							$css .= 'color:'.$chars_colors[ strtolower($_char['charName']) ];
						}						
						
						$overlib = ' onmouseover="return overlib(\'<center>'.esc_js($overlib_html).'</center>\',ABOVE);" ';
						$overlib .= ' onmouseout="return nd();" ';					
                        
                        if(isset($_GET['period']) && !$_GET['from'])
						{$data2 = sprintf('<a %s %s href="%s&period=%s&char=%">%s</a>',$overlib, ( $css ? 'style="'.$css.'"' : '' ) ,$file,$_GET['period'],urlencode($_char['charName']),$_char['charName']);}
                        elseif($_GET['from'])
                        {
                        $data2 = sprintf('<a %s %s href="%s&&char=%">%s</a>',$overlib, ( $css ? 'style="'.$css.'"' : '' ) ,$file,urlencode($_char['charName']),$_char['charName']);
                        }
	//////////////////////////"""""""""""""""""""""""""""""########################
						
						#	$data .= empty( $data ) ? '' : '<br>';
						#	$data .= "<!-- * -->{$data2} \n";
							$char_arr_list[$_char['charName']] = "<!-- * -->{$data2} \n";
						}
                        
                        
                        
						#$data .= '';
						$s_array = array_keys($char_arr_list);
						sort( $s_array , SORT_STRING );
						foreach(  $s_array as $char__ ) {
							if( isset($char_arr_list[$char__]) ) {
								$data .= empty( $data ) ? '' : '<br>';
								$data .= "<!-- * -->".$char_arr_list[$char__]." \n";
							}
						}
						
						#$data = join( $char_arr_list , '<br>' );
						
						$htmlspecialchars = false;
						
					} elseif($row1['_main'] == '1'){
					   
						$overlib_html = '<br><b>'.htmlspecialchars($data).'</b>';
						if( defined('char_port_img_url') && isset($row1['_charid']) ) {
						$overlib_html ='<br><img src='.sprintf(char_port_img_url,$row1['_charid']).'>'.$overlib_html.'<br>';
						}
						
						$tmp = $row1;
			
					#if( isset($tmp['kb_kills_30days']) ):
					
					
#						if( !isset($tmp['kb_kills_30days']) || (int)@$tmp['kb_kills_30days']==0 ) {
#							$overlib_html .= "<i>i'm hopless carebear or just slacker!</i><br>";
#						} else {
#							$overlib_html .= "<i>i kill stuff too, in last 30 days i'm scored <b style='color:red'>".(int)@$tmp['kb_kills_30days']."</b> kills! !</i><br>";
#						}

						if( $mainName ) {
							$overlib_html .= " my main is <b>{$mainName}</b> ";
						}
					#endif;
						
						$overlib = ' onmouseover="return overlib(\'<center>'.esc_js($overlib_html).'</center>\',ABOVE);" ';
						$overlib .= ' onmouseout="return nd();" ';					
                        
						$data = sprintf('<a %s href="#" id="main">%s</a>',$overlib,$data);					   
					}else{
		
						$overlib_html = '<br><b>'.htmlspecialchars($data).'</b>';
						if( defined('char_port_img_url') && isset($row1['_charid']) ) {
						$overlib_html ='<br><img src='.sprintf(char_port_img_url,$row1['_charid']).'>'.$overlib_html.'<br>';
						}
						
						$tmp = $row1;
			
					#if( isset($tmp['kb_kills_30days']) ):
					
					
#						if( !isset($tmp['kb_kills_30days']) || (int)@$tmp['kb_kills_30days']==0 ) {
#							$overlib_html .= "<i>i'm hopless carebear or just slacker!</i><br>";
#						} else {
#							$overlib_html .= "<i>i kill stuff too, in last 30 days i'm scored <b style='color:red'>".(int)@$tmp['kb_kills_30days']."</b> kills! !</i><br>";
#						}

						if( $mainName ) {
							$overlib_html .= " my main is <b>{$mainName}</b> ";
						}
					#endif;
						
						$overlib = ' onmouseover="return overlib(\'<center>'.esc_js($overlib_html).'</center>\',ABOVE);" ';
						$overlib .= ' onmouseout="return nd();" ';					
                        
						$data = sprintf('<a %s %s href="%s&keyid=%s&vcode=%s" onslick="" >%s</a>',$overlib,( $css ? 'style="'.$css.'"' : '' ),$file,$row1['_keyid'],$row1['_vcode'],$data);
					}
					
					$htmlspecialchars = false;
					
				}
				if( $title == 'dif_sys' ) {
					$align = 'right';
				}

				// _ratid
				if( $title == 'ratName' && isset($row1['_ratid']) ) {

					
					$x1 = '<div><b><u>'.htmlspecialchars($data).'</u></b>';
					$x1.= '<br><span>баунти: '.'<b>'.isknf((int)@$row1['ratBouny'],true).' ISK</span></b>' ;
					$x2 = '</div>'; //'<i>no-image</i>';
					if( isset($row1['_ratImgId']) && $row1['_ratImgId'] && defined('rats_img_url') ) {
						$x2 = '<br><img src='.sprintf(rats_img_url,$row1['_ratImgId']).'>';
					}
					
					$ratPopUpHtml = $x1.$x2;
					
				#	$ratPopUpHtml .= '<center>';
			/*		
					$ratPopUpHtml .= '<table><tr><td>';
					
					$ratPopUpHtml .= "</td valign=top>{$x2}<td>";
					$ratPopUpHtml .= '</td><td>';

					$ratPopUpHtml .= "</td>{$x1}<td>";
					$ratPopUpHtml .= '</td></tr></table>';

					if( !empty($row1['_description']) ) {
						$ratPopUpHtml .= '<br>'.htmlspecialchars( str_replace('Threat level:','<br>Threat level:',$row1['_description']) ); 
                        $ratPopUpHtml .= '</div>';
					}else{*/$ratPopUpHtml .= '</div>';
					
				#	$ratPopUpHtml .= '</center>';

					$overlib = ' onmouseover="return overlib(\''.esc_js($ratPopUpHtml).'\',ABOVE);" ';
					$overlib .= ' onmouseout="return nd();" ';
				
					$htmlspecialchars = false;
					// http://eveinfo.com/npcship/13542/eve-online-domination-nephilim.html
				#	$is_officer = in_array($data,$officers);
					$data = sprintf('<a %s %s target="_blank" href="http://eveinfo.com/npcship/%s/eve-online-%s.html">%s</a>', '', $overlib /*($is_officer?'style="color:red;font-weight:bold;"':'')*/ , (int)$row1['_ratid'] , urlencode( str_replace("'",'',str_replace(' ','-',strtolower($data))) ) , htmlspecialchars($data) );
					if( $is_officer ) {
						$data .= ' <i style="color:'.body_font_color_common.';font-weight:normal;">(Officer)</i>';
					}
					
				}	

				if( $title == 'Char_name' || isset($row1['Char_name']) && !$row1['smain'] ) {
					
				#	$ratPopUpHtml .= '<center>';
			/*		
					$ratPopUpHtml .= '<table><tr><td>';
					
					$ratPopUpHtml .= "</td valign=top>{$x2}<td>";
					$ratPopUpHtml .= '</td><td>';

					$ratPopUpHtml .= "</td>{$x1}<td>";
					$ratPopUpHtml .= '</td></tr></table>';

					if( !empty($row1['_description']) ) {
						$ratPopUpHtml .= '<br>'.htmlspecialchars( str_replace('Threat level:','<br>Threat level:',$row1['_description']) ); 
                        $ratPopUpHtml .= '</div>';
					}else{*/$ratPopUpHtml .= '</div>';
					
				#	$ratPopUpHtml .= '</center>';

				$htmlspecialchars = false;
					// http://eveinfo.com/npcship/13542/eve-online-domination-nephilim.html
				#	$is_officer = in_array($data,$officers);
					$data = sprintf('<a target="" href="#" onclick="select_row(this);">%s</a><input type="checkbox" style="display:none;" name="char_n" value="%s" />', $data, $data );
				}

				if(in_array( $title , array('smain'))) {
				$htmlspecialchars = false;
                $add = $data == 'альт' ? '<span class="example" data-dropdown="#dropdown-1">альт</span>
                <input name="main_n" type="hidden" value="1" id="ma" />
                <input id="chardi" name="char_idx" type="hidden" value="'.$row1['_charid'].'" />
                <input type="hidden" name="id_papa" value="'.$row1['_id_main'].'" />
                ':'<span class="example" data-dropdown="#dropdown-2">мейн</span>
                <input name="main_n" type="hidden" value="0" id="ma" />
                <input id="chardi" name="char_idx" type="hidden" value="'.$row1['_charid'].'" />
                <input type="hidden" id="id_papa" name="id_papa" value="'.$row1['_id_main'].'" />
                ';
				$data = $add;
				}
                
				
				if( in_array( $title , array('kb_kills_7days','kb_kills_30days','kb_kills_alltime') ) ) {
					if( is_numeric($data) ) { 
						$align = 'right';
						$data = isknf($data,true);
					} else {
						$htmlspecialchars = false;
						$data = '<a style="color:'.($highlight_this?'red':'black').';" href="#n00b">n00b*</a>';
					}
				}
				
				
				if( in_array( $title , array('level','quality','faction','location','regionName','systemName','truesec','locate') ) && trim($data)=='' ) {
					$htmlspecialchars = false;
					$align = 'center';
					$data = '<i>unknow</i>';
					$data = '<span title="unknow">---</span>';
				}
				
				$print_out .=  "\n<td style='padding-left:5px;padding-right:5px;' align='".$align."'>";
				if( $highlight_this ) { $print_out .=  '<span style="color:red;">'; }
				$print_out .=  ($htmlspecialchars?htmlspecialchars($data):$data);
				if( $highlight_this ) { $print_out .=  '</span>'; }
				$print_out .=  "</td>";
			}
			$print_out .=  "\n</tr>";
			$cnt++;
		}
		$print_out .=  "\n</table>";
	}
	
	if( $print_output ) {
		echo $print_out;
	} else {
		return $print_out;
	}
	
}

function add_zero($nr) {
	if( $nr <= 9 ) {
		return '0'.$nr;
	}
	return $nr;
}

function clear_directory_files_older($directory,$older_sec,$ext='*') {
	$glob = $directory."*.{$ext}";
	$removed = 0;
	
	$array = glob( $glob );
	foreach( $array as $file ) {
		$filemtime = filemtime($file);
		if( $filemtime < ( time()-$older_sec ) ) {
	//		print "\n<br>OLD => ".( $file ); 	print "<br>".date('r',$filemtime);
			@unlink( $file );
			$removed++;
		} else {
	//		print "\n<br>NEW => ".( $file );
		}
	}
	
	return $removed;
//	print_r2( $array );
}

function rusDate($date=false,$format=3) {
    if(!$date) {
        $date = date('m-Y');
    }
    $tmp = explode('-',$date);
    $month = (int)$tmp[0];
    $year = (int)$tmp[1];
    $months = array('','Января','Февраля','Марта','Апреля','Мая','Июня','Июля','Августа','Сентября','Октября','Ноября','Декабря');
    $months_s = array('','Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь');
      if($format==1) {
        return "&nbsp;".$months_s[$month].'&nbsp;'.$year.'&nbsp;г.';
    } elseif ($format==2) {
        return "&nbsp;".$months_s[$month];
    } elseif ($format==3) {
        return $months_s[$month].' '.$year.' г.';
    }
}

function minus_nal($nalog)
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

function log_in($login,$pass)
{
    $sql = 'SELECT * FROM `eve_online_pilotki` a WHERE 1 AND a.`pilot_name` = "'.$login.'" AND a.`pass`="'.$pass.'" LIMIT 1';
    $execute = fetch_all($sql);
    if(count($execute)>0)
    {
        return true;
    }else{
        return false;
    }
}

function get_id($login,$pass)
{
    $sql = 'SELECT `id`,`pers_word` FROM `eve_online_pilotki` a WHERE 1 AND a.`pilot_name` = "'.$login.'" AND a.`pass`="'.$pass.'" LIMIT 1';
    $execute = fetch_all($sql);
    if(count($execute)>0){
    foreach($execute as $key)
    {
        return $key['id'].':'.$key['pers_word'];   
    }
    }else
    return -1;    
}

function check_in($name, $email)
{
    $sql = 'SELECT * FROM `eve_online_pilotki` a WHERE 1 AND a.`pilot_name` = "'.$name.'" AND a.`email` = "'.$email.'"';
    $execute = fetch_one($sql);
    if(count($execute)>0)
    {
        return false;
    }else{
        return true;
    }
}

function array_pw($id)
{
    $sql = 'SELECT p.`pers_word` FROM `eve_online_pilotki` p WHERE 1 AND p.`id` = '.$id;
    $fetch = fetch_all($sql);
    return $fetch;
}

