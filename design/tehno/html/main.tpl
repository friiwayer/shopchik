{* Главная страница магазина *}

{* Для того чтобы обернуть центральный блок в шаблон, отличный от index.tpl *}
{* Укажите нужный шаблон строкой ниже. Это работает и для других модулей *}
{$wrapper = 'index.tpl' scope=parent}

{* Заголовок страницы *}
<h1>{$page->header}</h1>

{* Тело страницы *}
{$page->body}


{* Рекомендуемые товары *}
{get_featured_products var=featured_products}
{if $featured_products}
<!-- Список товаров-->



  

<!-- bof: featured products  -->

	  
	  <div class="centerBoxWrapper" id="featuredProducts">
	  <h2 class="centerBoxHeading">Рекомендуемые Электроинструменты</h2>
	  
	  {foreach $featured_products as $product}
    <div class="centerBoxContentsFeatured centeredContent back" style="width:33%;"><div class="product-col" >
<li class="product">
	<!-- Фото товара -->
		{if $product->image}
		<div class="img">
			<a href="products/{$product->url}"><img src="{$product->image->filename|resize:211:141}" alt="{$product->name|escape}" title="{$product->name|escape}"/></a>
		</div>
		{else}
			<div class="img">
			<a href="products/{$product->url}"><img src="design/{$settings->theme}/images/nofoto.jpg" alt="{$product->name|escape}" title="{$product->name|escape}"/></a>
			</div>
		{/if}
			<!-- Фото товара (The End) -->
				<div class="prod-info">
				<!-- Название товара -->
		<a class="name" data-product="{$product->id}" href="products/{$product->url}">{$product->name|escape}</a>
		<!-- Название товара (The End) -->
					<div class="text">
		{if $product->variants|count > 0}
		<!-- Выбор варианта товара -->
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
					{if $v->compare_price > 0}<span class="compare_price">{$v->compare_price|convert}</span>{/if}
				</td>
			</tr>
			
			</table>
					</div>
					<div class="wrapper">
						<div class="price">
							<strong>{$v->price|convert} {$currency->sign|escape}</strong>
						</div>
						<div class="button">
						<input type='image' src='design/{$settings->theme}/images/buttons/button_add_to_cart.png' name='submit' class="buttonRow"  data-result-text='добавлено'>
						
						 
						</div>
						</form>
					</div>
				</div>
			</div></div>
   			
			{/foreach}
		<!-- Выбор варианта товара (The End) -->
		{else}
			Нет в наличии
		{/if}
		
  </li>

 
</div>

{/foreach}{/if}<br class="clearBoth" />
 
</div>


<!-- eof: featured products  -->




<!-- bof: new products  -->
<div class="centerBoxWrapper" id="featuredProducts">

	  <h2 class="centerBoxHeading">Новинки Электроинструменты 2012 г.</h2>
	  {get_new_products var=new_products limit=3}
{if $new_products}
{foreach $new_products as $product}
    <div class="centerBoxContentsFeatured centeredContent back" style="width:33%;"><div class="product-col" >

	<!-- Фото товара -->
		{if $product->image}
		<div class="img">
			<a href="products/{$product->url}"><img src="{$product->image->filename|resize:211:141}" alt="{$product->name|escape}" title="{$product->name|escape}"/></a>
		</div>
		{else}
			<div class="img">
			<a href="products/{$product->url}"><img src="design/{$settings->theme}/images/nofoto.jpg" alt="{$product->name|escape}" title="{$product->name|escape}"/></a>
			</div>
			{/if}
		<!-- Фото товара (The End) -->
				<div class="prod-info">
				<!-- Название товара -->
		<a class="name" data-product="{$product->id}" href="products/{$product->url}">{$product->name|escape}</a>
		<!-- Название товара (The End) -->
					<div class="text">

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
					{if $v->compare_price > 0}<span class="compare_price">{$v->compare_price|convert}</span>{/if}
				</td>
			</tr>
			
			</table>
					</div>
					<div class="wrapper">
						<div class="price">		
					
							<strong>{$v->price|convert} {$currency->sign|escape}</strong>
						</div>
						<div class="button"><input type='image' src='design/{$settings->theme}/images/buttons/button_add_to_cart.png' name='submit' class="buttonRow" data-result-text='добавлено'></div>
						</form>
					</div>
				</div>
			</div></div>
   			
			{/foreach}
		<!-- Выбор варианта товара (The End) -->
		{else}
			Нет в наличии
		{/if}
		
  

 
</div>{/foreach}{/if}<div class="clear"></div>

<!-- eof: new products  -->


<!-- bof: hits products  -->
<div class="centerBoxWrapper" id="featuredProducts">

	  <h2 class="centerBoxHeading">Электроинструмент со скидкой</h2>
{get_discounted_products var=discounted_products limit=9}
{if $discounted_products}
	{foreach $discounted_products as $product}
    <div class="centerBoxContentsFeatured centeredContent back" style="width:33%;"><div class="product-col" >

	<!-- Фото товара -->
		{if $product->image}
		<div class="img">
			<a href="products/{$product->url}"><img src="{$product->image->filename|resize:211:141}" alt="{$product->name|escape}" title="{$product->name|escape}"/></a>
		</div>
		{else}
			<div class="img">
			<a href="products/{$product->url}"><img src="design/{$settings->theme}/images/nofoto.jpg" alt="{$product->name|escape}" title="{$product->name|escape}"/></a>
			</div>
		
		{/if}
		<!-- Фото товара (The End) -->
				<div class="prod-info">
				<!-- Название товара -->
		<a class="name" data-product="{$product->id}" href="products/{$product->url}">{$product->name|escape}</a>
		<!-- Название товара (The End) -->
					<div class="text">
		{if $product->variants|count > 0}
		<!-- Выбор варианта товара -->
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
					{if $v->compare_price > 0}<span class="compare_price">{$v->compare_price|convert}</span>{/if}
				</td>
			</tr>
			</table>
			
					</div>
					<div class="wrapper">
						<div class="price">
							<strong>{$v->price|convert} {$currency->sign|escape}</strong>
						</div>
						<div class="button"><input type='image' src='design/{$settings->theme}/images/buttons/button_add_to_cart.png' name='submit' class="buttonRow" data-result-text='добавлено'></div>
						
					</div>
				</div>
			</div></div>
   			
			{/foreach}
		<!-- Выбор варианта товара (The End) -->
		{else}
			Нет в наличии
		{/if}
		
  

 
</div>{/foreach}{/if}
<!-- eof: hits products  -->

