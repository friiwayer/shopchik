<?php
	session_start();
	chdir('..');
	require_once('api/Simpla.php');
	
	$simpla = new Simpla();
	if(isset($_GET['sort']))
    {
    if(!$sort_array = explode('&',$_GET['sort']))
	{
    for($t=0;$t<=count($sort_array);$t++)
    {
        $zap = explode('=',$sort_array[$t]);
        foreach($zap as $key=>$val)
        {
            $filter[$key]=$val;
        }
    }
    $category_url=$_GET['cat'];
    $category = $simpla->categories->get_category((string)$category_url);
    $filter['category_id'] = $category->children;
    //$products_count = $simpla->products->get_products($filter);
    $simpla->design->assign('sort', $filter['sort']);
    $simpla->body = $simpla->design->fetch('products.tpl');
		return $simpla->body;    
        
	}else{
    $aq = explode('=',$_GET['sort']);
    $filter['sort'] = $aq[1];
    $_SESSION['sort'] = $filter['sort'];		
	if (!empty($_SESSION['sort']))
			$filter['sort'] = $_SESSION['sort'];			
	else
			$filter['sort'] = 'position';			
    
    $category_url=$_GET['cat'];
    $category = $simpla->categories->get_category((string)$category_url);
    $filter['category_id'] = $category->children;
    //$products_count = $simpla->products->get_products($filter);
    $simpla->body = $simpla->design->fetch('products.tpl');
		return $simpla->body;
    }
    }else
    echo -1;