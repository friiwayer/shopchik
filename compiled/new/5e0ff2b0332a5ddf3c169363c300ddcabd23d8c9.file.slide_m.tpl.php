<?php /* Smarty version Smarty-3.0.7, created on 2012-09-23 11:39:20
         compiled from "Z:\home\localhost\www\shopchik//design/new/html\slide_m.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20396505ed8c8a20564-52302067%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e0ff2b0332a5ddf3c169363c300ddcabd23d8c9' => 
    array (
      0 => 'Z:\\home\\localhost\\www\\shopchik//design/new/html\\slide_m.tpl',
      1 => 1348173346,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20396505ed8c8a20564-52302067',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'Z:\home\localhost\www\shopchik\Smarty\libs\plugins\modifier.escape.php';
?><div class="b-most-popular">
    <div class="b-most-popular-i">
        <div class="b-most-popular-screen">
    
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_new_products'][0][0]->get_new_products_plugin(array('var'=>'new_products','limit'=>5),$_smarty_tpl);?>

        <?php if ($_smarty_tpl->getVariable('new_products')->value){?>
        <ul class="active">
        	<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('new_products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
?>
        	<li><div><a href="products/<?php echo $_smarty_tpl->getVariable('product')->value->url;?>
">
        		<?php if ($_smarty_tpl->getVariable('product')->value->image){?>
        			<img src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->getVariable('product')->value->image->filename,100,100);?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name);?>
" title="купить <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name);?>
"/>
        		<?php }?>
                <br />
        		<a data-product="<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" href="products/<?php echo $_smarty_tpl->getVariable('product')->value->url;?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name);?>
</a>
        
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
"  style="display:none;" name="variant" value="<?php echo $_smarty_tpl->getVariable('v')->value->id;?>
" type="radio" class="variant_radiobutton" <?php if ($_smarty_tpl->tpl_vars['v']->first){?>checked<?php }?> <?php if (count($_smarty_tpl->getVariable('product')->value->variants)<2){?>style="display:none;"<?php }?>/>
        				</td>
        				<td>
        					<?php if ($_smarty_tpl->getVariable('v')->value->name){?><label  style="display:none;" class="variant_name" for="featured_<?php echo $_smarty_tpl->getVariable('v')->value->id;?>
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
        			<span class="price"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('v')->value->price);?>
 <span class="currency"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('currency')->value->sign);?>
</span></span> 			
        		</form>
        
        		<?php }else{ ?>
        			<div class="price_new">Нет в наличии</div>
        		<?php }?>
            </div>
            </a>
        	</li>      
        	<?php }} ?>    			
        </ul>
        <?php }?>
                            
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_featured_products'][0][0]->get_featured_products_plugin(array('var'=>'featured_products','limit'=>5),$_smarty_tpl);?>

        <?php if ($_smarty_tpl->getVariable('featured_products')->value){?>        
        <ul style="left: 100%; display: block; " class="">        
        	<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('featured_products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
?>
        	<li><div><a href="products/<?php echo $_smarty_tpl->getVariable('product')->value->url;?>
">
        		<?php if ($_smarty_tpl->getVariable('product')->value->image){?>
        			<img src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->getVariable('product')->value->image->filename,100,100);?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name);?>
" title="купить <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name);?>
"/>
        		<?php }?>
                <br />
        		<a data-product="<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" href="products/<?php echo $_smarty_tpl->getVariable('product')->value->url;?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name);?>
</a>
        		
        
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
        					<?php if ($_smarty_tpl->getVariable('v')->value->compare_price>0){?><span class="compare_price"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('v')->value->compare_price);?>
</span><?php }?>
        					<span class="price"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('v')->value->price);?>
 <span class="currency"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('currency')->value->sign);?>
</span></span>
        				</td>
        			</tr>
        			<?php }} ?>
        			</table>
        			
        		</form>
        		<?php }else{ ?>
        			<div class="price_new">Нет в наличии</div>
        		<?php }?>
                </a>
                </div>
        	</li>
        	<?php }} ?>		
        </ul>
        <?php }?>
                            
<ul style="left: 100%; display: block; " class="">
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_discounted_products'][0][0]->get_discounted_products_plugin(array('var'=>'discounted_products','limit'=>5),$_smarty_tpl);?>

<?php if ($_smarty_tpl->getVariable('discounted_products')->value){?>
<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('discounted_products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
?>
	<li><div>
		
		<?php if ($_smarty_tpl->getVariable('product')->value->image){?>
			<a href="products/<?php echo $_smarty_tpl->getVariable('product')->value->url;?>
"><img src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->getVariable('product')->value->image->filename,100,100);?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name);?>
"/></a>
		<?php }?>

		<h3><a data-product="<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" href="products/<?php echo $_smarty_tpl->getVariable('product')->value->url;?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name);?>
</a></h3>
		
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
					<input id="discounted_<?php echo $_smarty_tpl->getVariable('v')->value->id;?>
" name="variant" value="<?php echo $_smarty_tpl->getVariable('v')->value->id;?>
" type="radio" class="variant_radiobutton" <?php if ($_smarty_tpl->tpl_vars['v']->first){?>checked<?php }?> <?php if (count($_smarty_tpl->getVariable('product')->value->variants)<2){?>style="display:none;"<?php }?>/>
				</td>
				<td>
					<?php if ($_smarty_tpl->getVariable('v')->value->name){?><label class="variant_name" for="discounted_<?php echo $_smarty_tpl->getVariable('v')->value->id;?>
"><?php echo $_smarty_tpl->getVariable('v')->value->name;?>
</label><?php }?>
				</td>
				<td>
					<?php if ($_smarty_tpl->getVariable('v')->value->compare_price>0){?><span class="compare_price"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('v')->value->compare_price);?>
</span><?php }?>
					<span class="price"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('v')->value->price);?>
 <span class="currency"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('currency')->value->sign);?>
</span></span>
				</td>
			</tr>
			<?php }} ?>
			</table>
		</form>
		<?php }else{ ?>
			Нет в наличии
		<?php }?>
    </div>
	</li>
<?php }} ?>
<?php }?>
</ul>
</div>
    </div>
    <div class="b-most-popular-nav" rel="484">
        <i class="icon arrow" style="margin-left: -207px; display: inline; "></i>
        <a href="#" class="active">Новые Товары</a>
        <a href="#" class="">Рекомендуем</a>
        <a href="#" class="">Товары со скидкой</a>
    </div>
</div>