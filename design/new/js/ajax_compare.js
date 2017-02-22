// Добавление товара к сравнению

$('input[name=compare]:checked').live('click', function(e) {

      var val = $(this).val()
      var bl =  $(this).closest('.compare');

      $.ajax({
    		url: "ajax/compare.php",
    		data: {compare: val},
	     	dataType: 'json',
    		success: function(data){
            if(data){
    			$('#compare_informer').html(data);
    			bl.html("В списке <a href=\"/compare/\">сравнения</a>");
            }
    		}
    	});

    	var o1 = $(this).offset();
    	var o2 = $('#compare_informer').offset();
    	var dx = o1.left - o2.left;
    	var dy = o1.top - o2.top;
    	var distance = Math.sqrt(dx * dx + dy * dy);
    	$(this).closest('.product').find('.image img').effect("transfer", { to: $("#compare_informer"), className: "transfer_class" }, distance);
    	$('.transfer_class').html($(this).closest('.product').find('.image').html());
    	$('.transfer_class').find('img').css('height', '100%');
    	return false;

});

