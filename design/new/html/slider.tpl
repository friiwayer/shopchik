<link href="design/{$settings->theme|escape}/css/example2.css" rel="stylesheet" type="text/css" media="screen"/>
<script type="text/javascript" src="design/{$settings->theme}/js/jquery.onebyone.min.js"></script>
<script type="text/javascript" src="design/{$settings->theme}/js/jquery.touchwipe.min.js"></script>
<script type="text/javascript" src="design/{$settings->theme}/js/jquery.countdown.js"></script>
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<style type="text/css" media="screen">
		#wrapp{              
			width: 530px;    
			-webkit-user-select: none;
            float:right;
            position:relative;	 
		}
       
	 

		#ep2{
			position:absolute;
			left: 36px;
			width: 540px;	 
			top: 50px; 

		}  
		
	  
 
	  
		.otherExample{ 
			position: absolute;
			right: 36px;
			top: 360px;
		}
		.otherExample a{ 
			display: block;
			float: left;
			margin-right: 16px;
			color: #0066FF;
		}    
 		.otherExample a:hover{ 
			color: #B22222;
			text-decoration: underline;
		}     		

	 
</style>
<script>
{literal}
// Can also be used with $(document).ready()
$(document).ready(function() {
    $('#example2').oneByOne({
			className: 'oneByOne2',
			easeType: 'fadeInLeft',	             
			width: 530,
			height: 270,
			showArrow: false,
			slideShow: true,
            delay:400,
            slideShowDelay: 6000
    }); 
});
{/literal}
</script>
<!-- Слайдер -->
<div id="wrapp">        
	 	<div id="example2">

{get_dl var=cop}
{if $cop}
<!-- Список товаров-->

	{foreach $cop as $produc}
	<!-- Товар-->
	<div class="oneByOne_item">
	{if $produc->image}
			<a href="products/{$produc->url}"><img class="img1" style="z-index:999;" src="{$produc->image->filename|resize:250:290}" alt="{$produc->name|escape}"/></a>
	{/if}            
	<div class="names"><span class="text1"><a href="products/{$produc->url}" style="color:#fff;">{$produc->name|escape}</a></span></div>
	

	<span class="text2">  
	<ul>
    {if $produc->feates}
	{foreach $produc->feates as $f}
	<li>
		<label style="margin-left:10px; font-size:11px;">{$f->name} - </label>
		<span class="infa"><b>{$f->value}</b></span>
	</li>
	{/foreach}
    {/if}
	</ul>
    
    </span>
	<form class="variants" action="/cart">
			<table>
			{foreach $produc->variants as $v}
			<tr class="variant">
				<td>
					<input id="discounted_{$v->id}" name="variant" value="{$v->id}" type="radio" class="variant_radiobutton hiden" {if $v@first}checked{/if} {if $produc->variants|count<2}style="display:none;"{/if}/>
				</td>
				<td>
					{if $v->name}<label class="variant_name" for="discounted_{$v->id}">{$v->name}</label>{/if}
				</td>
				<td>
					{if $v->compare_price > 0}<span class="compare_price hiden">{$v->compare_price|convert}</span>{/if}
                    <span style="font-size:12px;" class="priceq">
					<span class="pricez">
                    <span class="bi2">{$v->price|convert} {$currency->sign|escape}</span>
                    <span style="" class="ded">{$v->dprice|convert} {$currency->sign|escape}</span>
                    <span class="prica" style="font-family:tahoma; font-size:11px;" id="compact">{$v->d_day}</span>
                    </span>
                    </span>
				</td>
			</tr>
			{/foreach}
			</table>
	</form>    										
	</div>  
	{/foreach}
{/if}
</div>  
</div>
<!-- end -->