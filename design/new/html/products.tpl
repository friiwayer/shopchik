{* Список товаров *}
{literal}
<script type="text/javascript">
$(function(){
   $('.col').click(function(){
    $('select[name=ppp] option').val($(this).attr('href')).attr('selected');
     $('.ppp form').submit();
     return false;
   });
    
});
</script>
{/literal}
{* Заголовок страницы *}
{if $keyword}
<h1>Поиск {$keyword|escape}</h1>
{elseif $page}
<h1>{$page->name|escape}</h1>
{else}
<h1>{$category->name|escape} {$brand->name|escape} {$keyword|escape}({$products|count})</h1>
{/if}

{if $cena_to}
<h1>до цены {$cena_to|escape}</h1>
<h1>{$category->name|escape} {$brand->name|escape} {$cena_to|escape}</h1>
{/if}
{if $count}
<span id="countt"> всего товаров в категории: <b>{$count}</b></span>
{/if}
{* Описание страницы (если задана) *}
{$page->body}

{if $current_page_num==1}
{* Описание категории *}
{$category->description}
{/if}

{* Описание бренда *}
{$brand->description}

<!--Каталог товаров-->
{if $products}
<div class="section">
	<span class="vid">Вид:</span>
    <ul class="tabs">
		<li class="current tabl" style=""><h2 style="" class=""></h2></li>
		<li style="" class="block"><h2 style="" class=""></h2></li>
	</ul>
{*выбор кол отображения товаров*}
<div class="ppp">
<form action="{$smarty.server.REQUEST_URI}" method="post" style="display:none;">
<select name="ppp">
{if $smarty.session.items_per_pag}<option value="{$smarty.session.items_per_pag}" selected="" class="selected">{$smarty.session.items_per_pag}</option>{/if}
<option value="15">15</option>
<option value="24">24</option>
<option value="36">36</option>
<option value="48">48</option>
</select>
<input type="submit" name="send" value="показать" />
</form>
<noindex>
<a class="col" rel="nofollow" href="15">15</a>
<a class="col" rel="nofollow" href="24">24</a>
<a class="col" rel="nofollow" href="36">36</a>
<a class="col" rel="nofollow" href="48">48</a>
</noindex>
</div>

<div class="box visible" style="display: block; ">
{* Сортировка *}
{if $products|count>0}
<div class="sort">
<noindex>
	Сортировать по:
	<a rel="nofollow" {if $order =='ASC'}id="ask"{$order = 'DESC'}{else}id="desc"{$order = 'ASC'}{/if} {if $sort=='position'} class="selected"{/if} href="{url sort=position order=$order page=null}">умолчанию<span></span></a>
	<a rel="nofollow" {if $order =='DESC'}id="ask"{$order = 'DESC'}{else}id="desc"{$order = 'ASC'}{/if}{if $sort=='price'}    class="selected"{/if} href="{url sort=price order=$order page=null}">цене<span></span></a>
	<a rel="nofollow" {if $order =='DESC'}id="ask"{$order = 'DESC'}{else}id="desc"{$order = 'ASC'}{/if}{if $sort=='name'}     class="selected"{/if} href="{url sort=name order=$order page=null}">названию<span></span></a>
    <a rel="nofollow" {if $order =='DESC'}id="ask"{$order = 'DESC'}{else}id="desc"{$order = 'ASC'}{/if}{if $sort=='rating'}   class="selected"{/if} href="{url sort=rating order=$order page=null}">рейтингу<span></span></a>
</noindex>
</div>
{/if}





<!-- Список товаров-->
<div class="pr">
<table class="products">
	{foreach $products as $product}
	<!-- Товар-->
    <tr class="product">
		<!-- Фото товара -->
        <td valign="top" style="width:120px;">
		{if $product->image}
		<div class="imag">
			<a href="products/{$product->url}"><img src="{$product->image->filename|resize:110:110}" alt="{$product->name|escape}"/></a>
		</div>
		{/if}
<div class="compare">
<form action="/compare" class="compare">
{if $compare_informer->items_id[{$product->id}]>0}
В списке <a href="/compare/">сравнения</a>
{else}
<input id="compare_{$product->id}" name="compare" value="{$product->id}" type="checkbox" style="display:none;" />
<label for="compare_{$product->id}" style="cursor: pointer; font-size:11px; color:#333; border-bottom:1px dotted;">Сравнить</label>
{/if}
</form>
</div>
        </td>
		<!-- Фото товара (The End) -->
        <td valign="top" style="width:450px;" width="450">
		<div class="product_info">
		<!-- Название товара -->
		<h3 class="{if $product->featured}featured{/if}"><a data-product="{$product->id}" href="products/{$product->url}">{$product->name|escape}</a></h3>
        <span style="color:#888; font-size:11px;">Артикул: <b>{$product->id}</b></span>
		<!-- Название товара (The End) -->

		<!-- Описание товара -->
            <br />
            {if $product->ufo}
            <ul>
            {foreach $product->ufo as $ddd}
            <li class="evens">
            <div style="">{$ddd->name} - <span style="padding-left:10px;">{$ddd->value}</span></div>
            </li>
            {/foreach}
            </ul>
            {else}
            <div class="annotation">{$product->annotation}</div>            
            {/if}        
		<!-- Описание товара (The End) -->

            
		{if $product->variants|count > 0}
        </td>
        <td valign="top" width="150" style="padding-top:5px;">

        {if $product->variant->compare_price > 0}<span class="cold_price">{$product->variant->compare_price|convert}</span>{/if}
		<span class="cena">{$product->variant->price|convert} <span class="currency">{if $currency->sign|escape == 'руб'}р{else}{$currency->sign|escape}{/if}</span></span>

        </td>
        <td valign="top" style="padding-right:0px; width:120px;">
        
		<!-- Выбор варианта товара -->
		<form class="variants" action="/cart" id="cart" style="margin-right:10px; position:none;">
        <input type="submit" class="butte" value="в корзину" data-result-text="добавлено"/>
            <div style="position:relative; text-align:center; margin-top:38px; margin-left:5px;">
                    <div class="testRater" id="product_{$product->id}">
                    	<div class="statVal">
                    		<span class="rater">
                    			<span class="rater-starsOff" style="width:80px;">
                    				<span class="rater-starsOn" style="width:{$product->rating*80/5|string_format:"%.0f"}px"></span>
                    			</span>
                    			<span class="test-text">
                    			</span>
                    		</span>
                    	</div>
                    </div>
            </div>          
        {if $product->youtube}<span class="yuo" style="bottom:45px;" title="На данный товар есть видео ролик"></span>{else}{/if}    
			<table width="100%">
			<tr class="variant">
				<td valign="top">
					<input id="variants_{$product->variant->id}" name="variant" value="{$product->variant->id}" type="radio" class="variant_radiobutton" checked {if $product->variants|count>0}style="display:none;"{/if}/>
				</td>
				<td valign="top">
					
				</td>
			</tr>           
			
			</table>
		</form>
		<!-- Выбор варианта товара (The End) -->
		{else}
        </div>
        <td colspan="2">
		<div style="float:right;">Товара нет в наличии</div>
        </td>	
		{/if}
		</div>
<!-- Добавление товара к сравнению -->
<!-- Добавление товара к сравнени (The End) -->
        </td>
    </tr>
	<!-- Товар (The End)-->
	{/foreach}

</table>
</div>
{include file='pagination.tpl'}	
<!-- Список товаров (The End)-->

{else}
Товары не найдены!
{include file='pagination.tpl'}	
{/if}	
<!--Каталог товаров (The End)-->
</div>
<div class="box" style="display: none; ">
<noindex>
{if $products|count>0}
{* Сортировка *}
{if $products|count>0}
<div class="sort">
	Сортировать по: 
	<a rel="nofollow" {if $sort=='position'} class="selected"{/if}{if $order =='ASC'}id="ask"{$order = 'desc'}{else}id="desc"{$order = 'asc'}{/if} href="{url sort=position order=$order page=null}">умолчанию<span></span></a>
	<a rel="nofollow" {if $sort=='price'}    class="selected"{/if}{if $order =='ASC'}id="ask"{$order = 'desc'}{else}id="desc"{$order = 'asc'}{/if} href="{url sort=price order=$order page=null}">цене<span></span></a>
	<a rel="nofollow" {if $sort=='name'}     class="selected"{/if}{if $order =='ASC'}id="ask"{$order = 'desc'}{else}id="desc"{$order = 'asc'}{/if} href="{url sort=name order=$order page=null}">названию<span></span></a>
    <a rel="nofollow" {if $sort=='rating'}   class="selected"{/if}{if $order =='ASC'}id="ask"{$order = 'desc'}{else}id="desc"{$order = 'asc'}{/if} href="{url sort=rating order=$order page=null}">рейтингу<span></span></a>
</div>
{/if}



<br style="clear:both;" />
<div class="pr">
<!-- Список товаров-->
	{foreach $products as $product}
	<!-- Товар-->
        <div id="blokt">
        <div class="compar" style="padding-top:0px; text-align:left; padding-left:20px;">
        <form action="/compare" class="compar">
        {if $compare_informer->items_id[{$product->id}]>0}
        В списке <a href="/compare/">сравнения</a>
        {else}
        <input id="compare_{$product->id}" name="compare" value="{$product->id}" type="checkbox" />
        <label for="compare_{$product->id}" style="cursor: pointer; font-size:11px; color:#333;">Сравнить</label>
        {/if}
        </form>
        </div>
    
		<!-- Фото товара -->
		{if $product->image}
		<div class="imag">
			<a href="products/{$product->url}"><img src="{$product->image->filename|resize:130}" alt="{$product->name|escape}" height="100"/></a>
		</div>
		{/if}
		<!-- Фото товара (The End) -->
		<div class="product_info">
		<!-- Название товара -->
		<h3 class="{if $product->featured}featured{/if}"><a data-product="{$product->id}" href="products/{$product->url}">{$product->name|escape}</a></h3>
        <span style="color:#888; font-size:11px;position: absolute;top: 0;right: 3px;">Артикул: <b style="padding-right:20px;">{$product->id}</b>{if $product->youtube}<span class="yuo" title="На данный товар есть видео ролик"></span>{else}{/if}</span>
		<!-- Название товара (The End) -->

		<!-- Описание товара -->
		<!-- Описание товара (The End) -->
                    
		{if $product->variants|count > 0}
        {if $product->variant->compare_price > 0}<span class="cold_price">{$product->variant->compare_price|convert}</span>{/if}
		<span class="cenal">{$product->variant->price|convert} <span class="currency">{$currency->sign|escape}</span></span>        
		<!-- Выбор варианта товара -->
		<form class="variants" action="/cart" id="cartz">
        <input type="submit" class="buttr" value="купить" data-result-text="в корзине"/>
			<table width="100%">
			<tr class="variant">
				<td valign="top">
					<input id="variants_{$product->variant->id}" name="variant" value="{$product->variant->id}" type="radio" class="variant_radiobutton" checked style="display:none;"/>
				</td>
				<td valign="top">
				</td>
			</tr>
			</table>
		</form>
		<!-- Выбор варианта товара (The End) -->
		{else}
			<div style="float:right;">Товара нет в наличии</div>
		{/if}
		</div>
<!-- Добавление товара к сравнению -->
<!-- Добавление товара к сравнени (The End) -->
	<!-- Товар (The End)-->
</div> 
{/foreach}
</div>
<div class="clear"></div>
{include file='pagination.tpl'}	
<!-- Список товаров (The End)-->
</noindex>
</div>
</div>
{else}
Товары не найдены

{/if}	
<!--Каталог товаров (The End)-->
