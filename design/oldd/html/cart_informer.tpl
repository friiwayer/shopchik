{* Информера корзины (отдаётся аяксом) *}
{if $cart->total_products>0}
<div class="cartf"></div>
	В <a href="./cart/">корзине</a>
	{$cart->total_products} {$cart->total_products|plural:'товар':'товаров':'товара'}
	на {$cart->total_price|convert} {$currency->sign|escape}
{else}
<div class="carts"></div>
	Корзина пуста
{/if}
