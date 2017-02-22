{* Вкладки *}
{capture name=tabs}
	<li><a href="index.php?module=ProductsAdmin">Товары</a></li>
	<li><a href="index.php?module=CategoriesAdmin">Категории</a></li>
	<li><a href="index.php?module=BrandsAdmin">Бренды</a></li>
	<li><a href="index.php?module=FeaturesAdmin">Свойства</a></li>
    <li class="active"><a href="index.php?module=AskProduct">Вопросы по товарам <span class="colc">{$col->col}</span></a></li>
    <li><a href="index.php?module=Showe">Обратная связь <span class="colc">{$erc->ercol}</span></a></li>      
{/capture}
{* Title *}
{$meta_title='Вопросы по товарам' scope=parent}
{* Заголовок *}
<div id="header">
	<h1>Вопросы по товарам</h1>
</div>
{if $asks}
<div id="main_list" class="asks">
	<!-- Листалка страниц -->
	{include file='pagination.tpl'}	
	<!-- Листалка страниц (The End) -->

	<form id="list_form" method="post">
	<input type="hidden" name="session_id" value="{$smarty.session.id}">
		<div id="list">
		{foreach $asks as $as}
        <div class="row">
        <div class="checkbox cell">
		<input type="checkbox" name="check[]" value="{$as->id}" />				
		</div>
        <div class="cell"><a href="{url module=AskProduc id=$as->id return=$smarty.server.REQUEST_URI}">имя: <b>{$as->name}</b>
        |  товар: <b>{$as->product|escape}</b></a> {$as->date}
        </div>
        <div class="icons cell">
            {if $as->status != 1}				
			<a class="delete"  title="Удалить" href="#"></a>
            {else}
            <a class="asked"></a>
            <a class="delete"  title="Удалить" href="#"></a>
            {/if}
		</div>
		<div class="clear"></div>
        </div>
        {/foreach}
		</div>
        <div id="action">
			<label id="check_all" class="dash_link">Выбрать все</label>
			<span id="select">
			<select name="action">
			<option value="delete">Удалить</option>
			</select>
			</span>
			<input id="apply_action" class="button_green" type="submit" value="Применить">
		</div>
	</form>
    {else}
Нет Вопросов
    {/if}
</div>
	<!-- Листалка страниц -->
	{include file='pagination.tpl'}	
	<!-- Листалка страниц (The End) -->		
{literal}
<script>
$(function() {

	// Раскраска строк
	function colorize()
	{
		$("#list div.row:even").addClass('even');
		$("#list div.row:odd").removeClass('even');
	}
	// Раскрасить строки сразу
	colorize();	
	
	// Выделить все
	$("#check_all").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', 1-$('#list input[type="checkbox"][name*="check"]').attr('checked'));
	});	

	// Удалить
	$("a.delete").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', false);
		$(this).closest("div.row").find('input[type="checkbox"][name*="check"]').attr('checked', true);
		$(this).closest("form").find('select[name="action"] option[value=delete]').attr('selected', true);
		$(this).closest("form").submit();
	});
	
	// Подтверждение удаления
	$("form").submit(function() {
		if($('#list input[type="checkbox"][name*="check"]:checked').length>0)
			if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
				return false;	
	});
 	
});
</script>
{/literal}