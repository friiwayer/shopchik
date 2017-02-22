{* Страница входа пользователя *}

{* Подключаем js-проверку формы *}
<script src="/js/baloon/js/default.js" language="JavaScript" type="text/javascript"></script>
<script src="/js/baloon/js/validate.js" language="JavaScript" type="text/javascript"></script>
<script src="/js/baloon/js/baloon.js" language="JavaScript" type="text/javascript"></script>
<link  href="/js/baloon/css/baloon.css" rel="stylesheet" type="text/css" /> 

    
<h2 class="centerBoxHeading">Панель Управления</h2>

{if $error}
<div class="message_error">
	{if $error == 'login_incorrect'}Неверный логин или пароль
	{elseif $error == 'user_disabled'}Ваш аккаунт еще не активирован.
	{else}{$error}{/if}
{/if}


<form method="post"><fieldset>
<legend>Вход</legend>

<label class="inputLabel" for="login-email-address">Email:</label>
<input type="text" name="email" size = "41" maxlength= "96" data-format="email" data-notice="Введите email" value="{$email|escape}" /><br class="clearBoth" />

<label class="inputLabel" for="login-password">Пароль:</label>
<input type="password" name="password" size = "41" maxlength = "40" data-format=".+" data-notice="Введите пароль" value="" /><br class="clearBoth" />
</fieldset>

<div class="buttonRow back"><input type="image" src="http://livedemo00.template-help.com/zencart_33775/includes/templates/theme490/buttons/english/button_login.gif" alt="Sign In" title=" Sign In " /></div>
<div class="buttonRow back">&nbsp; &nbsp; &nbsp;<a href="user/password_remind">Забыли Пароль?</a></div>
</form>
<br class="clearBoth" />

</div>