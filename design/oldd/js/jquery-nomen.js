$(function(){
$('#ask').click(function(){
$('.foo').dialog({ title: "Задайте ваш вопрос.",buttons: { 
"Ок": function() { 
var fap =  $('.subg').val();
var mail = $('.foo input[name=mail]').val();
var id_tovar = $('#ask').attr('href');
var user = $('.foo input[name=uname]').val();
var tname = $('.tname').html();
if(fap != '' && checkmail(mail))
    {
    $.ajax({
    type: "post",
    url: "ajax/ask.php",
    data:{email:mail, mesg:fap, id:id_tovar, uname:user, product:tname},
    success: function(){
    $('.foo > input').css('display','none');
    $('.foo textarea').val('Ваш вопрос был добавлен, скоро на указанную вам почту прийдет ответ.');
    setTimeout($('.foo').dialog('close'), 10000);
    }    
    })
}else{
$('#infa').val('Заполните поля');}
}, 
"Отмена": function(){
$(this).dialog("close"); 
} 
}});
});

function fileExists(fileLocation) {
    var response = $.ajax({
        url: fileLocation,
        type: 'HEAD',
        async: false
    }).status;
    alert(response);
}
function checkmail(value) {
reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
if (!value.match(reg)){alert("Пожалуйста, введите свой настоящий e-mail"); return false; 
}else {return true;}
}            
});