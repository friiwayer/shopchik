<!DOCTYPE html>
<html>
<head>
	<base href="{$config->root_url}/"/>
	<title>{$meta_title|escape}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="{$meta_description|escape}" />
	<meta name="keywords"    content="{$meta_keywords|escape}" />
	<meta name="viewport" content="width=1024"/>
    {if $page && $page->url == ''}
    <link href="design/{$settings->theme|escape}/css/stylem.css" rel="stylesheet" type="text/css" media="screen"/>
    {elseif $compare->total}
    <link href="design/{$settings->theme|escape}/css/stylem.css" rel="stylesheet" type="text/css" media="screen"/>
    {elseif !$product->name}
    <link href="design/{$settings->theme|escape}/css/style.css" rel="stylesheet" type="text/css" media="screen"/>
    {else}
    <link href="design/{$settings->theme|escape}/css/style.css" rel="stylesheet" type="text/css" media="screen"/>
    {/if}
   
    {if $page->url == 'blog' || $page->url == 'contact' || $page->url == 'staty' || $page->url == 'dostavka' || $page->url == 'oplata' || $page->url == 'garantii-i-vozvrat'}
    <style>
    #content{
        width:auto;
        float:none;
    }
    </style>
    {/if}
    
	<link href="design/{$settings->theme|escape}/images/favicon.ico" rel="icon"          type="image/x-icon"/>
	<link href="design/{$settings->theme|escape}/images/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
    <link href="design/{$settings->theme|escape}/css/default.css" rel="stylesheet" type="text/css" media="screen"/>
    
	<script src="js/jquery/jquery.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
	{if $smarty.session.admin == 'admin'}
	<script src ="js/admintooltip/admintooltip.js" type="text/javascript"></script>
	<link   href="js/admintooltip/css/admintooltip.css" rel="stylesheet" type="text/css" /> 
	{/if}
	<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" href="js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
	
    <script type="text/javascript" src="js/ctrlnavigate.js"></script>           

	<script src="design/{$settings->theme}/js/jquery-ui.min.js"></script>
	<script src="design/{$settings->theme}/js/ajax_cart.js"></script>
    <script type="text/javascript" src="design/new/js/cnt_filter.js"></script>
	<script src="/js/baloon/js/baloon.js" type="text/javascript"></script>
	<link   href="/js/baloon/css/baloon.css" rel="stylesheet" type="text/css" /> 
    <script src="design/{$settings->theme}/js/ajax_compare.js"></script>    
	{literal}
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
	{/literal}

    {if $product->name}
    {literal}
    <script>
    $(function(){
       $('div#content').css({'width':'auto','float':'none'}); 
       $('div#left').css({'width':'auto','float':'none'});
       $('div#mleft').css({'width':'auto'});
    });
    </script>
    {/literal}
    {/if}

	{literal}
    <script>
    $(document).ready(function(){
        $('#account a:first').css({'border-right':'1px dashed #898989','padding-right':'8px'});
                        
    });
    </script>
    {/literal}
    {literal}
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
    {/literal}
<!--[if lte IE 7]>
        <link rel="stylesheet" type="text/css" href="design/{$settings->theme}/css/ie.css" media="screen" />
<![endif]-->
<script type="text/javascript" src="design/{$settings->theme}/js/jquery.jcarousel.js"></script>
{literal}
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
{/literal}
<link rel="stylesheet" type="text/css" href="design/{$settings->theme}/css/jquery-ui.css" />
<script src="design/{$settings->theme}/js/jquery-nomen.js" type="text/javascript"></script>
<script type="text/javascript" src="design/{$settings->theme}/js/jquery.ui.core.js"></script>
<script type="text/javascript" src="design/{$settings->theme}/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="design/{$settings->theme}/js/jquery.ui.mouse.js"></script>
<script type="text/javascript" src="design/{$settings->theme}/js/jquery.ui.slider.js"></script>
<script type="text/javascript" src="design/{$settings->theme}/js/cookies.js"></script>
<script type="text/javascript" src="design/{$settings->theme}/js/jquery.dropdownPlain.js"></script>
<script src="design/{$settings->theme}/js/dropdown.js"></script>
<script src="design/{$settings->theme}/js/jquery.tinyTips.js"></script>
{literal}
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
{/literal}

{literal}
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
{/literal}
<script src="design/{$settings->theme}/js/upTT.js"></script>
<link rel="stylesheet" type="text/css" href="design/{$settings->theme}/css/tinyTips.css" media="screen" />
<script type="text/javascript" src="design/{$settings->theme}/js/smartmodel.js"></script>
</head>
<body>
<div class="menu_t">
		<ul id="menu">
			{foreach $pages as $p}
				{* Выводим только страницы из первого меню *}
				{if $p->menu_id == 1}
				<li {if $page && $page->id == $p->id}class="selected"{/if}>
					<a data-page="{$p->id}" href="{$p->url}"><h2>{$p->name|escape}</h2></a>
				</li>
				{/if}
			{/foreach}                    
		</ul>               
</div>        
<div id="fon_b">
<div class="foterr">
	<div id="top_background">
        {* {if $city != 'Not found'}
        <span class="geo"><label style="color:#999;">Ваш город:</label> <noindex><span style="color:333; cursor:pointer; text-decoration:underline;" rel="nofollow,noindex" href="#">{$city}</span></noindex></span>
        {else}
        <span class="geo"><label style="color:#999;">Ваш город:</label> <noindex><span style="color:333; cursor:pointer; text-decoration:underline;" rel="nofollow,noindex" href="#">город не найден</span></noindex></span>
        {/if} *}    
	<div id="top">
	    <div id="logo">
		<a href="/"><img src="design/{$settings->theme|escape}/images/logo.png" title="{$settings->site_name|escape}" alt="{$settings->site_name|escape}"/></a>
		</div>
        <span class="sabj">Лучшая Электроника из Китая.</span>
    <noindex>
			<div id="search">
				<form action="products">
					<input class="input_search" type="text" name="keyword" value="{$keyword}" placeholder="найти товар"/>
					<input class="button_search" value="" type="submit" />
				</form>
			</div>
   </noindex>        
            <div id="compare_informer" >
            <noindex>
            {if $compare_informer->total>0}
            в <a target="_blank" href="/compare/">сравнении</a> {$compare_informer->total} {$compare_informer->total|plural:'товар':'товаров':'товара'}
            {else}
            Товары для сравнения
            {/if}
            </noindex>
            </div>
                    
		<div id="account">
			{if $user}
				<span id="username">
					<a href="user">{$user->name}</a>{if $group->discount>0},
					ваша скидка &mdash; {$group->discount}%{/if}
				</span>
				<a id="logout" href="user/logout">выйти</a>
			{else}
            <noindex>
				<a id="register" rel="nofollow" href="user/register">Регистрация</a>
				<a id="login" rel="nofollow" href="user/login">Вход</a>
            </noindex>
			{/if}
		</div>
		<div id="cart_informer">
        
			{* Обновляемая аяксом корзина должна быть в отдельном файле *}
			{include file='cart_informer.tpl'}
            
		</div>                                   
    		<div id="contact">
			{* Выбор валюты только если их больше одной *}
            {if $page && $page->url == ''}
            <p style="margin:0; font-size:11px; padding-top:25px;">заказ по телефону.</p>
			тел. 8(904) <span id="phone">366-26-55</span>
            {else}
			{if $currencies|count>1}
			<div id="currencies">
				<h2></h2>
				<ul>
					{foreach from=$currencies item=c}
					{if $c->enabled}
					<li class="{if $c->id==$currency->id}selected{/if}"><noindex><a rel="nofollow" href='{url currency_id=$c->id}'>{$c->name|escape}</a></noindex></li>
					{/if}
					{/foreach}
				</ul>
			</div>
            <p style="margin:0; font-size:11px; padding-top:0px;">заказ по телефону.</p>
			<p>тел. 8(904) <span id="phone">366-26-55</span></p> 
			{/if}
            {/if}
		</div>
	</div>
	</div>
	<div id="main">
    <div class="topm">
 {include file='menu.tpl'}
   </div>
   {if $page && $page->url == ''}{else}<script src="design/{$settings->theme}/js/slidemenu.js"></script>{/if}
   <div class="clear" style="height:15px;"></div>
    {if $page && $page->url == ''}
    {else}

    <div id="path">
    	<a href="./">Главная</a>
    	{foreach from=$category->path item=cat}
    	→ <a href="catalog/{$cat->url}">{$cat->name|escape}</a>
    	{/foreach}
    	{if $brand}
    	→ <a href="catalog/{$cat->url}/{$brand->url}">{$brand->name|escape}</a>
    	{/if}
    	→  {$product->name|escape}                
    </div>

    {/if}
    
		<div id="content">
        <div class="up" style="position:absolute; bottom:0; right:0;"></div>
        {if $page && $section->url == $this->settings->main_section || $compare->total}
		{$content}
		</div>

        {elseif $product->id || $keyword && !$product->name}
        {$content}
        </div>
        <div id="mleft">
		<div id="left" style="border:1px solid #e3e0d9;">
			{if $features}
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
                <form name="price" action="{$smarty.server.REQUEST_URI}" class="" style="margin-top:13px;">
                <input type="hidden" name="id_" value="{$product->id}" />
                <input id="cena_ot" name="cena_from" {if $cena_from && $cena_from > 0}value="{$cena_from}"{else}value="3927"{/if}  alt="filtr" style="width:55px;" />
                <input id="cena_do" name="cena_to" {if $cena_to && $cena_to > 0}value="{$cena_to}"{else}value="28046"{/if} alt="filtr" style="width:55px;" />
                <input type="submit" name="send" class="butte" value="показать" />
                </form></div>
			</div>
            {/if}
            
                {if $category->brands}
                <div id="blog_menu">
                <h2 style="">Бренды: </h2>
                <div id="brands">
                	<a rel="nofollow" href="catalog/{$category->url}" {if !$brand->id}class="selected"{/if} style="padding-left:;">все</a>
                	{foreach name=brands item=b from=$category->brands}
                		{if $b->image}
                		<a data-brand="{$b->id}" rel="nofollow" href="catalog/{$category->url}/{$b->url}"><img src="{$config->brands_images_dir}{$b->image}" alt="{$b->name|escape}"></a>
                		{else}
                		<a data-brand="{$b->id}" rel="nofollow" href="catalog/{$category->url}/{$b->url}" {if $b->id == $brand->id}class="selected"{/if}>{$b->name|escape}</a>
                		{/if}
                	{/foreach}
                </div>
                </form>
			    </div>
                {/if}
            
            {if $features}
            {foreach $features as $ro}
            <div id="blog_menu">
            <h2 style="padding-top:5px;"><a href="#" id="tog" onclick="return false;">{$ro->name}</a>
            <a rel="nofollow" href="{url params=[$ro->id=>null, page=>null]}" {if !$smarty.get.$ro@key}class="selected"{/if} class="all" style="padding-left:11px; font-weight:normal; float:right; padding-right:25px; color:#656565; text-decoration:underline;">все</a></h2>
            <div class="">
            {foreach $ro->options as $o}
            <input type="radio" {if !$smarty.get.$ro@key}checked="true"{/if} /><a class="oname" rel="nofollow" href="{url params=[$ro->id=>$o->value, page=>null]}" {if $smarty.get.$ro@key == $o->value}class="selected"{/if}>{$o->value|escape}</a>
            {/foreach}
            </div></div>
            {/foreach}
            {/if}
                                        
			{* Выбираем в переменную $last_posts последние записи *}
			{*get_posts var=last_posts limit=5}
			{if $last_posts}
			<div id="blog_menu">
				<h2>Новости магазина: </h2>
                <div class="">
				{foreach $last_posts as $post}
				<ul>
					<li data-post="{$post->id}"><span class="date">{$post->date|date}</span> <a class="news_t" href="blog/{$post->url}">{$post->name|escape}</a></li>
				</ul>
				{/foreach}
                </div>
			</div>
			{/if*}

			{get_staty var=get_staty limit=5}
			{if $get_staty && !$product->name}
			<div id="blog_menu">
				<h2>Новые статьи: </h2>
                <div class="">
				{foreach $get_staty as $st}
				<ul>
					<li data-post="{$st->id}"><span class="date">{$st->date|date}</span> <a class="news_t" href="staty/{$st->url}">{$st->name|escape}</a></li>
				</ul>
				{/foreach}
                </div>
			</div>
			{/if}
            

			{get_browsed_products var=browsed_products limit=8}
			{if $browsed_products}
            <div id="blog_menu">
				<h2>Вы просматривали:</h2>
                <div class="paddin">
				<ul id="browsed_products">
				{foreach $browsed_products as $browsed_product}
					<li>
					<a href="products/{$browsed_product->url}"><img src="{$browsed_product->image->filename|resize:60:60}" alt="{$browsed_product->name}" title="{$browsed_product->name}"></a>
					</li>
				{/foreach}
				</ul>
                </div>
                </div>
			{/if}

            {get_tags var=get_tags limit=10}
            {if $get_tags}
            <div id="blog_menu" style="min-height:;">
            <h2>Облако Тегов: </h2>
            <div class="">
            <ul id="tags" style="">
            {foreach $get_tags as $tags}
            <li style="margin-right:2px; list-style:none;"><a style="font-size:{math equation='rand(9,18)'}px; 
            font-weight:{math equation='rand(100,900)'};" href="products/{$tags->url}">{$tags->name}</a></li>
            {/foreach}
            </ul>
            </div>
            </div>
            {/if}
            

		</div>
        </div>
        </div>                
        {elseif !$product->name}

        {$content}
  
        </div>
        <noindex>
        <div id="mleft">         
        <div id="top_left">	
			{if $features}
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
                <form name="price" action="{$smarty.server.REQUEST_URI}" class="" style="margin-top:13px; text-align:center;">
                от <input id="cena_ot" name="cena_from" {if $cena_from && $cena_from > 0}value="{$cena_from}"{else}value="3927"{/if}  alt="filtr" style="width:55px;" />
                до <input id="cena_do" name="cena_to" {if $cena_to && $cena_to > 0}value="{$cena_to}"{else}value="28046"{/if} alt="filtr" style="width:55px;" /> руб.
                <input type="hidden" value="{$category->url}" name="fopo" id="catee" />
                <br />
                
                <div style="display:none;" id="show_c" class="first"></div>
                </form></div>
			</div>
            {/if}
            
            {if $category->brands}
                <div id="blog_menu">
                <h2 style="">Бренды: </h2>
                <div id="brands">
                	<a rel="nofollow" href="catalog/{$category->url}" {if !$brand->id}class="selected"{/if} style="padding-left:;">все</a>
                	{foreach name=brands item=b from=$category->brands}
                		{if $b->image}
                		<a rel="nofollow" data-brand="{$b->id}" href="catalog/{$category->url}/{$b->url}"><img src="{$config->brands_images_dir}{$b->image}" alt="{$b->name|escape}"></a>
                		{else}
                		<a rel="nofollow" data-brand="{$b->id}" href="catalog/{$category->url}/{$b->url}" {if $b->id == $brand->id}class="selected"{/if}>{$b->name|escape}</a>
                		{/if}
                	{/foreach}
                </div>
                </form>
                <div style="display:none;" id="show_c"></div>
			</div>
            {/if}

            
            {if $features}
            {foreach $features as $ro}
            <div id="blog_menu">
            <h2 style="float:left;" class="close"><a href="#" id="tog" class="{$ro->id}" onclick="return false;">{$ro->name}</a>
            <a rel="nofollow" href="{url params=[$ro->id=>null, page=>null]}" {if !$smarty.get.$ro@key}class="selected"{/if} class="all" style="padding-right:8px; font-weight:normal; float:right; color:#656565; text-decoration:underline;">все</a>
            </h2>
            <div class="clear"></div>
            <div class="me_{$ro->id}" id="cook">
            <ul>
            {foreach $ro->options as $o}
            <li>
            <a class="oname" rel="nofollow" href="{url params=[$ro->id=>$o->value, page=>null]}" {if $smarty.get.$ro@key == $o->value}class="selected"{/if}>
            <div class="filtr_chek producer_check {if $smarty.get.$ro@key == $o->value} filtr_cheked_hover filtr_cheked{/if}">
                            <input class="filter_brand" type="checkbox" {if $smarty.get.$ro@key == $o->value}checked="true"{/if} />
						</div>
            {$o->value|escape}</a>
            </li>
            {/foreach}
            </ul>
            </div>
            <div style="display:none;" class="filter_{$ro->id}" id="show_c"></div>
            </div>
            {/foreach}
            {/if}
        </div>       
		<div id="left">
        <div class="top_left">                
			{* Выбираем в переменную $last_posts последние записи *}


			{get_staty var=get_staty limit=5}
			{if $get_staty}
			<div id="blog_menu">
				<h2>Новые статьи: </h2>
                <div class="padding">
				{foreach $get_staty as $st}
				<ul>
					<li data-post="{$st->id}"><span class="date">{$st->date|date}</span> <a class="news_t" href="staty/{$st->url}">{$st->name|escape}</a></li>
				</ul>
				{/foreach}
                </div>
			</div>
			{/if}
            
			{get_browsed_products var=browsed_products limit=12}
			{if $browsed_products}
            <div id="blog_menu">
				<h2>Вы просматривали:</h2>
                <div class="paddin">
				<ul id="browsed_products">
				{foreach $browsed_products as $browsed_product}
					<li>
					<a href="products/{$browsed_product->url}"><img src="{$browsed_product->image->filename|resize:60:60}" alt="{$browsed_product->name}" title="{$browsed_product->name}"></a>
					</li>
				{/foreach}
				</ul>
                </div>
                </div>
			{/if}

            {get_tags var=get_tags limit=15}
            {if $get_tags}
            <div id="blog_menu">
            <h2>Облако Тегов: </h2>
            <div class="padding">
            <ul id="tags" style="">
            {foreach $get_tags as $tags}
            <li style="margin-right:2px; list-style:none;"><a style="font-size:{math equation='rand(9,18)'}px; 
            font-weight:{math equation='rand(100,900)'};" href="products/{$tags->url}">{$tags->name}</a></li>
            {/foreach}
            </ul>
            </div>
            </div>
            {/if}
            <div></div>
		</div>
        </div>
		{/if}
	</div>
    </noindex>

</div>
</div>
<div id="footer">
<div class="fot_in">
{get_discounted_products var=discounted_products limit=15}
{if $discounted_products}
<div id="wrappe">  
<div class="clear"></div>
</div>
{/if}
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
<script src="design/{$settings->theme}/js/anime.js"></script>
{literal}
<script>
(function(){if(testCanvas())
var footer=new androidExternal.animations.footer(document.getElementById("canvas-android"));
})();
</script>
{/literal}
<div class="fmsg">
Интернет маркет Shop4ik.com.{get_date var=data}{$data->year}
 — магазин китайской техники, сотовых, планшетов, гаджетов и смартфонов по самым низким ценам.
<br />
<a href="/">{$settings->site_name|escape}</a>
<div class="counter" style="z-index:10;">
{literal}
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
{/literal}
{literal}
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
{/literal}
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
{literal}
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44993750-1', 'shopchik.com');
  ga('send', 'pageview');

</script>
{/literal}
</html>