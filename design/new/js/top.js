$(document).ready(function(){

	// popular items animation
	$('.b-most-popular-nav').attr('rel',0);
	
	$('.b-most-popular-nav a').each(function(){
		$('.b-most-popular-nav').attr('rel',parseInt($('.b-most-popular-nav').attr('rel')) + $(this).width() + 8);
	});
	
	l = -1 * Math.round(parseInt($('.b-most-popular-nav').attr('rel')) / 2) + Math.round($('.b-most-popular-nav a:eq(0)').width() / 2) - 9;
	$('.b-most-popular-nav .arrow').css({marginLeft:l + 'px'}).show();
	
	$('.b-most-popular-nav a').click(function(){
		if ($(this).hasClass('active')) {
			return false;	
		}
		if ($(this).parent().hasClass('block')) {
			return false;	
		}
		$(this).parent().addClass('block');
		$('.b-most-popular-nav .active').removeClass('active');
		$(this).addClass('active');
		l = Math.round(parseInt($('.b-most-popular-nav').attr('rel')) / -2);
		(function(l){
			$('.b-most-popular-nav a').each(function(i){
				if ($(this).hasClass('active')) {
					l += Math.round(($(this).width()) / 2) - 8
					$('.b-most-popular-nav .arrow').animate({marginLeft:l + 'px'},400);
					$('.b-most-popular-screen .active').removeClass('active').fadeOut(100);
					$('.b-most-popular-screen ul:eq(' + i + ')').addClass('active').animate({left:'0%'},400,function(){;
						$('.b-most-popular-screen ul.active').prevAll().each(function(j){
							$(this).css({left:'-100%'}).show();
						});
						$('.b-most-popular-screen ul.active').nextAll().each(function(j){
							$(this).css({left:'100%'}).show();
						});
						$('.b-most-popular-nav').removeClass('block');
					});
					return false;
				}
				l += $(this).width() + 20;
			});
		}(l));
		return false;
	});
	
	// hiding something
	$(window).resize(function(){
		homeResize();
	});
	homeResize();
	
	function homeResize() {
		if ($(window).width() >= 1149) {
			$('.b-catalog-sections').removeClass('shorter');
			$('.b-main-page-news__main-news article h3').css('font-size','22px');
		} else {
			$('.b-catalog-sections').addClass('shorter');
			p = ($(window).width() - 1050) / 100;
			if (p < 0) {
				p = 0;
			}
			fs = p * 4.5 + 17.5;
			$('.b-main-page-news__main-news article h3').css('font-size',fs + 'px');
		} 
		
	}
});