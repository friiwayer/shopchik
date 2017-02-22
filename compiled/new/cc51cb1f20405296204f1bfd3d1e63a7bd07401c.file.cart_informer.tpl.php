<?php /* Smarty version Smarty-3.0.7, created on 2012-09-06 16:10:25
         compiled from "Z:\home\localhost\www\shopchik//design/new/html\cart_informer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:102775048aed11eb8a2-00524013%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cc51cb1f20405296204f1bfd3d1e63a7bd07401c' => 
    array (
      0 => 'Z:\\home\\localhost\\www\\shopchik//design/new/html\\cart_informer.tpl',
      1 => 1345546948,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '102775048aed11eb8a2-00524013',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'Z:\home\localhost\www\shopchik\Smarty\libs\plugins\modifier.escape.php';
?>
<?php if ($_smarty_tpl->getVariable('cart')->value->total_products>0){?>
<div class="cartf"></div>
	В <a href="./cart/">корзине</a>
	<?php echo $_smarty_tpl->getVariable('cart')->value->total_products;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->getVariable('cart')->value->total_products,'товар','товаров','товара');?>

	на <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('cart')->value->total_price);?>
 <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('currency')->value->sign);?>

<?php }else{ ?>
<div class="carts"></div>
	Корзина пуста
<?php }?>
