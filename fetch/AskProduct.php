<?php
require_once('api/Simpla.php');

Class AskProduct extends Simpla{
    
    public function fetch()
    {  	if($this->request->method('post'))
		{
        $ids = $this->request->post('check');
        if(is_array($ids))
        switch($this->request->post('action'))
        {
        case 'delete':
        {
        foreach($ids as $id)
        $this->products->delete_ask($id);    
        break;
        }
        }
    }   
        
        $asks = $this->products->asks_show();
        $col = $this->products->asks_shows();
        $this->design->assign('col', $col);
        $this->design->assign('asks', $asks);
		return $this->design->fetch('asks.tpl');  
    }
}