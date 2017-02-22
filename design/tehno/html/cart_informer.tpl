{* Информера корзины (отдаётся аяксом) *}
<div class="cart">
{if $cart->total_products>0}

						<!-- ========== SHOPPING CART ========== -->
												<span>В корзине <a href="./cart/"><span>
{$cart->total_products} {$cart->total_products|plural:'товар':'товаров':'товара'}
	на {$cart->total_price|convert} {$currency->sign|escape}
{else}
	Корзина пуста
{/if}

</span></a></span> 
					<!-- =================================== -->
					</div>


	
