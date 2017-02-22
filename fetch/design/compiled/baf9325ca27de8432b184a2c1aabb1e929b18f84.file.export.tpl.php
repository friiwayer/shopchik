<?php /* Smarty version Smarty-3.0.7, created on 2012-07-17 08:56:49
         compiled from "simpla/design/html\export.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3156250050cb1c57f35-12835731%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'baf9325ca27de8432b184a2c1aabb1e929b18f84' => 
    array (
      0 => 'simpla/design/html\\export.tpl',
      1 => 1308159020,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3156250050cb1c57f35-12835731',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
	<li><a href="index.php?module=ImportAdmin">Импорт</a></li>
	<li class="active"><a href="index.php?module=ExportAdmin">Экспорт</a></li>
	<li><a href="index.php?module=BackupAdmin">Бекап</a></li>			
<?php  Smarty::$_smarty_vars['capture']['tabs']=ob_get_clean();?>
<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_variable('Экспорт товаров', null, 1);?>

<script>

	
var in_process=false;

$(function() {

	// On document load
	$('input#start').click(function() {
 
    	$("#progressbar").progressbar({ value: 0 });
 		
    	$("#start").hide('fast');
		do_export();
    
	});
  
	function do_export(page)
	{
		page = typeof(page) != 'undefined' ? page : 1;

		$.ajax({
 			 url: "ajax/export.php",
 			 	data: {page:page},
 			 	dataType: 'json',
  				success: function(data){
  				
    				if(data && !data.end)
    				{
    					$("#progressbar").progressbar({ value: 100*data.page/data.totalpages });
    					do_export(data.page*1+1);
    				}
    				else
    				{	
    					$("#progressbar").hide('fast');
    					window.location.href = 'files/export/export.csv';
 
    				}
  				},
				error:function(xhr, status, errorThrown) {
                	alert(errorThrown+'\n'+status+'\n'+xhr.statusText);
        		}  				
  				
		});
	
	} 
	
});

</script>

<style>
	.ui-progressbar-value { background-image: url(design/images/progress.gif); background-position:left; border-color: #009ae2;}
	#progressbar{ clear: both; height:29px; }
	#result{ clear: both; width:100%;}
	#download{ display:none;  clear: both; }
</style>


<?php if ($_smarty_tpl->getVariable('message_error')->value){?>
<!-- Системное сообщение -->
<div class="message message_error">
	<span>
	<?php if ($_smarty_tpl->getVariable('message_error')->value=='no_permission'){?>Установите права на запись в папку <?php echo $_smarty_tpl->getVariable('export_files_dir')->value;?>

	<?php }else{ ?><?php echo $_smarty_tpl->getVariable('message_error')->value;?>
<?php }?>
	</span>
</div>
<!-- Системное сообщение (The End)-->
<?php }?>


<div>
	<h1>Экспорт товаров</h1>
	<?php if ($_smarty_tpl->getVariable('message_error')->value!='no_permission'){?>
	<div id='progressbar'></div>
	<input class="button_green" id="start" type="button" name="" value="Экспортировать" />	
	<?php }?>
</div>
 
