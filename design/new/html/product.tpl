{* Страница товара *}
{literal}
<script type="text/javascript">
$(document).ready(function(){
    $('.images a').hover(function(){
       var big = $(this).attr('href');
       var small = $(this).children('img').attr('src');
       $('.imagez a').attr('href',big);
       $('.imagez a img').attr('src',small);
    });
    
    $('#opis p').css({'clear':'left','paddingTop':'15px'});
});
</script>
<script type="text/javascript">
$(document).ready(function() {
		  
          
			$('div.qiwi, div.wbm, div.ya').tinyTips('blue', 'title');
			$('a.imgTip').tinyTips('blue');
			$('img.tTip').tinyTips('blue', 'title');
			$('h1.tagline').tinyTips('blue');
            
            $('.variant_radiobutton, label.variant_name').bind('click', function(){
                $('div.pricec').html($(this).parents('.variant').find('#cenac').html());
            });
            
            
            $('div.pricec').html($('.variant_radiobutton:first').parents('.variant').find('#cenac').html());
});
</script>
{/literal}


<h1 data-product="{$product->id}">{$product->name|escape}
                    <div class="testRater" id="product_{$product->id}">
                    	<div class="statVal">
                    		<span class="rater">
                    			<span class="rater-starsOff" style="width:80px;">
                    				<span class="rater-starsOn" style="width:{$product->rating*80/5|string_format:"%.0f"}px"></span>
                    			</span>
                    			<span class="test-text">
                    				<span class="rater-rating">{$product->rating|string_format:"%.1f"}</span>&#160;(голосов <span class="rater-rateCount">{$product->votes|string_format:"%.0f"}</span>)
                    			</span>
                    		</span>
                    	</div>
                    </div>
                    <script src="design/{$settings->theme|escape}/js/project.js"></script>
                    {literal}
                    <script type="text/javascript">$(function() { $('.testRater').rater({ postHref: 'ajax/rating.php' }); });</script>
                    {/literal}
</h1>
<span style="color:#888; font-size:11px;">Артикул: {$product->id}</span>
<div class="product">

<div id="tov_prod">
<span style="font-size:11.5px; float:right; position:absolute; right:5px; top:0;">предоплата 100%</span>
        {if $product->variants|count > 0}
		<!-- Выбор варианта товара -->
<div class="for">
<div style="position:absolute; top:42px;">
<span style="float:left; margin-right:10px; clear:both;">Оплатить можно: </span>
<div class="qiwi" title="<b>Оплата Qiwi</b><p>Пополнить счет можно многими способами.</p> <p>Кошелек для оплаты <b>9043662655</b></p>"></div>
<div class="wbm" title="<b>Оплата Web Money</b><p>к оплате принимаются WMZ и WMR</p><p>Кошельки для оплаты</p><p>WMR - <b>R329427801234 </b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; WMZ -<b> Z330092409911</b></p>"></div>
<div class="ya" title="<b>Оплата Яндекс деньги</b><p>Для оплаты вы должны иметь кошелек в данной системе платежей.</p>"></div>
</div>
<div class="yearg">
<span class="">1 год гарантии</span>
<div class="imgg"></div>
</div>
        	<div class="description">
            <div class="compare" style="float:left;">
    <form action="/compare" class="compare" style="position:relative;">
    {if $compare_informer->items_id[{$product->id}]>0}
    В списке <a href="/compare/">сравнения</a>
    {else}
    <input id="compare_{$product->id}" name="compare" style="position: absolute; top: 3px;" value="{$product->id}" type="checkbox" />
    <label for="compare_{$product->id}" style="border-bottom: 1px dashed #000; cursor: pointer; padding-left: 15px;">к сравнению</label>
    {/if}
    </form>
    </div>	
	</div>
		<form class="variants" action="/cart" style="">
			<table class="variantss">
			{foreach $product->variants as $v}
            {if $v->d_day && $v->dprice!=0}
            <script type="text/javascript" src="design/{$settings->theme}/js/jquery.countdown.js"></script>            
            <div class="discc">
            <span style="" class="ded">{$v->dprice|convert} {$currency->sign|escape} </span> 
            <span id="compact" class="prica">{$v->d_day}</span>
            </div>
            {/if}            
            <div style="position:absolute; top:4px;">
            <label>
            <span>
            <b style="color:green; font-size:14px;">Почта России</b> - Доставка из Китая.
            </span>
            </label>
            </div>
			<tr class="variant">            
				<td>
					<input id="product_{$v->id}" name="variant" value="{$v->id}" type="radio" class="variant_radiobutton" {if $product->variant->id==$v->id}checked{/if} {if $product->variants|count<2}style="display:none;"{/if}/>
				</td>
				<td>
					{if $v->name}<label class="variant_name" for="product_{$v->id}">{$v->name}</label>{/if}
				</td>
				<td>
                    <span class="def_price" style="display:none;">{$v->price|convert}</span>
                    {if $product->variants|count > 1}<span class="">{$v->price|convert} <span class="currency">{$currency->sign|escape}</span></span>{else}{/if}
                    <div id="cenac" style="display:none;"><span class="pricec">{$v->price|convert} <span class="currency">{$currency->sign|escape}</span></span></div>					                                 
				</td>
			</tr>                
            <div class="pricec"><span class="pricec">{$v->price|convert} <span class="currency">{$currency->sign|escape}</span></span></div>               
            {if $v->compare_price > 0}<span class="old_prices">{$v->compare_price|convert}</span>{/if}
			{/foreach}
			</table>
            <noindex><a id="ask" rel="nofollow" href="{$product->id}" onclick="return false;" class="but2">Задать вопрос по товару.</a></noindex>
			<input type="submit" class="buttonq" value="Добавить в корзину" data-result-text="добавлено"/>
		</form>
		<!-- Выбор варианта товара (The End) -->
		{else}
            <div class="forma">
			<p style="position:absolute; right:0; top:50px;">Нет в наличии</p>
		{/if}
<div class="b-overlay" style="display: none;">
<div class="b-popups skin_default scheme_default shadow_on mod_report" style="top: 108px;">
    <div class="b-popup-h">
        <div class="b-popup-close"></div>
        <div class="b-popup-head">
            <div class="b-popup-head-h">
                <div class="head-title">Задать вопрос</div>
            </div>
        </div>
        <div class="b-popup-body">
            <div class="b-popup-body-h">                    
        <form method="post" class="foo">
        <label> по товару <b>{$product->name}</b></label>
        <input type="hidden" name="tov_id" value="{$product->id}" />
        <input type="hidden" value="{$product->name}" name="productz" />        
        {literal}
        <input type="text" name="uname" value="Ваше имя:" onclick="if(this.value=='Ваше имя:'){this.value=''}" onblur="if(this.value==''){this.value='Ваше имя:'}" />
        <input type="text" class="imail" name="mail" value="Ваш e-mail:" onclick="if(this.value=='Ваш e-mail:'){this.value=''}" onblur="if(this.value==''){this.value='Ваш e-mail:'}" />
        <textarea name="sabj" class="subg" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">Текст Вопроса...</textarea>
        <input type="submit" name="send" value="отправить" id="bobo" />                            
        </form>
        {/literal}        
        </div>
    </div>
</div>
</div>
</div>        
        
       </div>
       <table class="cart">
       <tr>
       <td></td>
       <td></td>
       </tr>
       <tr>
       <td></td>
       </tr>
       </table>
</div>
<div class="dostav">
<span style="font-size:11.5px; line-height:27px; float:left; position:absolute; left:5px; top:0;">Доставка 15-60 дней.</span>
</div>
<div class="nali">
<span style="font-size:11.5px; line-height:27px; float:left; position:absolute; left:5px; top:0;">Товар есть в наличии</span>
</div>
	<!-- Большое фото -->
	{if $product->image}
	<div class="imagez">
		<a href="{$product->image->filename|resize:800:600:w}" class="zoom" data-rel="group"><img src="{$product->image->filename|resize:350:350}" alt="{$product->product->name|escape}" /></a>
	</div>
	{/if}
	<!-- Большое фото (The End)-->

	<!-- Описание товара -->


	<!-- Описание товара (The End)-->

	<!-- Дополнительные фото продукта -->
	{if $product->images|count>1}
	<div class="images">
		{* cut удаляет первую фотографию, если нужно начать 2-й - пишем cut:2 и тд *}
		{foreach $product->images as $i=>$image}
			<a href="{$image->filename|resize:800:600:w}" class="zoom" data-rel="group"><img src="{$image->filename|resize:350:350}" width="95" alt="{$product->name|escape}" /></a>
		{/foreach}
	</div>
	{/if}
	<!-- Дополнительные фото продукта (The End)-->
    <div class="clear"></div>
	<div class="section">
	<ul class="tabz">
		<li class="current"><h2 style="" style="">Характеристики: </h2></li>
        <li><h2 style="">Описание</h2></li>
		<li><h2 style="">Видео ролик</h2></li>
		<li class=""><h2 style="">Отзывы</h2></li>
		<li><h2 style="">Комментарии</h2></li>
	</ul>
    <div class="box visible" style="display: block; ">
	{if $product->features}
	<!-- Характеристики товара -->
	<ul class="features">
    <h2>Основные Характеристики</h2>
	{foreach $product->main as $m}
	<li>
		<label>{$m->name}</label>
		<span class="infa">{$m->value}</span>
	</li>
	{/foreach}
	</ul>

	<ul class="features">
    <h2>Аппаратная часть</h2>
	{foreach $product->hards as $h}
	<li>
		<label>{$h->name}</label>
		<span class="infa">{$h->value}</span>
	</li>
	{/foreach}
	</ul>

	<ul class="features">
    <h2>Экран</h2>
	{foreach $product->display as $d}
	<li>
		<label>{$d->name}</label>
		<span class="infa">{$d->value}</span>
	</li>
	{/foreach}
	</ul>

    {if $product->net}
	<ul class="features">
    <h2>Коммуникации</h2>
	{foreach $product->net as $net}
	<li>
		<label>{$net->name}</label>
		<span class="infa">{$net->value}</span>
	</li>
	{/foreach}
	</ul>
    {/if} 

	<ul class="features">
    <h2>Мультимедия</h2>
	{foreach $product->multimedia as $mu}
	<li>
		<label>{$mu->name}</label>
		<span class="infa">{$mu->value}</span>
	</li>
	{/foreach}
	</ul>
    
    {if $product->compl}
	<ul class="features">
    <h2>Комплектация</h2>
	{foreach $product->compl as $co}
	<li>
		<label>{$co->name}</label>
		<span class="infa">{$co->value}</span>
	</li>
	{/foreach}
	</ul>
    {/if} 
                
	<!-- Характеристики товара (The End)-->
	{/if}
    </div>
    <div class="box visible" style="display: block; padding:10px;">
    <span id="opis">
    {$product->body}
    </span>
    </div>
    <div class="box visible" style="display: none; ">
    {if !empty($product->youtube)}
        <iframe class="youtube" title="YouTube video player" width="821" height="388" src="http://www.youtube.com/embed/{$product->youtube}?rel=0&amp;wmode=transparent" frameborder="0" allowfullscreen=""></iframe>
    {/if}
    </div>
    <div class="box visible" style="display: none; ">
    
    </div>
    <div class="box visible" style="display: none; ">
<!-- Комментарии -->
<div id="comments" style="padding:50px 10px 10px 10px;">
	<h2>Комментарии</h2>
	
	{if $comments}
	<!-- Список с комментариями -->
	<ul class="comment_list">
		{foreach $comments as $comment}
		<a name="comment_{$comment->id}"></a>
		<li>
			<!-- Имя и дата комментария-->
			<div class="comment_header">	
				{$comment->name|escape} <i>{$comment->date|date}, {$comment->date|time}</i>
				{if !$comment->approved}ожидает модерации</b>{/if}
			</div>
			<!-- Имя и дата комментария (The End)-->
			
			<!-- Комментарий -->
			{$comment->text|escape|nl2br}
			<!-- Комментарий (The End)-->
		</li>
		{/foreach}
	</ul>
	<!-- Список с комментариями (The End)-->
	{else}
	<p>
		Пока нет комментариев
	</p>
	{/if}
	
	<!--Форма отправления комментария-->	
	<form class="comment_form" method="post"  style="">
		<h2>Написать комментарий</h2>
		{if $error}
		<div class="message_error">
			{if $error=='captcha'}
			Неверно введена капча
			{elseif $error=='empty_name'}
			Введите имя
			{elseif $error=='empty_comment'}
			Введите комментарий
			{/if}
		</div>
		{/if}
		<textarea class="comment_textarea" id="comment_text" name="text" data-format=".+" data-notice="Введите комментарий">{$comment_text}</textarea><br />
		<div>
		<label for="comment_name">Имя</label>
		<input class="input_name" type="text" id="comment_name" name="name" value="{$comment_name}" data-format=".+" data-notice="Введите имя"/><br />

		<input class="button" type="submit" name="comment" value="Отправить" />
		
		<label for="comment_captcha">Число</label>
		<div class="captcha"><img src="captcha/image.php?{math equation='rand(10,10000)'}" alt='captcha'/></div> 
		<input class="input_captcha" id="comment_captcha" type="text" name="captcha_code" value="" data-format="\d\d\d\d" data-notice="Введите капчу"/>
		
		</div>
	</form>
	<!--Форма отправления комментария (The End)-->
</div>
<!-- Комментарии (The End) -->    
    </div>    
    </div>
	<!-- Соседние товары /-->
	<div id="back_forward">
		{if $prev_product}
			←&nbsp;<a class="prev_page_link" href="products/{$prev_product->url}">{$prev_product->name|escape}</a>
		{/if}
		{if $next_product}
			<a class="next_page_link" href="products/{$next_product->url}">{$next_product->name|escape}</a>&nbsp;→
		{/if}
	</div>
	
</div>
<!-- Описание товара (The End)-->

{* Связанные товары *}
{if $related_products}
<div class="accesories">
<h2>Похожие товары:</h2>
<!-- Список каталога товаров-->
<ul class="">
	{foreach $related_products as $product}
	<!-- Товар-->
	<li class="produc">

		{if $product->image}
		<div class="image">
			<a href="products/{$product->url}"><img src="{$product->image->filename|resize:100:100}" alt="{$product->name|escape}" title="{$product->name|escape}"/></a>
		</div>
		{/if}


		<div class="link"><a data-product="{$product->id}" href="products/{$product->url}">{$product->name|escape}</a></div>
		

		{if $product->variants|count > 0}

		<form class="variants" action="/cart">
			<table>
			{foreach $product->variants as $v}
			<tr class="variant">
				<td>
					<input id="featured_{$v->id}" name="variant" value="{$v->id}" type="radio" class="variant_radiobutton" {if $v@first}checked{/if} {if $product->variants|count<2}style="display:none;"{/if}/>
				</td>
				<td>
					{if $v->name}<label class="variant_name" for="featured_{$v->id}">{$v->name}</label>{/if}
				</td>
				<td>
				</td>
			</tr>
			{/foreach}
			</table>
            {if $v->compare_price > 0}<span class="compare_price">{$v->compare_price|convert}</span>{/if}
			
		</form>
		{else}
			Нет в наличии
		{/if}
	</li>
	<!-- Товар (The End)-->
	{/foreach}
</ul>
</div>
{/if}

{literal}
<script>
$(function() {
	// Раскраска строк характеристик
	$("ul.features li:even").addClass('even');

	// Зум картинок
	$("a.zoom").fancybox({ 'hideOnContentClick' : true });
});
</script>
{/literal}
<script src="design/{$settings->theme}/js/jquery-nomen.js" type="text/javascript"></script>