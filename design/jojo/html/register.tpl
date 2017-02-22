{* Страница регистрации *}
{$meta_title = "Регистрация на сайте" scope=parent}
<h1>Регистрация Нового покупателя</h1>
<p>Все поля регистрации, обязательны для заполнения.</p>
{if $error}
<div class="message_error">
	{if $error == 'empty_name'}Введите имя
	{elseif $error == 'empty_email'}Введите email
    {elseif $error == 'wrong_email'}Введите правильный email
	{elseif $error == 'empty_password'}Введите пароль
    {elseif $error == 'empty_postindex'}Введите свой почтовый индекс
    {elseif $error == 'empty_adress'}Введите свой адресс
    {elseif $error == 'empty_phone'}Введите свой номер телефона
	{elseif $error == 'user_exists'}Пользователь с таким email уже зарегистрирован
    {elseif $error == 'captcha'}Не верно ввели код проверки
	{else}{$error}{/if}
</div>
{/if}

<form class="form register_form" method="post">
	<label>Имя</label>
	<input type="text" name="name" data-format=".+" data-notice="Введите имя" value="{$name|escape}" maxlength="255" />
	
	<label>Email</label>
	<input type="text" name="email" data-format="email" data-notice="Введите email" value="{$email|escape}" maxlength="255" />
    
    <label>Номер телефона</label>
    <input type="text" name="phone" data-format="" data-notice="Номер телефона для связи" value="{$phone|escape}" maxlength="255" />
    
    <label>Почтовый индекс</label>
    <input type="text" name="postindex" data-format="" data-notice="Введите Почтовый индекс" value="{$postindex|escape}" maxlength="255" />
    
    <label>Адресс вашего проживания</label>
    <textarea name="adress" data-format=".+" data-notice="Ваш адрес прописки">{$adress|escape}</textarea>
    
    <label>Пароль</label>
    <input type="password" name="password" data-format=".+" data-notice="Введите пароль" value="" />
    
    <div class="captcha"><img src="captcha/image.php?{math equation='rand(10,10000)'}" alt='captcha'/></div> 
		<input class="input_captcha" id="comment_captcha" type="text" name="captcha_code" value="" data-format="\d\d\d\d\" data-notice="Введите капчу"/>
        
	<input type=submit class="button" name="register" value="Зарегистрироваться">
</form>
