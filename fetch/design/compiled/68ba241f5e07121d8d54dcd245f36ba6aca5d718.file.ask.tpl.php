<?php /* Smarty version Smarty-3.0.7, created on 2012-08-20 06:20:59
         compiled from "fetch/design/html/ask.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4754429985031bb2b1eb791-97745360%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '68ba241f5e07121d8d54dcd245f36ba6aca5d718' => 
    array (
      0 => 'fetch/design/html/ask.tpl',
      1 => 1345436421,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4754429985031bb2b1eb791-97745360',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/home/f/friiw/test.kino-smena.ru/public_html/Smarty/libs/plugins/modifier.escape.php';
?>
<?php ob_start(); ?>
	<li><a href="index.php?module=ProductsAdmin">Товары</a></li>
	<li><a href="index.php?module=CategoriesAdmin">Категории</a></li>
	<li><a href="index.php?module=BrandsAdmin">Бренды</a></li>
	<li><a href="index.php?module=FeaturesAdmin">Свойства</a></li>
    <li class="active"><a href="index.php?module=AskProduct">Вопросы по товарам</a></li>
<?php  Smarty::$_smarty_vars['capture']['tabs']=ob_get_clean();?>
<?php $_template = new Smarty_Internal_Template('tinymce_init.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_variable('Вопросы по товарам', null, 1);?>

<script>
$(function() {

	// Удаление изображений
	$(".images a.delete").click( function() {
		$("input[name='delete_image']").val('1');
		$(this).closest("ul").fadeOut(200, function() { $(this).remove(); });
		return false;
	});

	// Автозаполнение мета-тегов
	meta_title_touched = true;
	meta_keywords_touched = true;
	meta_description_touched = true;
	url_touched = true;
	
	if($('input[name="meta_title"]').val() == generate_meta_title() || $('input[name="meta_title"]').val() == '')
		meta_title_touched = false;
	if($('input[name="meta_keywords"]').val() == generate_meta_keywords() || $('input[name="meta_keywords"]').val() == '')
		meta_keywords_touched = false;
	if($('textarea[name="meta_description"]').val() == generate_meta_description() || $('textarea[name="meta_description"]').val() == '')
		meta_description_touched = false;
	if($('input[name="url"]').val() == generate_url() || $('input[name="url"]').val() == '')
		url_touched = false;
		
	$('input[name="meta_title"]').change(function() { meta_title_touched = true; });
	$('input[name="meta_keywords"]').change(function() { meta_keywords_touched = true; });
	$('input[textarea="meta_description"]').change(function() { meta_description_touched = true; });
	$('input[name="url"]').change(function() { url_touched = true; });
	
	$('input[name="name"]').keyup(function() { set_meta(); });
	
	function set_meta()
	{
		if(!meta_title_touched)
			$('input[name="meta_title"]').val(generate_meta_title());
		if(!meta_keywords_touched)
			$('input[name="meta_keywords"]').val(generate_meta_keywords());
		if(!meta_description_touched)
			$('textarea[name="meta_description"]').val(generate_meta_description());
		if(!url_touched)
			$('input[name="url"]').val(generate_url());
	}
	
	function generate_meta_title()
	{
		name = $('input[name="name"]').val();
		return name;
	}

	function generate_meta_keywords()
	{
		name = $('input[name="name"]').val();
		return name;
	}

	function generate_meta_description()
	{
		name = $('input[name="name"]').val();
		return name;
	}
		
	function generate_url()
	{
		url = $('input[name="name"]').val();
		url = url.replace(/[\s]+/gi, '-');
		url = translit(url);
		url = url.replace(/[^0-9a-z_\-]+/gi, '').toLowerCase();	
		return url;
	}
	
	function translit(str)
	{
		var ru=("А-а-Б-б-В-в-Ґ-ґ-Г-г-Д-д-Е-е-Ё-ё-Є-є-Ж-ж-З-з-И-и-І-і-Ї-ї-Й-й-К-к-Л-л-М-м-Н-н-О-о-П-п-Р-р-С-с-Т-т-У-у-Ф-ф-Х-х-Ц-ц-Ч-ч-Ш-ш-Щ-щ-Ъ-ъ-Ы-ы-Ь-ь-Э-э-Ю-ю-Я-я").split("-")   
		var en=("A-a-B-b-V-v-G-g-G-g-D-d-E-e-E-e-E-e-ZH-zh-Z-z-I-i-I-i-I-i-J-j-K-k-L-l-M-m-N-n-O-o-P-p-R-r-S-s-T-t-U-u-F-f-H-h-TS-ts-CH-ch-SH-sh-SCH-sch-'-'-Y-y-'-'-E-e-YU-yu-YA-ya").split("-")   
	 	var res = '';
		for(var i=0, l=str.length; i<l; i++)
		{ 
			var s = str.charAt(i), n = ru.indexOf(s); 
			if(n >= 0) { res += en[n]; } 
			else { res += s; } 
	    } 
	    return res;  
	}

});

</script>


	<form method=post id=product enctype="multipart/form-data">
        <input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">
        <div id="name">
    	<h2>Вопрос по "<a style="color:#ff0000;" href="../products/<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('asks')->value->product);?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('asks')->value->product);?>
</a>"</h2>
        </div>
        <input type="hidden" value="<?php echo $_smarty_tpl->getVariable('asks')->value->mail;?>
" name="mail" />
        <input type="hidden" value="<?php echo $_smarty_tpl->getVariable('asks')->value->id;?>
" name="id" />
        <input type="hidden" value="<?php echo $_smarty_tpl->getVariable('asks')->value->msg;?>
" maxlength="3000" name="msg" />
	    <div class="block layer">
			<h2>Данные пользователя</h2>
			<ul>
				<li><label class=property>Имя: </label><input name="meta_title" class="simpla_inp" disabled="disabled" type="text" value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('asks')->value->name);?>
" /></li>
				<li><label class=property>Почта: </label><input name="meta_keywords" class="simpla_inp" disabled="disabled" type="text" value="<?php echo $_smarty_tpl->getVariable('asks')->value->mail;?>
" /></li>
			</ul>
		</div>
        
		<div class="block layer">
        <h2>Вопрос: </h2>
        <textarea name="msgg" class="simpla_inp" disabled="disabled" style="width:97.5%;"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('asks')->value->msg);?>
</textarea>       
		</div>
        
        <div class="block layer">
		<h2>Ответ: </h2>
        <?php if (!empty($_smarty_tpl->getVariable('asks',null,true,false)->value->otvet)){?>
		<textarea name="otvet" class="simpla_inp" disabled="disabled" style="width:97.5%;"><?php echo $_smarty_tpl->getVariable('asks')->value->otvet;?>
</textarea>
        </div>     
        <input type="submit" value="Ответить" name="feedack" disabled="disabled" class="button_green" />
        <a href="index.php?module=AskProduct" class="button_green" style="padding:5px 7px 5px 7px;">Вернуться</a>   
        <?php }else{ ?>
		<textarea name="otvet" class="simpla_inp" style="width:97.5%; height:150px;"></textarea>
        </div>
        <input type="submit" value="Ответить" name="feedack" class="button_green" />
        <?php }?>
	</form>