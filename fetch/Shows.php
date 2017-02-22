<?php
require_once('api/Simpla.php');

Class Shows extends Simpla {
    public function fetch()
    {
        if($this->request->method('post'))
        {
          $erz->id = $this->request->post('id', 'integer'); 
          
          
        if($this->request->post('err'))
        {
        $erz->otvet1 = "<div style='border:1px solid #ccc; color: #181818; background-color:#ccc; border-radius:5px; padding:5px;'>"
        .$this->request->post('msgg')."</div>\r\n".$this->request->post('otvet');
          if($this->products->send_ask($this->request->post('mail'),$erz->otvet1))
          {
            $this->blog->update_sabj($erz->id,$this->request->post('otvet'));
          }
        }
        }
        else
        {
          $erz->id = $this->request->get('id', 'integer');
        }
        
        if($this->request->post('delete'))
        {
            $this->blog->del_er($er->id);
        }
    $erc = $this->blog->col_sabjs();
    $this->design->assign('erc', $erc);       
    $erz = $this->blog->select_sabj($erz->id);
    $this->design->assign('er', $erz);
    return $this->design->fetch('ers.tpl'); 
    }    
}