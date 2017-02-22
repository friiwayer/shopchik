<?php
require_once('api/Simpla.php');

Class AskProduc extends Simpla {
    public function fetch()
    {
        if($this->request->method('post'))
        {
          $asks->username = $this->request->post('name');
          $asks->tovar_name = $this->request->post('tovar');
          $asks->idt = $this->request->post('id', 'integer'); 
          
          
        if($this->request->post('feedack'))
        {
        $asks->otvet1 = "<div style='border:1px solid #ccc; color: #181818; background-color:#ccc; border-radius:5px; padding:5px;'>".$this->request->post('msg')."</div>\r\n".$this->request->post('otvet');
          
          if($this->products->send_ask($this->request->post('mail'),$asks->otvet1))
          {
            $this->products->update_ask($asks->idt,$this->request->post('otvet'));
          }
        }
        }
        else
        {
          $asks->idt = $this->request->get('id', 'integer');
        }
        
        if($this->request->post('delete'))
        {
            $this->products->delete_ask($asks->idt);
        }
    $col = $this->products->asks_shows();
    $this->design->assign('col', $col);        
    $asks = $this->products->show_ask($asks->idt);
    $this->design->assign('asks', $asks);
    return $this->design->fetch('ask.tpl'); 
    }    
}