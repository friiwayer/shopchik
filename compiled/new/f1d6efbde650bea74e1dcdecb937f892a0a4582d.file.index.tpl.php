<?php /* Smarty version Smarty-3.0.7, created on 2017-02-21 02:59:48
         compiled from "D:\OpenServer\domains\shopchik//design/new/html\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:495658ab9f14049dd5-89871919%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f1d6efbde650bea74e1dcdecb937f892a0a4582d' => 
    array (
      0 => 'D:\\OpenServer\\domains\\shopchik//design/new/html\\index.tpl',
      1 => 1390994728,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '495658ab9f14049dd5-89871919',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'D:\OpenServer\domains\shopchik\Smarty\libs\plugins\modifier.escape.php';
if (!is_callable('smarty_function_math')) include 'D:\OpenServer\domains\shopchik\Smarty\libs\plugins\function.math.php';
?><!DOCTYPE html>
<html>
<head>
	<base href="<?php echo $_smarty_tpl->getVariable('config')->value->root_url;?>
/"/>
	<title><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('meta_title')->value);?>
</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('meta_description')->value);?>
" />
	<meta name="keywords"    content="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('meta_keywords')->value);?>
" />
	<meta name="viewport" content="width=1024"/>
    <?php if ($_smarty_tpl->getVariable('page')->value&&$_smarty_tpl->getVariable('page')->value->url==''){?>
    <link href="design/<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('settings')->value->theme);?>
/css/stylem.css" rel="stylesheet" type="text/css" media="screen"/>
    <?php }elseif($_smarty_tpl->getVariable('compare')->value->total){?>
    <link href="design/<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('settings')->value->theme);?>
/css/stylem.css" rel="stylesheet" type="text/css" media="screen"/>
    <?php }elseif(!$_smarty_tpl->getVariable('product')->value->name){?>
    <link href="design/<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('settings')->value->theme);?>
/css/style.css" rel="stylesheet" type="text/css" media="screen"/>
    <?php }else{ ?>
    <link href="design/<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('settings')->value->theme);?>
/css/style.css" rel="stylesheet" type="text/css" media="screen"/>
    <?php }?>
   
    <?php if ($_smarty_tpl->getVariable('page')->value->url=='blog'||$_smarty_tpl->getVariable('page')->value->url=='contact'||$_smarty_tpl->getVariable('page')->value->url=='staty'||$_smarty_tpl->getVariable('page')->value->url=='dostavka'||$_smarty_tpl->getVariable('page')->value->url=='oplata'||$_smarty_tpl->getVariable('page')->value->url=='garantii-i-vozvrat'){?>
    <style>
    #content{
        width:auto;
        float:none;
    }
    </style>
    <?php }?>
    
	<link href="design/<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('settings')->value->theme);?>
/images/favicon.ico" rel="icon"          type="image/x-icon"/>
	<link href="design/<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('settings')->value->theme);?>
/images/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
    <link href="design/<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('settings')->value->theme);?>
/css/default.css" rel="stylesheet" type="text/css" media="screen"/>
    
	<script src="js/jquery/jquery.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
	<?php if ($_SESSION['admin']=='admin'){?>
	<script src ="js/admintooltip/admintooltip.js" type="text/javascript"></script>
	<link   href="js/admintooltip/css/admintooltip.css" rel="stylesheet" type="text/css" /> 
	<?php }?>
	<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" href="js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
	
    <script type="text/javascript" src="js/ctrlnavigate.js"></script>           

	<script src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/jquery-ui.min.js"></script>
	<script src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/ajax_cart.js"></script>
    <script type="text/javascript" src="design/new/js/cnt_filter.js"></script>
	<script src="/js/baloon/js/baloon.js" type="text/javascript"></script>
	<link   href="/js/baloon/css/baloon.css" rel="stylesheet" type="text/css" /> 
    <script src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/ajax_compare.js"></script>    
	
	<script src="js/autocomplete/jquery.autocomplete-min.js" type="text/javascript"></script>
	<style>
	.autocomplete-w1 { position:absolute; top:0px; left:0px; margin:6px 0 0 6px; /* IE6 fix: */ _background:none; _margin:1px 0 0 0; }
	.autocomplete { border:1px solid #999; background:#FFF; cursor:default; text-align:left; overflow-x:auto;  overflow-y: auto; margin:-6px 6px 6px -6px; /* IE6 specific: */ _height:350px;  _margin:0; _overflow-x:hidden; }
	.autocomplete .selected { background:#F0F0F0; }
	.autocomplete div { padding:2px 5px; white-space:nowrap; }
	.autocomplete strong { font-weight:normal; color:#3399FF; }
	</style>  	
	<script>
	$(function() {
		$(".input_search").autocomplete({
			serviceUrl:'ajax/search_products.php',
			minChars:1,
			noCache: false, 
			onSelect:
				function(value, data){
					 $(".input_search").closest('form').submit();
				},
			fnFormatResult:
				function(value, data, currentValue){
					var reEscape = new RegExp('(\\' + ['/', '.', '*', '+', '?', '|', '(', ')', '[', ']', '{', '}', '\\'].join('|\\') + ')', 'g');
					var pattern = '(' + currentValue.replace(reEscape, '\\$1') + ')';
	  				return (data.image?"<img align=absmiddle src='"+data.image+"'> ":'') + value.replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>');
				}
		});
        $('#tog').toggle(function(){
            
        },function(){
            return false;
        });
        $('#top_left #blog_menu ul li a').hover(function(){
        $(this).children('div').addClass('filtr_hover');
        },function(){
        $(this).children('div').removeClass('filtr_hover');            
        });
        $('.xop a').click(function(){
        bef_send_form($(this));
        sent();
        });
	});
	</script>
	

    <?php if ($_smarty_tpl->getVariable('product')->value->name){?>
    
    <script>
    $(function(){
       $('div#content').css({'width':'auto','float':'none'}); 
       $('div#left').css({'width':'auto','float':'none'});
       $('div#mleft').css({'width':'auto'});
    });
    </script>
    
    <?php }?>

	
    <script>
    $(document).ready(function(){
        $('#account a:first').css({'border-right':'1px dashed #898989','padding-right':'8px'});
                        
    });
    </script>
    
    
    <script>
        $(function(){
        $('div #cook:not(:first)').hide();
        $('.close:not(:first)').css({'background-image':'url(design/new/images/filter-arrow-expanded-orange.png)'});
        
        /*var num = '/blockhide_/';
        $('#cook').each(function(){
        if($.cookie("blockhide")){
        if($.cookie("blockhide_"+$(this).attr('class').split('_')[1]) == "hide"){
          $('.me_' + $.cookie("blockhide_"+$(this).attr('class')).split('_')[1]).hide();
        }	else {
          $('.me_' + $.cookie("blockhide_"+$(this).attr('class')).split('_')[1]).show();       
        }
        }            
        });*/    
                
        $('h2 #tog').click(function(){
           //$.cookie("blockhide_"+$(this).attr('class'), "hide_"+$(this).attr('class'));
           if($('.me_'+ $(this).attr('class')).css('display') == 'none')
           {
           $('.me_'+ $(this).attr('class')).show(500);
           $(this).parent('h2').css({'background-image':'url(design/new/images/filter-arrow-collapsed.png)'});
           }
           else
           {
           //$.cookie("blockhide_"+$(this).attr('class'), "show_"+$(this).attr('class'));
           $('.me_'+ $(this).attr('class')).hide(500);
           $(this).parent('h2').css({'background-image':'url(design/new/images/filter-arrow-expanded-orange.png)'});              
           }        
        });           
    });
    </script>
    
<!--[if lte IE 7]>
        <link rel="stylesheet" type="text/css" href="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/css/ie.css" media="screen" />
<![endif]-->
<script type="text/javascript" src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/jquery.jcarousel.js"></script>

<script type="text/javascript">
jQuery(document).ready(function() {
        function mycarousel_initCallback(carousel)
    {
        // Disable autoscrolling if the user clicks the prev or next button.
        carousel.buttonNext.bind('click', function() {
            carousel.startAuto(0);
        });
    
        carousel.buttonPrev.bind('click', function() {
            carousel.startAuto(0);
        });
    
        // Pause autoscrolling if the user moves with the cursor over the clip.
        carousel.clip.hover(function() {
            carousel.stopAuto();
        }, function() {
            carousel.startAuto();
        });
    };
    
	jQuery('.d-carousel .carousel').jcarousel({
        auto: 6,
        wrap: 'last',
        initCallback: mycarousel_initCallback
    });
});
</script>

<link rel="stylesheet" type="text/css" href="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/css/jquery-ui.css" />
<script src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/jquery-nomen.js" type="text/javascript"></script>
<script type="text/javascript" src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/jquery.ui.core.js"></script>
<script type="text/javascript" src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/jquery.ui.mouse.js"></script>
<script type="text/javascript" src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/jquery.ui.slider.js"></script>
<script type="text/javascript" src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/cookies.js"></script>
<script type="text/javascript" src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/jquery.dropdownPlain.js"></script>
<script src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/dropdown.js"></script>
<script src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/jquery.tinyTips.js"></script>

<script>
	$(document).ready(function(){
    
    $("#slider").slider({
	min: 2000,
	max: 30000,
	values: [$('#cena_ot').val(),$('#cena_do').val()],
	range: true,
	stop: function(event, ui) {
		$("#cena_ot").val($("#slider").slider("values",0));
		$("#cena_do").val($("#slider").slider("values",1));
	sent();	
    },
    slide: function(event, ui){
		$("#cena_ot").val($("#slider").slider("values",0));
		$("#cena_do").val($("#slider").slider("values",1));
    }
    });

$("#cena_ot").change(function(){

	var value1=$("#cena_ot").val();
	var value2=$("#cena_do").val();

    if(parseInt(value1) > parseInt(value2)){
		value1 = value2;
		$("#cena_ot").val(value1);
	}
	$("#slider").slider("values",0,value1);    
    sent();
});

/*$('.oname').click(function(){
    bef_snd_a($(this));
    return false;
});*/
	
$("#cena_do").change(function(){
		
	var value1 = $("#cena_ot").val();
	var value2 = $("#cena_do").val();
	


	if(parseInt(value1) > parseInt(value2)){
		value2 = value1 + 500;
		$("#cena_do").val(value2);
	}
	$("#slider").slider("values",1,value2);
    sent();  
});

		$('li.headlink').hover(
		function() { $('ul', this).css('display', 'block'); },
		function() { $('ul', this).css('display', 'none');
});
});
</script>



<script type="text/javascript">
	$(document).ready(function () {
		$('#dropdown').hover(
			function () {
				//change the background of parent menu				
				$('#dropdown li a.parent').addClass('hover');
				
				//display the submenu
				$('#dropdown ul.children').show();
			},
			function () {
				//change the background of parent menu
				$('#dropdown li a.parent').removeClass('hover');			

				//display the submenu
				$('#dropdown ul.children').hide();
			}
		);
        $('#blog_menu:first').css('background-image','none');
        $('.yuo').tinyTips('blue', 'title');	
	});
</script>
<style>
    li.headlink ul { display: none; }
    li.headlink:hover ul { display: block; }
</style>

<script src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/upTT.js"></script>
<link rel="stylesheet" type="text/css" href="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/css/tinyTips.css" media="screen" />
<script type="text/javascript" src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/smartmodel.js"></script>
</head>
<body>
<div class="menu_t">
		<ul id="menu">
			<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
?>
				<?php if ($_smarty_tpl->getVariable('p')->value->menu_id==1){?>
				<li <?php if ($_smarty_tpl->getVariable('page')->value&&$_smarty_tpl->getVariable('page')->value->id==$_smarty_tpl->getVariable('p')->value->id){?>class="selected"<?php }?>>
					<a data-page="<?php echo $_smarty_tpl->getVariable('p')->value->id;?>
" href="<?php echo $_smarty_tpl->getVariable('p')->value->url;?>
"><h2><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('p')->value->name);?>
</h2></a>
				</li>
				<?php }?>
			<?php }} ?>                    
		</ul>               
</div>        
<div id="fon_b">
<div class="foterr">
	<div id="top_background">    
	<div id="top">
	    <div id="logo">
		<a href="/"><img src="design/<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('settings')->value->theme);?>
/images/logo.png" title="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('settings')->value->site_name);?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('settings')->value->site_name);?>
"/></a>
		</div>
        <span class="sabj">Лучшая Электроника из Китая.</span>
    <noindex>
			<div id="search">
				<form action="products">
					<input class="input_search" type="text" name="keyword" value="<?php echo $_smarty_tpl->getVariable('keyword')->value;?>
" placeholder="найти товар"/>
					<input class="button_search" value="" type="submit" />
				</form>
			</div>
   </noindex>        
            <div id="compare_informer" >
            <noindex>
            <?php if ($_smarty_tpl->getVariable('compare_informer')->value->total>0){?>
            в <a target="_blank" href="/compare/">сравнении</a> <?php echo $_smarty_tpl->getVariable('compare_informer')->value->total;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->getVariable('compare_informer')->value->total,'товар','товаров','товара');?>

            <?php }else{ ?>
            Товары для сравнения
            <?php }?>
            </noindex>
            </div>
                    
		<div id="account">
			<?php if ($_smarty_tpl->getVariable('user')->value){?>
				<span id="username">
					<a href="user"><?php echo $_smarty_tpl->getVariable('user')->value->name;?>
</a><?php if ($_smarty_tpl->getVariable('group')->value->discount>0){?>,
					ваша скидка &mdash; <?php echo $_smarty_tpl->getVariable('group')->value->discount;?>
%<?php }?>
				</span>
				<a id="logout" href="user/logout">выйти</a>
			<?php }else{ ?>
            <noindex>
				<a id="register" rel="nofollow" href="user/register">Регистрация</a>
				<a id="login" rel="nofollow" href="user/login">Вход</a>
            </noindex>
			<?php }?>
		</div>
		<div id="cart_informer">
        
			<?php $_template = new Smarty_Internal_Template('cart_informer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
            
		</div>                                   
    		<div id="contact">
            <?php if ($_smarty_tpl->getVariable('page')->value&&$_smarty_tpl->getVariable('page')->value->url==''){?>
            <p style="margin:0; font-size:11px; padding-top:25px;">заказ по телефону.</p>
			тел. 8(904) <span id="phone">366-26-55</span>
            <?php }else{ ?>
			<?php if (count($_smarty_tpl->getVariable('currencies')->value)>1){?>
			<div id="currencies">
				<h2></h2>
				<ul>
					<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('currencies')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
?>
					<?php if ($_smarty_tpl->getVariable('c')->value->enabled){?>
					<li class="<?php if ($_smarty_tpl->getVariable('c')->value->id==$_smarty_tpl->getVariable('currency')->value->id){?>selected<?php }?>"><noindex><a rel="nofollow" href='<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('currency_id'=>$_smarty_tpl->getVariable('c')->value->id),$_smarty_tpl);?>
'><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('c')->value->name);?>
</a></noindex></li>
					<?php }?>
					<?php }} ?>
				</ul>
			</div>
            <p style="margin:0; font-size:11px; padding-top:0px;">заказ по телефону.</p>
			<p>тел. 8(904) <span id="phone">366-26-55</span></p> 
			<?php }?>
            <?php }?>
		</div>
	</div>
	</div>
	<div id="main">
    <div class="topm">
 <?php $_template = new Smarty_Internal_Template('menu.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
   </div>
   <?php if ($_smarty_tpl->getVariable('page')->value&&$_smarty_tpl->getVariable('page')->value->url==''){?><?php }else{ ?><script src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/slidemenu.js"></script><?php }?>
   <div class="clear" style="height:15px;"></div>
    <?php if ($_smarty_tpl->getVariable('page')->value&&$_smarty_tpl->getVariable('page')->value->url==''){?>
    <?php }else{ ?>

    <div id="path">
    	<a href="./">Главная</a>
    	<?php  $_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('category')->value->path; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cat']->key => $_smarty_tpl->tpl_vars['cat']->value){
?>
    	→ <a href="catalog/<?php echo $_smarty_tpl->getVariable('cat')->value->url;?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('cat')->value->name);?>
</a>
    	<?php }} ?>
    	<?php if ($_smarty_tpl->getVariable('brand')->value){?>
    	→ <a href="catalog/<?php echo $_smarty_tpl->getVariable('cat')->value->url;?>
/<?php echo $_smarty_tpl->getVariable('brand')->value->url;?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('brand')->value->name);?>
</a>
    	<?php }?>
    	→  <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name);?>
                
    </div>

    <?php }?>
    
		<div id="content">
        <div class="up" style="position:absolute; bottom:0; right:0;"></div>
        <?php if ($_smarty_tpl->getVariable('page')->value&&$_smarty_tpl->getVariable('section')->value->url==$_smarty_tpl->getVariable('this')->value->settings->main_section||$_smarty_tpl->getVariable('compare')->value->total){?>
		<?php echo $_smarty_tpl->getVariable('content')->value;?>

		</div>

        <?php }elseif($_smarty_tpl->getVariable('product')->value->id||$_smarty_tpl->getVariable('keyword')->value&&!$_smarty_tpl->getVariable('product')->value->name){?>
        <?php echo $_smarty_tpl->getVariable('content')->value;?>

        </div>
        <div id="mleft">
		<div id="left" style="border:1px solid #e3e0d9;">
			<?php if ($_smarty_tpl->getVariable('features')->value){?>
            <div id="blog_menu">           
				<h2 style="border-width:0px;">Цена: </h2>
                <div class="xop">
                <noindex>
                <a ot="0" do="7000" rel="nofollow">до 7 000</a><br />
                <a ot="6000" do="14000" rel="nofollow">от 6 000 до 14 000</a><br />
                <a ot="15000" do="25000" rel="nofollow">от 15 000 до 25 000</a><br />
                <a ot="0" do="25000" rel="nofollow">до...25 000</a><br />
                </noindex>
                </div>
                <div id="slider"></div>
                <div class="">
                <form name="price" action="<?php echo $_SERVER['REQUEST_URI'];?>
" class="" style="margin-top:13px;">
                <input type="hidden" name="id_" value="<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" />
                <input id="cena_ot" name="cena_from" <?php if ($_smarty_tpl->getVariable('cena_from')->value&&$_smarty_tpl->getVariable('cena_from')->value>0){?>value="<?php echo $_smarty_tpl->getVariable('cena_from')->value;?>
"<?php }else{ ?>value="3927"<?php }?>  alt="filtr" style="width:55px;" />
                <input id="cena_do" name="cena_to" <?php if ($_smarty_tpl->getVariable('cena_to')->value&&$_smarty_tpl->getVariable('cena_to')->value>0){?>value="<?php echo $_smarty_tpl->getVariable('cena_to')->value;?>
"<?php }else{ ?>value="28046"<?php }?> alt="filtr" style="width:55px;" />
                <input type="submit" name="send" class="butte" value="показать" />
                </form></div>
			</div>
            <?php }?>
            
                <?php if ($_smarty_tpl->getVariable('category')->value->brands){?>
                <div id="blog_menu">
                <h2 style="">Бренды: </h2>
                <div id="brands">
                	<a rel="nofollow" href="catalog/<?php echo $_smarty_tpl->getVariable('category')->value->url;?>
" <?php if (!$_smarty_tpl->getVariable('brand')->value->id){?>class="selected"<?php }?> style="padding-left:;">все</a>
                	<?php  $_smarty_tpl->tpl_vars['b'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('category')->value->brands; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['b']->key => $_smarty_tpl->tpl_vars['b']->value){
?>
                		<?php if ($_smarty_tpl->getVariable('b')->value->image){?>
                		<a data-brand="<?php echo $_smarty_tpl->getVariable('b')->value->id;?>
" rel="nofollow" href="catalog/<?php echo $_smarty_tpl->getVariable('category')->value->url;?>
/<?php echo $_smarty_tpl->getVariable('b')->value->url;?>
"><img src="<?php echo $_smarty_tpl->getVariable('config')->value->brands_images_dir;?>
<?php echo $_smarty_tpl->getVariable('b')->value->image;?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('b')->value->name);?>
"></a>
                		<?php }else{ ?>
                		<a data-brand="<?php echo $_smarty_tpl->getVariable('b')->value->id;?>
" rel="nofollow" href="catalog/<?php echo $_smarty_tpl->getVariable('category')->value->url;?>
/<?php echo $_smarty_tpl->getVariable('b')->value->url;?>
" <?php if ($_smarty_tpl->getVariable('b')->value->id==$_smarty_tpl->getVariable('brand')->value->id){?>class="selected"<?php }?>><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('b')->value->name);?>
</a>
                		<?php }?>
                	<?php }} ?>
                </div>
                </form>
			    </div>
                <?php }?>
            
            <?php if ($_smarty_tpl->getVariable('features')->value){?>
            <?php  $_smarty_tpl->tpl_vars['ro'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('features')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['ro']->key => $_smarty_tpl->tpl_vars['ro']->value){
?>
            <div id="blog_menu">
            <h2 style="padding-top:5px;"><a href="#" id="tog" onclick="return false;"><?php echo $_smarty_tpl->getVariable('ro')->value->name;?>
</a>
            <a rel="nofollow" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('params'=>array($_smarty_tpl->getVariable('ro')->value->id=>null,'page'=>null)),$_smarty_tpl);?>
" <?php if (!$_GET[$_smarty_tpl->getVariable('ro')->key]){?>class="selected"<?php }?> class="all" style="padding-left:11px; font-weight:normal; float:right; padding-right:25px; color:#656565; text-decoration:underline;">все</a></h2>
            <div class="">
            <?php  $_smarty_tpl->tpl_vars['o'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('ro')->value->options; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['o']->key => $_smarty_tpl->tpl_vars['o']->value){
?>
            <input type="radio" <?php if (!$_GET[$_smarty_tpl->getVariable('ro')->key]){?>checked="true"<?php }?> /><a class="oname" rel="nofollow" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('params'=>array($_smarty_tpl->getVariable('ro')->value->id=>$_smarty_tpl->getVariable('o')->value->value,'page'=>null)),$_smarty_tpl);?>
" <?php if ($_GET[$_smarty_tpl->getVariable('ro')->key]==$_smarty_tpl->getVariable('o')->value->value){?>class="selected"<?php }?>><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('o')->value->value);?>
</a>
            <?php }} ?>
            </div></div>
            <?php }} ?>
            <?php }?>
                                        

			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_staty'][0][0]->get_staty_plugin(array('var'=>'get_staty','limit'=>5),$_smarty_tpl);?>

			<?php if ($_smarty_tpl->getVariable('get_staty')->value&&!$_smarty_tpl->getVariable('product')->value->name){?>
			<div id="blog_menu">
				<h2>Новые статьи: </h2>
                <div class="">
				<?php  $_smarty_tpl->tpl_vars['st'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('get_staty')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['st']->key => $_smarty_tpl->tpl_vars['st']->value){
?>
				<ul>
					<li data-post="<?php echo $_smarty_tpl->getVariable('st')->value->id;?>
"><span class="date"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->getVariable('st')->value->date);?>
</span> <a class="news_t" href="staty/<?php echo $_smarty_tpl->getVariable('st')->value->url;?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('st')->value->name);?>
</a></li>
				</ul>
				<?php }} ?>
                </div>
			</div>
			<?php }?>
            

			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_browsed_products'][0][0]->get_browsed_products(array('var'=>'browsed_products','limit'=>8),$_smarty_tpl);?>

			<?php if ($_smarty_tpl->getVariable('browsed_products')->value){?>
            <div id="blog_menu">
				<h2>Вы просматривали:</h2>
                <div class="paddin">
				<ul id="browsed_products">
				<?php  $_smarty_tpl->tpl_vars['browsed_product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('browsed_products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['browsed_product']->key => $_smarty_tpl->tpl_vars['browsed_product']->value){
?>
					<li>
					<a href="products/<?php echo $_smarty_tpl->getVariable('browsed_product')->value->url;?>
"><img src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->getVariable('browsed_product')->value->image->filename,60,60);?>
" alt="<?php echo $_smarty_tpl->getVariable('browsed_product')->value->name;?>
" title="<?php echo $_smarty_tpl->getVariable('browsed_product')->value->name;?>
"></a>
					</li>
				<?php }} ?>
				</ul>
                </div>
                </div>
			<?php }?>

            <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_tags'][0][0]->get_tags_plugin(array('var'=>'get_tags','limit'=>10),$_smarty_tpl);?>

            <?php if ($_smarty_tpl->getVariable('get_tags')->value){?>
            <div id="blog_menu" style="min-height:;">
            <h2>Облако Тегов: </h2>
            <div class="">
            <ul id="tags" style="">
            <?php  $_smarty_tpl->tpl_vars['tags'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('get_tags')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['tags']->key => $_smarty_tpl->tpl_vars['tags']->value){
?>
            <li style="margin-right:2px; list-style:none;"><a style="font-size:<?php echo smarty_function_math(array('equation'=>'rand(9,18)'),$_smarty_tpl);?>
px; 
            font-weight:<?php echo smarty_function_math(array('equation'=>'rand(100,900)'),$_smarty_tpl);?>
;" href="products/<?php echo $_smarty_tpl->getVariable('tags')->value->url;?>
"><?php echo $_smarty_tpl->getVariable('tags')->value->name;?>
</a></li>
            <?php }} ?>
            </ul>
            </div>
            </div>
            <?php }?>
            

		</div>
        </div>
        </div>                
        <?php }elseif(!$_smarty_tpl->getVariable('product')->value->name){?>

        <?php echo $_smarty_tpl->getVariable('content')->value;?>

  
        </div>
        <noindex>
        <div id="mleft">         
        <div id="top_left">	
			<?php if ($_smarty_tpl->getVariable('features')->value){?>
            <div id="blog_menu">          
				<h2 style="border-width:0px;">Цена: </h2>
                <div class="xop">
                <a ot="0" do="7000" rel="nofollow">до 7 000</a><br />
                <a ot="6000" do="14000" rel="nofollow">от 6 000 до 14 000</a><br />
                <a ot="15000" do="25000" rel="nofollow">от 15 000 до 25 000</a><br />
                <a ot="0" do="25000" rel="nofollow">до...25 000</a><br />
                </div>
                <div id="slider"></div>            
                <div class="">
                <form name="price" action="<?php echo $_SERVER['REQUEST_URI'];?>
" class="" style="margin-top:13px; text-align:center;">
                от <input id="cena_ot" name="cena_from" <?php if ($_smarty_tpl->getVariable('cena_from')->value&&$_smarty_tpl->getVariable('cena_from')->value>0){?>value="<?php echo $_smarty_tpl->getVariable('cena_from')->value;?>
"<?php }else{ ?>value="3927"<?php }?>  alt="filtr" style="width:55px;" />
                до <input id="cena_do" name="cena_to" <?php if ($_smarty_tpl->getVariable('cena_to')->value&&$_smarty_tpl->getVariable('cena_to')->value>0){?>value="<?php echo $_smarty_tpl->getVariable('cena_to')->value;?>
"<?php }else{ ?>value="28046"<?php }?> alt="filtr" style="width:55px;" /> руб.
                <input type="hidden" value="<?php echo $_smarty_tpl->getVariable('category')->value->url;?>
" name="fopo" id="catee" />
                <br />
                
                <div style="display:none;" id="show_c" class="first"></div>
                </form></div>
			</div>
            <?php }?>
            
            <?php if ($_smarty_tpl->getVariable('category')->value->brands){?>
                <div id="blog_menu">
                <h2 style="">Бренды: </h2>
                <div id="brands">
                	<a rel="nofollow" href="catalog/<?php echo $_smarty_tpl->getVariable('category')->value->url;?>
" <?php if (!$_smarty_tpl->getVariable('brand')->value->id){?>class="selected"<?php }?> style="padding-left:;">все</a>
                	<?php  $_smarty_tpl->tpl_vars['b'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('category')->value->brands; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['b']->key => $_smarty_tpl->tpl_vars['b']->value){
?>
                		<?php if ($_smarty_tpl->getVariable('b')->value->image){?>
                		<a rel="nofollow" data-brand="<?php echo $_smarty_tpl->getVariable('b')->value->id;?>
" href="catalog/<?php echo $_smarty_tpl->getVariable('category')->value->url;?>
/<?php echo $_smarty_tpl->getVariable('b')->value->url;?>
"><img src="<?php echo $_smarty_tpl->getVariable('config')->value->brands_images_dir;?>
<?php echo $_smarty_tpl->getVariable('b')->value->image;?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('b')->value->name);?>
"></a>
                		<?php }else{ ?>
                		<a rel="nofollow" data-brand="<?php echo $_smarty_tpl->getVariable('b')->value->id;?>
" href="catalog/<?php echo $_smarty_tpl->getVariable('category')->value->url;?>
/<?php echo $_smarty_tpl->getVariable('b')->value->url;?>
" <?php if ($_smarty_tpl->getVariable('b')->value->id==$_smarty_tpl->getVariable('brand')->value->id){?>class="selected"<?php }?>><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('b')->value->name);?>
</a>
                		<?php }?>
                	<?php }} ?>
                </div>
                </form>
                <div style="display:none;" id="show_c"></div>
			</div>
            <?php }?>

            
            <?php if ($_smarty_tpl->getVariable('features')->value){?>
            <?php  $_smarty_tpl->tpl_vars['ro'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('features')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['ro']->key => $_smarty_tpl->tpl_vars['ro']->value){
?>
            <div id="blog_menu">
            <h2 style="float:left;" class="close"><a href="#" id="tog" class="<?php echo $_smarty_tpl->getVariable('ro')->value->id;?>
" onclick="return false;"><?php echo $_smarty_tpl->getVariable('ro')->value->name;?>
</a>
            <a rel="nofollow" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('params'=>array($_smarty_tpl->getVariable('ro')->value->id=>null,'page'=>null)),$_smarty_tpl);?>
" <?php if (!$_GET[$_smarty_tpl->getVariable('ro')->key]){?>class="selected"<?php }?> class="all" style="padding-right:8px; font-weight:normal; float:right; color:#656565; text-decoration:underline;">все</a>
            </h2>
            <div class="clear"></div>
            <div class="me_<?php echo $_smarty_tpl->getVariable('ro')->value->id;?>
" id="cook">
            <ul>
            <?php  $_smarty_tpl->tpl_vars['o'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('ro')->value->options; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['o']->key => $_smarty_tpl->tpl_vars['o']->value){
?>
            <li>
            <a class="oname" rel="nofollow" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('params'=>array($_smarty_tpl->getVariable('ro')->value->id=>$_smarty_tpl->getVariable('o')->value->value,'page'=>null)),$_smarty_tpl);?>
" <?php if ($_GET[$_smarty_tpl->getVariable('ro')->key]==$_smarty_tpl->getVariable('o')->value->value){?>class="selected"<?php }?>>
            <div class="filtr_chek producer_check <?php if ($_GET[$_smarty_tpl->getVariable('ro')->key]==$_smarty_tpl->getVariable('o')->value->value){?> filtr_cheked_hover filtr_cheked<?php }?>">
                            <input class="filter_brand" type="checkbox" <?php if ($_GET[$_smarty_tpl->getVariable('ro')->key]==$_smarty_tpl->getVariable('o')->value->value){?>checked="true"<?php }?> />
						</div>
            <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('o')->value->value);?>
</a>
            </li>
            <?php }} ?>
            </ul>
            </div>
            <div style="display:none;" class="filter_<?php echo $_smarty_tpl->getVariable('ro')->value->id;?>
" id="show_c"></div>
            </div>
            <?php }} ?>
            <?php }?>
        </div>       
		<div id="left">
        <div class="top_left">


			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_staty'][0][0]->get_staty_plugin(array('var'=>'get_staty','limit'=>5),$_smarty_tpl);?>

			<?php if ($_smarty_tpl->getVariable('get_staty')->value){?>
			<div id="blog_menu">
				<h2>Новые статьи: </h2>
                <div class="padding">
				<?php  $_smarty_tpl->tpl_vars['st'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('get_staty')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['st']->key => $_smarty_tpl->tpl_vars['st']->value){
?>
				<ul>
					<li data-post="<?php echo $_smarty_tpl->getVariable('st')->value->id;?>
"><span class="date"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->getVariable('st')->value->date);?>
</span> <a class="news_t" href="staty/<?php echo $_smarty_tpl->getVariable('st')->value->url;?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('st')->value->name);?>
</a></li>
				</ul>
				<?php }} ?>
                </div>
			</div>
			<?php }?>
            
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_browsed_products'][0][0]->get_browsed_products(array('var'=>'browsed_products','limit'=>12),$_smarty_tpl);?>

			<?php if ($_smarty_tpl->getVariable('browsed_products')->value){?>
            <div id="blog_menu">
				<h2>Вы просматривали:</h2>
                <div class="paddin">
				<ul id="browsed_products">
				<?php  $_smarty_tpl->tpl_vars['browsed_product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('browsed_products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['browsed_product']->key => $_smarty_tpl->tpl_vars['browsed_product']->value){
?>
					<li>
					<a href="products/<?php echo $_smarty_tpl->getVariable('browsed_product')->value->url;?>
"><img src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->getVariable('browsed_product')->value->image->filename,60,60);?>
" alt="<?php echo $_smarty_tpl->getVariable('browsed_product')->value->name;?>
" title="<?php echo $_smarty_tpl->getVariable('browsed_product')->value->name;?>
"></a>
					</li>
				<?php }} ?>
				</ul>
                </div>
                </div>
			<?php }?>

            <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_tags'][0][0]->get_tags_plugin(array('var'=>'get_tags','limit'=>15),$_smarty_tpl);?>

            <?php if ($_smarty_tpl->getVariable('get_tags')->value){?>
            <div id="blog_menu">
            <h2>Облако Тегов: </h2>
            <div class="padding">
            <ul id="tags" style="">
            <?php  $_smarty_tpl->tpl_vars['tags'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('get_tags')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['tags']->key => $_smarty_tpl->tpl_vars['tags']->value){
?>
            <li style="margin-right:2px; list-style:none;"><a style="font-size:<?php echo smarty_function_math(array('equation'=>'rand(9,18)'),$_smarty_tpl);?>
px; 
            font-weight:<?php echo smarty_function_math(array('equation'=>'rand(100,900)'),$_smarty_tpl);?>
;" href="products/<?php echo $_smarty_tpl->getVariable('tags')->value->url;?>
"><?php echo $_smarty_tpl->getVariable('tags')->value->name;?>
</a></li>
            <?php }} ?>
            </ul>
            </div>
            </div>
            <?php }?>
            <div></div>
		</div>
        </div>
		<?php }?>
	</div>
    </noindex>

</div>
</div>
<div id="footer">
<div class="fot_in">
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_discounted_products'][0][0]->get_discounted_products_plugin(array('var'=>'discounted_products','limit'=>15),$_smarty_tpl);?>

<?php if ($_smarty_tpl->getVariable('discounted_products')->value){?>
<div id="wrappe">  
<div class="clear"></div>
</div>
<?php }?>
<div class="inf">
<ul>
<li style="position:relative;"><div class="skyp"></div><noindex><a rel="nofollow" href="skype:shop4ik">shop4ik</a></noindex></li>
<li style="position:relative;"><span class="icq"></span> <i>390-977</i></li>
<li style="position:relative;"><span class="mail"></span><noindex><a rel="nofollow" href="mailto:sup@shopchik.com">sup@shopchik.com</a></noindex></li>
</ul>
</div>
<div class="">

</div>
<canvas height="75" id="canvas-android" width="100"></canvas>
<script src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/anime.js"></script>

<script>
(function(){if(testCanvas())
var footer=new androidExternal.animations.footer(document.getElementById("canvas-android"));
})();
</script>

<div class="fmsg">
Интернет маркет Shop4ik.com.<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_date'][0][0]->get_date_plugin(array('var'=>'data'),$_smarty_tpl);?>
<?php echo $_smarty_tpl->getVariable('data')->value->year;?>

 — магазин китайской техники, сотовых, планшетов, гаджетов и смартфонов по самым низким ценам.
<br />
<a href="/"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('settings')->value->site_name);?>
</a>
<div class="counter" style="z-index:10;">

<script type="text/javascript"><!--
document.write("<a href='http://www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t26.5;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";h"+escape(document.title.substring(0,80))+";"+Math.random()+
"' alt='' title='LiveInternet: показано число посетителей за"+
" сегодня' "+
"border='0' width='88' height='15'><\/a>")
//--></script>


<a href="http://metrika.yandex.ru/stat/?id=23783164&amp;from=informer"
target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/23783164/1_0_FFFFFFFF_FCFCFCFF_0_pageviews"
style="width:80px; height:15px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры)" onclick="try{Ya.Metrika.informer({i:this,id:23783164,lang:'ru'});return false}catch(e){}"/></a>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter23783164 = new Ya.Metrika({id:23783164,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/23783164" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</div>

</div>

</div>
</div>
<div class="support">Обратная связь</div>
<div class="b-overlay" style="display: none;">
<div class="b-popup skin_default scheme_default shadow_on mod_report" style="top: 108px;">
<div class="b-popup-h">
        <div class="b-popup-close"></div>
        <div class="b-popup-head">
            <div class="b-popup-head-h">
                <div class="head-title">Оставить Сообщение</div>
            </div>
        </div>
        <div class="b-popup-body">
            <div class="b-popup-body-h">                    
                    <form method="post">
                        <div class="forma" style="">
                            <fieldset class="new_b-form-fset">
                                <div class="new_b-form-row">
                                    <div class="new_b-form-label">
                                        <label class="new_b-label">Электронная почта</label>
                                    </div>
                                    <div class="new_b-input size_big">
                                        <input type="text" value="" name="mail" class="new_b-input-h" style="width:98%;" />
                                    </div>
                                </div>
                                <div class="new_b-form-row">
                                    <div class="new_b-form-label">
                                        <label class="new_b-label">Cообщение</label>
                                    </div>
                                    <div class="new_b-input">
                                        <textarea name="sbg" class="new_b-input-h"></textarea>
                                    </div>
                                </div>                                
                                <div class="new_b-form-row">
                                    <input type="submit" class="new_b-submit" id="bobo" value="Отправить"/>
                                </div>
                            </fieldset>
                        </div>                    
            </form>
        </div>
    </div>
</div>
</div>
</div>

</body>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44993750-1', 'shopchik.com');
  ga('send', 'pageview');

</script>

</html>