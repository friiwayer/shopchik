<?
require_once 'inx.php';
$filename = 'time.txt';
$file = file_get_contents($filename);
$ar = explode('*',$file);

for($a=0;$a<=count($ar)-1;$a++){
    $systems[$a] = explode(':',$ar[$a]);
}

if($_POST['refresh']){$swop = explode(':',$_POST['refresh']);}
$_SESSION['systema'] = $swop;

$result = 'false';
if(isset($_COOKIE['sifrr']) || isset($_POST['sifrr']))
{
$result = cookie_chek($pass);
if($result == 'true'){
if(isset($swop[0]) && !empty($swop[0]))
{
    switch ($swop[0]){ 
	case 'add':if(!in_array_r($swop[1],$systems)){add_system($systems,$swop[1]);}
	break;

	case 'dell':del_system($systems,$swop[1]);
	break;

	case 'up':update($systems,$swop[1]);
    break;
    
    case 'pass':change_pass($swop[1]);
	break;
    
    default:return false;
}
}
}}

function change_pass($newpass){
    $file = 'codw.txt';
    if($pass = file_get_contents($file))
    {
    
    if (is_writable($file)) {
    if (!$handle = fopen($file, 'w')) {
         echo "Не могу открыть файл ($fname)";
         exit;
    }
    if (fwrite($handle, $newpass) === FALSE) {
        echo "Не могу произвести запись в файл ($fname)";
        exit;
    }
    }
    }
    setcookie('sifrr', '', time()-3600);
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
<title>Смс напоминатель v2.1</title>
<style style="text/css">

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
#leave_email{
	padding-top:13px;
	text-align:center;
	
}
#ajax_form{
    border-top:1px solid #616161;
    padding-top:15px;    
}
.input_bg {
    background:#444;
    color: #fff;
    border: solid 1px #333333;
    width:485px;
    padding:5px 10px;
    height:28px;
    font-size:12px;
    font-weight:normal;
    border:1px solid #666;
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
<link rel="Stylesheet" type="text/css" href="style/dark.css"/>
<link rel="Stylesheet" type="text/css" href="style/keyboard.css"/>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("form#ajax_form").submit(function() {
 
	var input_leave_sabj = $('#input_leave_sabj').val();
		$.ajax({
			type: "POST",
			url: "",
			data:({"refresh":input_leave_sabj}),
			success: function(d){
				$("#ajax_form").fadeOut();
				$("#update_success").fadeIn();
                location.reload();
			}
		});
        return false;
	});
    $('.keyboardInputInitiator').click(function(){
var myInput = document.getElementById('keyboardInput');
if (!myInput.VKI_attached) VKI_attach(myInput);
    });
});
</script>
<script type="text/javascript" src="js/keyboard.js"></script>
<script type="text/javascript">
function createInput() {
  var div = document.getElementById('attachSandbox');
  while (div.firstChild) div.removeChild(div.firstChild);
  var input = document.createElement('input');
      input.type = "text";
  div.appendChild(input);
}


function applyKeyboard() {
  var div = document.getElementById('attachSandbox');
  var input = div.getElementsByTagName('input');
  if (input.length) {
    VKI_attach(input[0]);
  } else alert('Create the input first!');
}
</script>
<script type="text/javascript" src="js/jquery.dropdown.js"></script>
<link type="text/css" rel="stylesheet" href="style/jquery.dropdown.css" />
</head>

<body>
<div class="wrapper">
<div id="header"></div>
<div id="central_header">
<h1></h1><br />
<div id="count_down_container"></div>
<script type="text/javascript">
    $(function(){
       $('#count_down_container').after('<? echo '<table cellspacing=1>'; for($o=0;$o<=count($systems)-1;$o++) {echo '<tr class="xyu" id="countdown-example'.$o.'"></tr>';} ?>');
       $('#hid').prepend('<? for($o=0;$o<=count($systems)-1;$o++) {echo '<span class="example" data-dropdown="#dropdown-'.$o.'"> '.strtoupper($systems[$o][4]).' </span><div id="dropdown-'.$o.'" class="dropdown dropdown-tip" style="display: none; left: 1044px; top: 495px;"><ul class="dropdown-menu"><li><a href="#1">up:'.$systems[$o][4].'</a></li><li><a href="#0">dell:'.$systems[$o][4].'</a></li></ul></div>';} ?>');
    });
</script>
<script src="js/countdow.js" type="text/javascript"></script>
<div id="leave_email">
<form id="ajax_form" method="post">
<input id="input_leave_sabj" type="text" class="input_bg keyboardInput" name="refresh" value="" aria-haspopup="true" x-webkit-speech />
<input type="submit" class="input_button" value="" />
</form>
</div>
<div id="update_success">Обновил!..не дай бог хоть 1 прокакал</div>
</div>
<div id="bot"></div>
</div>
<div id="fon_braker"></div>
</body>
<script type="text/javascript">
    $(function(){
       <?
       $count= count($systems);
       for($o=0;$o<=count($systems)-2;$o++){
        $cur_month = date(m)-1;
        echo '$("#countdown-example'.$o.'").countdown(new Date('.date(Y).', '.$cur_month.', '.$systems[$o][0].', '.$systems[$o][1].', '.$systems[$o][2].', '.$systems[$o][3].'), {prefix:"<td width=130><span style=color:#c3c3c3;>10/10 Drone Hive -</span></td><td width=80><span style=color:#15e71f;font-weight:bold;padding-left:10px;>'.strtoupper($systems[$o][4]).'</span></td> : <td width=320>", finish: "Обнови 10/10 или просрал в <span style=color:red;>'.strtoupper($systems[$o][4]).'</span></td>"});';
       }
       ?>
    });
</script>
<script>
$(function(){
   var bool = <? echo $result; ?>;
   $('.xyu:odd').css('background','#343333');
   $('.xyu:even').css('background','#444444');
   $('#input_leave_sabj').bind('click',function(){
    if(bool!=false || $(this).val() != ''){$(this).removeAttribute('disabled');}else{
        $('#input_leave_sab').attr('disabled');
        $('body').prepend('<form id="ajax_form1" method="post" class="show"><input id="sec_code" type="password" class="input_b" name="sifrr" value=""/><input type="submit" class="innner" name="send" value="войти"></form>');
        $('#sec_code').focus();
        $('#fon_braker').attr('id','fon_brakerp');
    }
   });
});
</script>
<script>
$(function(){
    $('div#fon_braker').click(function(){
    $(this).attr('id','fon_braker');
    $('#ajax_form1').remove();
   });
});
</script>
<script type="text/javascript">
$(document).ready(function($) {
   var fop;
   $('#input_leave_sabj').bind('change',function(){
   fop = '';
   var sys = $('.gopp'); 
   latin(fop);
   });
   $(window).load(function() {
   $('a.gopp').click(function(){
   $('#input_leave_sabj').val(fop + $(this).html()).focus();
   return false;
   });
   
   ////ojlkjkj
   //kjhkjhjh
});
   
   function latin(com)
   {
    var ret;
    var aray = com.split(' ');
    var sysa = aray[1]-1;
   if($.isArray(aray))
   {switch(aray[0]){
        case("обновить"):$('#input_leave_sabj').val("up:"+$('.gopp:eq('+sysa+')').html()); $('#ajax_form').submit(); location.reload();
        break;
        case("удалить"):$('#input_leave_sabj').val("dell:"+$('.gopp:eq('+sysa+')').html()); $('#ajax_form').submit(); location.reload();
        break;
        case("добавить"):$('#input_leave_sabj').val("add:");
        break;                        
    }}else{
        switch(com){
        case("добавить"):$('#input_leave_sabj').val("add:");
        break;
    }
    }
   }
   $('.dropdown-menu li a').click(function(){
   $('#input_leave_sabj').val($(this).html());
   $('#ajax_form').submit();
   });
});
</script>

<div id="hid">
</div>
<footer>
<p>Made in China@</p>
</footer>
</html>
