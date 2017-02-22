$(document).ready(function() {
		  
          
			$('div.qiwi, div.wbm, div.ya').tinyTips('blue', 'title');
			$('a.imgTip').tinyTips('blue');
			$('img.tTip').tinyTips('blue', 'title');
			$('h1.tagline').tinyTips('blue');
            
////////////////////////////////////

          function check_sum(element,a)
          { 
            var numeric = 0;
            var j = 0;
            var cena = parseInt($('span.def_price').html().replace(" ", ""));
            
            element.each(function(){
            if($(this).is(':checked'))
            {                   
               numeric += parseInt($(this).parent('a').children('span#cenik').html().replace(" ", ""));
            }else{
            }        
            });
            
            var fin = cena + numeric;
            return fin;
          }
           
          function make_space(e)
          {
            
          } 
////////////////////////////////////
            
            var price = $('span.pricec').html().replace(" ", "");
            $('.ac_ad ul li a').toggle(function(){
                $(this).find('input[type=checkbox]').attr('checked','true');
                
            }, function(){
                $(this).find('input[type=checkbox]').removeAttr('checked');
            });
            
            $('.ac_ad ul li a').bind('click', function(){
                $('span.pricec').html(check_sum($('.ac_ad ul li a').find('input[type=checkbox]'),$(this)).toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 '));
   });
});