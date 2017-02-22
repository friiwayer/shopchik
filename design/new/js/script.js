$(function(){
	var note = $('span#compact'),
		newYear = true;
	
    var c = $('span#compact');
    c.each(function(){ 
    var ts = $(this).html();	
	c.countdown({
		timestamp	: "2013, 11, 0, 10",
		callback	: function(days, hours, minutes, seconds){
			
			var message = "";
			
			message += days + " day" + ( days==1 ? '':'s' ) + ", ";
			message += hours + " hour" + ( hours==1 ? '':'s' ) + ", ";
			message += minutes + " minute" + ( minutes==1 ? '':'s' ) + " and ";
			message += seconds + " second" + ( seconds==1 ? '':'s' ) + " <br />";
			
			note.html(message);
		}
	});
   	});
});
