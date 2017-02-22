<?php /* Smarty version Smarty-3.0.7, created on 2012-09-06 22:08:36
         compiled from "Z:\home\localhost\www\shopchik//design/new/html\compare_informer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:460504902c4126114-25012794%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1e494bcb23089d0ea4fbcf3dc185c31f0b15a62' => 
    array (
      0 => 'Z:\\home\\localhost\\www\\shopchik//design/new/html\\compare_informer.tpl',
      1 => 1346338916,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '460504902c4126114-25012794',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!--
/**
 * For Simpla CMS
 *
 * @link		http://forum.simplacms.ru/profile/1024/Wizard
 * @author		Wizard
 *
 */
 -->

<?php if ($_smarty_tpl->getVariable('compare')->value->total>0){?>
	В <a href="/compare/">сравнении</a> <?php echo $_smarty_tpl->getVariable('compare')->value->total;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->getVariable('compare')->value->total,'товар','товаров','товара');?>

<?php }else{ ?>
	Список сравнения пуст
<?php }?>
