<?PHP

require_once('api/Simpla.php');

class ShowE extends Simpla
{
	function fetch()
	{
    if($this->request->method('post'))
		{
        $ids = $this->request->post('check');
        if(is_array($ids))
        switch($this->request->post('action'))
        {
        case 'delete':
        {
        foreach($ids as $id)
        $this->blog->del_er($id);    
        break;
        }
        }
        }
        $col = $this->blog->col_sabjs();
        $this->design->assign('erc', $col); 
        $er = $this->blog->select_sabjs();
        $this->design->assign('rerrors', $er);
		return $this->body = $this->design->fetch('errorz.tpl');        	   
    }
    
}