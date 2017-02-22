<div class="b-most-popular">
    <div class="b-most-popular-i">
        <div class="b-most-popular-screen">
    
        {get_new_products var=new_products limit=5}
        {if $new_products}
        <ul class="active">
        	{foreach $new_products as $product}
        	<li><div><a href="products/{$product->url}">
        		{if $product->image}
        			<img src="{$product->image->filename|resize:100:100}" alt="{$product->name|escape}" title="купить {$product->name|escape}"/>
        		{/if}
                <br />
        		<a data-product="{$product->id}" href="products/{$product->url}">{$product->name|escape}</a>
        
        		{if $product->variants|count > 0}
        
        		<form class="variants" action="/cart">
        			<table>
        			{foreach $product->variants as $v}
        			<tr class="variant">
        			     <td>
        					<input id="featured_{$v->id}"  style="display:none;" name="variant" value="{$v->id}" type="radio" class="variant_radiobutton" {if $v@first}checked{/if} {if $product->variants|count<2}style="display:none;"{/if}/>
        				</td>
        				<td>
        					{if $v->name}<label  style="display:none;" class="variant_name" for="featured_{$v->id}">{$v->name}</label>{/if}
        				</td>
        				<td>
        				</td>
        			</tr>
        			{/foreach}
        			</table>
        			{if $v->compare_price > 0}<span class="compare_price">{$v->compare_price|convert}</span>{/if}
        			<span class="price">{$v->price|convert} <span class="currency">{$currency->sign|escape}</span></span> 			
        		</form>
        
        		{else}
        			<div class="price_new">Нет в наличии</div>
        		{/if}
            </div>
            </a>
        	</li>      
        	{/foreach}    			
        </ul>
        {/if}
                            
        {get_featured_products var=featured_products limit=5}
        {if $featured_products}        
        <ul style="left: 100%; display: block; " class="">        
        	{foreach $featured_products as $product}
        	<li><div><a href="products/{$product->url}">
        		{if $product->image}
        			<img src="{$product->image->filename|resize:100:100}" alt="{$product->name|escape}" title="купить {$product->name|escape}"/>
        		{/if}
                <br />
        		<a data-product="{$product->id}" href="products/{$product->url}">{$product->name|escape}</a>
        		
        
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
        			
        		</form>
        		{else}
        			<div class="price_new">Нет в наличии</div>
        		{/if}
                </a>
                </div>
        	</li>
        	{/foreach}		
        </ul>
        {/if}
                            
<ul style="left: 100%; display: block; " class="">
{get_discounted_products var=discounted_products limit=5}
{if $discounted_products}
{foreach $discounted_products as $product}
	<li><div>
		
		{if $product->image}
			<a href="products/{$product->url}"><img src="{$product->image->filename|resize:100:100}" alt="{$product->name|escape}"/></a>
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
		</form>
		{else}
			Нет в наличии
		{/if}
    </div>
	</li>
{/foreach}
{/if}
</ul>
</div>
    </div>
    <div class="b-most-popular-nav" rel="484">
        <i class="icon arrow" style="margin-left: -207px; display: inline; "></i>
        <a href="#" class="active">Новые Товары</a>
        <a href="#" class="">Рекомендуем</a>
        <a href="#" class="">Товары со скидкой</a>
    </div>
</div>