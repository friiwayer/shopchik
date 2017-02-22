<?php /* Smarty version Smarty-3.0.7, created on 2013-04-25 18:34:29
         compiled from "Z:\home\localhost\www\shopchik//design/new/html\product.tpl" */ ?>
<?php /*%%SmartyHeaderCode:954351795b15367e55-69031262%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'adc6b2961ec0f071305ab328f8ec0415172c4ff7' => 
    array (
      0 => 'Z:\\home\\localhost\\www\\shopchik//design/new/html\\product.tpl',
      1 => 1366907667,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '954351795b15367e55-69031262',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'Z:\home\localhost\www\shopchik\Smarty\libs\plugins\modifier.escape.php';
if (!is_callable('smarty_function_math')) include 'Z:\home\localhost\www\shopchik\Smarty\libs\plugins\function.math.php';
?>

<script type="text/javascript">
$(document).ready(function(){
    $('.images a').hover(function(){
       var big = $(this).attr('href');
       var small = $(this).children('img').attr('src');
       $('.imagez a').attr('href',big);
       $('.imagez a img').attr('src',small);
    });
    
    $('#opis p').css({'clear':'left','paddingTop':'15px'});
});
</script>
<script type="text/javascript">
$(document).ready(function() {
		  
          
			$('div.qiwi, div.wbm, div.ya').tinyTips('blue', 'title');
			$('a.imgTip').tinyTips('blue');
			$('img.tTip').tinyTips('blue', 'title');
			$('h1.tagline').tinyTips('blue');
            
            $('.variant_radiobutton, label.variant_name').bind('click', function(){
                $('div.pricec').html($(this).parents('.variant').find('#cenac').html());
            });
            
            
            $('div.pricec').html($('.variant_radiobutton:first').parents('.variant').find('#cenac').html());
});
</script>



<h1 data-product="<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name);?>

                    <div class="testRater" id="product_<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
">
                    	<div class="statVal">
                    		<span class="rater">
                    			<span class="rater-starsOff" style="width:80px;">
                    				<span class="rater-starsOn" style="width:<?php echo $_smarty_tpl->getVariable('product')->value->rating*80/sprintf("%.0f",5);?>
px"></span>
                    			</span>
                    			<span class="test-text">
                    				<span class="rater-rating"><?php echo sprintf("%.1f",$_smarty_tpl->getVariable('product')->value->rating);?>
</span>&#160;(голосов <span class="rater-rateCount"><?php echo sprintf("%.0f",$_smarty_tpl->getVariable('product')->value->votes);?>
</span>)
                    			</span>
                    		</span>
                    	</div>
                    </div>
                    <script src="design/<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('settings')->value->theme);?>
/js/project.js"></script>
                    
                    <script type="text/javascript">$(function() { $('.testRater').rater({ postHref: 'ajax/rating.php' }); });</script>
                    
</h1>
<span style="color:#888; font-size:11px;">Артикул: <?php echo $_smarty_tpl->getVariable('product')->value->id;?>
</span>
<div class="product">

<div id="tov_prod">
<span style="font-size:11.5px; float:right; position:absolute; right:5px; top:0;">предоплата 100%</span>
        <?php if (count($_smarty_tpl->getVariable('product')->value->variants)>0){?>
		<!-- Выбор варианта товара -->
<div class="for">
<div style="position:absolute; top:42px;">
<span style="float:left; margin-right:10px; clear:both;">Оплатить можно: </span>
<div class="qiwi" title="<b>Оплата Qiwi</b><p>Пополнить счет можно многими способами.</p> <p>Кошелек для оплаты <b>9043662655</b></p>"></div>
<div class="wbm" title="<b>Оплата Web Money</b><p>к оплате принимаются WMZ и WMR</p><p>Кошельки для оплаты</p><p>WMR - <b>R329427801234 </b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; WMZ -<b> Z330092409911</b></p>"></div>
<div class="ya" title="<b>Оплата Яндекс деньги</b><p>Для оплаты вы должны иметь кошелек в данной системе платежей.</p>"></div>
</div>
<div class="yearg">
<span class="">1 год гарантии</span>
<div class="imgg"></div>
</div>
        	<div class="description">
            <div class="compare" style="float:left;">
    <form action="/compare" class="compare" style="position:relative;">
    <?php ob_start();?><?php echo $_smarty_tpl->getVariable('product')->value->id;?>
<?php $_tmp1=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('compare_informer')->value->items_id[$_tmp1]>0){?>
    В списке <a href="/compare/">сравнения</a>
    <?php }else{ ?>
    <input id="compare_<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" name="compare" style="position: absolute; top: 3px;" value="<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" type="checkbox" />
    <label for="compare_<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" style="border-bottom: 1px dashed #000; cursor: pointer; padding-left: 15px;">к сравнению</label>
    <?php }?>
    </form>
    </div>	
	</div>
		<form class="variants" action="/cart" style="">
			<table class="variantss">
			<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('product')->value->variants; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['v']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
 $_smarty_tpl->tpl_vars['v']->index++;
 $_smarty_tpl->tpl_vars['v']->first = $_smarty_tpl->tpl_vars['v']->index === 0;
?>
            <div style="position:absolute; top:4px;">
            <label>
            <span>
            <b style="color:green; font-size:14px;">Почта России</b> - Доставка из Китая.
            </span>
            </label>
            </div>
			<tr class="variant">            
				<td>
					<input id="product_<?php echo $_smarty_tpl->getVariable('v')->value->id;?>
" name="variant" value="<?php echo $_smarty_tpl->getVariable('v')->value->id;?>
" type="radio" class="variant_radiobutton" <?php if ($_smarty_tpl->getVariable('product')->value->variant->id==$_smarty_tpl->getVariable('v')->value->id){?>checked<?php }?> <?php if (count($_smarty_tpl->getVariable('product')->value->variants)<2){?>style="display:none;"<?php }?>/>
				</td>
				<td>
					<?php if ($_smarty_tpl->getVariable('v')->value->name){?><label class="variant_name" for="product_<?php echo $_smarty_tpl->getVariable('v')->value->id;?>
"><?php echo $_smarty_tpl->getVariable('v')->value->name;?>
</label><?php }?>
				</td>
				<td>
                    <span class="def_price" style="display:none;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('v')->value->price);?>
</span>
                    <?php if (count($_smarty_tpl->getVariable('product')->value->variants)>1){?><span class=""><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('v')->value->price);?>
 <span class="currency"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('currency')->value->sign);?>
</span></span><?php }else{ ?><?php }?>
                    <div id="cenac" style="display:none;"><span class="pricec"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('v')->value->price);?>
 <span class="currency"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('currency')->value->sign);?>
</span></span></div>					                                 
				</td>
			</tr>                
            <div class="pricec"><span class="pricec"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('v')->value->price);?>
 <span class="currency"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('currency')->value->sign);?>
</span></span></div>               
            <?php if ($_smarty_tpl->getVariable('v')->value->compare_price>0){?><span class="old_prices"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('v')->value->compare_price);?>
</span><?php }?>
			<?php }} ?>
			</table>
            <noindex><a id="ask" rel="nofollow" href="<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" onclick="return false;" class="but2">Задать вопрос по товару.</a></noindex>
			<input type="submit" class="buttonq" value="Добавить в корзину" data-result-text="добавлено"/>
		</form>
		<!-- Выбор варианта товара (The End) -->
		<?php }else{ ?>
            <div class="forma">
			<p style="position:absolute; right:0; top:50px;">Нет в наличии</p>
		<?php }?>
<div class="b-overlay" style="display: none;">
<div class="b-popups skin_default scheme_default shadow_on mod_report" style="top: 108px;">
    <div class="b-popup-h">
        <div class="b-popup-close"></div>
        <div class="b-popup-head">
            <div class="b-popup-head-h">
                <div class="head-title">Задать вопрос</div>
            </div>
        </div>
        <div class="b-popup-body">
            <div class="b-popup-body-h">                    
        <form method="post" class="foo">
        <label> по товару <b><?php echo $_smarty_tpl->getVariable('product')->value->name;?>
</b></label>
        <input type="hidden" name="tov_id" value="<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" />
        <input type="hidden" value="<?php echo $_smarty_tpl->getVariable('product')->value->name;?>
" name="productz" />        
        
        <input type="text" name="uname" value="Ваше имя:" onclick="if(this.value=='Ваше имя:'){this.value=''}" onblur="if(this.value==''){this.value='Ваше имя:'}" />
        <input type="text" class="imail" name="mail" value="Ваш e-mail:" onclick="if(this.value=='Ваш e-mail:'){this.value=''}" onblur="if(this.value==''){this.value='Ваш e-mail:'}" />
        <textarea name="sabj" class="subg" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">Текст Вопроса...</textarea>
        <input type="submit" name="send" value="отправить" id="bobo" />                            
        </form>
                
        </div>
    </div>
</div>
</div>
</div>        
        
       </div>
       <table class="cart">
       <tr>
       <td></td>
       <td></td>
       </tr>
       <tr>
       <td></td>
       </tr>
       </table>
</div>
<div class="dostav">
<span style="font-size:11.5px; line-height:27px; float:left; position:absolute; left:5px; top:0;">Доставка 15-60 дней.</span>
</div>
<div class="nali">
<span style="font-size:11.5px; line-height:27px; float:left; position:absolute; left:5px; top:0;">Товар есть в наличии</span>
</div>
	<!-- Большое фото -->
	<?php if ($_smarty_tpl->getVariable('product')->value->image){?>
	<div class="imagez">
		<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->getVariable('product')->value->image->filename,800,600,'w');?>
" class="zoom" data-rel="group"><img src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->getVariable('product')->value->image->filename,350,350);?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->product->name);?>
" /></a>
	</div>
	<?php }?>
	<!-- Большое фото (The End)-->

	<!-- Описание товара -->


	<!-- Описание товара (The End)-->

	<!-- Дополнительные фото продукта -->
	<?php if (count($_smarty_tpl->getVariable('product')->value->images)>1){?>
	<div class="images">
		<?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('product')->value->images; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['image']->key;
?>
			<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->getVariable('image')->value->filename,800,600,'w');?>
" class="zoom" data-rel="group"><img src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->getVariable('image')->value->filename,350,350);?>
" width="95" alt="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name);?>
" /></a>
		<?php }} ?>
	</div>
	<?php }?>
	<!-- Дополнительные фото продукта (The End)-->
    <div class="clear"></div>
	<div class="section">
	<ul class="tabz">
		<li class="current"><h2 style="" style="">Характеристики: </h2></li>
        <li><h2 style="">Описание</h2></li>
		<li><h2 style="">Видео ролик</h2></li>
		<li class=""><h2 style="">Отзывы</h2></li>
		<li><h2 style="">Комментарии</h2></li>
	</ul>
    <div class="box visible" style="display: block; ">
	<?php if ($_smarty_tpl->getVariable('product')->value->features){?>
	<!-- Характеристики товара -->
	<ul class="features">
    <h2>Основные Характеристики</h2>
	<?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('product')->value->main; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value){
?>
	<li>
		<label><?php echo $_smarty_tpl->getVariable('m')->value->name;?>
</label>
		<span class="infa"><?php echo $_smarty_tpl->getVariable('m')->value->value;?>
</span>
	</li>
	<?php }} ?>
	</ul>

	<ul class="features">
    <h2>Аппаратная часть</h2>
	<?php  $_smarty_tpl->tpl_vars['h'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('product')->value->hards; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['h']->key => $_smarty_tpl->tpl_vars['h']->value){
?>
	<li>
		<label><?php echo $_smarty_tpl->getVariable('h')->value->name;?>
</label>
		<span class="infa"><?php echo $_smarty_tpl->getVariable('h')->value->value;?>
</span>
	</li>
	<?php }} ?>
	</ul>

	<ul class="features">
    <h2>Экран</h2>
	<?php  $_smarty_tpl->tpl_vars['d'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('product')->value->display; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['d']->key => $_smarty_tpl->tpl_vars['d']->value){
?>
	<li>
		<label><?php echo $_smarty_tpl->getVariable('d')->value->name;?>
</label>
		<span class="infa"><?php echo $_smarty_tpl->getVariable('d')->value->value;?>
</span>
	</li>
	<?php }} ?>
	</ul>

    <?php if ($_smarty_tpl->getVariable('product')->value->net){?>
	<ul class="features">
    <h2>Коммуникации</h2>
	<?php  $_smarty_tpl->tpl_vars['net'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('product')->value->net; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['net']->key => $_smarty_tpl->tpl_vars['net']->value){
?>
	<li>
		<label><?php echo $_smarty_tpl->getVariable('net')->value->name;?>
</label>
		<span class="infa"><?php echo $_smarty_tpl->getVariable('net')->value->value;?>
</span>
	</li>
	<?php }} ?>
	</ul>
    <?php }?> 

	<ul class="features">
    <h2>Мультимедия</h2>
	<?php  $_smarty_tpl->tpl_vars['mu'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('product')->value->multimedia; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['mu']->key => $_smarty_tpl->tpl_vars['mu']->value){
?>
	<li>
		<label><?php echo $_smarty_tpl->getVariable('mu')->value->name;?>
</label>
		<span class="infa"><?php echo $_smarty_tpl->getVariable('mu')->value->value;?>
</span>
	</li>
	<?php }} ?>
	</ul>
    
    <?php if ($_smarty_tpl->getVariable('product')->value->compl){?>
	<ul class="features">
    <h2>Комплектация</h2>
	<?php  $_smarty_tpl->tpl_vars['co'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('product')->value->compl; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['co']->key => $_smarty_tpl->tpl_vars['co']->value){
?>
	<li>
		<label><?php echo $_smarty_tpl->getVariable('co')->value->name;?>
</label>
		<span class="infa"><?php echo $_smarty_tpl->getVariable('co')->value->value;?>
</span>
	</li>
	<?php }} ?>
	</ul>
    <?php }?> 
                
	<!-- Характеристики товара (The End)-->
	<?php }?>
    </div>
    <div class="box visible" style="display: block; padding:10px;">
    <span id="opis">
    <?php echo $_smarty_tpl->getVariable('product')->value->body;?>

    </span>
    </div>
    <div class="box visible" style="display: none; ">
    <?php if (!empty($_smarty_tpl->getVariable('product',null,true,false)->value->youtube)){?>
        <iframe class="youtube" title="YouTube video player" width="821" height="388" src="http://www.youtube.com/embed/<?php echo $_smarty_tpl->getVariable('product')->value->youtube;?>
?rel=0&amp;wmode=transparent" frameborder="0" allowfullscreen=""></iframe>
    <?php }?>
    </div>
    <div class="box visible" style="display: none; ">
    
    </div>
    <div class="box visible" style="display: none; ">
<!-- Комментарии -->
<div id="comments" style="padding:50px 10px 10px 10px;">
	<h2>Комментарии</h2>
	
	<?php if ($_smarty_tpl->getVariable('comments')->value){?>
	<!-- Список с комментариями -->
	<ul class="comment_list">
		<?php  $_smarty_tpl->tpl_vars['comment'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('comments')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['comment']->key => $_smarty_tpl->tpl_vars['comment']->value){
?>
		<a name="comment_<?php echo $_smarty_tpl->getVariable('comment')->value->id;?>
"></a>
		<li>
			<!-- Имя и дата комментария-->
			<div class="comment_header">	
				<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('comment')->value->name);?>
 <i><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->getVariable('comment')->value->date);?>
, <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['time'][0][0]->time_modifier($_smarty_tpl->getVariable('comment')->value->date);?>
</i>
				<?php if (!$_smarty_tpl->getVariable('comment')->value->approved){?>ожидает модерации</b><?php }?>
			</div>
			<!-- Имя и дата комментария (The End)-->
			
			<!-- Комментарий -->
			<?php echo nl2br(smarty_modifier_escape($_smarty_tpl->getVariable('comment')->value->text));?>

			<!-- Комментарий (The End)-->
		</li>
		<?php }} ?>
	</ul>
	<!-- Список с комментариями (The End)-->
	<?php }else{ ?>
	<p>
		Пока нет комментариев
	</p>
	<?php }?>
	
	<!--Форма отправления комментария-->	
	<form class="comment_form" method="post"  style="">
		<h2>Написать комментарий</h2>
		<?php if ($_smarty_tpl->getVariable('error')->value){?>
		<div class="message_error">
			<?php if ($_smarty_tpl->getVariable('error')->value=='captcha'){?>
			Неверно введена капча
			<?php }elseif($_smarty_tpl->getVariable('error')->value=='empty_name'){?>
			Введите имя
			<?php }elseif($_smarty_tpl->getVariable('error')->value=='empty_comment'){?>
			Введите комментарий
			<?php }?>
		</div>
		<?php }?>
		<textarea class="comment_textarea" id="comment_text" name="text" data-format=".+" data-notice="Введите комментарий"><?php echo $_smarty_tpl->getVariable('comment_text')->value;?>
</textarea><br />
		<div>
		<label for="comment_name">Имя</label>
		<input class="input_name" type="text" id="comment_name" name="name" value="<?php echo $_smarty_tpl->getVariable('comment_name')->value;?>
" data-format=".+" data-notice="Введите имя"/><br />

		<input class="button" type="submit" name="comment" value="Отправить" />
		
		<label for="comment_captcha">Число</label>
		<div class="captcha"><img src="captcha/image.php?<?php echo smarty_function_math(array('equation'=>'rand(10,10000)'),$_smarty_tpl);?>
" alt='captcha'/></div> 
		<input class="input_captcha" id="comment_captcha" type="text" name="captcha_code" value="" data-format="\d\d\d\d" data-notice="Введите капчу"/>
		
		</div>
	</form>
	<!--Форма отправления комментария (The End)-->
</div>
<!-- Комментарии (The End) -->    
    </div>    
    </div>
	<!-- Соседние товары /-->
	<div id="back_forward">
		<?php if ($_smarty_tpl->getVariable('prev_product')->value){?>
			←&nbsp;<a class="prev_page_link" href="products/<?php echo $_smarty_tpl->getVariable('prev_product')->value->url;?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('prev_product')->value->name);?>
</a>
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('next_product')->value){?>
			<a class="next_page_link" href="products/<?php echo $_smarty_tpl->getVariable('next_product')->value->url;?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('next_product')->value->name);?>
</a>&nbsp;→
		<?php }?>
	</div>
	
</div>
<!-- Описание товара (The End)-->
<?php if ($_smarty_tpl->getVariable('related_products')->value){?>
<div class="accesories">
<h2>Похожие товары:</h2>
<!-- Список каталога товаров-->
<ul class="">
	<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('related_products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
?>
	<!-- Товар-->
	<li class="produc">

		<?php if ($_smarty_tpl->getVariable('product')->value->image){?>
		<div class="image">
			<a href="products/<?php echo $_smarty_tpl->getVariable('product')->value->url;?>
"><img src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->getVariable('product')->value->image->filename,100,100);?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name);?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name);?>
"/></a>
		</div>
		<?php }?>


		<div class="link"><a data-product="<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" href="products/<?php echo $_smarty_tpl->getVariable('product')->value->url;?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name);?>
</a></div>
		

		<?php if (count($_smarty_tpl->getVariable('product')->value->variants)>0){?>

		<form class="variants" action="/cart">
			<table>
			<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('product')->value->variants; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['v']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
 $_smarty_tpl->tpl_vars['v']->index++;
 $_smarty_tpl->tpl_vars['v']->first = $_smarty_tpl->tpl_vars['v']->index === 0;
?>
			<tr class="variant">
				<td>
					<input id="featured_<?php echo $_smarty_tpl->getVariable('v')->value->id;?>
" name="variant" value="<?php echo $_smarty_tpl->getVariable('v')->value->id;?>
" type="radio" class="variant_radiobutton" <?php if ($_smarty_tpl->tpl_vars['v']->first){?>checked<?php }?> <?php if (count($_smarty_tpl->getVariable('product')->value->variants)<2){?>style="display:none;"<?php }?>/>
				</td>
				<td>
					<?php if ($_smarty_tpl->getVariable('v')->value->name){?><label class="variant_name" for="featured_<?php echo $_smarty_tpl->getVariable('v')->value->id;?>
"><?php echo $_smarty_tpl->getVariable('v')->value->name;?>
</label><?php }?>
				</td>
				<td>
				</td>
			</tr>
			<?php }} ?>
			</table>
            <?php if ($_smarty_tpl->getVariable('v')->value->compare_price>0){?><span class="compare_price"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('v')->value->compare_price);?>
</span><?php }?>
			
		</form>
		<?php }else{ ?>
			Нет в наличии
		<?php }?>
	</li>
	<!-- Товар (The End)-->
	<?php }} ?>
</ul>
</div>
<?php }?>


<script>
$(function() {
	// Раскраска строк характеристик
	$("ul.features li:even").addClass('even');

	// Зум картинок
	$("a.zoom").fancybox({ 'hideOnContentClick' : true });
});
</script>

<script src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/jquery-nomen.js" type="text/javascript"></script>