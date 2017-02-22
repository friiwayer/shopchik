{* Страница регистрации *}

<h2 class="centerBoxHeading">Регистрация в Техно Свит</h2>

{if $error}
<div class="message_error">
	{if $error == 'empty_name'}Введите имя
	{elseif $error == 'empty_email'}Введите email
	{elseif $error == 'empty_password'}Введите пароль
	{elseif $error == 'user_exists'}Пользователь с таким email уже зарегистрирован
	{else}{$error}{/if}
</div>
{/if}

<form method="post"><fieldset>
<legend>Регистрация</legend>

<label class="inputLabel" for="firstname">Имя</label>
<input type="text"  size = "41" maxlength= "96" name="name" data-format=".+" data-notice="Введите имя" value="{$name|escape}" /><br class="clearBoth" />

<label class="inputLabel" for="email-address">Email</label>
<input size = "41" maxlength = "40" name="email" data-format="email" data-notice="Введите email" value="{$email|escape}" /><br class="clearBoth" />

<label class="inputLabel" for="password-new">Пароль</label>
<input size = "41" maxlength = "40" type="password" name="password" data-format=".+" data-notice="Введите пароль" value="" /><br class="clearBoth" />

<input type=submit class="button" name="register" value="Зарегистрироваться">
</fieldset>


</form>
<br class="clearBoth" />


