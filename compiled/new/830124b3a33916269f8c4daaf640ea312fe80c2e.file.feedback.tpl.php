<?php /* Smarty version Smarty-3.0.7, created on 2017-02-21 03:43:34
         compiled from "D:\OpenServer\domains\shopchik//design/new/html\feedback.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1300558aba9561b2099-35843046%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '830124b3a33916269f8c4daaf640ea312fe80c2e' => 
    array (
      0 => 'D:\\OpenServer\\domains\\shopchik//design/new/html\\feedback.tpl',
      1 => 1345543348,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1300558aba9561b2099-35843046',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'D:\OpenServer\domains\shopchik\Smarty\libs\plugins\modifier.escape.php';
if (!is_callable('smarty_function_math')) include 'D:\OpenServer\domains\shopchik\Smarty\libs\plugins\function.math.php';
?>

<h1><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('page')->value->name);?>
</h1>

<?php echo $_smarty_tpl->getVariable('page')->value->body;?>


<h2>Обратная связь</h2>

<?php if ($_smarty_tpl->getVariable('message_sent')->value){?>
	<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('name')->value);?>
, ваше сообщение отправлено.
<?php }else{ ?>
<form class="form feedback_form" method="post">
	<?php if ($_smarty_tpl->getVariable('error')->value){?>
	<div class="message_error">
		<?php if ($_smarty_tpl->getVariable('error')->value=='captcha'){?>
		Неверно введена капча
		<?php }elseif($_smarty_tpl->getVariable('error')->value=='empty_name'){?>
		Введите имя
		<?php }elseif($_smarty_tpl->getVariable('error')->value=='empty_email'){?>
		Введите email
		<?php }elseif($_smarty_tpl->getVariable('error')->value=='empty_text'){?>
		Введите сообщение
		<?php }?>
	</div>
	<?php }?>
	<label>Имя</label>
	<input data-format=".+" data-notice="Введите имя" value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('name')->value);?>
" name="name" maxlength="255" type="text"/>
 
	<label>Email</label>
	<input data-format="email" data-notice="Введите email" value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('email')->value);?>
" name="email" maxlength="255" type="text"/>
	
	<label>Сообщение</label>
	<textarea data-format=".+" data-notice="Введите сообщение" value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('message')->value);?>
" name="message"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('message')->value);?>
</textarea>

	<input class="button" type="submit" name="feedback" value="Отправить" />

	<div class="captcha"><img src="captcha/image.php?<?php echo smarty_function_math(array('equation'=>'rand(10,10000)'),$_smarty_tpl);?>
"/></div> 
	<input class="input_captcha" id="comment_captcha" type="text" name="captcha_code" value="" format="\d\d\d\d" notice="Введите капчу"/>
	
</form>
<?php }?>