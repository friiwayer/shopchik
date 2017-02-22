<?php /* Smarty version Smarty-3.0.7, created on 2013-02-11 18:31:53
         compiled from "fetch/design/html\asks.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2398851192b09dc8ae8-63601448%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dca4f1c4cb83d5563c9ac2bd2b5558739e97cf67' => 
    array (
      0 => 'fetch/design/html\\asks.tpl',
      1 => 1356506129,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2398851192b09dc8ae8-63601448',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'Z:\home\localhost\www\shopchik\Smarty\libs\plugins\modifier.escape.php';
?>
<?php ob_start(); ?>
	<li><a href="index.php?module=ProductsAdmin">Товары</a></li>
	<li><a href="index.php?module=CategoriesAdmin">Категории</a></li>
	<li><a href="index.php?module=BrandsAdmin">Бренды</a></li>
	<li><a href="index.php?module=FeaturesAdmin">Свойства</a></li>
    <li class="active"><a href="index.php?module=AskProduct">Вопросы по товарам <span class="colc"><?php echo $_smarty_tpl->getVariable('col')->value->col;?>
</span></a></li>
    <li><a href="index.php?module=Showe">Обратная связь <span class="colc"><?php echo $_smarty_tpl->getVariable('erc')->value->ercol;?>
</span></a></li>      
<?php  Smarty::$_smarty_vars['capture']['tabs']=ob_get_clean();?>
<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_variable('Вопросы по товарам', null, 1);?>
<div id="header">
	<h1>Вопросы по товарам</h1>
</div>
<?php if ($_smarty_tpl->getVariable('asks')->value){?>
<div id="main_list" class="asks">
	<!-- Листалка страниц -->
	<?php $_template = new Smarty_Internal_Template('pagination.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>	
	<!-- Листалка страниц (The End) -->

	<form id="list_form" method="post">
	<input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
		<div id="list">
		<?php  $_smarty_tpl->tpl_vars['as'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('asks')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['as']->key => $_smarty_tpl->tpl_vars['as']->value){
?>
        <div class="row">
        <div class="checkbox cell">
		<input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->getVariable('as')->value->id;?>
" />				
		</div>
        <div class="cell"><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'AskProduc','id'=>$_smarty_tpl->getVariable('as')->value->id,'return'=>$_SERVER['REQUEST_URI']),$_smarty_tpl);?>
">имя: <b><?php echo $_smarty_tpl->getVariable('as')->value->name;?>
</b>
        |  товар: <b><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('as')->value->product);?>
</b></a> <?php echo $_smarty_tpl->getVariable('as')->value->date;?>

        </div>
        <div class="icons cell">
            <?php if ($_smarty_tpl->getVariable('as')->value->status!=1){?>				
			<a class="delete"  title="Удалить" href="#"></a>
            <?php }else{ ?>
            <a class="asked"></a>
            <a class="delete"  title="Удалить" href="#"></a>
            <?php }?>
		</div>
		<div class="clear"></div>
        </div>
        <?php }} ?>
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
    <?php }else{ ?>
Нет Вопросов
    <?php }?>
</div>
	<!-- Листалка страниц -->
	<?php $_template = new Smarty_Internal_Template('pagination.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>	
	<!-- Листалка страниц (The End) -->		

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
