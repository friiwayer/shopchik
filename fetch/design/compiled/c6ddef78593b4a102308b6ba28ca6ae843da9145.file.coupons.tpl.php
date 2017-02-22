<?php /* Smarty version Smarty-3.0.7, created on 2012-07-16 13:55:22
         compiled from "simpla/design/html\coupons.tpl" */ ?>
<?php /*%%SmartyHeaderCode:272815004012a1d3826-80846813%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c6ddef78593b4a102308b6ba28ca6ae843da9145' => 
    array (
      0 => 'simpla/design/html\\coupons.tpl',
      1 => 1340314798,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '272815004012a1d3826-80846813',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'Z:\home\localhost\www\shop4\Smarty\libs\plugins\modifier.escape.php';
if (!is_callable('smarty_modifier_date_format')) include 'Z:\home\localhost\www\shop4\Smarty\libs\plugins\modifier.date_format.php';
?>
<?php ob_start(); ?>
	<li><a href="index.php?module=UsersAdmin">Покупатели</a></li>
	<li><a href="index.php?module=GroupsAdmin">Группы</a></li>
	<li class="active"><a href="index.php?module=CouponsAdmin">Купоны</a></li>
<?php  Smarty::$_smarty_vars['capture']['tabs']=ob_get_clean();?>
<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_variable('Купоны', null, 1);?>
		
<div id="header">
	<?php if ($_smarty_tpl->getVariable('coupons_count')->value){?>
	<h1><?php echo $_smarty_tpl->getVariable('coupons_count')->value;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->getVariable('coupons_count')->value,'купон','купонов','купона');?>
</h1>
	<?php }else{ ?>
	<h1>Нет купонов</h1>
	<?php }?>
	<a class="add" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'CouponAdmin','return'=>$_SERVER['REQUEST_URI']),$_smarty_tpl);?>
">Новый купон</a>
</div>	

<?php if ($_smarty_tpl->getVariable('coupons')->value){?>
<div id="main_list">
	
	<!-- Листалка страниц -->
	<?php $_template = new Smarty_Internal_Template('pagination.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>	
	<!-- Листалка страниц (The End) -->

	<form id="form_list" method="post">
	<input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
	
		<div id="list">
			<?php  $_smarty_tpl->tpl_vars['coupon'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('coupons')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['coupon']->key => $_smarty_tpl->tpl_vars['coupon']->value){
?>
			<div class="<?php if ($_smarty_tpl->getVariable('coupon')->value->valid){?>green<?php }?> row">
		 		<div class="checkbox cell">
					<input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->getVariable('coupon')->value->id;?>
"/>				
				</div>
				<div class="coupon_name cell">			 	
	 				<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'CouponAdmin','id'=>$_smarty_tpl->getVariable('coupon')->value->id,'return'=>$_SERVER['REQUEST_URI']),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->getVariable('coupon')->value->code;?>
</a>
				</div>
				<div class="coupon_discount cell">			 	
	 				Скидка <?php echo $_smarty_tpl->getVariable('coupon')->value->value*1;?>
 <?php if ($_smarty_tpl->getVariable('coupon')->value->type=='absolute'){?><?php echo $_smarty_tpl->getVariable('currency')->value->sign;?>
<?php }else{ ?>%<?php }?><br>
	 				<?php if ($_smarty_tpl->getVariable('coupon')->value->min_order_price>0){?>
	 				<div class="detail">
	 				Для заказов от <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('coupon')->value->min_order_price);?>
 <?php echo $_smarty_tpl->getVariable('currency')->value->sign;?>

	 				</div>
	 				<?php }?>
				</div>
				<div class="coupon_details cell">			 	
					<?php if ($_smarty_tpl->getVariable('coupon')->value->single){?>
	 				<div class="detail">
	 				Одноразовый
	 				</div>
	 				<?php }?>
	 				<?php if ($_smarty_tpl->getVariable('coupon')->value->usages>0){?>
	 				<div class="detail">
	 				Использован <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('coupon')->value->usages);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->getVariable('coupon')->value->usages,'раз','раз','раза');?>

	 				</div>
	 				<?php }?>
	 				<?php if ($_smarty_tpl->getVariable('coupon')->value->expire){?>
	 				<div class="detail">
	 				<?php if (smarty_modifier_date_format(time(),'%Y%m%d')<=smarty_modifier_date_format($_smarty_tpl->getVariable('coupon')->value->expire,'%Y%m%d')){?>
	 				Действует до <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->getVariable('coupon')->value->expire);?>

	 				<?php }else{ ?>
	 				Истёк <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->getVariable('coupon')->value->expire);?>

	 				<?php }?>
	 				</div>
	 				<?php }?>
				</div>
				<div class="icons cell">
					<a href='#' class=delete></a>
				</div>
				<div class="name cell" style='white-space:nowrap;'>
					
	 				
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

	<!-- Листалка страниц -->
	<?php $_template = new Smarty_Internal_Template('pagination.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>	
	<!-- Листалка страниц (The End) -->
	
</div>
<?php }?>


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
		
	// Подтверждение удаления
	$("form").submit(function() {
		if($('#list input[type="checkbox"][name*="check"]:checked').length>0)
			if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
				return false;	
	});
});

</script>
