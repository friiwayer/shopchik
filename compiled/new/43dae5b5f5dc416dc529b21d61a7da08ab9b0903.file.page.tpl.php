<?php /* Smarty version Smarty-3.0.7, created on 2017-02-21 02:59:48
         compiled from "D:\OpenServer\domains\shopchik//design/new/html\page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1789958ab9f14add0d1-15362100%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '43dae5b5f5dc416dc529b21d61a7da08ab9b0903' => 
    array (
      0 => 'D:\\OpenServer\\domains\\shopchik//design/new/html\\page.tpl',
      1 => 1345543348,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1789958ab9f14add0d1-15362100',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'D:\OpenServer\domains\shopchik\Smarty\libs\plugins\modifier.escape.php';
?>

<!-- Заголовок страницы -->
<h1 data-page="<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('page')->value->header);?>
</h1>

<!-- Тело страницы -->
<?php echo $_smarty_tpl->getVariable('page')->value->body;?>

