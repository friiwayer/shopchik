<?php /* Smarty version Smarty-3.0.7, created on 2012-07-16 13:59:17
         compiled from "simpla/design/html\images.tpl" */ ?>
<?php /*%%SmartyHeaderCode:69385004021587e959-59812064%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'af34200f7754f186621060d1d78fba4c7fb4cdd2' => 
    array (
      0 => 'simpla/design/html\\images.tpl',
      1 => 1340132348,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '69385004021587e959-59812064',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'Z:\home\localhost\www\shop4\Smarty\libs\plugins\modifier.escape.php';
if (!is_callable('smarty_modifier_truncate')) include 'Z:\home\localhost\www\shop4\Smarty\libs\plugins\modifier.truncate.php';
?><?php ob_start(); ?>
	<li><a href="index.php?module=ThemeAdmin">Тема</a></li>
	<li><a href="index.php?module=TemplatesAdmin">Шаблоны</a></li>		
	<li><a href="index.php?module=StylesAdmin">Стили</a></li>		
	<li class="active"><a href="index.php?module=ImagesAdmin">Изображения</a></li>		
<?php  Smarty::$_smarty_vars['capture']['tabs']=ob_get_clean();?>

<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_variable("Изображения", null, 1);?>

<script>
$(function() {

	// Редактировать
	$("a.edit").click(function() {
		name = $(this).closest('li').attr('name');
		inp1 = $('<input type=hidden name="old_name[]">').val(name);
		inp2 = $('<input type=text name="new_name[]">').val(name);
		$(this).closest('li').find("p.name").html('').append(inp1).append(inp2);
		inp2.focus().select();
		return false;
	});
 

	// Удалить 
	$("a.delete").click(function() {
		name = $(this).closest('li').attr('name');
		$('input[name=delete_image]').val(name);
		$(this).closest("form").submit();
	});
	
	// Загрузить
	$("#upload_image").click(function() {
		$(this).closest('div').append($('<input type=file name=upload_images[]>'));
	});
	
	$("form").submit(function() {
		if($('input[name="delete_image"]').val()!='' && !confirm('Подтвердите удаление'))
			return false;	
	});

});
</script>


<h1>Изображения темы <?php echo $_smarty_tpl->getVariable('theme')->value;?>
</h1>

<?php if ($_smarty_tpl->getVariable('message_error')->value){?>
<!-- Системное сообщение -->
<div class="message message_error">
	<span><?php if ($_smarty_tpl->getVariable('message_error')->value=='permissions'){?>Установите права на запись для папки <?php echo $_smarty_tpl->getVariable('images_dir')->value;?>

	<?php }elseif($_smarty_tpl->getVariable('message_error')->value=='name_exists'){?>Файл с таким именем уже существует
	<?php }elseif($_smarty_tpl->getVariable('message_error')->value=='theme_locked'){?>Текущая тема защищена от изменений. Создайте копию темы.
	<?php }else{ ?><?php echo $_smarty_tpl->getVariable('message_error')->value;?>
<?php }?></span>
</div>
<!-- Системное сообщение (The End)-->
<?php }?>

<form method="post" enctype="multipart/form-data">
<input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
<input type="hidden" name="delete_image" value="">
<!-- Список файлов для выбора -->
<div class="block layer">
	<ul class="theme_images">
		<?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('images')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
?>
			<li name='<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('image')->value->name);?>
'>
			<a href='#' class='delete' title="Удалить"><img src='design/images/delete.png'></a>
			<a href='#' class='edit' title="Переименовать"><img src='design/images/pencil.png'></a>
			<p class="name"><?php echo smarty_modifier_truncate(smarty_modifier_escape($_smarty_tpl->getVariable('image')->value->name),16,'...');?>
</p>
			<div class="theme_image">
			<a class='preview' href='../<?php echo $_smarty_tpl->getVariable('images_dir')->value;?>
<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('image')->value->name);?>
'><img src='../<?php echo $_smarty_tpl->getVariable('images_dir')->value;?>
<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('image')->value->name);?>
'></a>
			</div>
			<p class=size><?php if ($_smarty_tpl->getVariable('image')->value->size>1024*1024){?><?php echo round(($_smarty_tpl->getVariable('image')->value->size/1024/1024),2);?>
 МБ<?php }elseif($_smarty_tpl->getVariable('image')->value->size>1024){?><?php echo round(($_smarty_tpl->getVariable('image')->value->size/1024),2);?>
 КБ<?php }else{ ?><?php echo $_smarty_tpl->getVariable('image')->value->size;?>
 Байт<?php }?>, <?php echo $_smarty_tpl->getVariable('image')->value->width;?>
&times;<?php echo $_smarty_tpl->getVariable('image')->value->height;?>
 px</p>
			</li>
		<?php }} ?>
	</ul>
</div>


<div class="block upload_image">
<span id="upload_image"><i class="dash_link">Добавить изображение</i></span>
</div>

<div class="block">
<input class="button_green button_save" type="submit" name="save" value="Сохранить" />
</div>

</form>
