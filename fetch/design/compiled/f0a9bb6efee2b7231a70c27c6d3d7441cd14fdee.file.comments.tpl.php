<?php /* Smarty version Smarty-3.0.7, created on 2012-07-30 13:31:42
         compiled from "simpla/design/html/comments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:885995895016709e47b837-74134075%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f0a9bb6efee2b7231a70c27c6d3d7441cd14fdee' => 
    array (
      0 => 'simpla/design/html/comments.tpl',
      1 => 1343131365,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '885995895016709e47b837-74134075',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/home/f/friiw/test.kino-smena.ru/public_html/Smarty/libs/plugins/modifier.escape.php';
?>
<?php ob_start(); ?>
	<li class="active"><a href="index.php?module=CommentsAdmin">Комментарии</a></li>
	<li><a href="index.php?module=FeedbacksAdmin">Обратная связь</a></li>
<?php  Smarty::$_smarty_vars['capture']['tabs']=ob_get_clean();?>
<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_variable('Комментарии', null, 1);?>
<?php if ($_smarty_tpl->getVariable('comments')->value||$_smarty_tpl->getVariable('keyword')->value){?>
<form method="get">
<div id="search">
	<input type="hidden" name="module" value='CommentsAdmin'>
	<input class="search" type="text" name="keyword" value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('keyword')->value);?>
" />
	<input class="search_button" type="submit" value=""/>
</div>
</form>
<?php }?>
<div id="header">
	<?php if ($_smarty_tpl->getVariable('keyword')->value&&$_smarty_tpl->getVariable('comments_count')->value){?>
	<h1><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->getVariable('comments_count')->value,'Нашелся','Нашлось','Нашлись');?>
 <?php echo $_smarty_tpl->getVariable('comments_count')->value;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->getVariable('comments_count')->value,'комментарий','комментариев','комментария');?>
</h1> 
	<?php }elseif(!$_smarty_tpl->getVariable('type')->value){?>
	<h1><?php echo $_smarty_tpl->getVariable('comments_count')->value;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->getVariable('comments_count')->value,'комментарий','комментариев','комментария');?>
</h1> 
	<?php }elseif($_smarty_tpl->getVariable('type')->value=='product'){?>
	<h1><?php echo $_smarty_tpl->getVariable('comments_count')->value;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->getVariable('comments_count')->value,'комментарий','комментариев','комментария');?>
 к товарам</h1> 
	<?php }elseif($_smarty_tpl->getVariable('type')->value=='blog'){?>
	<h1><?php echo $_smarty_tpl->getVariable('comments_count')->value;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->getVariable('comments_count')->value,'комментарий','комментариев','комментария');?>
 к записям в блоге</h1> 
	<?php }?>
</div>	


<?php if ($_smarty_tpl->getVariable('comments')->value){?>
<div id="main_list">
	
	<!-- Листалка страниц -->
	<?php $_template = new Smarty_Internal_Template('pagination.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>	
	<!-- Листалка страниц (The End) -->
	
	<form id="list_form" method="post">
	<input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
	
		<div id="list" class="sortable">
			<?php  $_smarty_tpl->tpl_vars['comment'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('comments')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['comment']->key => $_smarty_tpl->tpl_vars['comment']->value){
?>
			<div class="<?php if (!$_smarty_tpl->getVariable('comment')->value->approved){?>unapproved<?php }?> row">
		 		<div class="checkbox cell">
					<input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->getVariable('comment')->value->id;?>
"/>				
				</div>
				<div class="name cell">
					<div class="comment_name">
					<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('comment')->value->name);?>

					<a class="approve" href="#">Одобрить</a>
					</div>
					<div class="comment_text">
					<?php echo nl2br(smarty_modifier_escape($_smarty_tpl->getVariable('comment')->value->text));?>

					</div>
					<div class="comment_info">
					Комментарий оставлен <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->getVariable('comment')->value->date);?>
 в <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['time'][0][0]->time_modifier($_smarty_tpl->getVariable('comment')->value->date);?>

					<?php if ($_smarty_tpl->getVariable('comment')->value->type=='product'){?>
					к товару <a target="_blank" href="<?php echo $_smarty_tpl->getVariable('config')->value->root_url;?>
/products/<?php echo $_smarty_tpl->getVariable('comment')->value->product->url;?>
#comment_<?php echo $_smarty_tpl->getVariable('comment')->value->id;?>
"><?php echo $_smarty_tpl->getVariable('comment')->value->product->name;?>
</a>
					<?php }elseif($_smarty_tpl->getVariable('comment')->value->type=='blog'){?>
					к статье <a target="_blank" href="<?php echo $_smarty_tpl->getVariable('config')->value->root_url;?>
/blog/<?php echo $_smarty_tpl->getVariable('comment')->value->post->url;?>
#comment_<?php echo $_smarty_tpl->getVariable('comment')->value->id;?>
"><?php echo $_smarty_tpl->getVariable('comment')->value->post->name;?>
</a>
					<?php }?>
					</div>
				</div>
				<div class="icons cell">
					<a class="delete" title="Удалить" href="#"></a>
				</div>
				<div class="clear"></div>
			</div>
			<?php }} ?>
		</div>
	
		<div id="action">
		Выбрать <label id="check_all" class="dash_link">все</label> или <label id="check_unapproved" class="dash_link">ожидающие</label>
	
		<span id="select">
		<select name="action">
			<option value="approve">Одобрить</option>
			<option value="delete">Удалить</option>
		</select>
		</span>
	
		<input id="apply_action" class="button_green" type="submit" value="Применить">

	</div>
	</form>
	
	<!-- Листалка страниц -->
	<?php $_template = new Smarty_Internal_Template('pagination.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>	
	<!-- Листалка страниц (The End) -->
		
</div>
<?php }else{ ?>
Нет комментариев
<?php }?>

<!-- Меню -->
<div id="right_menu">
	
	<!-- Категории товаров -->
	<ul>
	<li <?php if (!$_smarty_tpl->getVariable('type')->value){?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('type'=>null),$_smarty_tpl);?>
">Все комментарии</a></li>
	</ul>
	<ul>
		<li <?php if ($_smarty_tpl->getVariable('type')->value=='product'){?>class="selected"<?php }?>><a href='<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('keyword'=>null,'type'=>'product'),$_smarty_tpl);?>
'>К товарам</a></li>
		<li <?php if ($_smarty_tpl->getVariable('type')->value=='blog'){?>class="selected"<?php }?>><a href='<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('keyword'=>null,'type'=>'blog'),$_smarty_tpl);?>
'>К блогу</a></li>
	</ul>
	<!-- Категории товаров (The End)-->
	
</div>
<!-- Меню  (The End) -->


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

	// Выделить ожидающие
	$("#check_unapproved").click(function() {
		$('#list .unapproved input[type="checkbox"][name*="check"]').attr('checked', 1-$('#list .unapproved input[type="checkbox"][name*="check"]').attr('checked'));
	});	

	// Удалить 
	$("a.delete").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', false);
		$(this).closest(".row").find('input[type="checkbox"][name*="check"]').attr('checked', true);
		$(this).closest("form").find('select[name="action"] option[value=delete]').attr('selected', true);
		$(this).closest("form").submit();
	});
	
	// Одобрить
	$("a.approve").click(function() {
		var line        = $(this).closest(".row");
		var id          = line.find('input[type="checkbox"][name*="check"]').val();
		$.ajax({
			type: 'POST',
			url: 'ajax/update_object.php',
			data: {'object': 'comment', 'id': id, 'values': {'approved': 1}, 'session_id': '<?php echo $_SESSION['id'];?>
'},
			success: function(data){
				line.removeClass('unapproved');
			},
			dataType: 'json'
		});	
		return false;	
	});
	
	$("form#list_form").submit(function() {
		if($('#list_form select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
			return false;	
	});	
 	
});

</script>

