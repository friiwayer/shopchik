<?php /* Smarty version Smarty-3.0.7, created on 2012-10-27 18:19:18
         compiled from "fetch/design/html\currency.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28645508c09862f9169-48662826%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd839e3fbb633cd4b8e0b02538b77e1c328db5f45' => 
    array (
      0 => 'fetch/design/html\\currency.tpl',
      1 => 1351354756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28645508c09862f9169-48662826',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'Z:\home\localhost\www\shopchik\Smarty\libs\plugins\modifier.escape.php';
?><?php ob_start(); ?>
		<li><a href="index.php?module=SettingsAdmin">Настройки</a></li>
		<li class="active"><a href="index.php?module=CurrencyAdmin">Валюты</a></li>
		<li><a href="index.php?module=DeliveriesAdmin">Доставка</a></li>
		<li><a href="index.php?module=PaymentMethodsAdmin">Оплата</a></li>
<?php  Smarty::$_smarty_vars['capture']['tabs']=ob_get_clean();?>

<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_variable('Валюты', null, 1);?>

<script src="design/js/jquery/jquery.js"></script>
<script src="design/js/jquery/jquery-ui.min.js"></script>

<script>

$(function() {

	// Сортировка списка
	// Сортировка вариантов
	$("#currencies_block").sortable({ items: 'ul.sortable' , axis: 'y',  cancel: '#header', handle: '.move_zone' });

	// Добавление валюты
	var curr = $('#new_currency').clone(true);
	$('#new_currency').remove().removeAttr('id');
	$('a#add_currency').click(function() {
		$(curr).clone(true).appendTo('#currencies').fadeIn('slow').find("input[name*=currency][name*=name]").focus();
		return false;		
	});

    function xmlParser(xml) {
    $('#load').fadeOut();
    $(xml).find("item").each(function () {
    $(".main").append('<div class="book"><div class="title">' + $(this).find("title").text() + '</div><div class="description">' + $(this).find("description").text() + '</div><div class="date">Опубликовано ' + $(this).find("pubDate").text() + '</div></div>');
    $(".book").fadeIn(1000);});
    $('img').attr({ width: 200 });}

    $('a#up_curs').click(function() {
    
    $.ajax({
    type: "post",
    url: "dol.php",
    data:{upc:'upc'},
    success:function(tutu){
    $('input[name="currency[rate_to][1]"]').val(tutu);
    }
    });
    return false;
	});	    	
 

	// Скрыт/Видим
	$("a.enable").click(function() {
		var icon        = $(this);
		var line        = icon.closest("ul");
		var id          = line.find('input[name*="currency[id]"]').val();
		var state       = line.hasClass('invisible')?1:0;
		icon.addClass('loading_icon');
		$.ajax({
			type: 'POST',
			url: 'ajax/update_object.php',
			data: {'object': 'currency', 'id': id, 'values': {'enabled': state}, 'session_id': '<?php echo $_SESSION['id'];?>
'},
			success: function(data){
				icon.removeClass('loading_icon');
				if(state)
					line.removeClass('invisible');
				else
					line.addClass('invisible');				
			},
			dataType: 'json'
		});	
		return false;	
	});
	
	// Центы
	$("a.cents").click(function() {
		var icon        = $(this);
		var line        = icon.closest("ul");
		var id          = line.find('input[name*="currency[id]"]').val();
		var state       = line.hasClass('cents')?0:2;
		icon.addClass('loading_icon');

		$.ajax({
			type: 'POST',
			url: 'ajax/update_object.php',
			data: {'object': 'currency', 'id': id, 'values': {'cents': state}, 'session_id': '<?php echo $_SESSION['id'];?>
'},
			success: function(data){
				icon.removeClass('loading_icon');
				if(!state)
					line.removeClass('cents');
				else
					line.addClass('cents');				
			},
			error: function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
            },
			dataType: 'json'
		});	
		return false;	
	});
	
	// Показать центы
	$("a.delete").click(function() {
		$('input[type="hidden"][name="action"]').val('delete');
		$('input[type="hidden"][name="action_id"]').val($(this).closest("ul").find('input[type="hidden"][name*="currency[id]"]').val());
		$(this).closest("form").submit();
	});
	
	// Запоминаем id первой валюты, чтобы определить изменение базовой валюты
	var base_currency_id = $('input[name*="currency[id]"]').val();
	
	$("form").submit(function() {
		if($('input[type="hidden"][name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
			return false;	
		if(base_currency_id != $('input[name*="currency[id]"]:first').val() && confirm('Пересчитать все цены в '+$('input[name*="name"]:first').val()+' по текущему курсу?', 'msgBox Title'))
			$('input[name="recalculate"]').val(1);
	});


});

</script>


		
	<!-- Заголовок -->
	<div id="header">
		<h1>Валюты</h1>
		<a class="add" id="add_currency" href="#">Добавить</a>
        <a class="adds" style="float:right;" id="up_curs" href="#">Обновить курс валют</a>
	<!-- Заголовок (The End) -->	
	</div>	


	
 
	<form method=post>
	<input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
	
	
	<!-- Валюты -->
	<div id="currencies_block">
		<ul id="header">
			<li class="move"></li>
			<li class="name">Название валюты</li>	
			<li class="icons"></li>	
			<li class="sign">Знак</li>	
			<li class="iso">Код ISO</li>	
		</ul>
		<div id="currencies">
		<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('currencies')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['c']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
 $_smarty_tpl->tpl_vars['c']->index++;
 $_smarty_tpl->tpl_vars['c']->first = $_smarty_tpl->tpl_vars['c']->index === 0;
?>
		<ul class="sortable <?php if (!$_smarty_tpl->getVariable('c')->value->enabled){?>invisible<?php }?> <?php if ($_smarty_tpl->getVariable('c')->value->cents==2){?>cents<?php }?>">
			<li class="move"><div class="move_zone"></div></li>
			<li class="name">
				<input name="currency[id][<?php echo $_smarty_tpl->getVariable('c')->value->id;?>
]" type="hidden" 	value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('c')->value->id);?>
" /><input name="currency[name][<?php echo $_smarty_tpl->getVariable('c')->value->id;?>
]" type="" value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('c')->value->name);?>
" />
			</li>
			<li class="icons">
				<a class="cents" href="#" title="Выводить копейки"></a>
				<a class="enable" href="#" title="Показывать на сайте"></a>
			</li>
			<li class="sign">		<input name="currency[sign][<?php echo $_smarty_tpl->getVariable('c')->value->id;?>
]" type="text" 	value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('c')->value->sign);?>
" /></li>
			<li class="iso">		<input name="currency[code][<?php echo $_smarty_tpl->getVariable('c')->value->id;?>
]" type="text" 	value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('c')->value->code);?>
" /></li>
			<li class="rate">
				<?php if (!$_smarty_tpl->tpl_vars['c']->first){?>
				<div class=rate_from><input name="currency[rate_from][<?php echo $_smarty_tpl->getVariable('c')->value->id;?>
]" type="text" value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('c')->value->rate_from);?>
" /> <?php echo $_smarty_tpl->getVariable('c')->value->sign;?>
</div>
				<div class=rate_to>= <input name="currency[rate_to][<?php echo $_smarty_tpl->getVariable('c')->value->id;?>
]" type="text" value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('c')->value->rate_to);?>
" /> <?php echo $_smarty_tpl->getVariable('currency')->value->sign;?>
</div>
				<?php }else{ ?>
				<input name="currency[rate_from][<?php echo $_smarty_tpl->getVariable('c')->value->id;?>
]" type="hidden" value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('c')->value->rate_from);?>
" />
				<input name="currency[rate_to][<?php echo $_smarty_tpl->getVariable('c')->value->id;?>
]" type="hidden" value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('c')->value->rate_to);?>
" />
				<?php }?>
			</li>
			<li class="icons">
			<?php if (!$_smarty_tpl->tpl_vars['c']->first){?>
				<a class="delete" href="#" title="Удалить"></a>				
			<?php }?>
			</li>
		</ul>
		<?php }} ?>		
		<ul id="new_currency" style='display:none;'>
			<li class="move"><div class="move_zone"></div></li>
			<li class="name"><input name="currency[id][]" type="hidden" value="" /><input name="currency[name][]" type="" value="" /></li>
			<li class="icons">
			</li>
			<li class="sign"><input name="currency[sign][]" type="" value="" /></li>
			<li class="iso"><input  name="currency[code][]" type="" value="" /></li>
			<li class="rate">
				<div class=rate_from><input name="currency[rate_from][]" type="text" value="1" /> </div>
				<div class=rate_to>= <input name="currency[rate_to][]" type="text" value="1" /> <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('currency')->value->sign);?>
</div>			
			</li>
			<li class="icons">
			
			</li>
		</ul>
		</div>

	</div>
	<!-- Валюты (The End)--> 


	<div id="action">

	<input type=hidden name=recalculate value='0'>
	<input type=hidden name=action value=''>
	<input type=hidden name=action_id value=''>
	<input id='apply_action' class="button_green" type=submit value="Применить">

	
	</div>
	</form>
	
 
