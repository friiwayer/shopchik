<!DOCTYPE html>
{*
	Общий вид страницы
	Этот шаблон отвечает за общий вид страниц без центрального блока.
*}
<html>
<head>
	<base href="{$config->root_url}/"/>
	<title>{$meta_title|escape}</title>
	

	{* Метатеги *}
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="{$meta_description|escape}" />
<meta name="keywords"    content="{$meta_keywords|escape}" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="author" content="tehno-svit.com" />
<meta name="generator" content="by ds" />


{* Стили *}
<link href="design/{$settings->theme|escape}/images/favicon.ico" rel="icon"          type="image/x-icon"/>
<link href="design/{$settings->theme|escape}/images/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
<link href="design/{$settings->theme|escape}/css/style.css" rel="stylesheet" type="text/css" media="screen"/>
<link rel="stylesheet" type="text/css" href="design/{$settings->theme|escape}/css/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="design/{$settings->theme|escape}/css/stylesheet_main.css" />
<link rel="stylesheet" type="text/css" href="design/{$settings->theme|escape}/css/stylesheet_boxes.css" />
<link rel="stylesheet" type="text/css" href="design/{$settings->theme|escape}/css/stylesheet_css_buttons.css" />
<link rel="stylesheet" type="text/css" href="design/{$settings->theme|escape}/css/stylesheet_darkbox.css" />
<link rel="stylesheet" type="text/css" href="design/{$settings->theme|escape}/css/stylesheet_tm.css" />
<link rel="stylesheet" type="text/css" media="print" href="design/{$settings->theme|escape}/css/print_stylesheet.css" />


{* JQuery *}
<script type="text/javascript" src="js/jquery/jquery.js"  type="text/javascript"></script>
<script type="text/javascript" src="design/{$settings->theme|escape}/js/jscript_xdarkbox.js"></script>
<script type="text/javascript" src="design/{$settings->theme|escape}/js/jscript_zhover-image.js"></script>
<script type="text/javascript" src="design/{$settings->theme|escape}/js/jscript2_xjquery.easing.1.3.js"></script>
<script type="text/javascript" src="design/{$settings->theme|escape}/js/jscript2_ytms.js"></script>
<script type="text/javascript" src="design/{$settings->theme|escape}/js/jscript2_ytms_butter.js"></script>
<script type="text/javascript" src="design/{$settings->theme|escape}/js/jscript2_zslider.js"></script>



{* Всплывающие подсказки для администратора *}
{if $smarty.session.admin == 'admin'}
<script src ="js/admintooltip/admintooltip.js" type="text/javascript"></script>
<link   href="js/admintooltip/css/admintooltip.css" rel="stylesheet" type="text/css" /> 
{/if}

{* Увеличитель картинок *}
	<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" href="js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
	
	{* Ctrl-навигация на соседние товары *}
	<script type="text/javascript" src="js/ctrlnavigate.js"></script>           
	
	{* Аяксовая корзина *}
	<script src="design/{$settings->theme}/js/jquery-ui.min.js"></script>
	<script src="design/{$settings->theme}/js/ajax_cart.js"></script>
	
	{* js-проверка форм *}
	<script src="/js/baloon/js/baloon.js" type="text/javascript"></script>
	<link   href="/js/baloon/css/baloon.css" rel="stylesheet" type="text/css" /> 
	
	{* Автозаполнитель поиска *}

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
		$(".input1").autocomplete({
			serviceUrl:'ajax/search_products.php',
			minChars:1,
			noCache: false, 
			onSelect:
				function(value, data){
					 $(".input1").closest('form').submit();
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

	  <script type="text/javascript">
			(function($) {
				$.fn.thumbnailSlider = function(options) {
					var opts = $.extend({}, $.fn.thumbnailSlider.defaults, options);
					return this.each(function() {
						var $this 				= $(this),
							o 					= $.meta ? $.extend({}, opts, $pxs_container.data()) : opts;
						
						var $ts_container		= $this.children('.ts_container'),
							$ts_thumbnails		= $ts_container.children('.ts_thumbnails'),
							$nav_elems			= $ts_container.children('li').not($ts_thumbnails),
							total_elems			= $nav_elems.length,
							$ts_preview_wrapper	= $ts_thumbnails.children('.ts_preview_wrapper'),
							$arrow				= $ts_thumbnails.children('span'),
							$ts_preview			= $ts_preview_wrapper.children('.ts_preview');
						
						/*
						calculate sizes for $ts_thumbnails:
						width 	-> width thumbnail + border (2*5)
						height 	-> height thumbnail + border + triangle height(6)
						top		-> -(height plus margin of 5)
						left	-> leftDot - 0.5*width + 0.5*widthNavDot 
							this will be set when hovering the nav,
							and the default value will correspond to the first nav dot	
						*/
						var w_ts_thumbnails	= o.thumb_width + 2*5,
							h_ts_thumbnails	= o.thumb_height + 2*5 + 6,
							t_ts_thumbnails	= -(h_ts_thumbnails + 5),
							$first_nav		= $nav_elems.eq(0),
							l_ts_thumbnails	= $first_nav.position().left - 0.5*w_ts_thumbnails + 0.5*$first_nav.width();
						
						$ts_thumbnails.css({
							width	: w_ts_thumbnails + 'px',
							height	: h_ts_thumbnails + 'px',
							top		: t_ts_thumbnails + 'px',
							left	: l_ts_thumbnails + 'px'
						});
						
						/*
						calculate the top and left for the arrow of the tooltip
						top		-> thumb height + border(2*5)
						left	-> (thumb width + border)/2 -width/2
						*/
						var t_arrow	= o.thumb_height + 2*5,
							l_arrow	= (o.thumb_width + 2*5) / 2 - $arrow.width() / 2;
						$arrow.css({
							left	: l_arrow + 'px',
							top		: t_arrow + 'px'
						});
						
						/*
						calculate the $ts_preview width -> thumb width times number of thumbs
						*/
						$ts_preview.css('width' , total_elems*o.thumb_width + 'px');
						
						/*
						set the $ts_preview_wrapper width and height -> thumb width / thumb height
						*/
						$ts_preview_wrapper.css({
							width	: o.thumb_width + 'px',
							height	: o.thumb_height + 'px'
						});
						
						//hover the nav elems
						$nav_elems.bind('mouseenter',function(){
							var $nav_elem	= $(this),
								idx			= $nav_elem.index();
								
							/*
							calculate the new left
							for $ts_thumbnails
							*/
							var new_left	= $nav_elem.position().left - 0.5*w_ts_thumbnails + 0.5*$nav_elem.width();
							
							$ts_thumbnails.stop(true)
										  .show()	
										  .animate({
											left	: new_left + 'px'
										  },o.speed,o.easing);				  
							
							/*
							animate the left of the $ts_preview to show the right thumb 
							*/
							$ts_preview.stop(true)
									   .animate({
											left	: -idx*o.thumb_width + 'px'
									   },o.speed,o.easing);
							
							//zoom in the thumb image if zoom is true
							if(o.zoom && o.zoomratio > 1){
								var new_width	= o.zoomratio * o.thumb_width,
									new_height	= o.zoomratio * o.thumb_height;
								
								//increase the $ts_preview width in order to fit the zoomed image
								var ts_preview_w	= $ts_preview.width();
								$ts_preview.css('width' , (ts_preview_w - o.thumb_width + new_width)  + 'px');
								
								$ts_preview.children().eq(idx).find('img').stop().animate({
									width		: new_width + 'px',
									height		: new_height + 'px'
								},o.zoomspeed);
							}		
							
						}).bind('mouseleave',function(){
							//if zoom set the width and height to defaults
							if(o.zoom && o.zoomratio > 1){
								var $nav_elem	= $(this),
									idx			= $nav_elem.index();
								$ts_preview.children().eq(idx).find('img').stop().css({
									width	: o.thumb_width + 'px',
									height	: o.thumb_height + 'px'	
								});	
							}
							
							$ts_thumbnails.stop(true)
										  .hide();
										  
						}).bind('click',function(){
							var $nav_elem	= $(this),
								idx			= $nav_elem.index();
							
							o.onClick(idx);
						});
						
					});
				};
				$.fn.thumbnailSlider.defaults = {
					speed		: 100,//speed of each slide animation
					easing		: 'jswing',//easing effect for the slide animation
					thumb_width	: 75,//your photos width
					thumb_height: 75,//your photos height
					zoom		: false,//zoom animation for the thumbs
					zoomratio	: 1.3,//multiplicator for zoom (must be > 1)
					zoomspeed	: 15000,//speed of zoom animation
					onClick		: function(){return false;}//click callback
				};
			})(jQuery);
		</script>
		<script type="text/javascript">
			$(function() {
				//demo1
				$('#demo1').thumbnailSlider();
				//demo2
				$('#demo2').thumbnailSlider({
					thumb_width	: 130,
					thumb_height: 87,
					easing		: 'easeOutExpo',//easeInBack
					speed		: 600
				});
				//demo3
				$('#demo3').thumbnailSlider({
					thumb_width	: 174,
					thumb_height: 260,
					speed		: 200
				});
				//demo4
				$('#demo4').thumbnailSlider({
					thumb_width	: 174,
					thumb_height: 260,
					speed		: 200,
					zoom		: true,
					zoomspeed	: 3000,
					zoomratio	: 1.7
				});
			});
        </script>

	{/literal}
		

<!--[if lt IE 7]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/images/upgrade.jpg" border="0"  alt="" /></a>
    </div>
<![endif]-->




{literal}
<script>
	$(function(){
	// zen button hover
	$(".btn1").hover(function(){
		$(this).find("a").stop().animate({opacity:0.5}, "fast") 
	}, function(){
		$(this).find("a").stop().animate({opacity:1}, "fast")
	});
});
</script>{/literal}
</head>



<body id="indexBody">





    <div id="header">
	
		<div class="top-head">
			<div class="main-width2">
			  <div class="wrapper">		<!-- Вход пользователя -->
			      <div class="navigation">
				     {if $user}
					 &gt; &nbsp; <a href="/simpla/">Главная</a>
				<span id="username">&nbsp; &gt; &nbsp;
					<a href="user">{$user->name}</a>{if $group->discount>0},
					ваша скидка &mdash; {$group->discount}%{/if}
				</span>
				&nbsp; &gt; &nbsp;<a id="logout" href="user/logout">выйти</a>
			{else}
				     &gt; &nbsp; <a href="/simpla/">Главная</a>
				      
				      				      &nbsp; &gt; &nbsp; <a href="./user/login">Вход</a>  
				       &nbsp; &gt; &nbsp; <a href="./user/register">Регистрация</a>  {/if}
				      						     </div>
				      				    	<!-- Вход пользователя (The End)-->


		     
				  {* Выбор валюты только если их больше одной *}
			{if $currencies|count>1}
			
			 <div class="currencies">
				      <!-- ========== CURRENCIES ========= -->
					    			    <div>
					      Валюта &nbsp;
					      
					      					   <ul>
					{foreach from=$currencies item=c}
					{if $c->enabled} 
					<li class="{if $c->id==$currency->id}selected{/if}"><a href='{url currency_id=$c->id}'>{$c->name|escape}</a></li>
					{/if}
					{/foreach}
				</ul>    </div>{/if}
				      <!-- ====================================== -->
			      </div>

			  </div>
		  </div></div>
		<div class="wrapper">
			<div class="main-width2">
			<div class="head-main">
				<div class="logo">
					
						<a href="http://on.cv.ua/simpla/"><img src="design/{$settings->theme}/images/logo.jpg" alt="" width="302" height="109" /></a><br>
						<a href="http://zingaya.com/widget/3e5dc2e0b0c0f40368e1b36bb3cdf592" onclick="window.open(this.href+'?referrer='+escape(window.location.href), '_blank', 'width=236,height=220,resizable=no,toolbar=no,menubar=no,location=no,status=no'); return false" class="zingaya_button"></a>
					
				</div>
				<div class="head-banner">
					
													<div id="bannerFour">
													
													<a href="#"><img src="design/{$settings->theme}/images/banner4.jpg" alt="Доставка Наложенным платежом Новая Почта" title="Доставка Наложенным платежом Новая Почта" width="342" height="90" /></a>
													</div>
													
										
				</div>
				<div class="head-right">
				<div id="cart_informer">
					{* Обновляемая аяксом корзина должна быть в отдельном файле *}
			{include file='cart_informer.tpl'}
			</div>

				<!-- Поиск-->
			<div class="search">
				<form action="products"><span class="corner"></span>

					<input class="input1" type="text" name="keyword" value="{$keyword}" placeholder="Поиск товара"/>
					<input type="image" src="design/{$settings->theme}/images/buttons/search.gif" alt="Search" title=" Search " class="input2"  />		
				</form>
			</div>
			<!-- Поиск (The End)-->
	
					
				</div>
			  </div>
				<div class="box2">

				<div class="menu">
						
													<div id="navEZPagesTop"> 
  <ul> 
     
                <li class="selected item_1"> 
                    <a href="http://on.cv.ua/simpla/"> 
						<span class="icon"></span>
                        <span class="ttx"> 
                            <span>Главная</span> 
                        </span> 
                    </a> 
                </li> 
             
                <li class="item_2"> 
                    <a href="http://www.tehno-svit.com/catalog/%D0%94%D1%80%D0%B5%D0%BB%D0%B8"> 
						<span class="icon"></span>
                        <span class="ttx"> 
                            <span>Новые Продукты</span> 
                        </span> 
                    </a> 
                </li> 
             
                <li class="item_3"> 
                    <a href="http://www.tehno-svit.com/catalog/%D0%94%D1%80%D0%B5%D0%BB%D0%B8"> 
						<span class="icon"></span>
                        <span class="ttx"> 
                            <span>Хит</span> 
                        </span> 
                    </a> 
                </li> 
             
                <li class="item_4"> 
                    <a href="http://www.tehno-svit.com/catalog/%D0%94%D1%80%D0%B5%D0%BB%D0%B8"> 
						<span class="icon"></span>
                        <span class="ttx"> 
                            <span>Каталог</span> 
                        </span> 
                    </a> 
                </li> 
             
                <li class="item_5"> 
                    <a href="http://www.tehno-svit.com/o_nas"> 
						<span class="icon"></span>
                        <span class="ttx"> 
                            <span>О Нас</span> 
                        </span> 
                    </a> 
                </li> 
             
                <li class="item_6"> 
                    <a href="http://www.tehno-svit.com/contact"> 
						<span class="icon"></span>
                        <span class="ttx"> 
                            <span>Контакты</span> 
                        </span> 
                    </a> 
                </li> 
             
                <li class="item_7"> 
                    <a href="http://www.tehno-svit.com/mail"> 
						<span class="icon"></span>
                        <span class="ttx"> 
                            <span>Помощь</span> 
                        </span> 
                    </a> 
                </li> 
             
  </ul> 
</div>
												
				</div>
			</div>
			
			<div class="main-width">	
									
			  </div>
			</div>
			
			</div>
</div>
	</div>

	   





                
    



<div class="main-width2">
<div class="main-width">
<div class="table">
<table border="0" cellspacing="0" cellpadding="0" width="100%" id="contentMainWrapper">
	<tr>
    
				
            <td id="column-left" style="width:230px;">
				<div style="width:230px;">
					                     <!--// bof: categories //-->
        <div class="box" id="categories" style="width:230px;">

            <div class="box-bottom">
				<div class="box-top">
					<div class="box-right">
						<div class="box-left">
							<div class="box-bottom-right">
								<div class="box-bottom-left">
									<div class="box-top-right">
										<div class="box-top-left">
										
											<div class="box-head">
												Категории											</div>
			
											<div class="box-body">
												<div id="categoriesContent" class="sideBoxContent">


{* Рекурсивная функция вывода дерева категорий *}
			{function name=categories_tree}
			{if $categories}
			<ul>
			{foreach $categories as $c}
				{* Показываем только видимые категории *}
				{if $c->visible}
					<li class="category-top">
						{if $c->image}<img src="{$config->categories_images_dir}{$c->image}" alt="{$c->name}">{/if}
						<span class="top-span"><a class="category-top" {if $category->id == $c->id}class="selected"{/if} href="catalog/{$c->url}" data-category="{$c->id}">{$c->name}</a>
						{categories_tree categories=$c->subcategories}<span class="category-subs-parent">
					</li>
				{/if}
			{/foreach}
			</ul>
			{/if}
			{/function}
			{categories_tree categories=$categories}


</div>											</div> 
			
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            
        </div>

        <div class="box" id="manufacturers" style="width:230px;">

            <div class="box-bottom">
				<div class="box-top">
					<div class="box-right">
						<div class="box-left">
							<div class="box-bottom-right">
								<div class="box-bottom-left">
									<div class="box-top-right">
										<div class="box-top-left">
										
											<div class="box-head">
												<label>Бренды</label>											</div>
			
											<div class="box-body">
											
<!-- Все бренды -->
			{* Выбираем в переменную $all_brands все бренды *}
			{get_brands var=all_brands}
			{if $all_brands}
<ul>
				{foreach $all_brands as $b}	
				<li class="category-top">
					{if $b->image}
					<span class="top-span"><a class="category-top" href="brands/{$b->url}"><img src="{$config->brands_images_dir}{$b->image}" alt="{$b->name|escape}"></a>
					{else}
											<div id="manufacturersContent" class="sideBoxContent centeredContent"><span class="lbl"></span>
 <span class="top-span"><a class="category-top" href="brands/{$b->url}">{$b->name}</a>
</li>

{/if}
				{/foreach}</ul></div>									
			{/if}



									</div> 
			
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            
        </div>

        <div class="box" id="bestsellers" style="width:230px;">

            <div class="box-bottom">
				<div class="box-top">
					<div class="box-right">
						<div class="box-left">
							<div class="box-bottom-right">
								<div class="box-bottom-left">
									<div class="box-top-right">
										<div class="box-top-left">
										
											<div class="box-head">
												Вы просматривали:										</div>
			
											<div class="box-body">
												<div id="bestsellersContent" class="sideBoxContent">
<div class="wrapper">

<!-- Просмотренные товары -->
			{get_browsed_products var=browsed_products limit=7}
			{if $browsed_products}
			
			
				<ol>
				{foreach $browsed_products as $browsed_product}
					<li>
					<a href="products/{$browsed_product->url}"><span class="img"><img src="{$browsed_product->image->filename|resize:211:141}" alt="{$browsed_product->name}" title="{$browsed_product->name}"></span>{$browsed_product->name}</a>
					</li>
				{/foreach}
				</ol>
			{/if}
			<!-- Просмотренные товары (The End)-->

</div>
</div>											</div> 
			
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            
        </div>
<center>
<a href="http://www.tehno-svit.com" style="text-decoration: none; color:#A9A9A9;" target="_blank">Техно Свит Электроинструмент Украина</a>
</center>
                </div>
            </td>
            
		

	
  <td id="column-center" valign="top">
			            	<div class="slider">
					<ul class="items">
						<li>



							<!-- BOF- BANNER #1 display -->
														
								<div id="bannerOne"><a href="#"><img src="design/{$settings->theme}/images/banner1.jpg" alt="{$product->name|escape}" title="{$product->name|escape}" width="710" height="337" /></a></div>
								<div class="banner wrapper">
									<div class="info">
										<a href="cart?variant=342&submit.x=24&submit.y=11">DEWALT</a>
										<span>Miter Saw DW715</span>
									</div>
									
									<div class="price-info">
										<div class="price2">
											<strong><em>UAH</em>11111</strong>
										</div>
										<div class="btn1"><a href="cart?variant=342&submit.x=24&submit.y=11"></a></div>
										
						
									</div>
								</div>
												
		<!-- Выбор варианта товара (The End) -->
	
				
														
														<!-- EOF- BANNER #1 display -->
							
						</li>
						<li>
							
																	<div id="bannerTwo"><a href="#"><img src="design/{$settings->theme}/images/banner2.jpg" alt="DEWALT Miter Saw DW715" title=" DEWALT Miter Saw DW715 " width="710" height="337" /></a></div>
										<div class="banner wrapper">
									<div class="info">
										<a href="cart?variant=342&submit.x=24&submit.y=11">DEWALT</a>
										<span>Miter Saw DW715</span>
									</div>
									<div class="price-info">
										<div class="price2">
											<strong><em>UAH</em>799.99</strong>
										</div>
										<div class="btn1"><a href="cart?variant=342&submit.x=24&submit.y=11"></a></div>
									</div>
								</div>
														
						</li>
						<li>
							
																	<div id="bannerThree"><a href="#"><img src="design/{$settings->theme}/images/banner3.jpg" alt="Hitachi CM4SB2 4 Dry-Cut Masonry Saw" title=" Hitachi CM4SB2 4 Dry-Cut Masonry Saw " width="710" height="337" /></a></div>
										<div class="banner wrapper">
									<div class="info">
										<a href="cart?variant=342&submit.x=24&submit.y=11">Hitachi</a>
										<span>CM4SB2 4" Dry-Cut Masonry Saw</span>
									</div>
									<div class="price-info">
										<div class="price2">
											<strong><em>UAH</em>499.99</strong>
										</div>
										<div class="btn1"><a href="cart?variant=342&submit.x=24&submit.y=11"></a></div>
									</div>
								</div>
														
						</li>
					</ul>
                </div>
 


		
    
                            <div class="column-center-padding">
                
                  
                
                        
    
                    
						<div class="centerColumn" id="indexDefault">
	





<div id="indexDefaultMainContent"></div>


{$content}







               <a href="http://www.tehno-svit.com" style="text-decoration: none; color:#A9A9A9;" target="_blank">Техно Свит Электроинструмент Украина</a>
                
                	<div class="clear"></div>
                    
                    
                
                </div>
                
                
                
                    
                
            </td>
			
		        
    </tr>
</table>
</div>







   
       
<div id="footer">
	<div class="wrapper">
		<div class="footer-menu">
			
								
	
			{foreach name=page from=$pages item=p}
				{* Выводим только страницы из первого меню *}
				{if $p->menu_id == 1}
				 {if $page && $page->id == $p->id}&nbsp;&nbsp;&nbsp;&nbsp;{/if}
					<a data-page="{$p->id}" href="{$p->url}">{$p->name|escape}</a>&nbsp;&nbsp;&nbsp;&nbsp;
				
				{/if}
			{/foreach}
		
							
		</div>
		<div class="copyright">
			
				Copyright &copy; 2012 <a href="http://tehno-svit.com" target="_blank">Техно Свит</a>. Powered by <a href="http://www.tehno-svit.com" target="_blank">TSvit</a>
		
							
		</div>
		<div></div>
	</div>
</div>



<!-- ============================ -->



<!--bof- parse time display -->
<!--eof- parse time display -->



<!-- BOF- BANNER #6 display -->
<!-- EOF- BANNER #6 display -->




<!-- ========== IMAGE BORDER BOTTOM ========== -->

    </div>
</div>

<!-- ========================================= --><br><br><br><br><br><br><br>
<center>
<a href="http://www.tehno-svit.com" style="text-decoration: none;" target="_blank">Техно Свит Электроинструмент Украина</a>
</center>
</body></html>



