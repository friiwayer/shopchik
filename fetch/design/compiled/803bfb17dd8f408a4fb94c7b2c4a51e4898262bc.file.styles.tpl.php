<?php /* Smarty version Smarty-3.0.7, created on 2012-07-16 13:59:16
         compiled from "simpla/design/html\styles.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1376550040214b234b4-72321466%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '803bfb17dd8f408a4fb94c7b2c4a51e4898262bc' => 
    array (
      0 => 'simpla/design/html\\styles.tpl',
      1 => 1323094254,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1376550040214b234b4-72321466',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'Z:\home\localhost\www\shop4\Smarty\libs\plugins\modifier.escape.php';
?><?php ob_start(); ?>
	<li><a href="index.php?module=ThemeAdmin">Тема</a></li>
	<li><a href="index.php?module=TemplatesAdmin">Шаблоны</a></li>		
	<li class="active"><a href="index.php?module=StylesAdmin">Стили</a></li>		
	<li><a href="index.php?module=ImagesAdmin">Изображения</a></li>		
<?php  Smarty::$_smarty_vars['capture']['tabs']=ob_get_clean();?>

<?php if ($_smarty_tpl->getVariable('style_file')->value){?>
<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_variable("Стиль ".($_smarty_tpl->getVariable('style_file')->value), null, 1);?>
<?php }?>
<link rel="stylesheet" href="design/js/codemirror/lib/codemirror.css">
<script src="design/js/codemirror/lib/codemirror.js"></script>
<script src="design/js/codemirror/lib/overlay.js"></script>

<link rel="stylesheet" href="design/js/codemirror/mode/css/css.css">
<script src="design/js/codemirror/mode/css/css.js"></script>
 

<style type="text/css">
	.CodeMirror {font-family:'Courier New'; padding-bottom:20px; margin-bottom:10px; border:1px solid #c0c0c0; background-color: #ffffff; height: auto; min-height: 300px; width:100%;}
	.activeline {background: #f0fcff !important;}
	.smarty {color: #ff008a;}
</style>

<script>
$(function() {	
	// Сохранение кода аяксом
	function save()
	{
		$('.CodeMirror').css('background-color','#e0ffe0');
		content = editor.getValue();
		
		$.ajax({
			type: 'POST',
			url: 'ajax/save_style.php',
			data: {'content': content, 'theme':'<?php echo $_smarty_tpl->getVariable('theme')->value;?>
', 'style': '<?php echo $_smarty_tpl->getVariable('style_file')->value;?>
', 'session_id': '<?php echo $_SESSION['id'];?>
'},
			success: function(data){
			
				$('.CodeMirror').animate({'background-color': '#ffffff'});
			},
			dataType: 'json'
		});
	}

	// Нажали кнопку Сохранить
	$('input[name="save"]').click(function() {
		save();
	});
	
	// Обработка ctrl+s
	var isCtrl = false;
	var isCmd = false;
	$(document).keyup(function (e) {
		if(e.which == 17) isCtrl=false;
		if(e.which == 91) isCmd=false;
	}).keydown(function (e) {
		if(e.which == 17) isCtrl=true;
		if(e.which == 91) isCmd=true;
		if(e.which == 83 && (isCtrl || isCmd)) {
			save();
			e.preventDefault();
		}
	});
});
</script>


<h1>Тема <?php echo $_smarty_tpl->getVariable('theme')->value;?>
, стиль <?php echo $_smarty_tpl->getVariable('style_file')->value;?>
</h1>

<?php if ($_smarty_tpl->getVariable('message_error')->value){?>
<!-- Системное сообщение -->
<div class="message message_error">
	<span>
	<?php if ($_smarty_tpl->getVariable('message_error')->value=='permissions'){?>Установите права на запись для файла <?php echo $_smarty_tpl->getVariable('style_file')->value;?>

	<?php }elseif($_smarty_tpl->getVariable('message_error')->value=='theme_locked'){?>Текущая тема защищена от изменений. Создайте копию темы.
	<?php }else{ ?><?php echo $_smarty_tpl->getVariable('message_error')->value;?>
<?php }?>
	</span>
</div>
<!-- Системное сообщение (The End)-->
<?php }?>

<!-- Список файлов для выбора -->
<div class="block layer">
	<div class="templates_names">
		<?php  $_smarty_tpl->tpl_vars['s'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('styles')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['s']->key => $_smarty_tpl->tpl_vars['s']->value){
?>
			<a <?php if ($_smarty_tpl->getVariable('style_file')->value==$_smarty_tpl->tpl_vars['s']->value){?>class="selected"<?php }?> href='index.php?module=StylesAdmin&file=<?php echo $_smarty_tpl->tpl_vars['s']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['s']->value;?>
</a>
		<?php }} ?>
	</div>
</div>

<?php if ($_smarty_tpl->getVariable('style_file')->value){?>
<div class="block">
<form>
	<textarea id="content" name="content" style="width:700px;height:500px;"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('style_content')->value);?>
</textarea>
</form>

<input class="button_green button_save" type="button" name="save" value="Сохранить" />
<div class="block">

<script>

var editor = CodeMirror.fromTextArea(document.getElementById("content"), {
		mode: {name: "css"},		
		lineNumbers: true,
		matchBrackets: false,
		enterMode: 'keep',
		indentWithTabs: false,
		indentUnit: 1,
		tabMode: 'classic',
		onCursorActivity: function() {
			editor.setLineClass(hlLine, null);
			hlLine = editor.setLineClass(editor.getCursor().line, "activeline");
		}
	});
	var hlLine = editor.setLineClass(0, "activeline");
</script>


<?php }?>