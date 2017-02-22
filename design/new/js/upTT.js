$(document).ready(function() {
	
	// Виджет кнопки вверх (Test-Templates)
	// Версия 1.0
	
	$('.up').append('<div class="button-up" style="display: none; padding-top: 22px; position: fixed;right:20px;z-index:300; bottom:82px;cursor: pointer;text-align: center;line-height: 30px;color: #FFF;font-weight: bold;">вверх</div>');
		
	$ (window).scroll (function () {
		if ($ (this).scrollTop () > 100) {
			$ ('.button-up').fadeIn();
		} else {
			$ ('.button-up').fadeOut();
		}
	});
	
	$('.button-up').click(function(){
		$('body,html').animate({
            scrollTop: 0
        }, 500);
        return false;
	});
	
	/*$('.button-up').hover(function() {
			$(this).animate({
				'opacity':'1',
			}).css({'background-color':'#eeefe8','color':'#6a86a4'});
		}, function(){
			$(this).animate({
				'opacity':'0.8'
			}).css({'background':'none','color':'#d3dbe4'});;
	});*/
		
});
  $(document).ready(function() {  
    $('.support').click(function(){
       $('.b-popup').smart_modal();
       $('.b-popup').smart_modal_show(); 
    });
  });