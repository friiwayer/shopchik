{* Страница товара *}



<!--bof Product Name-->

<h1 data-product="{$product->id}" id="productName" class="productGeneral"><!-- Хлебные крошки /-->

	{$brand->name|escape} {$product->name|escape}                

<!-- Хлебные крошки #End /--></h1>
<!--eof Product Name-->


<div class="tie">
	<div class="tie-indent">
	

<div class="page-content">

<div class="wrapper">

<a  href="./">Главная</a>
	{foreach from=$category->path item=cat}
	→ <a href="catalog/{$cat->url}">{$cat->name|escape}</a>
	{/foreach}
	{if $brand}
	→ <a href="catalog/{$cat->url}/{$brand->url}">{$brand->name|escape}</a>
	{/if}
	→  {$product->name|escape}     





<!--bof Main Product Image -->

<div id="productMainImage" class="centeredContent back">
{if $product->image}
	<span class="image"><a href="{$product->image->filename|resize:800:600:w}"><img src="{$product->image->filename|resize:300:300}" alt="{$product->product->name|escape}" title="{$product->product->name|escape}" width="250" height="250" /><span class="zoom" data-rel="group"></span></a></span>
	{else}
	<span class="image"><a href="design/{$settings->theme}/images/nofoto.jpg"><img src="design/{$settings->theme}/images/nofoto.jpg" alt="{$product->product->name|escape}" title="{$product->product->name|escape}" width="250" height="250" /><span class="zoom" data-rel="group"></span></a></span>
</div><!--eof Main Product Image-->
{/if}





		<!--bof free ship icon  -->
		<!--eof free ship icon  --><br>

	<div class="name-type bot-border">{foreach from=$category->path item=cat}
	{$cat->name|escape}
	{/foreach}
	{if $brand}
	{$brand->name|escape}
	{/if}
	{$product->name|escape}</div>
	

	  


	

<!--bof Form start-->
<h2 id="productPrices" class="productGeneral">
{if $product->variants|count > 0}
		<!-- Выбор варианта товара -->
		<form class="variants" action="/cart">
			<table style="width:100%;border:1px solid;">
			{foreach $product->variants as $v}
			<tr class="variant">
				<td>
					<input id="product_{$v->id}" name="variant" value="{$v->id}" type="radio" class="variant_radiobutton" {if $v@first}checked{/if} {if $product->variants|count<2}style="display:none;"{/if}/>
				</td>
				<td>
					{if $v->name}<label class="variant_name" for="product_{$v->id}">{$v->name}</label>{/if}
				</td>
				<td>
					{if $v->compare_price > 0}<span class="compare_price">{$v->compare_price|convert}</span>{/if}
					<span class="price">{$v->price|convert} <span class="currency">{$currency->sign|escape}</span></span>
				</td>
				<td>
				<div style="padding-top:-20xp;">Купить
						<input type='image' src='design/{$settings->theme}/images/buttons/button_add_to_cart.png' name='submit' data-result-text='добавлено'>
						
						 
						</div>
				</td>
				
			</tr>
			
			{/foreach}
			</table>
		
		</form>
		<!-- Выбор варианта товара (The End) -->
		{else}
			Нет в наличии
		{/if}
<!--eof Form start-->


	
</div>
<div class="product">
<!-- Дополнительные фото продукта -->
	{if $product->images|count>1}
	<div class="image">
		{* cut удаляет первую фотографию, если нужно начать 2-й - пишем cut:2 и тд *}
		{foreach $product->images|cut as $i=>$image}
			<a href="{$image->filename|resize:800:600:w}" class="zoom" data-rel="group"><img src="{$image->filename|resize:95:95}" alt="{$product->name|escape}" /></a>
		{/foreach}
	</div>
	{/if}
	<!-- Дополнительные фото продукта (The End)-->
	 
<h1 data-product="{$product->id}" id="productName" class="productGeneral">Электроинструмент {$cat->name|escape} {$product->name|escape}</h1>

	
	<!-- Описание товара -->
<div id="productDescription" class="description biggerText"><h2>Описание:</h2>	<br>
{$product->body}	<br><br>
</div>
	<!-- Описание товара (The End)-->



	


	

	
	{if $product->features}
	<!-- Характеристики товара -->
<h2>Характеристики</h2>
	<ul class="features">
	{foreach $product->features as $f}
	<li>
		<label>{$f->name}</label>
		<span>{$f->value}</span>
	</li>
	{/foreach}
	</ul>
	<!-- Характеристики товара (The End)-->
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
<ul class="tiny_products">
	{foreach $related_products as $product}
	<!-- Товар-->
	<li class="product">
		
		<!-- Фото товара -->
		{if $product->image}
		<div class="image">
			<a href="products/{$product->url}"><img src="{$product->image->filename|resize:200:200}" alt="{$product->name|escape}"/></a>
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
					<input id="related_{$v->id}" name="variant" value="{$v->id}" type="radio" class="variant_radiobutton"  {if $v@first}checked{/if} {if $product->variants|count<2} style="display:none;"{/if}/>
				</td>
				<td>
					{if $v->name}<label class="variant_name" for="related_{$v->id}">{$v->name}</label>{/if}
				</td>
				<td>
					{if $v->compare_price > 0}<span class="compare_price">{$v->compare_price|convert}</span>{/if}
					<span class="price">{$v->price|convert} <span class="currency">{$currency->sign|escape}</span></span>
				</td>
			</tr>
			{/foreach}
			</table>
			<input type="submit" class="button" value="в корзину" data-result-text="добавлено"/>
		</form>
		<!-- Выбор варианта товара (The End) -->
		{else}
			Нет в наличии
		{/if}


	</li>
	<!-- Товар (The End)-->
	{/foreach}
</ul>
{/if}

<!-- Комментарии -->
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
	<form class="comment_form" method="post">
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
