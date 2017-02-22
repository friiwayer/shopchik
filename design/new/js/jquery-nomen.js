$(function(){

function checkmail(value) {
reg = "/[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/";
if (!value.match(reg)) {alert("Пожалуйста, введите свой настоящий e-mail"); 
$('.imail').val(''); return false; }else{return true;}
}

$('#ask').click(function(){
       $('.b-popups').smart_modal();
       $('.b-popups').smart_modal_show(); 
});

$('#id_email').bind("change",function(){
   checkmail($('.imail').val());
});        
});