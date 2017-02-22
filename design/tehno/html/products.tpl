{* Список товаров *}

<!-- Хлебные крошки /-->
<div id="path">
	<a href="/">Главная</a>
	{if $category}
	{foreach from=$category->path item=cat}
	→ <a href="catalog/{$cat->url}">{$cat->name|escape}</a>
	{/foreach}  
	{if $brand}
	→ <a href="catalog/{$cat->url}/{$brand->url}">{$brand->name|escape}</a>
	{/if}
	{elseif $brand}
	→ <a href="brands/{$brand->url}">{$brand->name|escape}</a>
	{elseif $keyword}
	→ Поиск Электроинструмента
	{/if}
</div>
<!-- Хлебные крошки #End /-->

 <div class="centerBoxWrapper" id="featuredProducts">

{* Заголовок страницы *}
{if $keyword}
<h1 class="centerBoxHeading">Вы Искали Электроинструмент {$keyword|escape}</h1>
{elseif $page}
<h1 class="centerBoxHeading">{$brand->name|escape} {$page->name|escape}</h1>
{else}
<h1 class="centerBoxHeading">{$category->name|escape} {$brand->name|escape} {$keyword|escape}</h1>
{/if}


{* Описание страницы (если задана) *}
{$page->body}

{if $current_page_num==1}
{* Описание категории *}
{$category->description}
{/if}

{* Фильтр по брендам *}
{if $category->brands}
<div id="brands">
	<a href="catalog/{$category->url}" {if !$brand->id}class="selected"{/if}>Все бренды</a>
	{foreach name=brands item=b from=$category->brands}
		{if $b->image}
		<img src="{$config->brands_images_dir}{$b->image}" alt="{$b->name|escape}">
		{/if}
		<a data-brand="{$b->id}" href="catalog/{$category->url}/{$b->url}" {if $b->id == $brand->id}class="selected"{/if}>{$b->name|escape}</a>
	{/foreach}
</div>
{/if}

{* Описание бренда *}
{$brand->description}

{* Фильтр по свойствам *}
{if $features}
<table id="features">
	{foreach $features as $f}
	<tr>
	<td class="feature_name" data-feature="{$f->id}">
		{$f->name}:
	</td>
	<td class="feature_values">
		<a href="{url params=[$f->id=>null, page=>null]}" {if !$smarty.get.$f@key}class="selected"{/if}>Все</a>
		{foreach $f->options as $o}
		<a href="{url params=[$f->id=>$o->value, page=>null]}" {if $smarty.get.$f@key == $o->value}class="selected"{/if}>{$o->value|escape}</a>
		{/foreach}
	</td>
	</tr>
	{/foreach}
</table>
{/if}


<!--Каталог товаров-->
{if $products}

{* Сортировка *}
{if $products|count>0}
<div class="sort">
	Сортировать по 
	<a {if $sort=='position'} class="selected"{/if} href="{url sort=position page=null}">умолчанию</a>
	<a {if $sort=='price'}    class="selected"{/if} href="{url sort=price page=null}">цене</a>
	<a {if $sort=='name'}     class="selected"{/if} href="{url sort=name page=null}">названию</a>
</div>
{/if}


{include file='pagination.tpl'}











<!-- Список товаров-->
 <div class="centerBoxWrapper" id="featuredProducts">

	{foreach $products as $product}
	<!-- Товар-->
<div class="centerBoxContentsFeatured centeredContent back" style="width:33%;"><div class="product-col" >
<li class="product">
	<!-- Фото товара -->
		{if $product->image}
		<div class="img">
			<a class="tools" href="products/{$product->url}"><img src="{$product->image->filename|resize:211:141}" alt="{$product->name|escape}" title="{$product->name|escape}"/><span class="classic"><em class="centerBoxHeading">{$product->name|escape}</em><img src="{$product->image->filename|resize:211:141}" alt="{$product->name|escape}" title="{$product->name|escape}"/><br>{$product->annotation}</span></a>
			</div>{else}
			<div class="img">
			<a class="tools" href="products/{$product->url}"><img src="design/{$settings->theme}/images/nofoto.jpg" alt="{$product->name|escape}" title="{$product->annotation}"/><span class="classic"><em class="centerBoxHeading">{$product->name|escape}</em>{$product->annotation}</span></a>
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
   			
		
	<!-- Товар (The End)-->
	{/foreach}
			
</li>


<!-- Список товаров (The End)-->

{else}
Товары не найдены
{/if}	



</div>

{/foreach}{/if}<br class="clearBoth" />
 {include file='pagination.tpl'}	
</div>
<!--Каталог товаров (The End)-->