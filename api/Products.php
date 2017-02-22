<?php

/**
 * Работа с товарами
 *
 * @copyright 	2011 Denis Pikusov
 * @link 		http://simplacms.ru
 * @author 		Denis Pikusov
 *
 */

require_once('Simpla.php');

class Products extends Simpla
{
	/**
	* Функция возвращает товары
	* Возможные значения фильтра:
	* id - id товара или их массив
	* category_id - id категории или их массив
	* brand_id - id бренда или их массив
	* page - текущая страница, integer
	* limit - количество товаров на странице, integer
	* sort - порядок товаров, возможные значения: position(по умолчанию), name, price
	* keyword - ключевое слово для поиска
	* features - фильтр по свойствам товара, массив (id свойства => значение свойства)
	*/
	public function get_products($filter = array())
	{		
		// По умолчанию
		$limit = 100;
		$page = 1;
		$category_id_filter = '';
		$brand_id_filter = '';
		$product_id_filter = '';
		$features_filter = '';
		$keyword_filter = '';
        $price_filter = '';
		$visible_filter = '';
		$visible_filter = '';
		$is_featured_filter = '';
		$discounted_filter = '';
		$in_stock_filter = '';
        $feat_filter = '';
		$order = 'p.position DESC';
        $show_main = '';

		if(isset($filter['limit']))
			$limit = max(1, intval($filter['limit']));

		if(isset($filter['page']))
			$page = max(1, intval($filter['page']));

		$sql_limit = $this->db->placehold(' LIMIT ?, ? ', ($page-1)*$limit, $limit);

		if(!empty($filter['id']))
			$product_id_filter = $this->db->placehold('AND p.id in(?@)', (array)$filter['id']);

		if(!empty($filter['category_id']))
			$category_id_filter = $this->db->placehold('INNER JOIN __products_categories pc ON pc.product_id = p.id AND pc.category_id in(?@)', (array)$filter['category_id']);

		if(!empty($filter['brand_id']))
			$brand_id_filter = $this->db->placehold('AND p.brand_id in(?@)', (array)$filter['brand_id']);

		if(!empty($filter['featured']))
			$is_featured_filter = $this->db->placehold('AND p.featured=?', intval($filter['featured']));

		if(!empty($filter['discounted']))
			$discounted_filter = $this->db->placehold('AND (SELECT 1 FROM __variants pv WHERE pv.product_id=p.id AND pv.compare_price>0 LIMIT 1) = ?', intval($filter['discounted']));

		if(!empty($filter['random']))
			$order = 'RAND ()';
            
		if(!empty($filter['in_stock']))
			$in_stock_filter = $this->db->placehold('AND (SELECT 1 FROM __variants pv WHERE pv.product_id=p.id AND pv.price>0 AND (pv.stock IS NULL OR pv.stock>0) LIMIT 1) = ?', intval($filter['in_stock']));

		if(!empty($filter['visible']))
			$visible_filter = $this->db->placehold('AND p.visible=?', intval($filter['visible']));

        if(!empty($filter['deadline']))
			$deadline = $this->db->placehold('AND (SELECT 1 FROM __variants pv WHERE pv.product_id=p.id AND pv.deadline>0 LIMIT 1) = ?', intval($filter['deadline']));
            
		
        if(!empty($filter['show_m']))
			$show_main = $this->db->placehold('AND p.show_m=1');

 		if(!empty($filter['sort']) && !empty($filter['order']))
			switch ($filter['sort'])
			{
				case 'position':
				$order = 'p.position '.$filter['order'];
				break;
				case 'name':
				$order = 'p.name '.$filter['order'];
				break;
                case 'rating':
                $order = 'p.rating '.$filter['order'];
                break;
				case 'created':
				$order = 'p.created '.$filter['order'];
				break;
				case 'price':
				//$order = 'pv.price IS NULL, pv.price=0, pv.price';
				$order = '(SELECT pv.price FROM __variants pv WHERE (pv.stock IS NULL OR pv.stock>0) AND p.id = pv.product_id AND pv.position=(SELECT MIN(position) FROM __variants WHERE (stock>0 OR stock IS NULL) AND product_id=p.id) LIMIT 1 ) '.$filter['order'];
				break;
			}

		if(!empty($filter['keyword']))
		{
			$keywords = explode(' ', $filter['keyword']);
			foreach($keywords as $keyword)
				$keyword_filter .= $this->db->placehold('AND (p.name LIKE "%'.mysql_real_escape_string(trim($keyword)).'%" OR p.meta_keywords LIKE "%'.mysql_real_escape_string(trim($keyword)).'%") ');
		}

        
        if(!empty($filter['cena_from']) && !empty($filter['cena_to']))
        {  
           $price1 = $filter['cena_from'];
           $price2 = $filter['cena_to'];
           $price_filter .= $this->db->placehold('AND (SELECT 1 FROM __variants pv WHERE pv.product_id = p.id AND pv.price > ? AND pv.price < ? LIMIT 1) ', $price1, $price2); 
        }
        
		if(!empty($filter['features']) && !empty($filter['features']))
			foreach($filter['features'] as $feature=>$value)
			$features_filter .= $this->db->placehold('AND p.id in (SELECT product_id FROM __options WHERE feature_id=? AND value=? ) ', $feature, $value);
            
        
		if(!empty($filter['article']))
				$feat_filter .= $this->db->placehold('AND (p.id =?) ', $filter['article']);                    

		$query = "SELECT
					p.id,
					p.url,
					p.brand_id,
					p.name,
					p.annotation,
					p.body,
                   	p.rating,
                    p.youtube,
                    p.votes,
					p.position,
					p.created as created,
					p.visible,
                    p.show_m,
					p.featured, 
					p.meta_title, 
					p.meta_keywords, 
					p.meta_description, 
					b.name as brand,
					b.url as brand_url
				FROM __products p		
				$category_id_filter 
				LEFT JOIN __brands b ON p.brand_id = b.id
				WHERE 
					1
					$product_id_filter
					$brand_id_filter
					$features_filter
					$keyword_filter
					$is_featured_filter
					$discounted_filter
					$in_stock_filter
					$visible_filter
                    $feat_filter
                    $show_main
                    $random
                    $deadline
                    $price_filter
				GROUP BY p.id
				ORDER BY $order
					$sql_limit";

		$query = $this->db->placehold($query);
		$this->db->query($query);

		return $this->db->results();
	}
    
    public function show_inmain($filter)
    {
        if(!empty($filter))
			$product_id_filter = $this->db->placehold('id =?', $filter);
            
        		$query = "SELECT show_m FROM __products WHERE $product_id_filter";

		$query = $this->db->placehold($query);
		$this->db->query($query);

		return $this->db->result('show_m');
    }

	/**
	* Функция возвращает количество товаров
	* Возможные значения фильтра:
	* category_id - id категории или их массив
	* brand_id - id бренда или их массив
	* keyword - ключевое слово для поиска
	* features - фильтр по свойствам товара, массив (id свойства => значение свойства)
	*/
    public function tags_clowd($filter = array())
    {   $limit = 100;
		$page = 1;
		if(isset($filter['limit']))
		$limit = max(1, intval($filter['limit']));
        $sql_limit = $this->db->placehold(' LIMIT ?, ? ', ($page-1)*$limit, $limit);
		$query = "SELECT  
					p.id,
					p.url,
					p.brand_id,
					p.name
				FROM __products p		
				LEFT JOIN __brands b ON p.brand_id = b.id
				GROUP BY p.id
                ORDER BY RAND()
				LIMIT 15";

		$query = $this->db->placehold($query);
		$this->db->query($query);
		return  $this->db->results();
    }
    
    public function get_most_rated($filter = array())
    { $limit = 5;
      $page = 1;
      if(isset($filter['limit']))
	  $limit = max(1, intval($filter['limit']));
      $sql_limit = $this->db->placehold(' LIMIT ?, ? ', ($page-1)*$limit, $limit);      
      $query = "SELECT  
					p.id,
					p.url,
					p.name
				FROM __products p
                WHERE p.rating > 0
                ORDER BY RAND()
				LIMIT 4";

		$query = $this->db->placehold($query);
		$this->db->query($query);
		return  $this->db->results();        
    }
    
   
    public function complect($id)
    {   if(is_numeric($id))
        $query = "
        SELECT
        p.id,
        p.name,
        p.compl
        FROM __products p
        WHERE p.id = $id
        ";
        $query = $this->db->placehold($query);
        $this->db->query($query);
        return $this->db->results();
    }
    
	public function count_products($filter = array())
	{
		$category_id_filter = '';
		$brand_id_filter = '';
		$keyword_filter = '';
		$visible_filter = '';
		$is_featured_filter = '';
		$discounted_filter = '';
		$features_filter = '';
        $price_filter = '';
        $feat_filter = '';
        $category_id_f = '';
		
		if(!empty($filter['category_id']))
			$category_id_filter = $this->db->placehold('INNER JOIN __products_categories pc ON pc.product_id = p.id AND pc.category_id in(?@)', (array)$filter['category_id']);

        if(!empty($filter['cat_id']))
			$category_id_f = $this->db->placehold('INNER JOIN __products_categories pc ON pc.product_id = p.id AND pc.category_id in(?@)', $filter['cat_id']);            

		if(!empty($filter['brand_id']))
			$brand_id_filter = $this->db->placehold('AND p.brand_id in(?@)', (array)$filter['brand_id']);
		
		if(isset($filter['keyword']))
		{
			$keywords = explode(' ', $filter['keyword']);
			foreach($keywords as $keyword)
				$keyword_filter .= $this->db->placehold('AND (p.name LIKE "%'.mysql_real_escape_string(trim($keyword)).'%" OR p.meta_keywords LIKE "%'.mysql_real_escape_string(trim($keyword)).'%") ');
		}
        
        if(!empty($filter['cena_from']) && !empty($filter['cena_to']))
        {  
           $price1 = $filter['cena_from'];
           $price2 = $filter['cena_to'];
           $price_filter .= $this->db->placehold('AND (SELECT 1 FROM __variants pv WHERE pv.product_id=p.id AND pv.price > ? AND pv.price < ? LIMIT 1) ', $price1, $price2); 
        }

		if(!empty($filter['featured']))
			$is_featured_filter = $this->db->placehold('AND p.featured=?', intval($filter['featured']));

		if(!empty($filter['discounted']))
			$discounted_filter = $this->db->placehold('AND (SELECT 1 FROM __variants pv WHERE pv.product_id=p.id AND pv.compare_price>0 LIMIT 1) = ?', intval($filter['discounted']));

		if(!empty($filter['visible']))
			$visible_filter = $this->db->placehold('AND p.visible=?', intval($filter['visible']));
		
		
		if(!empty($filter['features']) && !empty($filter['features']))
			foreach($filter['features'] as $feature=>$value)
				$features_filter .= $this->db->placehold('AND p.id in (SELECT product_id FROM __options WHERE feature_id=? AND value=? ) ', $feature, $value);

		if(!empty($filter['article']))
				$feat_filter .= $this->db->placehold('AND (p.id =?) ', $filter['article']);
		
		$query = "SELECT count(distinct p.id) as count
				FROM __products AS p
				$category_id_filter
				WHERE 1
					$brand_id_filter
					$keyword_filter
					$is_featured_filter
					$discounted_filter
					$visible_filter
					$features_filter
                    $feat_filter
                    $price_filter
                    ";

		$this->db->query($query);	
		return $this->db->result('count');
	}


	/**
	* Функция возвращает товар по id
	* @param	$id
	* @retval	object
	*/
	public function get_product($id)
	{
		if(is_int($id))
			$filter = $this->db->placehold('p.id = ?', $id);
		else
			$filter = $this->db->placehold('p.url = ?', $id);
			
		$query = $this->db->placehold("SELECT DISTINCT
					p.id,
					p.url,
					p.brand_id,
					p.name,
					p.annotation,
					p.body,
                   	p.rating,
                    p.votes,
					p.position,
					p.created as created,
					p.visible, 
					p.featured, 
					p.meta_title, 
					p.meta_keywords,
                    p.youtube,
                    p.postav,
                    p.meta_description
				FROM __products AS p
                LEFT JOIN __brands b ON p.brand_id = b.id
                WHERE $filter
                GROUP BY p.id
                LIMIT 1", intval($id));
		$this->db->query($query);
		$product = $this->db->result();
		return $product;
	}

	public function update_product($id, $product)
	{    
		$query = $this->db->placehold("UPDATE __products SET ?% WHERE id in (?@) LIMIT ?", $product, (array)$id, count((array)$id));
		if($this->db->query($query))
			return $id;
		else
			return false;
	}
	
	public function add_product($product)
	{	
		$product = (array) $product;
        
		if(empty($product['url']))
		{
			$product['url'] = preg_replace("/[\s]+/ui", '_', $product['name']);
			$product['url'] = strtolower(preg_replace("/[^0-9a-zа-я_]+/ui", '', $product['url']));
		}

		if($this->db->query("INSERT INTO __products SET ?%", $product))
		{
			$id = $this->db->insert_id();
			$this->db->query("UPDATE __products SET position=id WHERE id=?", $id);		
			return $id;
		}
		else
			return false;
	}
	
	
	/*
	*
	* Удалить товар
	*
	*/	
	public function delete_product($id)
	{
		if(!empty($id))
		{
			// Удаляем варианты
			$variants = $this->variants->get_variants(array('product_id'=>$id));
			foreach($variants as $v)
				$this->variants->delete_variant($v->id);
			
			// Удаляем изображения
			$images = $this->get_images(array('product_id'=>$id));
			foreach($images as $i)
				$this->delete_image($i->id);
			
			// Удаляем категории
			$categories = $this->categories->get_categories(array('product_id'=>$id));
			foreach($categories as $c)
				$this->categories->delete_product_category($id, $c->id);

			// Удаляем свойства
			$options = $this->features->get_options(array('product_id'=>$id));
			foreach($options as $o)
				$this->features->delete_option($id, $o->feature_id);
			
			// Удаляем связанные товары
			$related = $this->get_related_products($id);
			foreach($related as $r)
				$this->delete_related_product($id, $r->related_id);
			
			// Удаляем отзывы
			$comments = $this->comments->get_comments(array('object_id'=>$id, 'type'=>'product'));
			foreach($comments as $c)
				$this->comments->delete_comment($c->id);
			
			// Удаляем из покупок
			$this->db->query('UPDATE __purchases SET product_id=NULL WHERE product_id=?', intval($id));
			
			// Удаляем товар
			$query = $this->db->placehold("DELETE FROM __products WHERE id=? LIMIT 1", intval($id));
			if($this->db->query($query))
				return true;			
		}
		return false;
	}	
	
	public function duplicate_product($id)
	{
    	$product = $this->get_product($id);
    	$product->id = null;
    	$product->created = null;

		// Сдвигаем товары вперед и вставляем копию на соседнюю позицию
    	$this->db->query('UPDATE __products SET position=position+1 WHERE position>?', $product->position);
    	$new_id = $this->products->add_product($product);
    	$this->db->query('UPDATE __products SET position=? WHERE id=?', $product->position+1, $new_id);
    	
    	// Очищаем url
    	$this->db->query('UPDATE __products SET url="" WHERE id=?', $new_id);
    	
		// Дублируем категории
		$categories = $this->categories->get_product_categories($id);
		foreach($categories as $c)
			$this->categories->add_product_category($new_id, $c->category_id);
    	
    	// Дублируем изображения
    	$images = $this->get_images(array('product_id'=>$id));
    	foreach($images as $image)
    		$this->add_image($new_id, $image->filename);
    		
    	// Дублируем варианты
    	$variants = $this->variants->get_variants(array('product_id'=>$id));
    	foreach($variants as $variant)
    	{
    		$variant->product_id = $new_id;
    		unset($variant->id);
    		if($variant->infinity)
    			$variant->stock = null;
    		unset($variant->infinity);
    		$this->variants->add_variant($variant);
    	}
    	
    	// Дублируем свойства
		$options = $this->features->get_options(array('product_id'=>$id));
		foreach($options as $o)
			$this->features->update_option($new_id, $o->feature_id, $o->value);
			
		// Дублируем связанные товары
		$related = $this->get_related_products($id);
		foreach($related as $r)
			$this->add_related_product($new_id, $r->related_id);
			
    		
    	return $new_id;
	}
	

	
	function get_related_products($product_id = array())
	{
		if(empty($product_id))
			return array();

		$product_id_filter = $this->db->placehold('AND product_id in(?@)', (array)$product_id);
				
		$query = $this->db->placehold("SELECT product_id, related_id, position
					FROM __related_products
					WHERE 
					1
					$product_id_filter   
					ORDER BY position       
					");
		
		$this->db->query($query);
		return $this->db->results();
	}

	function get_ax_products($product_id = array())
	{
		if(empty($product_id))
			return array();

		$product_id_filter = $this->db->placehold('AND product_id in(?@)', (array)$product_id);
				
		$query = $this->db->placehold("SELECT product_id, related_id, position
					FROM __axesuares
					WHERE 
					1
					$product_id_filter   
					ORDER BY position       
					");
		
		$this->db->query($query);
		return $this->db->results();
	}
	
	// Функция возвращает связанные товары
	public function add_related_product($product_id, $related_id, $position=0)
	{
		$query = $this->db->placehold("INSERT IGNORE INTO __related_products SET product_id=?, related_id=?, position=?", $product_id, $related_id, $position);
		$this->db->query($query);
		return $related_id;
	}
	
	// Удаление связанного товара
	public function delete_related_product($product_id, $related_id)
	{
		$query = $this->db->placehold("DELETE FROM __related_products WHERE product_id=? AND related_id=? LIMIT 1", intval($product_id), intval($related_id));
		$this->db->query($query);
	}

	public function add_ax_product($product_id, $related_id, $position=0)
	{
		$query = $this->db->placehold("INSERT IGNORE INTO __axesuares SET product_id=?, related_id=?, position=?", $product_id, $related_id, $position);
		$this->db->query($query);
		return $related_id;
	}
	
	// Удаление связанного товара
	public function delete_ax_product($product_id, $related_id)
	{
		$query = $this->db->placehold("DELETE FROM __axesuares WHERE product_id=? AND related_id=? LIMIT 1", intval($product_id), intval($related_id));
		$this->db->query($query);
	}	
	
	function get_images($filter = array())
	{		
		$product_id_filter = '';
		$group_by = '';

		if(!empty($filter['product_id']))
			$product_id_filter = $this->db->placehold('AND i.product_id in(?@)', (array)$filter['product_id']);

		// images
		$query = $this->db->placehold("SELECT i.id, i.product_id, i.name, i.filename, i.position
									FROM __images AS i WHERE 1 $product_id_filter $group_by ORDER BY i.product_id, i.position");
		$this->db->query($query);
		return $this->db->results();
	}
	
	public function add_image($product_id, $filename, $name = '')
	{
		$query = $this->db->placehold("SELECT id FROM __images WHERE product_id=? AND filename=?", $product_id, $filename);
		$this->db->query($query);
		$id = $this->db->result('id');
		if(empty($id))
		{
			$query = $this->db->placehold("INSERT INTO __images SET product_id=?, filename=?", $product_id, $filename);
			$this->db->query($query);
			$id = $this->db->insert_id();
			$query = $this->db->placehold("UPDATE __images SET position=id WHERE id=?", $id);
			$this->db->query($query);
		}
		return($id);
	}
	
	public function update_image($id, $image)
	{
	
		$query = $this->db->placehold("UPDATE __images SET ?% WHERE id=?", $image, $id);
		$this->db->query($query);
		
		return($id);
	}
	
	public function delete_image($id)
	{
		$query = $this->db->placehold("SELECT filename FROM __images WHERE id=?", $id);
		$this->db->query($query);
		$filename = $this->db->result('filename');
		$query = $this->db->placehold("DELETE FROM __images WHERE id=? LIMIT 1", $id);
		$this->db->query($query);
		$query = $this->db->placehold("SELECT count(*) as count FROM __images WHERE filename=? LIMIT 1", $filename);
		$this->db->query($query);
		$count = $this->db->result('count');
		if($count == 0)
		{			
			$file = pathinfo($filename, PATHINFO_FILENAME);
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			
			// Удалить все ресайзы
			$rezised_images = glob($this->config->root_dir.$this->config->resized_images_dir.$file."*.".$ext);
			if(is_array($rezised_images))
			foreach (glob($this->config->root_dir.$this->config->resized_images_dir.$file."*.".$ext) as $f)
				@unlink($f);

			@unlink($this->config->root_dir.$this->config->original_images_dir.$filename);		
		}
	}
		
	/*
	*
	* Следующий товар
	*
	*/	
	public function get_next_product($id)
	{
		$this->db->query("SELECT position FROM __products WHERE id=? LIMIT 1", $id);
		$position = $this->db->result('position');
		
		$this->db->query("SELECT pc.category_id FROM __products_categories pc WHERE product_id=? ORDER BY position LIMIT 1", $id);
		$category_id = $this->db->result('category_id');

		$query = $this->db->placehold("SELECT id FROM __products p, __products_categories pc
										WHERE pc.product_id=p.id AND p.position>? 
										AND pc.position=(SELECT MIN(pc2.position) FROM __products_categories pc2 WHERE pc.product_id=pc2.product_id)
										AND pc.category_id=? 
										AND p.visible ORDER BY p.position limit 1", $position, $category_id);
		$this->db->query($query);
 
		return $this->get_product((integer)$this->db->result('id'));
	}
	
	/*
	*
	* Предыдущий товар
	*
	*/	
	public function get_prev_product($id)
	{
		$this->db->query("SELECT position FROM __products WHERE id=? LIMIT 1", $id);
		$position = $this->db->result('position');
		
		$this->db->query("SELECT pc.category_id FROM __products_categories pc WHERE product_id=? ORDER BY position LIMIT 1", $id);
		$category_id = $this->db->result('category_id');

		$query = $this->db->placehold("SELECT id FROM __products p, __products_categories pc
										WHERE pc.product_id=p.id AND p.position<? 
										AND pc.position=(SELECT MIN(pc2.position) FROM __products_categories pc2 WHERE pc.product_id=pc2.product_id)
										AND pc.category_id=? 
										AND p.visible ORDER BY p.position DESC limit 1", $position, $category_id);
		$this->db->query($query);
 
		return $this->get_product((integer)$this->db->result('id'));	}
    
    public function youtube_tovar($id)
    {  $query = $this->db->placehold("SELECT youtube FROM __products WHERE id=?",$id);
       $this->db->query($query);
       return $this->db->result('youtube'); 
    }

    public function insert_ask($email,$text,$tovname,$name,$id)
    {       $date = date("Y-m-d H:i:s");       
            $query = $this->db->placehold("INSERT INTO __ask SET mail = ?, id_tovar = ?, msg = ? , name=? , product = ?, date = ?", $email, $id, $text, $name, $tovname, $date);
            if($this->db->query($query))
            {   $mail = "fxbyden@gmail.com";
                $headers = "From: Shopchik.com \n"; 
                $headers .= "To: \"".$email."\n";  
                $headers .= "MIME-Version: 1.0\n"; 
                $headers .= "Content-Type: text/HTML; charset=UTF-8\n";
                $text .= $date."\n ".$name."\n".$text;
                mail($mail, "Ответ:", $text, $headers);
                return true;
            }

    }
  
    //вывод всех вопросов списком
    public function asks_show()
    {
        $query = $this->db->placehold("SELECT a.id, a.id_tovar, a.date, a.msg, a.mail, a.name, a.product, a.status FROM __ask a ORDER BY a.id DESC");
        $this->db->query($query);
        return $this->db->results();
    }

    public function asks_shows()
    {
        $query = $this->db->placehold("SELECT COUNT(a.id) as col FROM __ask a WHERE a.status = '0'");
        $this->db->query($query);
        return $this->db->result();
    }
    
    public function show_ask($id)
    {
        $query = $this->db->placehold("SELECT a.id, a.id_tovar, a.date, a.msg, a.mail, a.name, a.product, a.otvet FROM __ask a WHERE id = ?", $id);
        $this->db->query($query);
        return $this->db->result();
    }
    
    public function delete_ask($id)
    {
        $query = $this->db->placehold("DELETE FROM __ask WHERE id=?",$id);
		if($this->db->query($query))
		return true;
    }
    
    public function update_ask($id,$otvet)
    { 
        $update = $this->db->placehold("UPDATE __ask SET status = ?, otvet = ? WHERE id = ? ",1, $otvet, $id);
        $this->db->query($update);
        return true;
    }
    
    public function send_ask($mail,$text)
    {   
        $headers = "From: Shopchik.com \n"; 
        $headers .= "To: \"".$mail."\n";  
        $headers .= "MIME-Version: 1.0\n"; 
        $headers .= "Content-Type: text/HTML; charset=UTF-8\n";
        $text .= "\n С Уважанием менеджер "." \n".$mails;
        mail($mail, "Ответ:", $text, $headers);
        return true;
    }
    
    public function get_futurs($product_id)
    { $query = $this->db->placehold("SELECT f.id as feature_id, f.name, po.value, po.product_id FROM __options po LEFT JOIN __features f ON f.id=po.feature_id
										WHERE po.product_id in(?@) AND f.id IN(154,197,53,60) ORDER BY f.position", (array)$product_id);
      $this->db->query($query);
      return $this->db->results(); 
    }
    
    public function get_count_cat_p($category)
    {  $query = $this->db->placehold("SELECT count(x.product_id) as coc FROM __products_categories x WHERE x.category_id =? GROUP BY x.category_id",$category);
       $this->db->query($query);
       return $this->db->result();   
    }
    
    public function add_accesuar($id, $name, $price)
    {
        $query = $this->db->placehold('INSERT INTO __prod_ac SET prod_id=?, name_ac=?, price=?', $id, $name, $price);
        $this->db->query($query);
        return true;
    }
    
    
    public function select_accall()
    {
        $query = $this->db->placehold("SELECT * FROM __prod_ac");
        $this->db->query($query);
        return $this->db->results();
    }
    
    public function select_accesuars($id)
    {
        $query = $this->db->placehold('SELECT * FROM __prod_ac a WHERE a.prod_id = ?', $id);
        $this->db->query($query);
        return $this->db->results();
    }
    
    public function update_accesuars($id)
    {
        $query = $this->placehold('UPDATE __prod_ac a () VALUES (?,?)');
        $this->db->query($query);
        return $id;
    }
    
    public function delete_accesuars($id)
    {
        $query = $this->db->placehold("DELETE FROM __prod_ac WHERE id = ?", $id);
        $this->db->query($query);
        return true;
    }		
}