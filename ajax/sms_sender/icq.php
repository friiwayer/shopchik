<?php
/**	---------------------------------------
 **	Пример скрипта для отправке писем в ICQ
 **	Источник: live-code.ru
 **	---------------------------------------
 **/
 
// Убираем лимит на выполнение скрипта
set_time_limit(0); 

// Сколько сек. ждать после последней отправке
$sleep = 45; // в сек.

// Список UIN номнров для подключения
// UIN;PASSWORD
$Connect_list = file('connect-uin.txt');

// Список UIN на которые будет отправлены сообщения
// UIN
$Send_list = file('send-uin.txt');

// Подключаем класс WebIcqLite
require_once('libs/WebIcqLite.class.php');

## текст сообщения
$text = "Здравствуйте, я ICQ бот написанный на PHP";
// ICQ принимает текст в windows-1251
$text = iconv('utf-8', 'windows-1251', $text);

// Создаем класс
$icq = new WebIcqLite();

foreach($Send_list as $k) {

	// Выбирает рандом UIN для отправки сообщения (в избежании бана)
	$Choose_uin = $Connect_list[rand(0, count($Connect_list)-1)];
	$Connect_data = explode(";", $Choose_uin);
	$uin = $Connect_data[0];
	$pas = $Connect_data[1];

	// Подключаемся
	sleep($sleep);
	if($icq->connect($uin, $pas)){
		// Отправляем сообщение
		$send = $icq->send_message($k, $text);
		if(!$send) {
			// Если возникла ошибка, мы получем её текст
			echo $k." - ".$icq->error."<br />";
		}
		 else{
			// Если письмо удачно отправлено, мы увидем этот текст
			echo $k.' Message sent! <br />';
		 }
		 
		// Закрываем подключение к UIN
		$icq->disconnect();
	}
	 else {
		// Если не удалось подключится, мы увидем этот текст
		echo $k." - ".$icq->error."<br />";
	 }
}
?>
