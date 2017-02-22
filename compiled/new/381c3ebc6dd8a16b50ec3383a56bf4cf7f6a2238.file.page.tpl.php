<?php /* Smarty version Smarty-3.0.7, created on 2012-09-13 21:24:50
         compiled from "Z:\home\localhost\www\shopchik//design/new/html\page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:746950523302881d00-41333325%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '381c3ebc6dd8a16b50ec3383a56bf4cf7f6a2238' => 
    array (
      0 => 'Z:\\home\\localhost\\www\\shopchik//design/new/html\\page.tpl',
      1 => 1345546949,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '746950523302881d00-41333325',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'Z:\home\localhost\www\shopchik\Smarty\libs\plugins\modifier.escape.php';
?>

<!-- Заголовок страницы -->
<h1 data-page="<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('page')->value->header);?>
</h1>

<!-- Тело страницы -->
<?php echo $_smarty_tpl->getVariable('page')->value->body;?>

