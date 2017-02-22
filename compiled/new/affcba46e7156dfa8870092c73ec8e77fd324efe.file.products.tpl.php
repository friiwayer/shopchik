<?php /* Smarty version Smarty-3.0.7, created on 2013-06-09 20:45:51
         compiled from "Z:\home\localhost\www\shopchik//design/new/html\products.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2270351b4cd5f9b0325-49914860%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'affcba46e7156dfa8870092c73ec8e77fd324efe' => 
    array (
      0 => 'Z:\\home\\localhost\\www\\shopchik//design/new/html\\products.tpl',
      1 => 1370534004,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2270351b4cd5f9b0325-49914860',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'Z:\home\localhost\www\shopchik\Smarty\libs\plugins\modifier.escape.php';
?>

<script type="text/javascript">
$(function(){
   $('.col').click(function(){
    $('select[name=ppp] option').val($(this).attr('href')).attr('selected');
     $('.ppp form').submit();
     return false;
   });
    
});
</script>

<?php if ($_smarty_tpl->getVariable('keyword')->value){?>
<h1>Поиск <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('keyword')->value);?>
</h1>
<?php }elseif($_smarty_tpl->getVariable('page')->value){?>
<h1><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('page')->value->name);?>
</h1>
<?php }else{ ?>
<h1><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('category')->value->name);?>
 <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('brand')->value->name);?>
 <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('keyword')->value);?>
(<?php echo count($_smarty_tpl->getVariable('products')->value);?>
)</h1>
<?php }?>

<?php if ($_smarty_tpl->getVariable('cena_to')->value){?>
<h1>до цены <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('cena_to')->value);?>
</h1>
<h1><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('category')->value->name);?>
 <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('brand')->value->name);?>
 <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('cena_to')->value);?>
</h1>
<?php }?>
<?php if ($_smarty_tpl->getVariable('count')->value){?>
<span id="countt"> всего товаров в категории: <b><?php echo $_smarty_tpl->getVariable('count')->value;?>
</b></span>
<?php }?>
<?php echo $_smarty_tpl->getVariable('page')->value->body;?>


<?php if ($_smarty_tpl->getVariable('current_page_num')->value==1){?>
<?php echo $_smarty_tpl->getVariable('category')->value->description;?>

<?php }?>
<?php echo $_smarty_tpl->getVariable('brand')->value->description;?>


<!--Каталог товаров-->
<?php if ($_smarty_tpl->getVariable('products')->value){?>
<div class="section">
	<span class="vid">Вид:</span>
    <ul class="tabs">
		<li class="current tabl" style=""><h2 style="" class=""></h2></li>
		<li style="" class="block"><h2 style="" class=""></h2></li>
	</ul>
<div class="ppp">
<form action="<?php echo $_SERVER['REQUEST_URI'];?>
" method="post" style="display:none;">
<select name="ppp">
<?php if ($_SESSION['items_per_pag']){?><option value="<?php echo $_SESSION['items_per_pag'];?>
" selected="" class="selected"><?php echo $_SESSION['items_per_pag'];?>
</option><?php }?>
<option value="15">15</option>
<option value="24">24</option>
<option value="36">36</option>
<option value="48">48</option>
</select>
<input type="submit" name="send" value="показать" />
</form>
<noindex>
<a class="col" rel="nofollow" href="15">15</a>
<a class="col" rel="nofollow" href="24">24</a>
<a class="col" rel="nofollow" href="36">36</a>
<a class="col" rel="nofollow" href="48">48</a>
</noindex>
</div>

<div class="box visible" style="display: block; ">
<?php if (count($_smarty_tpl->getVariable('products')->value)>0){?>
<div class="sort">
<noindex>
	Сортировать по:
	<a rel="nofollow" <?php if ($_smarty_tpl->getVariable('order')->value=='ASC'){?>id="ask"<?php $_smarty_tpl->tpl_vars['order'] = new Smarty_variable('DESC', null, null);?><?php }else{ ?>id="desc"<?php $_smarty_tpl->tpl_vars['order'] = new Smarty_variable('ASC', null, null);?><?php }?> <?php if ($_smarty_tpl->getVariable('sort')->value=='position'){?> class="selected"<?php }?> href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('sort'=>'position','order'=>$_smarty_tpl->getVariable('order')->value,'page'=>null),$_smarty_tpl);?>
">умолчанию<span></span></a>
	<a rel="nofollow" <?php if ($_smarty_tpl->getVariable('order')->value=='DESC'){?>id="ask"<?php $_smarty_tpl->tpl_vars['order'] = new Smarty_variable('DESC', null, null);?><?php }else{ ?>id="desc"<?php $_smarty_tpl->tpl_vars['order'] = new Smarty_variable('ASC', null, null);?><?php }?><?php if ($_smarty_tpl->getVariable('sort')->value=='price'){?>    class="selected"<?php }?> href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('sort'=>'price','order'=>$_smarty_tpl->getVariable('order')->value,'page'=>null),$_smarty_tpl);?>
">цене<span></span></a>
	<a rel="nofollow" <?php if ($_smarty_tpl->getVariable('order')->value=='DESC'){?>id="ask"<?php $_smarty_tpl->tpl_vars['order'] = new Smarty_variable('DESC', null, null);?><?php }else{ ?>id="desc"<?php $_smarty_tpl->tpl_vars['order'] = new Smarty_variable('ASC', null, null);?><?php }?><?php if ($_smarty_tpl->getVariable('sort')->value=='name'){?>     class="selected"<?php }?> href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('sort'=>'name','order'=>$_smarty_tpl->getVariable('order')->value,'page'=>null),$_smarty_tpl);?>
">названию<span></span></a>
    <a rel="nofollow" <?php if ($_smarty_tpl->getVariable('order')->value=='DESC'){?>id="ask"<?php $_smarty_tpl->tpl_vars['order'] = new Smarty_variable('DESC', null, null);?><?php }else{ ?>id="desc"<?php $_smarty_tpl->tpl_vars['order'] = new Smarty_variable('ASC', null, null);?><?php }?><?php if ($_smarty_tpl->getVariable('sort')->value=='rating'){?>   class="selected"<?php }?> href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('sort'=>'rating','order'=>$_smarty_tpl->getVariable('order')->value,'page'=>null),$_smarty_tpl);?>
">рейтингу<span></span></a>
</noindex>
</div>
<?php }?>





<!-- Список товаров-->
<div class="pr">
<table class="products">
	<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
?>
	<!-- Товар-->
    <tr class="product">
		<!-- Фото товара -->
        <td valign="top" style="width:120px;">
		<?php if ($_smarty_tpl->getVariable('product')->value->image){?>
		<div class="imag">
			<a href="products/<?php echo $_smarty_tpl->getVariable('product')->value->url;?>
"><img src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->getVariable('product')->value->image->filename,110,110);?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name);?>
"/></a>
		</div>
		<?php }?>
<div class="compare">
<form action="/compare" class="compare">
<?php ob_start();?><?php echo $_smarty_tpl->getVariable('product')->value->id;?>
<?php $_tmp1=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('compare_informer')->value->items_id[$_tmp1]>0){?>
В списке <a href="/compare/">сравнения</a>
<?php }else{ ?>
<input id="compare_<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" name="compare" value="<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" type="checkbox" style="display:none;" />
<label for="compare_<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" style="cursor: pointer; font-size:11px; color:#333; border-bottom:1px dotted;">Сравнить</label>
<?php }?>
</form>
</div>
        </td>
		<!-- Фото товара (The End) -->
        <td valign="top" style="width:450px;" width="450">
		<div class="product_info">
		<!-- Название товара -->
		<h3 class="<?php if ($_smarty_tpl->getVariable('product')->value->featured){?>featured<?php }?>"><a data-product="<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" href="products/<?php echo $_smarty_tpl->getVariable('product')->value->url;?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name);?>
</a></h3>
        <span style="color:#888; font-size:11px;">Артикул: <b><?php echo $_smarty_tpl->getVariable('product')->value->id;?>
</b></span>
		<!-- Название товара (The End) -->

		<!-- Описание товара -->
            <br />
            <?php if ($_smarty_tpl->getVariable('product')->value->ufo){?>
            <ul>
            <?php  $_smarty_tpl->tpl_vars['ddd'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('product')->value->ufo; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['ddd']->key => $_smarty_tpl->tpl_vars['ddd']->value){
?>
            <li class="evens">
            <div style=""><?php echo $_smarty_tpl->getVariable('ddd')->value->name;?>
 - <span style="padding-left:10px;"><?php echo $_smarty_tpl->getVariable('ddd')->value->value;?>
</span></div>
            </li>
            <?php }} ?>
            </ul>
            <?php }else{ ?>
            <div class="annotation"><?php echo $_smarty_tpl->getVariable('product')->value->annotation;?>
</div>            
            <?php }?>        
		<!-- Описание товара (The End) -->

            
		<?php if (count($_smarty_tpl->getVariable('product')->value->variants)>0){?>
        </td>
        <td valign="top" width="150" style="padding-top:5px;">

        <?php if ($_smarty_tpl->getVariable('product')->value->variant->compare_price>0){?><span class="cold_price"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('product')->value->variant->compare_price);?>
</span><?php }?>
		<span class="cena"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('product')->value->variant->price);?>
 <span class="currency"><?php if (smarty_modifier_escape($_smarty_tpl->getVariable('currency')->value->sign)=='руб'){?>р<?php }else{ ?><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('currency')->value->sign);?>
<?php }?></span></span>

        </td>
        <td valign="top" style="padding-right:0px; width:120px;">
        
		<!-- Выбор варианта товара -->
		<form class="variants" action="/cart" id="cart" style="margin-right:10px; position:none;">
        <input type="submit" class="butte" value="в корзину" data-result-text="добавлено"/>
            <div style="position:relative; text-align:center; margin-top:38px; margin-left:5px;">
                    <div class="testRater" id="product_<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
">
                    	<div class="statVal">
                    		<span class="rater">
                    			<span class="rater-starsOff" style="width:80px;">
                    				<span class="rater-starsOn" style="width:<?php echo $_smarty_tpl->getVariable('product')->value->rating*80/sprintf("%.0f",5);?>
px"></span>
                    			</span>
                    			<span class="test-text">
                    			</span>
                    		</span>
                    	</div>
                    </div>
            </div>          
        <?php if ($_smarty_tpl->getVariable('product')->value->youtube){?><span class="yuo" style="bottom:45px;" title="На данный товар есть видео ролик"></span><?php }else{ ?><?php }?>    
			<table width="100%">
			<tr class="variant">
				<td valign="top">
					<input id="variants_<?php echo $_smarty_tpl->getVariable('product')->value->variant->id;?>
" name="variant" value="<?php echo $_smarty_tpl->getVariable('product')->value->variant->id;?>
" type="radio" class="variant_radiobutton" checked <?php if (count($_smarty_tpl->getVariable('product')->value->variants)>0){?>style="display:none;"<?php }?>/>
				</td>
				<td valign="top">
					
				</td>
			</tr>           
			
			</table>
		</form>
		<!-- Выбор варианта товара (The End) -->
		<?php }else{ ?>
        </div>
        <td colspan="2">
		<div style="float:right;">Товара нет в наличии</div>
        </td>	
		<?php }?>
		</div>
<!-- Добавление товара к сравнению -->
<!-- Добавление товара к сравнени (The End) -->
        </td>
    </tr>
	<!-- Товар (The End)-->
	<?php }} ?>

</table>
</div>
<?php $_template = new Smarty_Internal_Template('pagination.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>	
<!-- Список товаров (The End)-->

<?php }else{ ?>
Товары не найдены!
<?php $_template = new Smarty_Internal_Template('pagination.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>	
<?php }?>	
<!--Каталог товаров (The End)-->
</div>
<div class="box" style="display: none; ">
<noindex>
<?php if (count($_smarty_tpl->getVariable('products')->value)>0){?>
<?php if (count($_smarty_tpl->getVariable('products')->value)>0){?>
<div class="sort">
	Сортировать по: 
	<a rel="nofollow" <?php if ($_smarty_tpl->getVariable('sort')->value=='position'){?> class="selected"<?php }?><?php if ($_smarty_tpl->getVariable('order')->value=='ASC'){?>id="ask"<?php $_smarty_tpl->tpl_vars['order'] = new Smarty_variable('desc', null, null);?><?php }else{ ?>id="desc"<?php $_smarty_tpl->tpl_vars['order'] = new Smarty_variable('asc', null, null);?><?php }?> href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('sort'=>'position','order'=>$_smarty_tpl->getVariable('order')->value,'page'=>null),$_smarty_tpl);?>
">умолчанию<span></span></a>
	<a rel="nofollow" <?php if ($_smarty_tpl->getVariable('sort')->value=='price'){?>    class="selected"<?php }?><?php if ($_smarty_tpl->getVariable('order')->value=='ASC'){?>id="ask"<?php $_smarty_tpl->tpl_vars['order'] = new Smarty_variable('desc', null, null);?><?php }else{ ?>id="desc"<?php $_smarty_tpl->tpl_vars['order'] = new Smarty_variable('asc', null, null);?><?php }?> href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('sort'=>'price','order'=>$_smarty_tpl->getVariable('order')->value,'page'=>null),$_smarty_tpl);?>
">цене<span></span></a>
	<a rel="nofollow" <?php if ($_smarty_tpl->getVariable('sort')->value=='name'){?>     class="selected"<?php }?><?php if ($_smarty_tpl->getVariable('order')->value=='ASC'){?>id="ask"<?php $_smarty_tpl->tpl_vars['order'] = new Smarty_variable('desc', null, null);?><?php }else{ ?>id="desc"<?php $_smarty_tpl->tpl_vars['order'] = new Smarty_variable('asc', null, null);?><?php }?> href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('sort'=>'name','order'=>$_smarty_tpl->getVariable('order')->value,'page'=>null),$_smarty_tpl);?>
">названию<span></span></a>
    <a rel="nofollow" <?php if ($_smarty_tpl->getVariable('sort')->value=='rating'){?>   class="selected"<?php }?><?php if ($_smarty_tpl->getVariable('order')->value=='ASC'){?>id="ask"<?php $_smarty_tpl->tpl_vars['order'] = new Smarty_variable('desc', null, null);?><?php }else{ ?>id="desc"<?php $_smarty_tpl->tpl_vars['order'] = new Smarty_variable('asc', null, null);?><?php }?> href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('sort'=>'rating','order'=>$_smarty_tpl->getVariable('order')->value,'page'=>null),$_smarty_tpl);?>
">рейтингу<span></span></a>
</div>
<?php }?>



<br style="clear:both;" />
<div class="pr">
<!-- Список товаров-->
	<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
?>
	<!-- Товар-->
        <div id="blokt">
        <div class="compar" style="padding-top:0px; text-align:left; padding-left:20px;">
        <form action="/compare" class="compar">
        <?php ob_start();?><?php echo $_smarty_tpl->getVariable('product')->value->id;?>
<?php $_tmp2=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('compare_informer')->value->items_id[$_tmp2]>0){?>
        В списке <a href="/compare/">сравнения</a>
        <?php }else{ ?>
        <input id="compare_<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" name="compare" value="<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" type="checkbox" />
        <label for="compare_<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" style="cursor: pointer; font-size:11px; color:#333;">Сравнить</label>
        <?php }?>
        </form>
        </div>
    
		<!-- Фото товара -->
		<?php if ($_smarty_tpl->getVariable('product')->value->image){?>
		<div class="imag">
			<a href="products/<?php echo $_smarty_tpl->getVariable('product')->value->url;?>
"><img src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->getVariable('product')->value->image->filename,130);?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name);?>
" height="100"/></a>
		</div>
		<?php }?>
		<!-- Фото товара (The End) -->
		<div class="product_info">
		<!-- Название товара -->
		<h3 class="<?php if ($_smarty_tpl->getVariable('product')->value->featured){?>featured<?php }?>"><a data-product="<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" href="products/<?php echo $_smarty_tpl->getVariable('product')->value->url;?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name);?>
</a></h3>
        <span style="color:#888; font-size:11px;position: absolute;top: 0;right: 3px;">Артикул: <b style="padding-right:20px;"><?php echo $_smarty_tpl->getVariable('product')->value->id;?>
</b><?php if ($_smarty_tpl->getVariable('product')->value->youtube){?><span class="yuo" title="На данный товар есть видео ролик"></span><?php }else{ ?><?php }?></span>
		<!-- Название товара (The End) -->

		<!-- Описание товара -->
		<!-- Описание товара (The End) -->
                    
		<?php if (count($_smarty_tpl->getVariable('product')->value->variants)>0){?>
        <?php if ($_smarty_tpl->getVariable('product')->value->variant->compare_price>0){?><span class="cold_price"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('product')->value->variant->compare_price);?>
</span><?php }?>
		<span class="cenal"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('product')->value->variant->price);?>
 <span class="currency"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('currency')->value->sign);?>
</span></span>        
		<!-- Выбор варианта товара -->
		<form class="variants" action="/cart" id="cartz">
        <input type="submit" class="buttr" value="купить" data-result-text="в корзине"/>
			<table width="100%">
			<tr class="variant">
				<td valign="top">
					<input id="variants_<?php echo $_smarty_tpl->getVariable('product')->value->variant->id;?>
" name="variant" value="<?php echo $_smarty_tpl->getVariable('product')->value->variant->id;?>
" type="radio" class="variant_radiobutton" checked style="display:none;"/>
				</td>
				<td valign="top">
				</td>
			</tr>
			</table>
		</form>
		<!-- Выбор варианта товара (The End) -->
		<?php }else{ ?>
			<div style="float:right;">Товара нет в наличии</div>
		<?php }?>
		</div>
<!-- Добавление товара к сравнению -->
<!-- Добавление товара к сравнени (The End) -->
	<!-- Товар (The End)-->
</div> 
<?php }} ?>
</div>
<div class="clear"></div>
<?php $_template = new Smarty_Internal_Template('pagination.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>	
<!-- Список товаров (The End)-->
</noindex>
</div>
</div>
<?php }else{ ?>
Товары не найдены

<?php }?>	
<!--Каталог товаров (The End)-->
