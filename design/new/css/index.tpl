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
    <link href="design/{$settings->theme|escape}/css/jquery-ui-1.8.23.custom.css" rel="stylesheet" type="text/css" media="screen"/>
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
    <script type="text/javascript">
        $(function(){
           $('#catalog_menus ul li a').hover(function(){
            $(this).addClass('hover');
           },function(){
            $(this).removeClass('hover');
           });
           $('#catalog_menus ul li a').click(function(){
            if($(this).hasClass('hover')){$(this).removeClass('hover');}
            $(this).addClass('active');
           });
        });
    </script>    	
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
	});
	</script>
	{/literal}
	{literal}
    <script>
    $(document).ready(function(){
        $('#account a:first').css({'border-right':'1px dashed #898989','padding-right':'8px'});
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
	$(function(){
    $("#slider").slider({
	min: 2000,
	max: 20000,
	values: [2000,20000],
	range: true,
	stop: function(event, ui) {
		$("#cena_ot").val($("#slider").slider("values",0));
		$("#cena_do").val($("#slider").slider("values",1));
		
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
});

	
$("#cena_do").change(function(){
		
	var value1 = $("#cena_ot").val();
	var value2 = $("#cena_do").val();
	


	if(parseInt(value1) > parseInt(value2)){
		value2 = value1 + 500;
		$("#cena_do").val(value2);
	}
	$("#slider").slider("values",1,value2);
});

		$('li.headlink').hover(
		function() { $('ul', this).css('display', 'block'); },
		function() { $('ul', this).css('display', 'none');
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
	<div id="top">
	    <div id="logo">
		<a href="/"><img src="design/{$settings->theme|escape}/images/logo.png" title="{$settings->site_name|escape}" alt="{$settings->site_name|escape}"/></a>
		</div>
        <span class="sabj">Смартфоны и Планшеты из Китая.</span>
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
			тел. 8(904) <span id="phone">366-26-55</span> 
			{/if}
            {/if}
		</div>
	</div>
	</div>
	<div id="main">
    <div class="topm">
 {include file='menu.tpl'}
   </div>
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
        {elseif $product->id || $keyword}
        {$content}
		</div>
        <div id="mleft">
		<div id="left">
        <div class="filter_tl"></div>
        <div class="filter_tr"></div>
        <div class="filter_bl"></div>
        <div class="filter_br"></div>
			{if $features}
            <div id="blog_menu">
				<h2 style="border-width:0px;">Цена: </h2>
                <div id="slider"></div>
                <div class="">
                <form name="price" action="{$smarty.server.REQUEST_URI}" class="">
                <input id="cena_ot" name="cena_from" value="2000"  alt="filtr" style="width:55px;" />
                <input id="cena_do" name="cena_to" value="20000" alt="filtr" style="width:55px;" />
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
            <a rel="nofollow" href="{url params=[$ro->id=>null, page=>null]}" {if !$smarty.get.$ro@key}class="selected"{/if} class="all" style="padding-left:11px; font-weight:normal; float:right; padding-right:25px; color:#0095EB; text-decoration:underline;">все</a></h2>
            <div class="">
            {foreach $ro->options as $o}
            <input type="radio" {if !$smarty.get.$ro@key}checked="true"{/if} /><a class="oname" rel="nofollow" href="{url params=[$ro->id=>$o->value, page=>null]}" {if $smarty.get.$ro@key == $o->value}class="selected"{/if}>{$o->value|escape}</a>
            {/foreach}
            </div></div>
            {/foreach}
            {/if}
                                        
			{* Выбираем в переменную $last_posts последние записи *}
			{get_posts var=last_posts limit=5}
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
			{/if}

			{get_staty var=get_staty limit=5}
			{if $get_staty}
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
            
            {get_last_comments var=get_last_comments limit=2}
            {if $get_last_comment}
            <div id="blog_menu">
            <h2>Комментарии</h2>
            <ul class="coms_in">
            {foreach $get_last_comments as $com}
            <li>
            <b style="color:#505050;">{$com->name|escape}: </b> <a style="font-size:11px; color:#898989; text-decoration:none;" href="products/{$com->url}">--> {$com->tovname}</a>
            <p class="comment_in">{$com->jojo}</p>
            </li>
            {/foreach}
            </ul>
            </div>
            {/if}
		</div>
        </div>                
        {else}
        {$content}
		</div>
        <noindex>
        <div id="mleft">         
        <div id="top_left">
        <div class="filter_tl"></div>
        <div class="filter_tr"></div>
        <div class="filter_bl"></div>
        <div class="filter_br"></div>	
			{if $features}
            <div id="blog_menu">
				<h2 style="border-width:0px;">Цена: </h2>
                <div id="slider"></div>
                <div class="">
                <form name="price" action="{$smarty.server.REQUEST_URI}" class="">
                <input id="cena_ot" name="cena_from" value="2000"  alt="filtr" style="width:55px;" />
                <input id="cena_do" name="cena_to" value="20000" alt="filtr" style="width:55px;" />
                <input type="submit" name="send" class="buttong" value="показать" />
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
			</div>
            {/if}

            
            {if $features}
            {foreach $features as $ro}
            <div id="blog_menu">
            <h2 style="float:left;"><a href="#" id="tog" onclick="return false;">{$ro->name}</a>
            <a rel="nofollow" href="{url params=[$ro->id=>null, page=>null]}" {if !$smarty.get.$ro@key}class="selected"{/if} class="all" style="padding-left:11px; font-weight:normal; float:right; color:#0095EB; text-decoration:underline;">все</a>
            </h2>
            <div class="clear"></div>
            <div class="">
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
            </div></div>
            {/foreach}
            {/if}
        </div>       
		<div id="left">
        <div class="top_left">
        <div class="filter_tl"></div>
        <div class="filter_tr"></div>
        <div class="filter_bl"></div>
        <div class="filter_br"></div>                 
			{* Выбираем в переменную $last_posts последние записи *}
			{get_posts var=last_posts limit=5}
			{if $last_posts}
			<div id="blog_menu">
				<h2>Новости магазина: </h2>
                <div class="padding">
				{foreach $last_posts as $post}
				<ul>
					<li data-post="{$post->id}"><span class="date">{$post->date|date}</span> <a class="news_t" href="blog/{$post->url}">{$post->name|escape}</a></li>
				</ul>
				{/foreach}
                </div>
			</div>
			{/if}

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

            {get_last_comments var=get_last_comments limit=0}
            {if $get_last_comment}
            <div id="blog_menu">
            <h2>Комментарии</h2>
            <ul class="coms_in">
            {foreach $get_last_comments as $com}
            <li>
            <b style="color:#505050;">{$com->name|escape}: </b> <a style="font-size:11px; color:#898989; text-decoration:none;" href="products/{$com->url}">--> {$com->tovname}</a>
            <p class="comment_in">{$com->jojo}</p>
            </li>
            {/foreach}
            </ul>
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
Интернет маркет Shop4ik.com. 2012 — магазин китайской техники, сотовых, планшетов, гаджетов и смартфонов по самым низким ценам.
<br />
<a href="/">{$settings->site_name|escape}</a>
<div class="counter" style="z-index:10;">
{literal}
<script type="text/javascript"><!--
document.write("<a href='http://www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t44.4;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet' "+
"border='0' width='31' height='31'><\/a>")
//--></script>
{/literal}
</div>
</div>

</div>
</div>
</body>
</html>