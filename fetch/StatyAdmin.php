<?php

/**
 * Simpla CMS
 *
 * @copyright	2011 Denis Pikusov
 * @link		http://simplacms.ru
 * @author		Denis Pikusov
 *
 */
 
require_once('api/Simpla.php');

class StatyAdmin extends Simpla
{
	public function fetch()
	{
		// Обработка действий
		if($this->request->method('post'))
		{
			// Действия с выбранными
			$ids = $this->request->post('check');
			if(is_array($ids));
			switch($this->request->post('action'))
			{
			    case 'disable':
			    {
					$this->obzors->update_statya($ids, array('visible'=>0));	      
					break;
			    }
			    case 'enable':
			    {
					$this->obzors->update_statya($ids, array('visible'=>1));	      
			        break;
			    }
			    case 'delete':
			    {
				    foreach($ids as $id)
						$this->blog->delete_statya($id);    
			        break;
			    }
			}				
		}
        
		$filter = array();
		$filter['page'] = max(1, $this->request->get('page', 'integer')); 		
		$filter['limit'] = 20;
  	
		// Поиск
		$keyword = $this->request->get('keyword', 'string');
		if(!empty($keyword))
		{
			$filter['keyword'] = $keyword;
			$this->design->assign('keyword', $keyword);
		}		
        $staty = array();
        
		foreach($this->blog->get_staty($filter) as $ss)
		$staty[$ss->id] = $ss;
        
        $blogs_id = array_keys($staty);

		$staty_count = $this->blog->count_staty($filter);

        
        if(!empty($staty))
        {
        $blogs_id = array_keys($staty);                
        $images = $this->blog->get_images(array('blog_id'=>$blogs_id));
		foreach($images as $image)
		$staty[$image->blog_id]->images[] = $image;

			foreach($staty as &$stat)
			{
				if(isset($stat->images[0]))
					$stat->image = $stat->images[0];
			}
        }
		
		$this->design->assign('staty_count', $staty_count);
		
		$this->design->assign('pages_count', ceil($staty_count/$filter['limit']));
		$this->design->assign('current_page', $filter['page']);
		
		$this->design->assign('staty', $staty);
		return $this->design->fetch('staty.tpl');
	}
}
