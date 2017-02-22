<?php /* Smarty version Smarty-3.0.7, created on 2014-01-29 12:24:15
         compiled from "Z:\home\localhost\www\shopchik//design/new/html\slider.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2163252e8e4df183226-28322783%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'af74afbed1dfb7996bb283f938598ed7f12bb0fa' => 
    array (
      0 => 'Z:\\home\\localhost\\www\\shopchik//design/new/html\\slider.tpl',
      1 => 1389717247,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2163252e8e4df183226-28322783',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'Z:\home\localhost\www\shopchik\Smarty\libs\plugins\modifier.escape.php';
?>﻿<link href="design/<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('settings')->value->theme);?>
/css/example2.css" rel="stylesheet" type="text/css" media="screen"/>
<script type="text/javascript" src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/jquery.onebyone.min.js"></script>
<script type="text/javascript" src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/jquery.touchwipe.min.js"></script>
<script type="text/javascript" src="design/<?php echo $_smarty_tpl->getVariable('settings')->value->theme;?>
/js/jquery.countdown.js"></script>
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<style type="text/css" media="screen">
		#wrapp{              
			width: 530px;    
			-webkit-user-select: none;
            float:right;
            position:relative;	 
		}
       
	 

		#ep2{
			position:absolute;
			left: 36px;
			width: 540px;	 
			top: 50px; 

		}  
		
	  
 
	  
		.otherExample{ 
			position: absolute;
			right: 36px;
			top: 360px;
		}
		.otherExample a{ 
			display: block;
			float: left;
			margin-right: 16px;
			color: #0066FF;
		}    
 		.otherExample a:hover{ 
			color: #B22222;
			text-decoration: underline;
		}     		

	 
</style>
<script>

// Can also be used with $(document).ready()
$(document).ready(function() {
    $('#example2').oneByOne({
			className: 'oneByOne2',
			easeType: 'fadeInLeft',	             
			width: 530,
			height: 270,
			showArrow: false,
			slideShow: true,
            delay:400,
            slideShowDelay: 6000
    }); 
});

</script>
<!-- Слайдер -->
<div id="wrapp">        
	 	<div id="example2">

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_dl'][0][0]->get_deadline_products_plugin(array('var'=>'cop'),$_smarty_tpl);?>

<?php if ($_smarty_tpl->getVariable('cop')->value){?>
<!-- Список товаров-->

	<?php  $_smarty_tpl->tpl_vars['produc'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cop')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['produc']->key => $_smarty_tpl->tpl_vars['produc']->value){
?>
	<!-- Товар-->
	<div class="oneByOne_item">
	<?php if ($_smarty_tpl->getVariable('produc')->value->image){?>
			<a href="products/<?php echo $_smarty_tpl->getVariable('produc')->value->url;?>
"><img class="img1" style="z-index:999;" src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->getVariable('produc')->value->image->filename,250,290);?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('produc')->value->name);?>
"/></a>
	<?php }?>            
	<div class="names"><span class="text1"><a href="products/<?php echo $_smarty_tpl->getVariable('produc')->value->url;?>
" style="color:#fff;"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('produc')->value->name);?>
</a></span></div>
	

	<span class="text2">  
	<ul>
    <?php if ($_smarty_tpl->getVariable('produc')->value->feates){?>
	<?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('produc')->value->feates; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
?>
	<li>
		<label style="margin-left:10px; font-size:11px;"><?php echo $_smarty_tpl->getVariable('f')->value->name;?>
 - </label>
		<span class="infa"><b><?php echo $_smarty_tpl->getVariable('f')->value->value;?>
</b></span>
	</li>
	<?php }} ?>
    <?php }?>
	</ul>
    
    </span>
	<form class="variants" action="/cart">
			<table>
			<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('produc')->value->variants; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
" type="radio" class="variant_radiobutton hiden" <?php if ($_smarty_tpl->tpl_vars['v']->first){?>checked<?php }?> <?php if (count($_smarty_tpl->getVariable('produc')->value->variants)<2){?>style="display:none;"<?php }?>/>
				</td>
				<td>
					<?php if ($_smarty_tpl->getVariable('v')->value->name){?><label class="variant_name" for="discounted_<?php echo $_smarty_tpl->getVariable('v')->value->id;?>
"><?php echo $_smarty_tpl->getVariable('v')->value->name;?>
</label><?php }?>
				</td>
				<td>
					<?php if ($_smarty_tpl->getVariable('v')->value->compare_price>0){?><span class="compare_price hiden"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('v')->value->compare_price);?>
</span><?php }?>
                    <span style="font-size:12px;" class="priceq">
					<span class="pricez">
                    <span class="bi2"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('v')->value->price);?>
 <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('currency')->value->sign);?>
</span>
                    <span style="" class="ded"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->getVariable('v')->value->dprice);?>
 <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('currency')->value->sign);?>
</span>
                    <span class="prica" style="font-family:tahoma; font-size:11px;" id="compact"><?php echo $_smarty_tpl->getVariable('v')->value->d_day;?>
</span>
                    </span>
                    </span>
				</td>
			</tr>
			<?php }} ?>
			</table>
	</form>    										
	</div>  
	<?php }} ?>
<?php }?>
</div>  
</div>
<!-- end -->