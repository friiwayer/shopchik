<?php /* Smarty version Smarty-3.0.7, created on 2017-02-21 02:59:48
         compiled from "D:\OpenServer\domains\shopchik//design/new/html\cart_informer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3030958ab9f1441e647-42697757%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9f5ebb649eea9d4eff5bdbf3ae35f549b7b9b965' => 
    array (
      0 => 'D:\\OpenServer\\domains\\shopchik//design/new/html\\cart_informer.tpl',
      1 => 1345543348,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3030958ab9f1441e647-42697757',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'D:\OpenServer\domains\shopchik\Smarty\libs\plugins\modifier.escape.php';
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
