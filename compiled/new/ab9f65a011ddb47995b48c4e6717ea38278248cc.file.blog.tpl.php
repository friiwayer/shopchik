<?php /* Smarty version Smarty-3.0.7, created on 2017-02-21 03:42:40
         compiled from "D:\OpenServer\domains\shopchik//design/new/html\blog.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2490758aba9202617b6-34430170%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ab9f65a011ddb47995b48c4e6717ea38278248cc' => 
    array (
      0 => 'D:\\OpenServer\\domains\\shopchik//design/new/html\\blog.tpl',
      1 => 1347781058,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2490758aba9202617b6-34430170',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'D:\OpenServer\domains\shopchik\Smarty\libs\plugins\modifier.escape.php';
?>

<!-- Заголовок /-->
<h1><?php echo $_smarty_tpl->getVariable('page')->value->name;?>
</h1>

<?php $_template = new Smarty_Internal_Template('pagination.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<!-- Статьи /-->
<ul id="blog">
	<?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('posts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
?>
	<li>
		<h3><span class="date"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->getVariable('post')->value->date);?>
</span> <a data-post="<?php echo $_smarty_tpl->getVariable('post')->value->id;?>
" href="blog/<?php echo $_smarty_tpl->getVariable('post')->value->url;?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('post')->value->name);?>
</a></h3>
        <?php echo $_smarty_tpl->getVariable('post')->value->annotation;?>

	</li>
	<?php }} ?>
</ul>
<!-- Статьи #End /-->    

<?php $_template = new Smarty_Internal_Template('pagination.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
          