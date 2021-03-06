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

class Blog extends Simpla
{

	/*
	*
	* Функция возвращает пост по его id или url
	* (в зависимости от типа аргумента, int - id, string - url)
	* @param $id id или url поста
	*
	*/
	public function get_post($id)
	{
		if(is_int($id))
			$where = $this->db->placehold(' WHERE b.id=? ', intval($id));
		elseif($id == 'max')
			{$where = $this->db->placehold(' WHERE b.id = (SELECT MAX(m.id) FROM __blog m WHERE m.visible=1)');}            
		else
			$where = $this->db->placehold(' WHERE b.url=? ', $id);
		
		$query = $this->db->placehold("SELECT b.id, b.url, b.name, b.annotation, b.text, b.meta_title,
		                               b.meta_keywords, b.meta_description, b.visible, b.date
		                               FROM __blog b $where LIMIT 1");
		if($this->db->query($query))
			return $this->db->result();
		else
			return false; 
	}
	
	/*
	*
	* Функция возвращает массив постов, удовлетворяющих фильтру
	* @param $filter
	*
	*/
	public function get_posts($filter = array())
	{	
		// По умолчанию
		$limit = 1000;
		$page = 1;
		$post_id_filter = '';
		$visible_filter = '';
		$keyword_filter = '';
		$posts = array();
		
		if(isset($filter['limit']))
			$limit = max(1, intval($filter['limit']));

		if(isset($filter['page']))
			$page = max(1, intval($filter['page']));

		if(!empty($filter['id']))
			$post_id_filter = $this->db->placehold('AND b.id in(?@)', (array)$filter['id']);
			
		if(isset($filter['visible']))
			$visible_filter = $this->db->placehold('AND b.visible = ?', intval($filter['visible']));		
		
		if(isset($filter['keyword']))
		{
			$keywords = explode(' ', $filter['keyword']);
			foreach($keywords as $keyword)
				$keyword_filter .= $this->db->placehold('AND (b.name LIKE "%'.mysql_real_escape_string(trim($keyword)).'%" OR b.meta_keywords LIKE "%'.mysql_real_escape_string(trim($keyword)).'%") ');
		}

		$sql_limit = $this->db->placehold(' LIMIT ?, ? ', ($page-1)*$limit, $limit);

		$query = $this->db->placehold("SELECT b.id, b.url, b.name, b.annotation, b.text,
		                                      b.meta_title, b.meta_keywords, b.meta_description, b.visible,
		                                      b.date
		                                      FROM __blog b WHERE 1 $post_id_filter $visible_filter $keyword_filter
		                                      ORDER BY date DESC, id DESC $sql_limit");
		
		$this->db->query($query);
		return $this->db->results();
	}
	
	
	/*
	*
	* Функция вычисляет количество постов, удовлетворяющих фильтру
	* @param $filter
	*
	*/
	public function count_posts($filter = array())
	{	
		$post_id_filter = '';
		$visible_filter = '';
		$keyword_filter = '';
		
		if(!empty($filter['id']))
			$post_id_filter = $this->db->placehold('AND b.id in(?@)', (array)$filter['id']);
			
		if(isset($filter['visible']))
			$visible_filter = $this->db->placehold('AND b.visible = ?', intval($filter['visible']));		

		if(isset($filter['keyword']))
		{
			$keywords = explode(' ', $filter['keyword']);
			foreach($keywords as $keyword)
				$keyword_filter .= $this->db->placehold('AND (b.name LIKE "%'.mysql_real_escape_string(trim($keyword)).'%" OR b.meta_keywords LIKE "%'.mysql_real_escape_string(trim($keyword)).'%") ');
		}
		
		$query = "SELECT COUNT(distinct b.id) as count
		          FROM __blog b WHERE 1 $post_id_filter $visible_filter $keyword_filter";

		if($this->db->query($query))
			return $this->db->result('count');
		else
			return false;
	}
	
	/*
	*
	* Создание поста
	* @param $post
	*
	*/	
	public function add_post($post)
	{	
		if(isset($post->date))
		{
			$date = $post->date;
			unset($post->date);
			$date_query = $this->db->placehold(', date=STR_TO_DATE(?, ?)', $date, $this->settings->date_format);
		}
		$query = $this->db->placehold("INSERT INTO __blog SET ?% $date_query", $post);
		
		if(!$this->db->query($query))
			return false;
		else
			return $this->db->insert_id();
	}
	
	
	/*
	*
	* Обновить пост(ы)
	* @param $post
	*
	*/	
	public function update_post($id, $post)
	{
		$query = $this->db->placehold("UPDATE __blog SET ?% WHERE id in(?@) LIMIT ?", $post, (array)$id, count((array)$id));
		$this->db->query($query);
		return $id;
	}


	/*
	*
	* Удалить пост
	* @param $id
	*
	*/	
	public function delete_post($id)
	{
		if(!empty($id))
		{
			$query = $this->db->placehold("DELETE FROM __blog WHERE id=? LIMIT 1", intval($id));
			if($this->db->query($query))
			{
				$query = $this->db->placehold("DELETE FROM __comments WHERE type='blog' AND object_id=? LIMIT 1", intval($id));
				if($this->db->query($query))
					return true;
			}
							
		}
		return false;
	}	
	

	/*
	*
	* Следующий пост
	* @param $post
	*
	*/	
	public function get_next_post($id)
	{
		$this->db->query("SELECT date FROM __blog WHERE id=? LIMIT 1", $id);
		$date = $this->db->result('date');

		$this->db->query("(SELECT id FROM __blog WHERE date=? AND id>? AND visible  ORDER BY id limit 1)
		                   UNION
		                  (SELECT id FROM __blog WHERE date>? AND visible ORDER BY date, id limit 1)",
		                  $date, $id, $date);
		$next_id = $this->db->result('id');
		if($next_id)
			return $this->get_post(intval($next_id));
		else
			return false; 
	}
	
	/*
	*
	* Предыдущий пост
	* @param $post
	*
	*/	
	public function get_prev_post($id)
	{
		$this->db->query("SELECT date FROM __blog WHERE id=? LIMIT 1", $id);
		$date = $this->db->result('date');

		$this->db->query("(SELECT id FROM __blog WHERE date=? AND id<? AND visible ORDER BY id DESC limit 1)
		                   UNION
		                  (SELECT id FROM __blog WHERE date<? AND visible ORDER BY date DESC, id DESC limit 1)",
		                  $date, $id, $date);
		$prev_id = $this->db->result('id');
		if($prev_id)
			return $this->get_post(intval($prev_id));
		else
			return false; 
	}
    	public function get_statya($id)
	{
		if(is_int($id))
			{$where = $this->db->placehold(' WHERE b.id=? ', intval($id));}
		elseif($id == 'max')
			{$where = $this->db->placehold(' WHERE b.id = (SELECT MAX(m.id) FROM __staty m WHERE m.visible=1)');}
        else            
		    {$where = $this->db->placehold(' WHERE b.url=? ', $id);}
              
		$query = $this->db->placehold("SELECT b.id, b.url, b.name, b.image, b.annotation, b.text, b.meta_title,
		                               b.meta_keywords, b.meta_description, b.visible, b.date
		                               FROM __staty b $where LIMIT 1");
		if($this->db->query($query))
			return $this->db->result();
		else
			return false; 
	}
	
	/*
	*
	* Функция возвращает массив постов, удовлетворяющих фильтру
	* @param $filter
	*
	*/
	public function get_staty($filter = array())
	{	
		// По умолчанию
		$limit = 1000;
		$page = 1;
		$post_id_filter = '';
		$visible_filter = '';
		$keyword_filter = '';
		$posts = array();
		
		if(isset($filter['limit']))
			$limit = max(1, intval($filter['limit']));

		if(isset($filter['page']))
			$page = max(1, intval($filter['page']));

		if(!empty($filter['id']))
			$post_id_filter = $this->db->placehold('AND b.id in(?@)', (array)$filter['id']);
			
		if(isset($filter['visible']))
			$visible_filter = $this->db->placehold('AND b.visible = ?', intval($filter['visible']));		
		
		if(isset($filter['keyword']))
		{
			$keywords = explode(' ', $filter['keyword']);
			foreach($keywords as $keyword)
				$keyword_filter .= $this->db->placehold('AND (b.name LIKE "%'.mysql_real_escape_string(trim($keyword)).'%" OR b.meta_keywords LIKE "%'.mysql_real_escape_string(trim($keyword)).'%") ');
		}

		$sql_limit = $this->db->placehold(' LIMIT ?, ? ', ($page-1)*$limit, $limit);

		$query = $this->db->placehold("SELECT b.id, b.url, b.image, b.name, b.annotation, b.text,
		                                      b.meta_title, b.meta_keywords, b.meta_description, b.visible,
		                                      b.date
		                                      FROM __staty b WHERE 1 $post_id_filter $visible_filter $keyword_filter
		                                      ORDER BY date DESC, id DESC $sql_limit");
		
		$this->db->query($query);
		return $this->db->results();
	}
	
	
	/*
	*
	* Функция вычисляет количество постов, удовлетворяющих фильтру
	* @param $filter
	*
	*/
	public function count_staty($filter = array())
	{	
		$post_id_filter = '';
		$visible_filter = '';
		$keyword_filter = '';
		
		if(!empty($filter['id']))
			$post_id_filter = $this->db->placehold('AND b.id in(?@)', (array)$filter['id']);
			
		if(isset($filter['visible']))
			$visible_filter = $this->db->placehold('AND b.visible = ?', intval($filter['visible']));		

		if(isset($filter['keyword']))
		{
			$keywords = explode(' ', $filter['keyword']);
			foreach($keywords as $keyword)
				$keyword_filter .= $this->db->placehold('AND (b.name LIKE "%'.mysql_real_escape_string(trim($keyword)).'%" OR b.meta_keywords LIKE "%'.mysql_real_escape_string(trim($keyword)).'%") ');
		}
		
		$query = "SELECT COUNT(distinct b.id) as count
		          FROM __staty b WHERE 1 $post_id_filter $visible_filter $keyword_filter";

		if($this->db->query($query))
			return $this->db->result('count');
		else
			return false;
	}
	
	/*
	*
	* Создание поста
	* @param $post
	*
	*/	
	public function add_statya($post)
	{	
		if(isset($post->date))
		{
			$date = $post->date;
			unset($post->date);
			$date_query = $this->db->placehold(', date=STR_TO_DATE(?, ?)', $date, $this->settings->date_format);
		}
		$query = $this->db->placehold("INSERT INTO __staty SET ?% $date_query", $post);
		
		if(!$this->db->query($query))
			return false;
		else
			return $this->db->insert_id();
	}
	
	
	/*
	*
	* Обновить пост(ы)
	* @param $post
	*
	*/	
	public function update_statya($id, $post)
	{
		$query = $this->db->placehold("UPDATE __staty SET ?% WHERE id in(?@) LIMIT ?", $post, (array)$id, count((array)$id));
		$this->db->query($query);
		return $id;
	}


	/*
	*
	* Удалить пост
	* @param $id
	*
	*/	
	public function delete_statya($id)
	{
		if(!empty($id))
		{
			$query = $this->db->placehold("DELETE FROM __staty WHERE id=? LIMIT 1", intval($id));
			if($this->db->query($query))
			{
				$query = $this->db->placehold("DELETE FROM __comments WHERE type='staty' AND object_id=? LIMIT 1", intval($id));
				if($this->db->query($query))
					return true;
			}
							
		}
		return false;
	}	
	

	/*
	*
	* Следующий пост
	* @param $post
	*
	*/	
	public function get_next_statya($id)
	{
		$this->db->query("SELECT date FROM __staty WHERE id=? LIMIT 1", $id);
		$date = $this->db->result('date');

		$this->db->query("(SELECT id FROM __staty WHERE date=? AND id>? AND visible  ORDER BY id limit 1)
		                   UNION
		                  (SELECT id FROM __staty WHERE date>? AND visible ORDER BY date, id limit 1)",
		                  $date, $id, $date);
		$next_id = $this->db->result('id');
		if($next_id)
			return $this->get_statya(intval($next_id));
		else
			return false; 
	}
	
	/*
	*
	* Предыдущий пост
	* @param $post
	*
	*/	
	public function get_prev_statya($id)
	{
		$this->db->query("SELECT date FROM __staty WHERE id=? LIMIT 1", $id);
		$date = $this->db->result('date');

		$this->db->query("(SELECT id FROM __staty WHERE date=? AND id<? AND visible ORDER BY id DESC limit 1)
		                   UNION
		                  (SELECT id FROM __staty WHERE date<? AND visible ORDER BY date DESC, id DESC limit 1)",
		                  $date, $id, $date);
		$prev_id = $this->db->result('id');
		if($prev_id)
			return $this->get_statya(intval($prev_id));
		else
			return false; 
	}

	function get_images($filter = array())
	{		
		$product_id_filter = '';
		$group_by = '';

		if(!empty($filter['blog_id']))
			$product_id_filter = $this->db->placehold('AND i.blog_id in(?@)', (array)$filter['blog_id']);

		// images
		$query = $this->db->placehold("SELECT i.id, i.blog_id, i.name, i.filename, i.position
									FROM __imgblog AS i WHERE 1 $product_id_filter $group_by ORDER BY i.blog_id, i.position");
		$this->db->query($query);
		return $this->db->results();
	}

	public function add_image($blog_id, $filename, $name = '')
	{
		$query = $this->db->placehold("SELECT id FROM __imgblog WHERE blog_id=? AND filename=?", $blog_id, $filename);
		$this->db->query($query);
		$id = $this->db->result('id');
		if(empty($id))
		{
			$query = $this->db->placehold("INSERT INTO __imgblog SET blog_id=?, filename=?", $blog_id, $filename);
			$this->db->query($query);
			$id = $this->db->insert_id();
			$query = $this->db->placehold("UPDATE __imgblog SET position=id WHERE id=?", $id);
			$this->db->query($query);
		}
		return($id);
	}
	
	public function update_image($id, $image)
	{
	
		$query = $this->db->placehold("UPDATE __imgblog SET ?% WHERE id=?", $image, $id);
		$this->db->query($query);
		
		return($id);
	}
	
	public function delete_imag($id)
	{
		$query = $this->db->placehold("SELECT filename FROM __imgblog WHERE id=?", $id);
		$this->db->query($query);
		$filename = $this->db->result('filename');
		$query = $this->db->placehold("DELETE FROM __imgblog WHERE id=? LIMIT 1", $id);
		$this->db->query($query);
		$query = $this->db->placehold("SELECT count(*) as count FROM __imgblog WHERE filename=? LIMIT 1", $filename);
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
    
    public function add_sabj($txt, $mail)
    {
        if(!empty($txt) || !empty($mail))
        {   
            $query = $this->db->placehold('INSERT INTO __error_report SET text=?, mail=?, date=?',$txt,$mail, date("Ymd"));
            $this->db->query($query);
        }
    }
    
    public function select_sabjs()
    {
        $query = $this->db->placehold('SELECT e.id, e.text, e.mail, e.date FROM __error_report e');
        $this->db->query($query);
        return $this->db->results();
    }
    
    public function select_sabj($id)
    {
        if(is_numeric($id))
        {
            $vybor = $this->db->placehold('SELECT e.id, e.text, e.mail, e.date, e.otvet FROM __error_report e WHERE e.id=?', $id);
            $this->db->query($vybor);
            return $this->db->result();
        }
    }
    
    public function update_sabj($id,$otvet)
    {
        $update = $this->db->placehold("UPDATE __error_report SET status = ?, otvet = ? WHERE id = ? ",1, $otvet, $id);
        $this->db->query($update);
        return true;        
    }    
    
    public function col_sabjs()
    {
        $qu = $this->db->placehold('SELECT COUNT(e.id) as ercol FROM __error_report e WHERE e.status = "0"');
        $this->db->query($qu);
        return $this->db->result();
    }
    
    public function del_er($id)
    {   if(intval($id))
        $query = $this->db->query('DELETE FROM __error_report WHERE id=?',$id);
    }        
}
