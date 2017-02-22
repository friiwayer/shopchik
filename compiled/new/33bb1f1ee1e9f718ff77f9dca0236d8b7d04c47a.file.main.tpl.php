<?php /* Smarty version Smarty-3.0.7, created on 2017-02-21 02:59:47
         compiled from "D:\OpenServer\domains\shopchik//design/new/html\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:363058ab9f13cfbd44-73303432%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '33bb1f1ee1e9f718ff77f9dca0236d8b7d04c47a' => 
    array (
      0 => 'D:\\OpenServer\\domains\\shopchik//design/new/html\\main.tpl',
      1 => 1382188598,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '363058ab9f13cfbd44-73303432',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'D:\OpenServer\domains\shopchik\Smarty\libs\plugins\modifier.escape.php';
?>
<?php $_smarty_tpl->tpl_vars['wrapper'] = new Smarty_variable('index.tpl', null, 1);?>

<style type="text/css">
/* <![CDATA[ */
* {margin: 0; padding: 0;}
/* ]]> */
</style>
<script type="text/javascript">
$(function(){
   $('.ho').toggle(function(){
   $('.oh').show();
   }, function(){
   $('.oh').hide();
   }); 
});
</script>

<script src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/top.js"></script>
<div class="clear"></div>
<?php if ($_smarty_tpl->getVariable('page')->value&&$_smarty_tpl->getVariable('page')->value->url==''){?>

<div id="catalog_menus">
        <ul class="main_cat">
                    <li style="position:relative; border-bottom: 1px dashed #B1B1B1;">
        <a href="http://shopchik.com/catalog/smartfony" title="Смартфоны">
                    <img src="design/<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('settings')->value->theme);?>
/images/smarth.png" alt="Смартфоны">
                    <div class="nam">Смартфоны</div>
                    <div class="b-promobox-price"> <span class="btn btn-price btn-price_stock-in">от 3 700<span class="ruble">p</span></span> </div>
                    <a href="http://shopchik.com/catalog/smartfony" class="b-promobox-anchor"></a>
        </a>
					</li>
					
                    <li style="border-left: 1px dashed #B1B1B1; border-bottom: 1px dashed #B1B1B1; position:relative;">
						<a href="http://shopchik.com/catalog/planshety-netbuki" title="Планшетные ПК">                <div class="img">
                    <img src="design/<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('settings')->value->theme);?>
/images/tabletpc.png" alt="Планшетные ПК">
                </div>
                        <div class="nam">Планшетные ПК</div>
                        <div class="b-promobox-price"> <span class="btn btn-price btn-price_stock-in">от 2 400<span class="ruble">p</span></span> </div>
                        <a href="http://shopchik.com/catalog/planshety-netbuki" class="b-promobox-anchor"></a>
        </a>
					</li>
					
                    <li style="border-left: 1px dashed #B1B1B1; border-right: 1px dashed #B1B1B1; border-bottom: 1px dashed #B1B1B1; position:relative;">
						<a href="http://shopchik.com/catalog/sotovye" title="Сотовые телефоны">                <div class="img">
                    <img src="design/<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('settings')->value->theme);?>
/images/tel.png" alt="Сотовые телефоны">
                </div>
                        <div class="nam">Сотовые телефоны</div>
                        <div class="b-promobox-price"> <span class="btn btn-price btn-price_stock-in">от 1650<span class="ruble">p</span></span> </div>
                        <a href="http://shopchik.com/catalog/sotovye" class="b-promobox-anchor"></a>
        </a>
					</li>
					
                    <li style="position:relative;">
						<a href="http://respekt.msk.ru/catalog/foto_i_videokamery" title="Аксесуары">                <div class="img">
                    <img src="design/<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('settings')->value->theme);?>
/images/acessories.png" alt="Аксесуары">
                </div>
                        <div class="nam">Аксесуары</div>
                        <div class="b-promobox-price"> <span class="btn btn-price btn-price_stock-in">от 300<span class="ruble">p</span></span> </div>
                        <a href="http://shopchik.com/catalog/aksessuary" class="b-promobox-anchor"></a>
        </a>
					</li>
                    
					<li style="border-left: 1px dashed #B1B1B1; position:relative;">
						<a href="http://respekt.msk.ru/catalog/ofisnaya_tehnika" title="Гаджеты">                <div class="img">
                    <img src="design/<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('settings')->value->theme);?>
/images/gagets.png" alt="Гаджеты">
                </div>
                        <div class="nam">Гаджеты</div>
                        <div class="b-promobox-price"> <span class="btn btn-price btn-price_stock-in">от 160<span class="ruble">p</span></span> </div>
                        <a href="http://shopchik.com/catalog/gadzhety" class="b-promobox-anchor"></a>
        </a>
					</li>
                    
					<li style="border-left: 1px dashed #B1B1B1; border-right: 1px dashed #B1B1B1; position:relative;">
						<a href="http://shopchik.com/catalog/igrushki" title="Игрушки">                <div class="img">
                    <img src="design/<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('settings')->value->theme);?>
/images/games.png" alt="Игрушки">
                </div>
                        <div class="nam">Игрушки</div>
                        <div class="b-promobox-price"> <span class="btn btn-price btn-price_stock-in">от 1440<span class="ruble">p</span></span> </div>
                        <a href="http://shopchik.com/catalog/igrushki" class="b-promobox-anchor"></a>
        </a>
					</li>
</ul>
<?php $_template = new Smarty_Internal_Template("slider.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
</div>
<?php }?>
 
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_new_products'][0][0]->get_new_products_plugin(array('var'=>'new_products','limit'=>6),$_smarty_tpl);?>

<?php if ($_smarty_tpl->getVariable('new_products')->value){?>
<h3 style="border-bottom: 1px solid #CCC; line-height:23px; padding: 2px 0 0 5px; background-color: #F0F0F0; font-size: 14px; margin-top: 20px;width: 99.8%; position:relative;">Новинки:
<div class="h3"></div>
</h3>
<ul class="shop4">

	<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('new_products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
?>

	<li class="product">

		<?php if ($_smarty_tpl->getVariable('product')->value->image){?>
		<div class="image">
			<a href="products/<?php echo $_smarty_tpl->getVariable('product')->value->url;?>
"><img src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->getVariable('product')->value->image->filename,80,80);?>
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

			<tr class="variant">
				<td>
					<input id="featured_<?php echo $_smarty_tpl->getVariable('product')->value->variant->id;?>
" name="variant" value="<?php echo $_smarty_tpl->getVariable('product')->value->variant->id;?>
" type="radio" class="variant_radiobutton" checked <?php if (count($_smarty_tpl->getVariable('product')->value->variants)>0){?>style="display:none;"<?php }?>/>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>

			</table>
            <?php if ($_smarty_tpl->getVariable('product')->value->variant->compare_price>0){?><span class="compare_price"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('product')->value->variant->compare_price);?>
</span><?php }?>
			<div class="b-promobox-pricse"><span class="btn btn-price btn-price_stock-in"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('product')->value->variant->price);?>
 <span class="currency"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('currency')->value->sign);?>
</span></span></div>
    <div class="b-catalog_accessories-popup">
    <div class="b-catalog_accessories-popup-foot">
    <span class="sbtn sbtn_box sbtn_catalog-to-cart">
    <span class="">
    <input type="submit" class="butt" style="" value="в корзину" data-result-text="в корзине"/></span>
    </span>
    </div>
    </div>            
            
		</form>
		<?php }else{ ?>
			Нет в наличии
		<?php }?>
	</li>
	<?php }} ?>
			
</ul>
<?php }?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_featured_products'][0][0]->get_featured_products_plugin(array('var'=>'featured_products','limit'=>6),$_smarty_tpl);?>

<?php if ($_smarty_tpl->getVariable('featured_products')->value){?>
<h3 class="ho" style="border-bottom: 1px solid #CCC; padding: 2px 0 0 5px; line-height:23px; background-color: #F0F0F0; font-size: 14px; margin-top: 10px;width: 99.8%; cursor:pointer; position:relative;">Рекомендуемые товары:
<div class="h3"></div></h3>
<ul class="shop4 oh" style="display:none;">

	<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('featured_products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
?>

	<li class="product">

		<?php if ($_smarty_tpl->getVariable('product')->value->image){?>
		<div class="image">
			<a href="products/<?php echo $_smarty_tpl->getVariable('product')->value->url;?>
"><img src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->getVariable('product')->value->image->filename,80,80);?>
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

			<tr class="variant">
				<td>
					<input id="featured_<?php echo $_smarty_tpl->getVariable('product')->value->variant->id;?>
" name="variant" value="<?php echo $_smarty_tpl->getVariable('product')->value->variant->id;?>
" type="radio" class="variant_radiobutton" checked <?php if (count($_smarty_tpl->getVariable('product')->value->variants)>0){?>style="display:none;"<?php }?>/>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>

			</table>
            
			<div class="b-promobox-pricse"><span class="btn btn-price btn-price_stock-in"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('product')->value->variant->price);?>
 <span class="currency"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('currency')->value->sign);?>
</span></span></div>
    <div class="b-catalog_accessories-popup">
    <div class="b-catalog_accessories-popup-foot">
    <span class="sbtn sbtn_box sbtn_catalog-to-cart">
    <span class="">
    <input type="submit" class="butt" style="" value="в корзину" data-result-text="в корзине"/></span>
    </span>
    </div>
    </div>            
            
		</form>
		<?php }else{ ?>
			Нет в наличии
		<?php }?>
	</li>
	<?php }} ?>		
</ul>
<?php }?>
<div class="endpage"></div>
<div class="clear" style="height:10px; padding-bottom:5px;"></div>
<ul class="brands">
<noindex>
<?php  $_smarty_tpl->tpl_vars['br'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('brandy')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['br']->key => $_smarty_tpl->tpl_vars['br']->value){
?>
<a rel="nofollow" href="brands/<?php echo $_smarty_tpl->getVariable('br')->value->url;?>
" title="<?php echo $_smarty_tpl->getVariable('br')->value->name;?>
"><li class="<?php echo $_smarty_tpl->getVariable('br')->value->name;?>
"></li></a>
<?php }} ?>
</noindex>
</ul>
<div class="clear"></div>
