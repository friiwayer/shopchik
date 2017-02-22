<?php

/**
 * Simpla CMS
 *
 * @copyright	2011 Denis Pikusov
 * @link		http://simplacms.ru
 * @author		Denis Pikusov
 *
 */
 
require_once('Simpla.php');

class Features extends Simpla
{	
	
	function get_features($filter = array())
	{
		$category_id_filter = '';	
		if(isset($filter['category_id']))
			$category_id_filter = $this->db->placehold('AND id in(SELECT feature_id FROM __categories_features AS cf WHERE cf.category_id in(?@))', (array)$filter['category_id']);
		
		$in_filter_filter = '';	
		if(isset($filter['in_filter']))
			$in_filter_filter = $this->db->placehold('AND f.in_filter=?', intval($filter['in_filter']));
		
		$id_filter = '';	
		if(!empty($filter['id']))
			$id_filter = $this->db->placehold('AND f.id in(?@)', (array)$filter['id']);
		
        $prog_filter = $this->db->placehold('AND f.id in(1,2,3,4,5,6,7,8,13,22,27,28,29,149,166,150)');
        
		// Выбираем свойства
		$query = $this->db->placehold("SELECT id, name, position, in_filter FROM __features AS f
									WHERE 1
									$category_id_filter $in_filter_filter $id_filter ORDER BY f.position");
		$this->db->query($query);
		return $this->db->results();
	}


	function get_features_display($filter = array())
	{
		$category_id_filter = '';	
		if(isset($filter['category_id']))
			$category_id_filter = $this->db->placehold('AND id in(SELECT feature_id FROM __categories_features AS cf WHERE cf.category_id in(?@))', (array)$filter['category_id']);
		
		$in_filter_filter = '';	
		if(isset($filter['in_filter']))
			$in_filter_filter = $this->db->placehold('AND f.in_filter=?', intval($filter['in_filter']));
		
		$id_filter = '';	
		if(!empty($filter['id']))
			$id_filter = $this->db->placehold('AND f.id in(?@)', (array)$filter['id']);
		
        $prog_filter = $this->db->placehold('AND f.id in(9,10,11,12,13,181,186,177,181,152,153,202,204)');
        
		// Выбираем свойства
		$query = $this->db->placehold("SELECT id, name, position, in_filter FROM __features AS f
									WHERE 1
									$category_id_filter $in_filter_filter $id_filter $prog_filter ORDER BY f.position");
		$this->db->query($query);
		return $this->db->results();
	}

	function get_features_hard($filter = array())
	{
		$category_id_filter = '';	
		if(isset($filter['category_id']))
			$category_id_filter = $this->db->placehold('AND id in(SELECT feature_id FROM __categories_features AS cf WHERE cf.category_id in(?@))', (array)$filter['category_id']);
		
		$in_filter_filter = '';	
		if(isset($filter['in_filter']))
			$in_filter_filter = $this->db->placehold('AND f.in_filter=?', intval($filter['in_filter']));
		
		$id_filter = '';	
		if(!empty($filter['id']))
			$id_filter = $this->db->placehold('AND f.id in(?@)', (array)$filter['id']);
		
        $prog_filter = $this->db->placehold('AND f.id in(15,16,25,32,34,35,36,37,50,53,60,72,154,156,160,163,176,185,182,174,169,155,203)');
        
		// Выбираем свойства
		$query = $this->db->placehold("SELECT id, name, position, in_filter FROM __features AS f
									WHERE 1
									$category_id_filter $in_filter_filter $id_filter $prog_filter ORDER BY f.position");
		$this->db->query($query);
		return $this->db->results();
	}


	function get_features_multi($filter = array())
	{
		$category_id_filter = '';	
		if(isset($filter['category_id']))
			$category_id_filter = $this->db->placehold('AND id in(SELECT feature_id FROM __categories_features AS cf WHERE cf.category_id in(?@))', (array)$filter['category_id']);
		
		$in_filter_filter = '';	
		if(isset($filter['in_filter']))
			$in_filter_filter = $this->db->placehold('AND f.in_filter=?', intval($filter['in_filter']));
		
		$id_filter = '';	
		if(!empty($filter['id']))
			$id_filter = $this->db->placehold('AND f.id in(?@)', (array)$filter['id']);
		
        $prog_filter = $this->db->placehold('AND f.id in(20,22,23,30,33,40,46,188,125,126,159,161,162,167,168,175,179,180,195)');
        
		// Выбираем свойства
		$query = $this->db->placehold("SELECT id, name, position, in_filter FROM __features AS f
									WHERE 1
									$category_id_filter $in_filter_filter $id_filter $prog_filter ORDER BY f.position");
		$this->db->query($query);
		return $this->db->results();
	}

	function get_features_compl($filter = array())
	{
		$category_id_filter = '';	
		if(isset($filter['category_id']))
			$category_id_filter = $this->db->placehold('AND id in(SELECT feature_id FROM __categories_features AS cf WHERE cf.category_id in(?@))', (array)$filter['category_id']);
		
		$in_filter_filter = '';	
		if(isset($filter['in_filter']))
			$in_filter_filter = $this->db->placehold('AND f.in_filter=?', intval($filter['in_filter']));
		
		$id_filter = '';	
		if(!empty($filter['id']))
			$id_filter = $this->db->placehold('AND f.id in(?@)', (array)$filter['id']);
		
        $prog_filter = $this->db->placehold('AND f.id in(189,44,193)');
        
		// Выбираем свойства
		$query = $this->db->placehold("SELECT id, name, position, in_filter FROM __features AS f
									WHERE 1
									$category_id_filter $in_filter_filter $id_filter $prog_filter ORDER BY f.position");
		$this->db->query($query);
		return $this->db->results();
	}
		
	function get_feature($id)
	{
		// Выбираем свойство
		$query = $this->db->placehold("SELECT id, name, position, in_filter FROM __features WHERE id=? LIMIT 1", $id);
		$this->db->query($query);
		$feature = $this->db->result();

		return $feature;
	}
	
	function get_feature_categories($id)
	{
		$query = $this->db->placehold("SELECT cf.category_id as category_id FROM __categories_features cf
										WHERE cf.feature_id = ?", $id);
		$this->db->query($query);
		return $this->db->results('category_id');	
	}
	
	public function add_feature($feature)
	{
		$query = $this->db->placehold("INSERT INTO __features SET ?%", $feature);
		$this->db->query($query);
		$id = $this->db->insert_id();
		$query = $this->db->placehold("UPDATE __features SET position=id WHERE id=? LIMIT 1", $id);
		$this->db->query($query);
		return $id;
	}
		
	public function update_feature($id, $feature)
	{
		$query = $this->db->placehold("UPDATE __features SET ?% WHERE id in(?@) LIMIT ?", (array)$feature, (array)$id, count((array)$id));
		$this->db->query($query);
		return $id;
	}
	
	public function delete_feature($id = array())
	{
		if(!empty($id))
		{
			$query = $this->db->placehold("DELETE FROM __features WHERE id=? LIMIT 1", intval($id));
			$this->db->query($query);
			$query = $this->db->placehold("DELETE FROM __options WHERE feature_id=?", intval($id));
			$this->db->query($query);	
			$query = $this->db->placehold("DELETE FROM __categories_features WHERE feature_id=?", intval($id));
			$this->db->query($query);	
		}
	}
	

	public function delete_option($product_id, $feature_id)
	{
		$query = $this->db->placehold("DELETE FROM __options WHERE product_id=? AND feature_id=? LIMIT 1", intval($product_id), intval($feature_id));
		$this->db->query($query);
	}

	
	public function update_option($product_id, $feature_id, $value)
	{	 
		if($value != '')
			$query = $this->db->placehold("REPLACE INTO __options SET value=?, product_id=?, feature_id=?", $value, intval($product_id), intval($feature_id));
		else
			$query = $this->db->placehold("DELETE FROM __options WHERE feature_id=? AND product_id=?", intval($feature_id), intval($product_id));
		return $this->db->query($query);
	}


	public function add_feature_category($id, $category_id)
	{
		$query = $this->db->placehold("INSERT IGNORE INTO __categories_features SET feature_id=?, category_id=?", $id, $category_id);
		$this->db->query($query);
	}
			
	public function update_feature_categories($id, $categories)
	{
		$id = intval($id);
		$query = $this->db->placehold("DELETE FROM __categories_features WHERE feature_id=?", $id);
		$this->db->query($query);
		
		
		if(is_array($categories))
		{
			$values = array();
			foreach($categories as $category)
				$values[] = "($id , ".intval($category).")";
	
			$query = $this->db->placehold("INSERT INTO __categories_features (feature_id, category_id) VALUES ".implode(', ', $values));
			$this->db->query($query);

			// Удалим значения из options 
			$query = $this->db->placehold("DELETE o FROM __options o
			                               LEFT JOIN __products_categories pc ON pc.product_id=o.product_id
			                               WHERE o.feature_id=? AND pc.category_id not in(?@)", $id, $categories);
			$this->db->query($query);
		}
		else
		{
			// Удалим значения из options 
			$query = $this->db->placehold("DELETE o FROM __options o WHERE o.feature_id=?", $id);
			$this->db->query($query);
		}
	}
			

	public function get_options($filter = array())
	{
		$feature_id_filter = '';
		$product_id_filter = '';
		$category_id_filter = '';
		$visible_filter = '';
		$brand_id_filter = '';
		$features_filter = '';

		if(empty($filter['feature_id']) && empty($filter['product_id']))
			return array();
		
		$group_by = '';
		if(isset($filter['feature_id']))
			$group_by = 'GROUP BY feature_id, value';
			
		if(isset($filter['feature_id']))
			$feature_id_filter = $this->db->placehold('AND po.feature_id in(?@)', (array)$filter['feature_id']);

		if(isset($filter['product_id']))
			$product_id_filter = $this->db->placehold('AND po.product_id in(?@)', (array)$filter['product_id']);

		if(isset($filter['category_id']))
			$category_id_filter = $this->db->placehold('INNER JOIN __products_categories pc ON pc.product_id=po.product_id AND pc.category_id in(?@)', (array)$filter['category_id']);

		if(isset($filter['visible']))
			$visible_filter = $this->db->placehold('INNER JOIN __products p ON p.id=po.product_id AND visible=?', intval($filter['visible']));

		if(isset($filter['brand_id']))
			$brand_id_filter = $this->db->placehold('AND po.product_id in(SELECT id FROM __products WHERE brand_id in(?@))', (array)$filter['brand_id']);

		if(isset($filter['features']))
			foreach($filter['features'] as $feature=>$value)
			{
				$features_filter .= $this->db->placehold('AND (po.feature_id=? OR po.product_id in (SELECT product_id FROM __options WHERE feature_id=? AND value=? )) ', $feature, $feature, $value);
			}
		

		$query = $this->db->placehold("SELECT po.product_id, po.feature_id, po.value, po.tvalue, count(po.product_id) as count
		    FROM __options po
		    $visible_filter
			$category_id_filter
			WHERE 1 $feature_id_filter $product_id_filter $brand_id_filter $features_filter GROUP BY po.feature_id, po.value ORDER BY value=0, -value DESC, value");

		$this->db->query($query);
		$res = $this->db->results();

		return $res;
	}
	
	public function get_product_options($product_id)
	{	$query = $this->db->placehold("SELECT f.id as feature_id, f.name, po.value, po.product_id FROM __options po LEFT JOIN __features f ON f.id=po.feature_id
										WHERE po.product_id in(?@) ORDER BY f.position", (array)$product_id);
        //AND f.id in(1,2,3,4,5,6,7,8,13,22,27,28,29,149,166,150,151)
		$this->db->query($query);
		$res = $this->db->results();

		return $res;
	}

	public function get_product_optionz($product_id)
	{	$query = $this->db->placehold("SELECT f.id as feature_id, f.name, po.value, po.product_id FROM __options po LEFT JOIN __features f ON f.id=po.feature_id
										WHERE po.product_id in(?@) AND f.id in(1,2,3,4,5,6,7,8,22,36,37,62,66,149,166,150,198,199,200,201) ORDER BY f.position", (array)$product_id);
        //AND f.id in(1,2,3,4,5,6,7,8,13,22,27,28,29,149,166,150,151)
		$this->db->query($query);
		$res = $this->db->results();

		return $res;
	}    

	public function get_product_hard($product_id)
	{	$query = $this->db->placehold("SELECT f.id as feature_id, f.name, po.value, po.product_id FROM __options po LEFT JOIN __features f ON f.id=po.feature_id
										WHERE po.product_id in(?@) AND f.id IN(15,24,26,32,40,50,53,60,72,74,121,154,160,163,164,174,176,178,182,185,188,195,196,197,203,206,208) ORDER BY f.position", (array)$product_id);

		$this->db->query($query);
		$res = $this->db->results();

		return $res;
	}


	public function get_product_slider($product_id=array())
	{	$query = $this->db->placehold("SELECT f.id as feature_id, f.name, po.value, po.product_id FROM __options po LEFT JOIN __features f ON f.id=po.feature_id
										WHERE po.product_id in(?@) AND f.id IN(32,50,53,60,74,154,163,176,185) ORDER BY f.position LIMIT 28", (array)$product_id['product_id']);

		$this->db->query($query);
		$res = $this->db->results();
		return $res;
	}
	public function get_product_displ($product_id)
	{	$query = $this->db->placehold("SELECT f.id as feature_id, f.name, po.value, po.product_id FROM __options po LEFT JOIN __features f ON f.id=po.feature_id
										WHERE po.product_id in(?@) AND f.id IN(9,10,11,13,48,181,177,186,153,202,204,205,207) ORDER BY f.position", (array)$product_id);

		$this->db->query($query);
		$res = $this->db->results();

		return $res;
	}

	public function get_product_compl($product_id)
	{	$query = $this->db->placehold("SELECT f.id as feature_id, f.name, po.value, po.product_id FROM __options po LEFT JOIN __features f ON f.id=po.feature_id
										WHERE po.product_id in(?@) AND f.id IN(189) ORDER BY f.position", (array)$product_id);

		$this->db->query($query);
		$res = $this->db->results();

		return $res;
	}

	public function get_product_mult($product_id)
	{	$query = $this->db->placehold("SELECT f.id as feature_id, f.name, po.value, po.product_id FROM __options po LEFT JOIN __features f ON f.id=po.feature_id
										WHERE po.product_id in(?@) AND f.id IN(14,19,20,21,22,23,33,159,188,161,162,167,168,175,179,180) ORDER BY f.position", (array)$product_id);

		$this->db->query($query);
		$res = $this->db->results();

		return $res;
	}

	public function get_product_net($product_id)
	{	$query = $this->db->placehold("SELECT f.id as feature_id, f.name, po.value, po.product_id FROM __options po LEFT JOIN __features f ON f.id=po.feature_id
										WHERE po.product_id in(?@) AND f.id IN(27,28,29,30,31,151,169,172) ORDER BY f.position", (array)$product_id);

		$this->db->query($query);
		$res = $this->db->results();

		return $res;
	}                                     
}
