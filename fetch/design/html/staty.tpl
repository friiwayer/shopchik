{* Вкладки *}
{capture name=tabs}
	<li class="active"><a href="{url module=StatyAdmin page=null keyword=null}">Статьи и Обзоры</a></li>
{/capture}
{literal}
<style>
#main_list{
    max-width:100%;
}
</style>
{/literal}
{* Title *}
{$meta_title='Блог' scope=parent}

{* Поиск *}
{if $posts || $keyword}
<form method="get">
<div id="search">
	<input type="hidden" name="module" value='BlogAdmin'>
	<input class="search" type="text" name="keyword" value="{$keyword|escape}" />
	<input class="search_button" type="submit" value=""/>
</div>
</form>
{/if}
		
{* Заголовок *}
<div id="header">
	{if $keyword && $posts_count}
	<h1>{$staty_count|plural:'Нашлась':'Нашлись':'Нашлись'} {$staty_count} {$staty_count|plural:'запись':'записей':'записи'}</h1>
	{elseif $staty_count}
	<h1>{$staty_count} {$staty_count|plural:'запись':'записей':'записи'} в Статьях</h1>
	{else}
	<h1>Нет Статей - Обзоров</h1>
	{/if}
	<a class="add" href="{url module=PostStAdmin return=$smarty.server.REQUEST_URI}">Добавить Статью</a>
</div>	

{if $staty}
<div id="main_list">
	
	<!-- Листалка страниц -->
	{include file='pagination.tpl'}	
	<!-- Листалка страниц (The End) -->

	<form id="form_list" method="post">
	<input type="hidden" name="session_id" value="{$smarty.session.id}">
	
		<div id="list">
			{foreach $staty as $st}
			<div class="{if !$st->visible}invisible{/if} row">
				<input type="hidden" name="positions[{$st->id}]" value="{$st->position}">
		 		<div class="checkbox cell">
					<input type="checkbox" name="check[]" value="{$st->id}" />				
				</div>

			<div class="image cell">

				<a href="{url module=ProductAdmin id=$st->id return=$smarty.server.REQUEST_URI}"><img src="{$st->image->filename|escape|resize:35:35}" /></a>

			</div>
                
				<div class="name cell">		
					<a href="{url module=PostStAdmin id=$st->id return=$smarty.server.REQUEST_URI}">{$st->name|escape}</a>
					<br>
					{$st->date|date}
				</div>
				<div class="icons cell">
					<a class="preview" title="Предпросмотр в новом окне" href="../staty/{$st->url}" target="_blank"></a>
					<a class="enable" title="Активна" href="#"></a>
					<a class="delete" title="Удалить" href="#"></a>
				</div>
				<div class="clear"></div>
			</div>
			{/foreach}
		</div>
		
	
		<div id="action">
		<label id="check_all" class="dash_link">Выбрать все</label>
	
		<span id="select">
		<select name="action">
			<option value="enable">Сделать видимыми</option>
			<option value="disable">Сделать невидимыми</option>
			<option value="delete">Удалить</option>
		</select>
		</span>
	
		<input id="apply_action" class="button_green" type="submit" value="Применить">
		
		</div>
				
	</form>	

	<!-- Листалка страниц -->
	{include file='pagination.tpl'}	
	<!-- Листалка страниц (The End) -->
	
</div>
{/if}

{* On document load *}
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
		$(this).closest(".row").find('input[type="checkbox"][name*="check"]').attr('checked', true);
		$(this).closest("form").find('select[name="action"] option[value=delete]').attr('selected', true);
		$(this).closest("form").submit();
	});
	
	// Скрыт/Видим
	$("a.enable").click(function() {
		var icon        = $(this);
		var line        = icon.closest(".row");
		var id          = line.find('input[type="checkbox"][name*="check"]').val();
		var state       = line.hasClass('invisible')?1:0;
		icon.addClass('loading_icon');
		$.ajax({
			type: 'POST',
			url: 'ajax/update_object.php',
			data: {'object': 'blog', 'id': id, 'values': {'visible': state}, 'session_id': '{/literal}{$smarty.session.id}{literal}'},
			success: function(data){
				icon.removeClass('loading_icon');
				if(state)
					line.removeClass('invisible');
				else
					line.addClass('invisible');				
			},
			dataType: 'json'
		});	
		return false;	
	});
	
	// Подтверждение удаления
	$("form").submit(function() {
		if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
			return false;	
	});
});

</script>
{/literal}