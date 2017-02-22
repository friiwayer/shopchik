<?php
	session_start();
	chdir('..');
	require_once('api/Simpla.php');
	
	$simpla = new Simpla();
    if(isset($_GET['fname']))
    {
    $parse = explode(':',$_GET['fname']);
    $filter['cena_from'] = $parse[0];
    $filter['cena_to'] = $parse[1];
    $category_url = $_GET['categorry'];
    $category = $simpla->categories->get_category((string)$category_url);
    $filter['category_id'] = $category->children;
    $products_count = $simpla->products->count_products($filter);
    echo $products_count;
    }
    elseif(isset($_GET['filter']))
    {
    $parse = explode(',',$_GET['filter']);
    if (count($parse)>3)
    {$replace = str_replace('+',' ',$parse[4]);
    $filter['features'] = array($parse[3]=>$replace);
    $filter['cena_from'] = $parse[0];
    $filter['cena_to'] = $parse[1];    
    $category_url = $parse[2];}else{
    $parse = explode(',',$_GET['filter']);
    $replace = str_replace('+',' ',$parse[1]);
    $category_url = $parse[2];
    $filter['features'] = array($parse[0]=>$replace);            
    }
    $category = $simpla->categories->get_category((string)$category_url);
    $filter['category_id'] = $category->children;
    $products_count = $simpla->products->count_products($filter);
    echo $products_count;
    }else echo -1;