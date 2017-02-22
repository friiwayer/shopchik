<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<base href="{$config->root_url}/"/>
	<title>{$meta_title|escape}</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="{$meta_description|escape}" />
	<meta name="keywords"    content="{$meta_keywords|escape}" />
	<meta name="viewport" content="width=1024"/>
	<link href="design/{$settings->theme|escape}/css/style.css" rel="stylesheet" type="text/css" media="screen"/>
	<link href="design/{$settings->theme|escape}/images/favicon.ico" rel="icon"          type="image/x-icon"/>
	<link href="design/{$settings->theme|escape}/images/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
    <link href="design/{$settings->theme|escape}/css/nivo-slider.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="design/{$settings->theme|escape}/css/default.css" rel="stylesheet" type="text/css" media="screen"/>
	<script src="js/jquery/jquery.js"  type="text/javascript"></script>

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
		//  Автозаполнитель поиска
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
	});
	</script>
	{/literal}
		
			
</head>
<body>
<div id="fon_b">
<div class="foterr">
	<!-- Верхняя строка -->
	<div id="top_background">
	<div id="top">
	    <div id="logo">
			<a href="/"><img src="design/{$settings->theme|escape}/images/logo.png" title="{$settings->site_name|escape}" alt="{$settings->site_name|escape}"/></a>
		</div>

	
		<!-- Корзина -->
		<div id="cart_informer">
			{* Обновляемая аяксом корзина должна быть в отдельном файле *}
			{include file='cart_informer.tpl'}
		</div>
		<!-- Корзина (The End)-->

		<!-- Вход пользователя -->
		<div id="account">
			{if $user}
				<span id="username">
					<a href="user">{$user->name}</a>{if $group->discount>0},
					ваша скидка &mdash; {$group->discount}%{/if}
				</span>
				<a id="logout" href="user/logout">выйти</a>
			{else}
				<a id="register" href="user/register">Регистрация</a>
				<a id="login" href="user/login">Вход</a>
			{/if}
		</div>
		<!-- Вход пользователя (The End)-->
    		<div id="contact">
                	<!-- Выбор валюты -->
			{* Выбор валюты только если их больше одной *}
			{if $currencies|count>1}
			<div id="currencies">
				<h2></h2>
				<ul>
					{foreach from=$currencies item=c}
					{if $c->enabled}
					<li class="{if $c->id==$currency->id}selected{/if}"><a href='{url currency_id=$c->id}'>{$c->name|escape}</a></li>
					{/if}
					{/foreach}
				</ul>
			</div> 
			{/if}
			<!-- Выбор валюты (The End) -->	
			тел. (495) <span id="phone">545-54-54</span>
		</div>
	</div>
	</div>
	<!-- Верхняя строка (The End)-->
	
	
	<!-- Шапка -->
	<div id="header">
    <!-- Поиск-->
			<div id="search">
				<form action="products">
					<input class="input_search" type="text" name="keyword" value="{$keyword}" placeholder="Поиск товара"/>
					<input class="button_search" value="" type="submit" />
				</form>
			</div>
    <!-- Поиск (
        <!-- Меню -->
		<ul id="menu">
			{foreach $pages as $p}
				{* Выводим только страницы из первого меню *}
				{if $p->menu_id == 1}
				<li {if $page && $page->id == $p->id}class="selected"{/if}>
					<a data-page="{$p->id}" href="{$p->url}">{$p->name|escape}</a>
				</li>
				{/if}
			{/foreach}
		</ul>
		<!-- Меню (The End) -->	
        </div>
	<!-- Шапка (The End)--> 
	<!-- Вся страница --> 
	<div id="main">
		<!-- Основная часть --> 
		<div id="content">
            {if $page && $page->url==''}
            {include file='slider.tpl'}
            {/if}
			{$content}
		</div>
		<!-- Основная часть (The End) --> 

		<div id="left">

		
			<!-- Меню каталога -->
            <h2>Категории товара:</h2>
			<div id="catalog_menu">
			{$setings}		
			{* Рекурсивная функция вывода дерева категорий *}
			{function name=categories_tree}
			{if $categories}
			<ul>
			{foreach $categories as $c}
				{* Показываем только видимые категории *}
				{if $c->visible}
					<li>
						{if $c->image}<img src="{$config->categories_images_dir}{$c->image}" alt="{$c->name}">{/if}
						<a {if $category->id == $c->id}class="selected"{/if} href="catalog/{$c->url}" data-category="{$c->id}">{$c->name}</a><span style="font-size:12px;"> ({$c->count})</span>
						{categories_tree categories=$c->subcategories}
					</li>
				{/if}
			{/foreach}
			</ul>
			{/if}
			{/function}
			{categories_tree categories=$categories}
			</div>
			<!-- Меню каталога (The End)-->		
	
			<!-- Меню блога -->
			{* Выбираем в переменную $last_posts последние записи *}
			{get_posts var=last_posts limit=5}
			{if $last_posts}
			<div id="blog_menu">
				<h2>Новости магазина: </h2>
				{foreach $last_posts as $post}
				<ul>
					<li data-post="{$post->id}">{$post->date|date} <a href="blog/{$post->url}">{$post->name|escape}</a></li>
				</ul>
				{/foreach}
			</div>
			{/if}
			<!-- Просмотренные товары -->

            <!--Облако тегов--!>
            {get_tags var=get_tags limit=15}
            {if $get_tags}
            <h2>Облако Тегов: </h2>
            <ul id="tags">
            {foreach $get_tags as $tags}
            <li style="float:left; margin-right:2px; list-style:none;"><a style="font-size:{math equation='rand(9,18)'}px; 
            font-weight:{math equation='rand(100,900)'};" href="products/{$tags->url}">{$tags->name}</a></li>
            {/foreach}
            </ul>
            {/if}

			<!-- Просмотренные товары -->
			{get_browsed_products var=browsed_products limit=10}
			{if $browsed_products}
				<h2>Вы просматривали:</h2>
				<ul id="browsed_products">
				{foreach $browsed_products as $browsed_product}
					<li>
					<a href="products/{$browsed_product->url}"><img src="{$browsed_product->image->filename|resize:50:50}" alt="{$browsed_product->name}" title="{$browsed_product->name}"></a>
					</li>
				{/foreach}
				</ul>
			{/if}
			<!-- Просмотренные товары (The End)-->
            
            <h2>Мы принимаем: </h2>
            <div id="weacc" title="Способы оплаты на сайте"></div>
		</div>			

	</div>
	<!-- Вся страница (The End)--> 
	
	<!-- Футер -->
	<div id="footer">
         <center><a href="/">{$settings->site_name|escape}</a></center>
                	 Интернет маркет Shop4ik.com. — компьютерный магазин телефон: (4812) 67-99-97
                         <div class="counter"></div>
                         </div>
	<!-- Футер (The End)-->
</div>
</div>
</body>
</html>