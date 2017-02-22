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
});
</script>
{/literal}
<!-- Хлебные крошки /-->
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
<!-- Хлебные крошки #End /-->

<h1 data-product="{$product->id}">{$product->name|escape}
                    <div class="testRater" id="product_{$product->id}">
                    	<div class="statVal">
                    		<span class="rater">
                    			<span class="rater-starsOff" style="width:115px;">
                    				<span class="rater-starsOn" style="width:{$product->rating*115/5|string_format:"%.0f"}px"></span>
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
<div class="product">

	<!-- Большое фото -->
	{if $product->image}
	<div class="imagez">
		<a href="{$product->image->filename|resize:800:600:w}" class="zoom" data-rel="group"><img src="{$product->image->filename|resize:350:350}" alt="{$product->product->name|escape}" /></a>
	</div>
	{/if}
	<!-- Большое фото (The End)-->

	<!-- Описание товара -->
	<div class="description">
		{$product->body}
            <div class="compare">
    <form action="/compare" class="compare">
    {if $compare_informer->items_id[{$product->id}]>0}
    В списке <a href="/compare/">сравнения</a>
    {else}
    <input id="compare_{$product->id}" name="compare" value="{$product->id}" type="checkbox" />
    <label for="compare_{$product->id}" style="border-bottom: 1px dashed #000; cursor: pointer">Добавить к сравнению</label>
    {/if}
    </form>
    </div>	
	</div>
    		{if $product->variants|count > 0}
		<!-- Выбор варианта товара -->
        <div class="forma">
		<form class="variants" action="/cart" style="position:relative;">
			<table>
			{foreach $product->variants as $v}
			<tr class="variant">
				<td>
					<input id="product_{$v->id}" name="variant" value="{$v->id}" type="radio" class="variant_radiobutton" {if $product->variant->id==$v->id}checked{/if} {if $product->variants|count<2}style="display:none;"{/if}/>
				</td>
				<td>
					{if $v->name}<label class="variant_name" for="product_{$v->id}">{$v->name}</label>{/if}
				</td>
				<td>
					{if $v->compare_price > 0}<span class="old_prices">{$v->compare_price|convert}</span>{/if}
					<span class="pricec">Цена: {$v->price|convert} <span class="currency">{$currency->sign|escape}</span></span>
				</td>
			</tr>
			{/foreach}
			</table>
            <a id="ask" href="{$product->id}" onclick="return false;" class="but2">Задать вопрос по товару.</a>
			<input type="submit" class="but1" value="в корзину" data-result-text="добавлено"/>
		</form>
		<!-- Выбор варианта товара (The End) -->
		{else}
			Нет в наличии
		{/if}

        <form class="foo" style="display:none;"><label style="margin-bottom:5px;" class="tname">{$product->name|escape}</label>
        {literal}
        <input type="text" name="uname" value="Ваше имя:" onclick="if(this.value=='Ваше имя:'){this.value=''}" onblur="if(this.value==''){this.value='Ваше имя:'}" />
        <input type="text" name="mail" value="Ваш e-mail:" onclick="if(this.value=='Ваш e-mail:'){this.value=''}" onblur="if(this.value==''){this.value='Ваш e-mail:'}" />
        <textarea name="sabj" class="subg" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">Текст Вопроса...</textarea>
        <label id="infa"></label>
        </form>
        {/literal}
       </div>
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
	
	{if $product->features}
	<!-- Характеристики товара -->
	<h2 style="background-color:#fff;">Характеристики: </h2>
	<ul class="features">
    <h2>Программные функции</h2>
	{foreach $product->features as $f}
	<li>
		<label>{$f->name}</label>
		<span class="infa">{$f->value}</span>
	</li>
	{/foreach}
	</ul>
	<!-- Характеристики товара (The End)-->
	{/if}
    
    {if !empty($product->youtube)}
        <iframe class="youtube" title="YouTube video player" width="744" height="388" src="http://www.youtube.com/embed/{$product->youtube}?rel=0&amp;wmode=transparent" frameborder="0" allowfullscreen=""></iframe>
    {/if}
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
<h2>Так же советуем посмотреть</h2>
<!-- Список каталога товаров-->
<ul class="shop4">
	{foreach $related_products as $product}
	<!-- Товар-->
	<li class="product">
		<div id="tov">
		<!-- Фото товара -->
		{if $product->image}
		<div class="image">
			<a href="products/{$product->url}"><img src="{$product->image->filename|resize:150:150}" alt="{$product->name|escape}"/></a>
		</div>
		{/if}
		<!-- Фото товара (The End) -->

		<!-- Название товара -->
		<h3><a data-product="{$product->id}" href="products/{$product->url}">{$product->name|escape}</a></h3>
		<!-- Название товара (The End) -->

		{if $product->variants|count > 0}
		<!-- Выбор варианта товара -->
		<form class="variants" action="/cart">
			<table>
			{foreach $product->variants as $v}
			<tr class="variant">
				<td>
					{if $v->compare_price > 0}<span class="compare_price">{$v->compare_price|convert}</span>{/if}
					<span class="price">{$v->price|convert} <span class="currency">{$currency->sign|escape}</span></span>
				</td>
			</tr>
			{/foreach}
			</table>
			<input type="submit" class="button" value="купить" data-result-text="добавлено"/>
		</form>
		<!-- Выбор варианта товара (The End) -->
		{else}
			Нет в наличии
		{/if}

    </div>
	</li>
	<!-- Товар (The End)-->
	{/foreach}
</ul>
{/if}
<!--Роллик к товару с youtube.com--!>
<script type="text/javascript">
$(function(){
   $('#addc').toggle(function(){
   $('.comment_form').css('display','block');
   return false; 
   },function(){
   $('.comment_form').css('display','none'); 
   }); 
});
</script>
<!-- Комментарии -->
<a href="#" id="addc" class="but3">Оставить комментарий</a>
<div id="comments">

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
	<form class="comment_form" method="post"  style="display:none;">
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

{literal}
<script>
$(function() {
	// Раскраска строк характеристик
	$(".features li:even").addClass('even');

	// Зум картинок
	$("a.zoom").fancybox({ 'hideOnContentClick' : true });
});
</script>
{/literal}
