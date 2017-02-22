jQuery(document).ready(function($) {
// Main Menu fixing while scrolling
$.event.add(window, "scroll", main_menu_scroll);

});

var mainmenu = $('.topm');
var startMenu = $(mainmenu).offset().top;
function main_menu_scroll() {
	var p = $(window).scrollTop();
	$(mainmenu).css('position',((p)>startMenu) ? 'fixed' : 'static');
    $(mainmenu).css('height',((p)>startMenu) ? '35px' : '45px');
    $('.container nav').css('height',((p)>startMenu) ? '35px' : '45px');
    $('.container nav ul li a').css('height',((p)>startMenu) ? '23px' : '33px');
    $('.container nav ul li .subNav a').css('height',((p)>startMenu) ? '20px' : '20px');
    $('.container nav ul li .subNav a').css('line-height',((p)>startMenu) ? '20px' : '20px');
    $('.container nav ul li .subNav').css('top',((p)>startMenu) ? '35px' : '45px');
    $('.container nav ul li a.ddIcon').css('line-height',((p)>startMenu) ? '23px' : '33px');
    $('.container nav ul li a:last').css('border-width',((p)>startMenu) ? '0px' : '1px');
    $(mainmenu).css('box-shadow',((p)>startMenu) ? '0 2px 2px rgba(182, 182, 182, 0.75)' : 'none');
    $('a.bit').css('display',((p)>startMenu) ? 'block' : 'none');    
    $('a.cart').css('display',((p)>startMenu) ? 'block' : 'none');
	$(mainmenu).css('top',((p)>startMenu) ? '0px' : '');
}