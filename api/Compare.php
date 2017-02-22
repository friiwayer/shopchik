<?php

/**
 * For Simpla CMS
 *
 * @link		http://forum.simplacms.ru/profile/1024/Wizard
 * @author		Wizard
 *
 */

require_once('Simpla.php');

class Compare extends Simpla
{

	/*
	*
	* Функция возвращает сравнениея
	*
	*/
	public function get_compare()
	{

		$compare->total = 0;

		// Берем из сессии список сравнений
		if(!empty($_SESSION['compare_cart']))
		{
            $product_ids = $this->request->get('product_id');
            $product_ids = explode('-',$product_ids);
            foreach($product_ids as $id)
              $session_items[$id] = $id;

			if($_products = $this->products->get_products(array('id'=>array_keys($session_items))))
			{

                foreach($_products as $p){
                  $products[$p->id] = $p;
                  $variants[$p->id] = array();
                }

                $products_ids = array_keys($products);

                $vrs = $this->variants->get_variants(array('product_id'=>$products_ids, 'in_stock'=>true));

                foreach($vrs as &$variant)
                {
                  //$vrsiant->price *= (100-$discount)/100;
                  $variants[$variant->product_id][] = $variant;
                }

			   //$images = $this->products->get_images(array('product_id'=>$products_ids));
			     //foreach($images as $image)
				   //$products[$image->product_id]->image = $image->filename;
                foreach($_products as $p)
                {
                $images = $this->products->get_images(array('product_id'=>$p->id));
                $products[$p->id]->image = $images[0]->filename;
                }
                    
                $feature =array();
                $prt = $this->features->get_product_options($products_ids);
                if($prt){
                foreach($prt as $p)
                  $ftr[$p->name]['items'][$p->product_id] = $p->value;

                foreach($ftr as $k => $v){
                  foreach($products as $p){

                    if(!empty($v['items'][$p->id])){
                      $feature[$k]['items'][$p->id] = $v['items'][$p->id];
                    }

                    else{
                      $feature[$k]['items'][$p->id] = ' - ';
                    }

                   }
                }

                foreach($feature as $key => $value){
                  $feature[$key] = $value;
                  if(count(array_unique($value['items']))>1)$feature[$key]['diff'] = '1';
                }
                }

				$compare->products = $products;
				$compare->variants = $variants;
                $compare->features = $feature;

				$compare->total = count($products);
			}
		}

		return $compare;
	}

	/*
	*
	* Функция возвращает статистику сравнениея
	*
	*/
	public function get_compare_informer()
	{

		$compare->total = 0;

		// Берем из сессии список сравнений
		if(!empty($_SESSION['compare_cart']))
		{

				$compare->items_id = $_SESSION['compare_cart'];
				$compare->total = count($compare->items_id);

        }

    return $compare;

    }

	/*
	*
	* Добавление товара в к сравнению
	*
	*/
	public function add_item($compare_id)
	{

		// Выберем товар из базы, заодно убедившись в его существовании
		$product = $this->products->get_product($compare_id);

    	// Если товар существует, добавим его в корзину
		if(!empty($product)){

          // если количество товаров превышает допустимое количество (по умолчанию 5) то удаляем первый в цепочке
          if(isset($_SESSION['compare_cart']))
		  {
		      if(count($_SESSION['compare_cart'])>5){
			 //$shift = array_shift($_SESSION['compare_cart']);
             //foreach ($shift as $k => $v)
             //  $_SESSION['compare_cart'][$v] = $v;
             return false;
          }
          }

          // товар существует, добавим его в корзину
          $_SESSION['compare_cart'][$product->id] = $product->id;

      }

     return false;
	}

	/*
	*
	* Удаление товара из сравнения
	*
	*/
	public function delete_item($compare_id){
	unset($_SESSION['compare_cart'][$compare_id]);
	}

}