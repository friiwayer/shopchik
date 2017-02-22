{* Главная страница магазина *}

{* Для того чтобы обернуть центральный блок в шаблон, отличный от index.tpl *}
{* Укажите нужный шаблон строкой ниже. Это работает и для других модулей *}
{$wrapper = 'index.tpl' scope=parent}
{literal}
<style type="text/css">
/* <![CDATA[ */
* {margin: 0; padding: 0;}
/* ]]> */
</style>
<script type="text/javascript">
$(function(){
   $('.ho').toggle(function(){
   $('.oh').show();
   }, function(){
   $('.oh').hide();
   }); 
});
</script>
{/literal}
<script src="design/{$settings->theme}/js/top.js"></script>
<div class="clear"></div>
{* Каталог товаров на главной *}
{if $page && $page->url == ''}

<div id="catalog_menus">
        <ul class="main_cat">
                    <li style="position:relative; border-bottom: 1px dashed #B1B1B1;">
        <a href="http://shopchik.com/catalog/smartfony" title="Смартфоны">
                    <img src="design/{$settings->theme|escape}/images/smarth.png" alt="Смартфоны">
                    <div class="nam">Смартфоны</div>
                    <div class="b-promobox-price"> <span class="btn btn-price btn-price_stock-in">от 3 700<span class="ruble">p</span></span> </div>
                    <a href="http://shopchik.com/catalog/smartfony" class="b-promobox-anchor"></a>
        </a>
					</li>
					
                    <li style="border-left: 1px dashed #B1B1B1; border-bottom: 1px dashed #B1B1B1; position:relative;">
						<a href="http://shopchik.com/catalog/planshety-netbuki" title="Планшетные ПК">                <div class="img">
                    <img src="design/{$settings->theme|escape}/images/tabletpc.png" alt="Планшетные ПК">
                </div>
                        <div class="nam">Планшетные ПК</div>
                        <div class="b-promobox-price"> <span class="btn btn-price btn-price_stock-in">от 2 400<span class="ruble">p</span></span> </div>
                        <a href="http://shopchik.com/catalog/planshety-netbuki" class="b-promobox-anchor"></a>
        </a>
					</li>
					
                    <li style="border-left: 1px dashed #B1B1B1; border-right: 1px dashed #B1B1B1; border-bottom: 1px dashed #B1B1B1; position:relative;">
						<a href="http://shopchik.com/catalog/sotovye" title="Сотовые телефоны">                <div class="img">
                    <img src="design/{$settings->theme|escape}/images/tel.png" alt="Сотовые телефоны">
                </div>
                        <div class="nam">Сотовые телефоны</div>
                        <div class="b-promobox-price"> <span class="btn btn-price btn-price_stock-in">от 1650<span class="ruble">p</span></span> </div>
                        <a href="http://shopchik.com/catalog/sotovye" class="b-promobox-anchor"></a>
        </a>
					</li>
					
                    <li style="position:relative;">
						<a href="http://respekt.msk.ru/catalog/foto_i_videokamery" title="Аксесуары">                <div class="img">
                    <img src="design/{$settings->theme|escape}/images/acessories.png" alt="Аксесуары">
                </div>
                        <div class="nam">Аксесуары</div>
                        <div class="b-promobox-price"> <span class="btn btn-price btn-price_stock-in">от 300<span class="ruble">p</span></span> </div>
                        <a href="http://shopchik.com/catalog/aksessuary" class="b-promobox-anchor"></a>
        </a>
					</li>
                    
					<li style="border-left: 1px dashed #B1B1B1; position:relative;">
						<a href="http://respekt.msk.ru/catalog/ofisnaya_tehnika" title="Гаджеты">                <div class="img">
                    <img src="design/{$settings->theme|escape}/images/gagets.png" alt="Гаджеты">
                </div>
                        <div class="nam">Гаджеты</div>
                        <div class="b-promobox-price"> <span class="btn btn-price btn-price_stock-in">от 160<span class="ruble">p</span></span> </div>
                        <a href="http://shopchik.com/catalog/gadzhety" class="b-promobox-anchor"></a>
        </a>
					</li>
                    
					<li style="border-left: 1px dashed #B1B1B1; border-right: 1px dashed #B1B1B1; position:relative;">
						<a href="http://shopchik.com/catalog/igrushki" title="Игрушки">                <div class="img">
                    <img src="design/{$settings->theme|escape}/images/games.png" alt="Игрушки">
                </div>
                        <div class="nam">Игрушки</div>
                        <div class="b-promobox-price"> <span class="btn btn-price btn-price_stock-in">от 1440<span class="ruble">p</span></span> </div>
                        <a href="http://shopchik.com/catalog/igrushki" class="b-promobox-anchor"></a>
        </a>
					</li>
</ul>
{include file="slider.tpl"}
</div>
{/if}

{*include file="slide_m.tpl"*}
 
{* Заголовок страницы *}

{*include file="last_n.tpl"*}
{get_new_products var=new_products limit=6}
{if $new_products}
<h3 style="border-bottom: 1px solid #CCC; line-height:23px; padding: 2px 0 0 5px; background-color: #F0F0F0; font-size: 14px; margin-top: 20px;width: 99.8%; position:relative;">Новинки:
<div class="h3"></div>
</h3>
<ul class="shop4">

	{foreach $new_products as $product}

	<li class="product">

		{if $product->image}
		<div class="image">
			<a href="products/{$product->url}"><img src="{$product->image->filename|resize:80:80}" alt="{$product->name|escape}" title="{$product->name|escape}"/></a>
		</div>
		{/if}


		<div class="link"><a data-product="{$product->id}" href="products/{$product->url}">{$product->name|escape}</a></div>
		

		{if $product->variants|count > 0}

		<form class="variants" action="/cart">
			<table>

			<tr class="variant">
				<td>
					<input id="featured_{$product->variant->id}" name="variant" value="{$product->variant->id}" type="radio" class="variant_radiobutton" checked {if $product->variants|count>0}style="display:none;"{/if}/>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>

			</table>
            {if $product->variant->compare_price > 0}<span class="compare_price">{$product->variant->compare_price|convert}</span>{/if}
			<div class="b-promobox-pricse"><span class="btn btn-price btn-price_stock-in">{$product->variant->price|convert} <span class="currency">{$currency->sign|escape}</span></span></div>
    <div class="b-catalog_accessories-popup">
    <div class="b-catalog_accessories-popup-foot">
    <span class="sbtn sbtn_box sbtn_catalog-to-cart">
    <span class="">
    <input type="submit" class="butt" style="" value="в корзину" data-result-text="в корзине"/></span>
    </span>
    </div>
    </div>            
            
		</form>
		{else}
			Нет в наличии
		{/if}
	</li>
	{/foreach}
			
</ul>
{/if}

{get_featured_products var=featured_products limit=6}
{if $featured_products}
<h3 class="ho" style="border-bottom: 1px solid #CCC; padding: 2px 0 0 5px; line-height:23px; background-color: #F0F0F0; font-size: 14px; margin-top: 10px;width: 99.8%; cursor:pointer; position:relative;">Рекомендуемые товары:
<div class="h3"></div></h3>
<ul class="shop4 oh" style="display:none;">

	{foreach $featured_products as $product}

	<li class="product">

		{if $product->image}
		<div class="image">
			<a href="products/{$product->url}"><img src="{$product->image->filename|resize:80:80}" alt="{$product->name|escape}" title="{$product->name|escape}"/></a>
		</div>
		{/if}


		<div class="link"><a data-product="{$product->id}" href="products/{$product->url}">{$product->name|escape}</a></div>
		

		{if $product->variants|count > 0}

		<form class="variants" action="/cart">
			<table>

			<tr class="variant">
				<td>
					<input id="featured_{$product->variant->id}" name="variant" value="{$product->variant->id}" type="radio" class="variant_radiobutton" checked {if $product->variants|count>0}style="display:none;"{/if}/>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>

			</table>
            
			<div class="b-promobox-pricse"><span class="btn btn-price btn-price_stock-in">{$product->variant->price|convert} <span class="currency">{$currency->sign|escape}</span></span></div>
    <div class="b-catalog_accessories-popup">
    <div class="b-catalog_accessories-popup-foot">
    <span class="sbtn sbtn_box sbtn_catalog-to-cart">
    <span class="">
    <input type="submit" class="butt" style="" value="в корзину" data-result-text="в корзине"/></span>
    </span>
    </div>
    </div>            
            
		</form>
		{else}
			Нет в наличии
		{/if}
	</li>
	{/foreach}		
</ul>
{/if}

{*<h3 style="border-bottom: 1px solid #CCC; padding: 2px 0 0 5px; background-color: #F0F0F0; line-height:23px; font-size: 14px; margin-top: 20px;width: 99.8%; position:relative;">Бренды:<div class="h3"></div></h3>*}
<div class="endpage"></div>
<div class="clear" style="height:10px; padding-bottom:5px;"></div>
<ul class="brands">
<noindex>
{foreach $brandy as $br}
<a rel="nofollow" href="brands/{$br->url}" title="{$br->name}"><li class="{$br->name}"></li></a>
{/foreach}
</noindex>
</ul>
<div class="clear"></div>
