<?PHP

require_once('api/Simpla.php');

class PostStAdmin extends Simpla
{
	public function fetch()
	{
		if($this->request->method('post'))
		{
			$staty->id = $this->request->post('id', 'integer');
			$staty->name = $this->request->post('name');
			$staty->date = date('Y-m-d', strtotime($this->request->post('date')));
			
			$staty->visible = $this->request->post('visible', 'boolean');

			$staty->url = $this->request->post('url', 'string');
			$staty->meta_title = $this->request->post('meta_title');
			$staty->meta_keywords = $this->request->post('meta_keywords');
			$staty->meta_description = $this->request->post('meta_description');
            
			$staty->annotation = $this->request->post('annotation');
			$staty->text = $this->request->post('body');
            
            $blog->id = $this->request->post('id', 'integer');
            
			if(empty($staty->name))
			{	
			    $this->design->assign('message_error', 'empty_name');		
				$images = $this->blog->get_images(array('blog_id'=>$staty->id));
			}
            elseif(($a = $this->blog->get_statya($staty->url)) && $a->id!=$staty->id)
			{			
				$this->design->assign('message_error', 'url_exists');
                $images = $this->blog->get_images(array('blog_id'=>$staty->id));
                
			}else{

				if(empty($staty->id))
				{
	  				$staty->id = $this->blog->add_statya($staty);
	  				$staty = $this->blog->get_statya($staty->id);
					$this->design->assign('message_success', 'added');
	  			}
  	    		else
  	    		{
  	    			$this->blog->update_statya($staty->id, $staty);
  	    			$staty = $this->blog->get_statya($staty->id);
					$this->design->assign('message_success', 'updated');
  	    		}
                
                if($staty->id)
                {
					// Удаление изображений
					$images = (array)$this->request->post('images');
					$current_images = $this->blog->get_images(array('blog_id'=>$staty->id));
					foreach($current_images as $image)
					{
						if(!in_array($image->id, $images))
	 						$this->blog->delete_image($image->id);
					}
	
					// Порядок изображений
					if($images = $this->request->post('images'))
					{
	 					$i=0;
						foreach($images as $id)
						{
							$this->blog->update_image($id, array('position'=>$i));
							$i++;
						}
					}
	   	    		// Загрузка изображений
		  		    if($images = $this->request->files('images'))
		  		    {
						for($i=0; $i<count($images['name']); $i++)
						{
				 			if ($image_name = $this->image->upload_image($images['tmp_name'][$i], $images['name'][$i]))
				 			{
			  	   				$this->blog->add_image($staty->id, $image_name);
			  	   			}
							else
							{
								$this->design->assign('error', 'error uploading image');
							}
						}
					}
	   	    		// Загрузка изображений из интернета
		  		    if($images = $this->request->post('images_urls'))
		  		    {
						foreach($images as $url)
						{
							if(!empty($url) && $url != 'http://')
					 			$this->blog->add_image($staty->id, $url);
						}
					}
					$images = $this->blog->get_images(array('blog_id'=>$staty->id));

        }    
        }            
		}
		else
		{		  
			$staty->id = $this->request->get('id', 'integer');
			$staty = $this->blog->get_statya(intval($staty->id));
            if($staty && $staty->id)
            {
            $images = $this->blog->get_images(array('blog_id'=>$staty->id));
            }
            
            $this->design->assign('blog_img', $images);
		}
		if(empty($staty->date))
			$staty->date = date($this->settings->date_format, time());
        $this->design->assign('blog_img', $images); 		
		$this->design->assign('staty', $staty);				
 	  	return $this->design->fetch('statya.tpl');
	}
}