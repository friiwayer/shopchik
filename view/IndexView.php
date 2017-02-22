<?PHP

/**
 * Simpla CMS
 *
 * @copyright 	2011 Denis Pikusov
 * @link 		http://simp.la
 * @author 		Denis Pikusov
 *
 * Этот класс использует шаблон index.tpl,
 * который содержит всю страницу кроме центрального блока
 * По get-параметру module мы определяем что сожержится в центральном блоке
 *
 */

require_once('View.php');

class IndexView extends View
{	
	public $modules_dir = 'view/';

	public function __construct()
	{
		parent::__construct();
	}

		
	/**
	 *
	 * Отображение
	 *
	 */
	function fetch()
	{
		// Содержимое корзины
		$this->design->assign('cart',		$this->cart->get_cart());
        
   	    // Содержимое сравнения товаров
        if($this->request->get('module', 'string')!=='CompareView')
        $this->design->assign('compare_informer', $this->compare->get_compare_informer());
    
        // Категории товаров
		$this->design->assign('categories', $this->categories->get_categories_tree());
        
        
        //бранды
        $brandy = $this->brands->get_brands();
        $this->design->assign('brandy', $brandy);
                
		// Страницы
		$pages = $this->pages->get_pages(array('visible'=>1));		
		$this->design->assign('pages', $pages);
							
		// Текущий модуль (для отображения центрального блока)
		$module = $this->request->get('module', 'string');
		$module = preg_replace("/[^A-Za-z0-9]+/", "", $module);

		// Если не задан - берем из настроек
		if(empty($module))
			return false;
		//$module = $this->settings->main_module;

		// Создаем соответствующий класс
		if (is_file($this->modules_dir."$module.php"))
		{
				include_once($this->modules_dir."$module.php");
				if (class_exists($module))
				{
					$this->main = new $module($this);
				} else return false;
		} else return false;

		// Создаем основной блок страницы
		if (!$content = $this->main->fetch())
		{
			return false;
		}		

        //передаем сообщение в базу
        if($this->request->post('sbg','string'))
        {
            $this->blog->add_sabj($this->request->post('sbg'),$this->request->post('mail'));
        }

		// Передаем основной блок в шаблон
		$this->design->assign('content', $content);
        
        /*if(!isset($_COOKIE['city']))
        {
        $city = iconv("windows-1251", "utf-8", $this->notify->occurrence());
        $_COOKIE['city'] = $city;
        }else
        {
        $city = $_COOKIE['city'];            
        }		
		$this->design->assign('city', $city);*/
		// Передаем название модуля в шаблон, это может пригодиться
		$this->design->assign('module', $module);
				
		// Создаем текущую обертку сайта (обычно index.tpl)
		$wrapper = $this->design->smarty->getTemplateVars('wrapper');
		if(empty($wrapper))
			$wrapper = 'index.tpl';
			
		$this->body = $this->design->fetch($wrapper);
		return $this->body;
	}
}