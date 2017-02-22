<?php /* Smarty version Smarty-3.0.7, created on 2012-09-30 11:24:23
         compiled from "Z:\home\localhost\www\shopchik//design/new/html\last_n.tpl" */ ?>
<?php /*%%SmartyHeaderCode:618950680fc7e80005-73803295%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8e88967c9fd719cd81ced7ae3a1c852ac5c84448' => 
    array (
      0 => 'Z:\\home\\localhost\\www\\shopchik//design/new/html\\last_n.tpl',
      1 => 1348913324,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '618950680fc7e80005-73803295',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<table id="tbo">
<tr>
<td>
<div class="b-promo-tizer-item-h">
        <div class="b-promo-tizer-body">
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_last_statya'][0][0]->get_last_statya_plugin(array('var'=>'last_statya','limit'=>1),$_smarty_tpl);?>

            <img src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->getVariable('last_statya')->value->image->filename,100,100);?>
" alt="" class="b-promo-tizer-image">
            <?php echo $_smarty_tpl->getVariable('last_statya')->value->name;?>
 
        </div>
        <div class="b-promo-tizer-foot">Статьи Обзоры <span style="float:right;"><a href="http://shopchik.com/staty">все статьи</a></span></div>
        <a class="b-promo-tizer-anchor" href="staty/<?php echo $_smarty_tpl->getVariable('last_statya')->value->url;?>
"></a>
</div>
</td>
<td>
<div class="b-promo-tizer-item-h">
        <div class="b-promo-tizer-body">
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_last_news'][0][0]->get_last_news_plugin(array('var'=>'last_news'),$_smarty_tpl);?>

        <span class="date"><?php echo $_smarty_tpl->getVariable('last_news')->value->date;?>
</span>
        <div class="clear"></div>
            <?php echo $_smarty_tpl->getVariable('last_news')->value->name;?>

        </div>
        <div class="b-promo-tizer-foot">Новости <span style="float:right;"><a href="http://shopchik.com/blog">все новости</a></span></div>
        <a class="b-promo-tizer-anchor" href="blog/<?php echo $_smarty_tpl->getVariable('last_news')->value->url;?>
"></a>
</div>
<div class="book"></div>
</td>
<td>
<div class="comercial" style="">
        <div class="b-promo-tizer-body">
        </div>
        <a class="b-promo-tizer-anchor" href=""></a>
</div>
</td>
<td>
<div class="b-promo-tizer-item-l">
        <div class="b-promo-tizer-body">
            <p>Здесь отображается последний комментарий</p>
        </div>
        <div class="b-promo-tizer-foot">Последний коментарий</div>
        <a class="b-promo-tizer-anchor" href=""></a>
</div>
</td>
</tr>
</table>