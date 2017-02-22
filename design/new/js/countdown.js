jQuery.fn.countdown = function (date, options) {
		options = jQuery.extend({
			lang: {
				years:   ['год', 'года', 'лет'],
				months:  ['месяц', 'месяца', 'месяцев'],
				days:    ['д', 'д', 'д'],
				hours:   ['ч', 'ч', 'ч'],
				minutes: ['м', 'м', 'м'],
				seconds: ['с', 'с', 'с'],
				plurar:  function(n) {
					return (n % 10 == 1 && n % 100 != 11 ? 0 : n % 10 >= 2 && n % 10 <= 4 && (n % 100 < 10 || n % 100 >= 20) ? 1 : 2);
				}
			}, 
			prefix: "", //Осталось 
			finish: ""	 //конец
		}, options);
 
		var timeDifference = function(begin, end) {
		    if (end < begin) {
			    return false;
		    }
            
                var offset = 0;
                var o = new Date();
                var utc = o.getTime() + (o.getTimezoneOffset() * 60000);
                var begin = new Date(utc + (3600000*offset));       
            
		    var diff = {
		    	seconds: [end.getSeconds() - begin.getSeconds(), 60],
		    	minutes: [end.getMinutes() - begin.getMinutes(), 60],
		    	hours: [end.getHours() - begin.getHours(), 24],
		    	days: [end.getDate() - begin.getDate(), new Date(begin.getYear(), begin.getMonth() + 1, 0).getDate() - 0],
		    	months: [end.getMonth() - begin.getMonth(), 12],
		    	years: [end.getYear()  - begin.getYear(), 1]
		    };
            
		    var result = new Array();
		    var flag = false;
		    for (i in diff) {
		    	if (flag) {
		    		diff[i][0]--;
		    		flag = false;
		    	}    	
		    	if (diff[i][0] < 0) {
		    		flag = true;
		    		diff[i][0] += diff[i][1];
		    	}
		    	if (!diff[i][0]) continue;
			    result.push('<span class="pric">' + diff[i][0] + '' + options.lang[i][options.lang.plurar(diff[i][0])]);
		    }
		    return result.reverse().join('</span>:');
		};
		var elem = $(this);
		var timeUpdate = function () {
		    var s = timeDifference(new Date(), date);
		    if (s.length) {
		    	elem.html(options.prefix + s);
		    } else {
		        clearInterval(timer);
		        elem.html(options.finish);
		    }		
		};
		timeUpdate();
		var timer = setInterval(timeUpdate, 1000);		
	};
$(function(){
    var c = $('span#compact');
    c.each(function(){
    var dat = $(this).html();
    var yu = dat.split("-");
    $(this).countdown(new Date(dat));    
});
}); 