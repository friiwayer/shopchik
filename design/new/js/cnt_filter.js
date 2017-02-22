function sent(){
    var price_from = $("#cena_ot").val();
    var price_to = $("#cena_do").val();
    var link_a = '?cena_from='+ price_from + '&cena_to='+price_to;
    var fname = price_from+':'+price_to;
    var cat = $('#catee').val();
    send_json($('#show_c'),link_a,fname,cat);
}
function send_json (blok, value, fnam, cat)
{
    $.ajax({
    		url: "ajax/count_filter.php",
    		data: {'fname':fnam ,'categorry':cat},
	     	type: 'get',
            datatype: 'json',
    		success: function(data){
            if(data){
                blok.show();
    			blok.html('<span>Показать </span><a href="catalog/'+cat+value+'"> '+ data +' товаров</a>');
            }
    		}
    	});
}


function ssend_j(blok, filter, link)
{
    $.ajax({
    		url: "ajax/count_filter.php",
    		data: {filter:filter},
            datatype: 'json',
	     	type: 'get',
    		success: function(data){
            if(data){
                $('#show_c').hide();
                blok.show();
    			blok.html('<a href="'+link+'">найдено '+ data +' товаров</a>');
            }
    		}
    	});
}

function pause( iMilliseconds ) 
{ 
    var sDialogScript = 'window.setTimeout( function () { window.close(); }, ' + iMilliseconds + ');'; 
    window.showModalDialog('javascript:document.writeln("<script>' + sDialogScript + '<' + '/script>")'); 
} 

function bef_send_form(a)
{
    var ot = a.attr('ot');
    var to = a.attr('do');
    $('#cena_ot').val(ot);
    $("#slider").slider("values",0,ot);
    $('#cena_do').val(to);
    $("#slider").slider("values",1,to);
    return false;
}

function  bef_send_a(link)
{
    var price_f = $('.first a').attr('href');
    var anon = $('#show_c a').attr('href');
    var cat = $('#catee').val();
    if(price_f != null && price_f != undefined)
    {
    var price_from = $("#cena_ot").val();
    var price_to = $("#cena_do").val();
    var perem = link.attr('href').split('/');
    var id_f = perem[3].split('?');

    var fnam = price_from+','+price_to;
    var a_l = $('.first a').attr('href') + '&' + id_f[1];    
    var retur = fnam + ',' + cat + ',' +key[0]+','+key[1];
    ssend_j($('.filter_'+key[0]), retur, a_l);        
          
    }else{
    var a_l = link.attr('href');
    var perem = link.attr('href').split('/');
    var id_f = perem[3].split('?');
    var key = id_f[1].split('=');
    var retur = key[0]+','+key[1]+','+cat;
    ssend_j($('.filter_'+key[0]), retur, a_l);
    }    
    return false;
}

function sort_ajax(link)
{   
    var a = link.split('/');
    var b = a[3].split('?');
    return b[1];
}


function ajax_array_send(string, cat)
{
$.ajax({
    		url: "ajax/sorting.php",
    		data: {sort:string,cat:cat},
            datatype: 'json',
	     	type: 'get',
    		success: function(data){
            if(data){
            alert(data);
            }
    		}
    	});    
}

$(function(){
   /*$('a.oname').click(function(){
    $('#blog_menu #show_c').hide();
    bef_send_a($(this));
    return false;
   });*/
   /*var cat = $('#catee').val();
   $('.sort a').click(function(){
    ajax_array_send(sort_ajax($(this).attr('href')), cat);
    return false;
   })*/
});