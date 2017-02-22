$(function(){
	// zen button hover
	$(".button, #productTellFriendLink, #productReviewLink, .navNextPrevList, .buttonRow, .btn1").hover(function(){
		$(this).find("a").stop().animate({opacity:0.7}, "fast") 
	}, function(){
		$(this).find("a").stop().animate({opacity:1}, "fast")
	});
});
$(function(){
	// zen button hover
	$(".buttonRow").hover(function(){
		$(this).find("input").stop().animate({opacity:0.7}, "fast") 
	}, function(){
		$(this).find("input").stop().animate({opacity:1}, "fast")
	});
});




