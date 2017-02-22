<?php /* Smarty version Smarty-3.0.7, created on 2017-02-21 03:43:20
         compiled from "D:\OpenServer\domains\shopchik//design/new/html\staty.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1577358aba948d38340-99285395%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a7a01fa559b614f25fa7d9d2f5c23e93aafa98a' => 
    array (
      0 => 'D:\\OpenServer\\domains\\shopchik//design/new/html\\staty.tpl',
      1 => 1357130576,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1577358aba948d38340-99285395',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'D:\OpenServer\domains\shopchik\Smarty\libs\plugins\modifier.escape.php';
?>

<!-- Заголовок /-->
<h1><?php echo $_smarty_tpl->getVariable('staty')->value->name;?>
</h1>

<!-- Статьи /-->
<ul id="blog">
	<?php  $_smarty_tpl->tpl_vars['st'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('staty')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['st']->key => $_smarty_tpl->tpl_vars['st']->value){
?>
	<li style="height:100px;">
    <?php if ($_smarty_tpl->getVariable('st')->value->image){?>
    <div style="width:100%;" class="blog">
    <div class="leftcol"><a data-post="<?php echo $_smarty_tpl->getVariable('st')->value->id;?>
" href="staty/<?php echo $_smarty_tpl->getVariable('st')->value->url;?>
"><img src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->getVariable('st')->value->image->filename,80);?>
" style="max-width:90px; max-height:90px;" alt="<?php echo $_smarty_tpl->getVariable('st')->value->name;?>
" /></a></div>
    <?php }?>
	<div class="rightcol"><h3><a data-post="<?php echo $_smarty_tpl->getVariable('st')->value->id;?>
" href="staty/<?php echo $_smarty_tpl->getVariable('st')->value->url;?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('st')->value->name);?>
</a> <span class="dato"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->getVariable('post')->value->date);?>
</span></h3>
	<?php echo $_smarty_tpl->getVariable('st')->value->annotation;?>

    </div>
    </div>
    <div class="clear"></div>
	</li>
	<?php }} ?>
</ul>
<!-- Статьи #End /-->    
<?php $_template = new Smarty_Internal_Template('pagination.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>