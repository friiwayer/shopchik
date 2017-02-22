
jQuery(function($){
	$.datepicker.regional['ru'] = {
		closeText: 'закрыть',
		prevText: 'Пред',
		nextText: 'След',
		currentText: 'Aujourd\'hui',
		monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
		'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
		monthNamesShort: ['Янв.','Февр.','Март.','Апр.','Май.','Июнь',
		'Июль','Авг.','Сент.','Окт.','Нояб.','Дек.'],
		dayNames: ['Воскресенье','Понедельник','Вторник','Среда','Четверг','Пятница','Субота'],
		dayNamesShort: ['Вскр.','Пон.','Вт.','Сред.','Чет.','Пят.','Суб.'],
		dayNamesMin: ['В','П','В','С','Ч','П','С'],
		weekHeader: 'Sem.',
		dateFormat: 'yy-mm-dd',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['ru']);
});
