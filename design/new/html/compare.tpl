
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<base href="{$config->root_url}/"/>
	<title>{$meta_title|escape}</title>

	{* Метатеги *}
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="{$meta_description|escape}" />
	<meta name="keywords"    content="{$meta_keywords|escape}" />
	<meta name="viewport" content="width=1024"/>

	{* JQuery *}
	<script src="js/jquery/jquery.js"  type="text/javascript"></script>

    {* Стравнение товаров *}
	<script src="design/{$settings->theme}/js/ajax_compare.js"></script>

{literal}
<style type="text/css">
/*<![CDATA[*/
#comparemain{

}

#list td {
  margin:1px;
  padding:5px;
  background-color: #FFFFFF;
  border: 1px solid #C0C0C0;
  text-align:left;
}

#list td.image {
  margin:0;
  padding:0;
}

#variants  td {
  border: 0;

}

#comparebody {
    background-color: #FFFFFF;
    margin: 5px;
    padding: 5px;
    -o-box-shadow:0 0 15px #ADADAD;
	-moz-box-shadow: 0 0 15px #ADADAD;
	-webkit-box-shadow: 0 0 15px #ADADAD;
	box-shadow:0 0 15px #ADADAD;s
    border: 1px solid #FFFFFF;
	-webkit-border-radius:  10px;
	-moz-border-radius:  10px;
	border-radius: 10px;
    -khtml-border-radius:  10px;
    behavior: url(/css/1/PIE.htc);
    behavior: url(design/{$settings->theme|escape}/css//css/1/PIE.htc);
    width:auto;
    max-width:1100px;
}

/*]]>*/
</style>

<script language="JavaScript">

function toggleCompareDiffProperties(objCheckbox)
{
var arrObj = $('table.compare > tbody > tr').not('.diff').not('.action');

  if( $(objCheckbox).attr('checked') )
  {
    arrObj.hide();
  }
  else
  {
    arrObj.show();
  }
}

// Скрываем/отображаем колонки
function showHideCompareColumn(objInTd, needShow)
{
  var td = $(objInTd).parents('td:first');
  var index = th.index();

  $('table.compare').find('tr.hideable').each(function(rowIndex)
  {
    var td = $(this).find('td').eq(index);
    if(td.length == 0) td = $(this).find('td').eq(index);

    var content = '';//$(td).find('div.hidden').html();
    if(! needShow) content = '<div class="hidden">' + $(td).html() + '</div>&nbsp;';
    else content = $(td).find('div.hidden').html();

    // Нв верхней строке будет кнопочка, чтобы можно было развернуть (это если мы скрываем колонку)
    if(! rowIndex && ! needShow)
    {
      content = '<center><div class="expand" title="Показать скрытый товар" onclick="showHideCompareColumn(this, true); return false"></div></center>' + content;
    }

    $(td).html(content);
  });
}

</script>
    
<script type="text/javascript">
$(function(){
    $('td.diff, .f').css('background-color','#e2e2e2');
});
</script>
{/literal}
</head>
<body>
<div id="comparemain">

<div  id="comparebody">
<table bgcolor="#fff" id="list" class="compare">
<thead>
<tr class="hideable">
   <td align="center" valign="top" style="padding:20px; border: 0; " width="300">
         {$meta_title = "Сравнения товаров" scope=parent}

        <h3>Сравнение товаров</h3>
        {if $compare->total>1}
        <br />
           <label><input type="checkbox" onclick="toggleCompareDiffProperties(this)"> показать <b>только отличия</b></label><br />
        {/if}
   </td>
{if $compare->total>0}
	{foreach $compare->products as $product}
    <td align="center" class="image" valign="top"  width="{100/$compare->total}%">

    <div style="padding: 10px">
    <a href='compare/remove/{$product->id}' style="float: right">Убрать</a>
    <a rel="nofollow" class="minus_icon" style="float: left" href="/compare/#" onclick="showHideCompareColumn(this, false); return false" title="Не показывать этот товар в таблице сравнения (временно)">
    скрыть
    </a>
    </div>
    <div style="padding: 10px">
    <!-- Фото товара -->
		{if $product->image}
		<div class="image">
			<a href="products/{$product->url}"><img src="{$product->image|resize:200:200}" alt="{$product->name|escape}"/></a>
		</div>
		{/if}
	<!-- Фото товара (The End) -->
    </div>
    </td>
    {/foreach}

</tr>

<tr class="hideable">
<td class="f">Название</td>
{foreach $compare->products as $product}
<td class=""><h3><a data-product="{$product->id}" href="products/{$product->url}">{$product->name|escape}</a></h3></td>
{/foreach}
</tr>

<tr class="hideable">
<td class="f">Производитель</td>
{foreach $compare->products as $product}
<td class=""><a href="brands/{$product->brand_url}">{$product->brand|escape}</a></td>
{/foreach}
</tr>

<tr class="hideable">
<td class="f">Цены и варианты</td>
{foreach $compare->variants as $variant}
<td valign="bottom" align="left" class="">
		{if $variant|count > 0}
		<!-- Выбор варианта товара -->
		<form class="variants" action="/cart" target="_blank">
			<table class="action" id="variants">
			{foreach $variant as $v}
            {if $v->price>0}
			<tr class="variant">
				<td width="5">
					<input id="variants_{$v->id}" name="variant" value="{$v->id}" type="radio" class="variant_radiobutton" {if $v@first}checked{/if} {if $variant|count<2}style="display:none;"{/if}/>
				</td>
				<td>
					{if $v->name}<label class="variant_name" for="variants_{$v->id}">{$v->name}</label>{/if}
				</td>
				<td>
					{if $v->compare_price > 0}<span class="compare_price">{$v->compare_price|convert}</span>{/if}
					<span class="price">{$v->price|convert} <span class="currency">{$currency->sign|escape}</span></span>
				</td>
			</tr>
            {else}
            нет в наличии
            {/if}
			{/foreach}
			</table>

            {if $variant[0]->price > 0}<div style="padding: 15px"><input type="submit" class="" value="в корзину" data-result-text="добавлено"/></div>{/if}
		</form>
		<!-- Выбор варианта товара (The End) -->
		{else}
			Нет в наличии
		{/if}
</td>
{/foreach}
</tr>
</thead>

<tbody>
{foreach from=$compare->features key=k item=i}
<tr {if $i.diff}class='diff hideable'{/if}>
<td {if $i.diff}class='diff'{else} class='f'{/if}>{$k|escape}</td>
{foreach from=$i.items item=ii}
  <td class="">
     {$ii}
  </td>
{/foreach}
</tr>
{/foreach}
</tbody>

<tfoot>
<tr class="hideable">
<td class="f">Краткое описание</td>
{foreach $compare->products as $product}
<td valign="top" class="">{$product->annotation}</td>
{/foreach}
</tr>

<tr class="hideable">
<td class="f">Цены и варианты</td>
{foreach $compare->variants as $variant}
<td valign="bottom" align="left" class="">
		{if $variant|count > 0}
		<!-- Выбор варианта товара -->
		<form class="variants" action="/cart" target="_blank">
			<table class="action" id="variants">
			{foreach $variant as $v}
            {if $v->price>0}
			<tr class="variant">
				<td width="5">
					<input id="variants_{$v->id}" name="variant" value="{$v->id}" type="radio" class="variant_radiobutton" {if $v@first}checked{/if} {if $variant|count<2}style="display:none;"{/if}/>
				</td>
				<td>
					{if $v->name}<label class="variant_name" for="variants_{$v->id}">{$v->name}</label>{/if}
				</td>
				<td>
					{if $v->compare_price > 0}<span class="compare_price">{$v->compare_price|convert}</span>{/if}
					<span class="price">{$v->price|convert} <span class="currency">{$currency->sign|escape}</span></span>
				</td>
			</tr>
            {else}
            нет в наличии
            {/if}
			{/foreach}
			</table>

            {if $variant[0]->price > 0}<div style="padding: 15px"><input type="submit" class="" value="в корзину" data-result-text="добавлено"/></div>{/if}
		</form>
		<!-- Выбор варианта товара (The End) -->
		{else}
			Нет в наличии
		{/if}
</td>
{/foreach}
</tr>

{else}
<td width="100%" style="padding:20px; border: 0;" align="center"><h2>Нет товаров для сравнения</h2></td>
</tr>
{/if}
</tfoot>
</table>

</div>

</div>

</body>
</html>