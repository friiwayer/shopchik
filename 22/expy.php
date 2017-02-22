<?
$filename = 'time.txt';
$file = file_get_contents($filename);
$ar = explode('*',$file);

for($a=0;$a<=count($ar)-1;$a++){
    $systems[$a] = explode(':',$ar[$a]);
}

if($_POST['refresh'])$swop = explode(':',$_POST['refresh']);
$_SESSION['systema'] = $swop;

if(isset($swop[0]) && !empty($swop[0]))
{    
    switch ($swop[0]){ 
	case 'add':if(!in_array_r($swop[1],$systems)){add_system($systems,$swop[1]);}
	break;

	case 'del':del_system($systems,$swop[1]);
	break;

	case 'up':update($systems,$swop[1]);
	break;
    
    default:return false;
}
}

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}

function del_system($systems,$systema)
{
    for($z=0;$z<=count($systems);$z++)
    {
        if($systems[$z][4]==$systema)
        {
            unset($systems[$z]);
        }
        construct($systems);
    }
}

function update($systems,$systema)
{
$gmt = 3600*-0;
$cur_h = gmdate("H", time() + $gmt);
$cur_m = gmdate("i", time() + $gmt);
$cur_d = gmdate("d", time() + $gmt)+1;
$cur_s = gmdate("s", time() + $gmt);
    
    for($z=0;$z<=count($systems)-1;$z++)
    {
        if($systems[$z][4]==$systema)
        {
            $systems[$z][0] = $cur_d;
            $systems[$z][1] = $cur_h;
            $systems[$z][2] = $cur_m;
            $systems[$z][3] = $cur_s; 
        }
        construct($systems);
    }
}

function add_system($systems,$systema)
{
            $gmt = 3600*-0;
            $cur_h = gmdate("H", time() + $gmt);
            $cur_m = gmdate("i", time() + $gmt);
            $cur_d = gmdate("d", time() + $gmt);
            $cur_s = gmdate("s", time() + $gmt);
            $aray = array($cur_d,$cur_h,$cur_m,$cur_s,$systema);
            
            @array_push($systems[count($systems)-1] = $aray);
            //unset($systems[count($systems)]);
            construct($systems);
}

function construct($systems)
{   $fname='time.txt';
    for($z=0;$z<=count($systems)-1;$z++)
    {   
        if($systems[$z][0] != '')
        {$to_file .= $systems[$z][0].":".$systems[$z][1].":".$systems[$z][2].":".$systems[$z][3].":".$systems[$z][4]."*";}
    }
    $stroka = $to_file;
    
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

function bull($count)
{
    if($count <= 1){echo +1;}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Обратный отсчет</title>
<style style="text/css">
body 
{
	background:#001320 repeat-x;
	color:#444;
	font-family:"Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
}
#top_header
{
	width:750px;
	margin:0 auto;
	height:300px;
}
#central_header
{
	width:660px;
	margin:150px auto;
	min-height:450px;
	text-align:center;
    padding:10px;
    border-radius:8px;
    position:relative;
}
.count_down
{
    font: bold 52pt Verdana;
    font-weight: bold;
    color:#fff;
    text-align: center;
}

.count_down sup
{
	font-family:"Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#555;
	font-weight:normal;
}

.input_bg {
    background: white;
    color: #6F6F6F;
    border: solid 1px #79B7E7;
    width:510px;
    padding:5px 10px;
    height:28px;
}

#update_success{
	padding:6px;
	background:#CEECB8;
	margin:0 auto;
	margin-top:20px;
	width:300px;
	display:none;
}

</style>
<link rel="Stylesheet" type="text/css" href="style/dark.css"></link>
<link rel="stylesheet" type="text/css" href="style/jquery.countdown.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("form#ajax_form").submit(function() {
 
	var input_leave_sabj = $('#input_leave_sabj').attr('value');
		$.ajax({
			type: "POST",
			url: "",
			data:({ "refresh":input_leave_sabj}),
			success: function(){
				$("#ajax_form").fadeOut();
				$("#update_success").fadeIn();
			}
		});
	return false;
	});
});
</script>
<script src="js/jquery.countdown.js" type="text/javascript"></script>
</head>

<body>
<div id="central_header">
<h1>Напоминалка ...!!!</h1><br />
<div id="count_down_container"></div>
<script type="text/javascript">
    $(function(){
       $('#count_down_container').after('<? for($o=0;$o<=count($systems)-2;$o++) {echo '<div class="sysa">До закрытия 10/10 в <span style="color:yellow;">'.strtoupper($systems[$o][4]).'</span></div><div class="xyu_'.$o.'" id="glowingLayout"></div><br/>';} ?>');
    });
</script>
<div id="leave_email">
<form id="ajax_form" method="GET">
<input id="input_leave_sabj" type="text" class="input_bg" name="refresh" value=""/>
<input type="submit" class="input_button" />
</form>
</div>
<div id="update_success">Обновил!..не дай бог хоть 1 прокакал</div>
</div>
<footer>
made in China@
</footer>
</body>
<script type="text/javascript">

    $(function(){
       <? for($o=0;$o<=count($systems)-2;$o++){
        $cur_month = date(m)-1;
        echo '$(".xyu_'.$o.'").countdown({until:new Date('.date(Y).', '.$cur_month.', '.$systems[$o][0].', '.$systems[$o][1].', '.$systems[$o][2].'), compact: true,
        layout: 
        "<span class=image{h10} style=clear:both;></span><span class=image{h1}></span>" + 
        "<span class=imageSep></span>" + 
        "<span class=image{m10}></span><span class=image{m1}></span>" + 
        "<span class=imageSep></span>" + 
        "<span class=image{s10}></span><span class=image{s1}></span>"});
        ';
       } ?>
    });
</script>
</html>
