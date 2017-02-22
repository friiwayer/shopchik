<?PHP

/**
 * Simpla CMS
 *
 * @copyright 	2011 Denis Pikusov
 * @link 		http://simplacms.ru
 * @author 		Denis Pikusov
 *
 * Этот класс использует шаблоны blog.tpl и post.tpl
 *
 */

require_once('View.php');

class StatyView extends View
{
	public function fetch()
	{
		$url = $this->request->get('url', 'string');
		
		// Если указан адрес поста,
		if(!empty($url))
		{
			// Выводим пост
			return $this->fetch_statya($url);
		}
		else
		{
			// Иначе выводим ленту блога
			return $this->fetch_staty($url);
		}
	}
	
	private function fetch_statya($url)
	{
		// Выбираем пост из базы
		$staty = $this->blog->get_statya($url);
		
		// Если не найден - ошибка
		if(!$staty || (!$staty->visible && empty($_SESSION['admin'])))
			return false;
		
		// Автозаполнение имени для формы комментария
		if(!empty($this->user))
			$this->design->assign('comment_name', $this->user->name);

		
		// Принимаем комментарий
		if ($this->request->method('post') && $this->request->post('comment'))
		{
			$comment->name = $this->request->post('name');
			$comment->text = $this->request->post('text');
			$captcha_code =  $this->request->post('captcha_code', 'string');
			
			// Передадим комментарий обратно в шаблон - при ошибке нужно будет заполнить форму
			$this->design->assign('comment_text', $comment->text);
			$this->design->assign('comment_name', $comment->name);
			
			// Проверяем капчу и заполнение формы
			if ($_SESSION['captcha_code'] != $captcha_code || empty($captcha_code))
			{
				$this->design->assign('error', 'captcha');
			}
			elseif (empty($comment->name))
			{
				$this->design->assign('error', 'empty_name');
			}
			elseif (empty($comment->text))
			{
				$this->design->assign('error', 'empty_comment');
			}
			else
			{
				// Создаем комментарий
				$comment->object_id = $staty->id;
				$comment->type      = 'staty';
				$comment->ip        = $_SERVER['REMOTE_ADDR'];
				
				// Если были одобренные комментарии от текущего ip, одобряем сразу
				$this->db->query("SELECT 1 FROM __comments WHERE approved=1 AND ip=? LIMIT 1", $comment->ip);
				if($this->db->num_rows()>0)
					$comment->approved = 1;
				
				// Добавляем комментарий в базу
				$comment_id = $this->comments->add_comment($comment);
				
				// Отправляем email
				$this->notify->email_comment_admin($comment_id);				
				
				// Приберем сохраненную капчу, иначе можно отключить загрузку рисунков и постить старую
				unset($_SESSION['captcha_code']);
				header('location: '.$_SERVER['REQUEST_URI'].'#comment_'.$comment_id);
			}			
		}
		
		// Комментарии к посту
		$comments = $this->comments->get_comments(array('type'=>'staty', 'object_id'=>$staty->id, 'approved'=>1, 'ip'=>$_SERVER['REMOTE_ADDR']));
		$this->design->assign('comments', $comments);
		$this->design->assign('staty',      $staty);
		
		// Соседние записи
		$this->design->assign('next_stat', $this->blog->get_next_statya($staty->id));
		$this->design->assign('prev_stat', $this->blog->get_prev_statya($staty->id));
                
		// Мета-теги
		$this->design->assign('meta_title', $staty->meta_title);
		$this->design->assign('meta_keywords', $staty->meta_keywords);
		$this->design->assign('meta_description', $staty->meta_description);
		
		return $this->design->fetch('statya.tpl');
	}	
	
	// Отображение списка постов
	private function fetch_staty()
	{
		// Количество постов на 1 странице
		$items_per_page = 8;
		$filter = array();
		
		// Выбираем только видимые посты
		$filter['visible'] = 1;
		
		// Текущая страница в постраничном выводе
		$current_page = $this->request->get('page', 'integer');
		
		// Если не задана, то равна 1
		$current_page = max(1, $current_page);
		$this->design->assign('current_page_num', $current_page);

		// Вычисляем количество страниц
		$count_staty = $this->blog->count_staty($filter);
		$pages_num = ceil($count_staty/$items_per_page);
		$this->design->assign('total_pages_num', $pages_num);

		$filter['page'] = $current_page;
		$filter['limit'] = $items_per_page;
		
		// Выбираем статьи из базы
        $staty = array();
        
		foreach($this->blog->get_staty($filter) as $ss)
		$staty[$ss->id] = $ss;
                
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
        		
		// Передаем в шаблон
		$this->design->assign('staty', $staty);
		
		// Метатеги
		if($this->page)
		{
			$this->design->assign('meta_title', $this->page->meta_title);
			$this->design->assign('meta_keywords', $this->page->meta_keywords);
			$this->design->assign('meta_description', $this->page->meta_description);
		}
		
		$body = $this->design->fetch('staty.tpl');
		
		return $body;
	}	
}