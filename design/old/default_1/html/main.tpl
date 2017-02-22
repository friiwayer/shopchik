{* Главная страница магазина *}

{* Для того чтобы обернуть центральный блок в шаблон, отличный от index.tpl *}
{* Укажите нужный шаблон строкой ниже. Это работает и для других модулей *}
{$wrapper = 'index.tpl' scope=parent}


{* Новинки *}
{get_new_products var=new_products limit=12}
{if $new_products}
<ul class="shop4">

	{foreach $new_products as $product}

	<li class="product">
		<div id="tov">
		{if $product->image}
		<div class="image">
			<a href="products/{$product->url}"><img src="{$product->image->filename|resize:140:140}" alt="{$product->name|escape}"/></a>
		</div>
		{/if}

		<h3><a data-product="{$product->id}" href="products/{$product->url}">{$product->name|escape}</a></h3>

		{if $product->variants|count > 0}

		<form class="variants" action="/cart">
			<table>
			{foreach $product->variants as $v}
			<tr class="variant">
			     <td style="display:none;">
					<input id="featured_{$v->id}" name="variant" value="{$v->id}" type="radio" class="variant_radiobutton" {if $v@first}checked{/if} {if $product->variants|count<2}style="display:none;"{/if}/>
				</td>
				<td>
					{if $v->name}<label  style="display:none;" class="variant_name" for="featured_{$v->id}">{$v->name}</label>{/if}
				</td>
				<td style="display:none;">
					{if $v->compare_price > 0}<span class="compare_price">{$v->compare_price|convert}</span>{/if}
					<span class="price">{$v->price|convert} <span class="currency">{$currency->sign|escape}</span></span>
				</td>
			</tr>
			{/foreach}
			</table>
			<input type="submit" class="button" value="купить" data-result-text="в корзине"/>
		</form>

		{else}
			Нет в наличии
		{/if}
        </div>
	</li>

	{/foreach}
			
</ul>
{/if}

{foreach $extract_all_words as $val}
<li><a href="products/{$products->url}">{$product->name|escape}</a></li>
{/foreach}

{get_featured_products var=featured_products}
{if $featured_products}

<h1>Рекомендуемые товары</h1>
<ul class="shop4">

	{foreach $featured_products as $product}

	<li class="product">
		<div id="tov">
		{if $product->image}
		<div class="image">
			<a href="products/{$product->url}"><img src="{$product->image->filename|resize:140:140}" alt="{$product->name|escape}" title="{$product->name|escape}"/></a>
		</div>
		{/if}


		<h3><a data-product="{$product->id}" href="products/{$product->url}">{$product->name|escape}</a></h3>
		

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
					<span class="price">{$v->price|convert} <span class="currency">{$currency->sign|escape}</span></span>
				</td>
			</tr>
			{/foreach}
			</table>
			<input type="submit" class="button" value="купить" data-result-text="добавлено"/>
		</form>
		{else}
			Нет в наличии
		{/if}
    </div>
	</li>
	{/foreach}
			
</ul>
{/if}


{* Акционные товары *}
{get_discounted_products var=discounted_products limit=9}
{if $discounted_products}
<h1>Акции по продажам</h1>
<ul class="shop4">

	{foreach $discounted_products as $product}
	<li class="product">
		
		{if $product->image}
		<div class="image">
			<a href="products/{$product->url}"><img src="{$product->image->filename|resize:200:200}" alt="{$product->name|escape}"/></a>
		</div>
		{/if}

		<h3><a data-product="{$product->id}" href="products/{$product->url}">{$product->name|escape}</a></h3>
		
		{if $product->variants|count > 0}
		<form class="variants" action="/cart">
			<table>
			{foreach $product->variants as $v}
			<tr class="variant">
				<td>
					<input id="discounted_{$v->id}" name="variant" value="{$v->id}" type="radio" class="variant_radiobutton" {if $v@first}checked{/if} {if $product->variants|count<2}style="display:none;"{/if}/>
				</td>
				<td>
					{if $v->name}<label class="variant_name" for="discounted_{$v->id}">{$v->name}</label>{/if}
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
{* Заголовок страницы *}
<h1>{$page->header}</h1>
{* Тело страницы *}
{$page->body}