<?PHP

/**
 * Simpla CMS
 *
 * @copyright 	2011 Denis Pikusov
 * @link 		http://simplacms.ru
 * @author 		Denis Pikusov
 *
 * Этот класс использует шаблон products.tpl
 *
 */
 
require_once('View.php');

class ProductsView extends View
{
 	/**
	 *
	 * Отображение списка товаров
	 *
	 */	
	function fetch()
	{
		// GET-Параметры
		$category_url = $this->request->get('category', 'string');
		$brand_url    = $this->request->get('brand', 'string');
		
               
		$filter = array();
		$filter['visible'] = 1;	

		// Если задан бренд, выберем его из базы
		if (!empty($brand_url))
		{
			$brand = $this->brands->get_brand((string)$brand_url);
			if (empty($brand))
				return false;
			$this->design->assign('brand', $brand);
			$filter['brand_id'] = $brand->id;
		}
		
		// Выберем текущую категорию
		if (!empty($category_url))
		{
			$category = $this->categories->get_category((string)$category_url);
			if (empty($category) || (!$category->visible && empty($_SESSION['admin'])))
				return false;
			$this->design->assign('category', $category);
			$filter['category_id'] = $category->children;
		}

		// Если задано ключевое слово
		$keyword = $this->request->get('keyword', 'string');
		if (!empty($keyword))
		{
			$this->design->assign('keyword', $keyword);
			$filter['keyword'] = $keyword;
		}
        
        $cena_from = $this->request->get('cena_from');
        if(!empty($cena_from))
        {$this->design->assign('cena_from',$cena_from);
        $filter['cena_from'] = $cena_from;
        $this->design->assign('ot',$cena_from);
        }
        
        $cena_to = $this->request->get('cena_to');
        if(!empty($cena_to))
        {
        $this->design->assign('cena_to',$cena_to);
        $filter['cena_to'] = $cena_to;
        $this->design->assign('do',$cena_to);   
        }
        
        
		// Сортировка товаров, сохраняем в сесси, чтобы текущая сортировка оставалась для всего сайта
		if($sort = $this->request->get('sort', 'string'))
			$_SESSION['sort'] = $sort;		
		if (!empty($_SESSION['sort']))
			$filter['sort'] = $_SESSION['sort'];			
		else
			$filter['sort'] = 'position DESC';
            
        if($order = $this->request->get('order','string'))
        {   $_SESSION['order'] = $order;
        }if (!empty($_SESSION['order']))
			$filter['order'] = $_SESSION['order'];			
		else
            $filter['order'] = 'ASC';			
		$this->design->assign('sort', $filter['sort']);
		$this->design->assign('order',$filter['order']);
        
        $p_count = $this->products->count_products(array('category_id'=>$category->id));
        $this->design->assign('count',$p_count);
        		
		// Свойства товаров
		if(!empty($category))
		{
			$features = array();
			foreach($this->features->get_features(array('category_id'=>$category->id, 'in_filter'=>1)) as $feature)
			{ 
				$features[$feature->id] = $feature;
				if(($val = $this->request->get($feature->id))!='')
					$filter['features'][$feature->id] = $val;	
			}
			
			$options_filter['visible'] = 1;
			
			$features_ids = array_keys($features);
			if(!empty($features_ids))
				$options_filter['feature_id'] = $features_ids;
			$options_filter['category_id'] = $category->children;
			if(isset($filter['features']))
				$options_filter['features'] = $filter['features'];
			if(!empty($brand))
				$options_filter['brand_id'] = $brand->id;
			
			$options = $this->features->get_options($options_filter);

			foreach($options as $option)
			{
				if(isset($features[$option->feature_id]))
					$features[$option->feature_id]->options[] = $option;
			}
			
			foreach($features as $i=>&$feature)
			{ 
				if(empty($feature->options))
					unset($features[$i]);
			}
            
            $display = array();
            foreach($this->features->get_features_display(array('category_id'=>$category->id, 'in_filter'=>1)) as $lcd)
			{ 
				$display[$lcd->id] = $lcd;
				if(($val = $this->request->get($lcd->id))!='')
					$filter['features'][$lcd->id] = $val;	
			}            
            

			$this->design->assign('features', $features);
 		}

		// Постраничная навигация- выдерает с настроек количество товаров на страницу
                //Проверка получения 
        if($this->request->post('ppp','int'))
        {$items_per_page = $this->request->post('ppp','int');
        $_SESSION['items_per_pag'] = $items_per_page;}
        elseif($this->request->get('ppp'))
        {
        $items_per_page = substr($this->request->get('ppp'),10);
        $_SESSION['items_per_pag'] = $items_per_page;}
        elseif(isset($_SESSION['items_per_pag']) && intval($_SESSION['items_per_pag']))
        {$items_per_page = $_SESSION['items_per_pag'];}
        else{
        $items_per_page = $this->settings->products_num;
        }		
		// Текущая страница в постраничном выводе
		$current_page = $this->request->get('page', 'int');	
		// Если не задана, то равна 1
		$current_page = max(1, $current_page);
		$this->design->assign('current_page_num', $current_page);
		// Вычисляем количество страниц
		$products_count = $this->products->count_products($filter);
		$pages_num = ceil($products_count/$items_per_page);
		$this->design->assign('total_pages_num', $pages_num);
        
		$filter['page'] = $current_page;
        if(isset($_SESSION['$items_per_pag']))
        {$filter['limit'] = $_SESSION['$items_per_pag'];
        }else{$filter['limit'] = $items_per_page;}
		///////////////////////////////////////////////
		// Постраничная навигация END
		///////////////////////////////////////////////
		

		$discount = 0;
		if(isset($_SESSION['user_id']) && $user = $this->users->get_user(intval($_SESSION['user_id'])))
			$discount = $user->discount;
			
		// Товары 
		$products = array();
		foreach($this->products->get_products($filter) as $p)
			{$products[$p->id] = $p;
            $products[$p->id]->ufo = $this->products->get_futurs($p->id);}
			
		// Если искали товар и найден ровно один - перенаправляем на него
		if(!empty($keyword) && $products_count == 1)
			header('Location: '.$this->config->root_url.'/products/'.$p->url);
		
		if(!empty($products))
		{
			$products_ids = array_keys($products);
			foreach($products as &$product)
			{
				$product->variants = array();
				$product->images = array();
				$product->properties = array();
			}
            
			$variants = $this->variants->get_variants(array('product_id'=>$products_ids, 'in_stock'=>true));
			
			foreach($variants as &$variant)
			{
				//$variant->price *= (100-$discount)/100;
				$products[$variant->product_id]->variants[] = $variant;
			}
	
			$images = $this->products->get_images(array('product_id'=>$products_ids));
			foreach($images as $image)
				$products[$image->product_id]->images[] = $image;

			foreach($products as &$product)
			{
				if(isset($product->variants[0]))
					$product->variant = $product->variants[0];
				if(isset($product->images[0]))
					$product->image = $product->images[0];
			}
				
	
			/*
			$properties = $this->features->get_options(array('product_id'=>$products_ids));
			foreach($properties as $property)
				$products[$property->product_id]->options[] = $property;
			*/
	
			$this->design->assign('products', $products);
 		}
		
		// Выбираем бренды, они нужны нам в шаблоне	
		if(!empty($category))
		{
			$brands = $this->brands->get_brands(array('category_id'=>$category->children));
			$category->brands = $brands;		
		}
		
		// Устанавливаем мета-теги в зависимости от запроса
		if($this->page)
		{
			$this->design->assign('meta_title', $this->page->meta_title);
			$this->design->assign('meta_keywords', $this->page->meta_keywords);
			$this->design->assign('meta_description', $this->page->meta_description);
		}
		elseif(isset($category))
		{
			$this->design->assign('meta_title', $category->meta_title);
			$this->design->assign('meta_keywords', $category->meta_keywords);
			$this->design->assign('meta_description', $category->meta_description);
		}
		elseif(isset($brand))
		{
			$this->design->assign('meta_title', $brand->meta_title);
			$this->design->assign('meta_keywords', $brand->meta_keywords);
			$this->design->assign('meta_description', $brand->meta_description);
		}
		elseif(isset($keyword))
		{
			$this->design->assign('meta_title', $keyword);
		}
		
			
		$this->body = $this->design->fetch('products.tpl');
		return $this->body;
	}
}
