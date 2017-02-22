<link href="design/{$settings->theme|escape}/css/example2.css" rel="stylesheet" type="text/css" media="screen"/>

<script type="text/javascript" src="design/{$settings->theme}/js/jquery.onebyone.min.js"></script>
<script type="text/javascript" src="design/{$settings->theme}/js/jquery.touchwipe.min.js"></script>
<style type="text/css" media="screen">
		#wrapp{              
			width: 530px;    
			-webkit-user-select: none;
            float:right;
            position:relative;	 
		}
       
	 

		#ep2{
			position:absolute;
			left: 36px;
			width: 540px;	 
			top: 50px; 

		}  
		
	  
 
	  
		.otherExample{ 
			position: absolute;
			right: 36px;
			top: 360px;
		}
		.otherExample a{ 
			display: block;
			float: left;
			margin-right: 16px;
			color: #0066FF;
		}    
 		.otherExample a:hover{ 
			color: #B22222;
			text-decoration: underline;
		}     		

	 
</style>
<script>
{literal}
// Can also be used with $(document).ready()
$(document).ready(function() {
    $('#example2').oneByOne({
			className: 'oneByOne2',
			easeType: 'fadeInLeft',	             
			width: 530,
			height: 270,
			showArrow: false,
			slideShow: true
    }); 
});
{/literal}
</script>
<!-- Слайдер -->
<div id="wrapp">        
	 	<div id="example2">  				
		<div class="oneByOne_item">     
			<a href="http://shopchik.com/products/zopo-leader-zp900"><img src="design/{$settings->theme}/images/zopo.png" class="img1" />
			<span class="text1">Смартфон ZOPO Leader ZP900</span>			
			<span class="text2">
            <ul>
            <li>Операционная система Android 4.0.4</li>
            <li>Материал корпуса Пластик</li>
            <li>Вес 199гр</li>
            <li>Тип экрана PS LED</li>
            <li>Диагональ5,3 дюйма</li>
            <li>Размер изображения 960 x 540 пикселя</li>
            </ul></span>
            <span class="pricez">цена 10 400 p.</span>
            </a>												
		</div>
		<div class="oneByOne_item">                      
            <a href="http://shopchik.com/products/onda-vi30-dual-core-version"><img src="design/{$settings->theme}/images/onda.png" class="img1" />
			<span class="text1">Планшетный пк Onda Vi30</span>			
			<span class="text2"><ul>
            <li>Операционная система Android 4.0</li>
            <li>CPU Amlogic AML8726-MX,Cortex A9 dual core</li>
            <li>Вес 199гр</li>
            <li>Тип экрана IPS LED</li>
            <li>Диагональ 5,3 дюйма</li>
            <li>Размер изображения 960 x 540 пикселя</li>
            </ul></span>
            <span class="pricez">цена 5 850 p.</span>
            </a>						
		</div>
		<div class="oneByOne_item">
			<a href="http://shopchik.com/products/planshet-yuandao-window-n101"><img src="design/{$settings->theme}/images/sku20548_3.jpg" width="350" class="img1" />
			<span class="text1">Yandao Window N101</span>			
			<span class="text2"><ul>
            <li>Операционная система Android 4.0.4</li>
            <li>Материал корпуса Алюминий</li>
            <li>Вес 635гр</li>
            <li>Тип экрана матрицы IPS</li>
            <li>Диагональ 10 дюймов</li>
            <li>Разрешение 1280 x 800 пикселей</li>
            </ul></span>
            <span class="pricez">цена 8 320 p.</span>
            </a>						
		</div>                       
		<div class="oneByOne_item">
			<a href="http://shopchik.com/products/planshet-cube-mini-u30gt"><img src="design/{$settings->theme}/images/cubemini.jpg" width="200" class="img1" />
			<span class="text1">Планшет Cube Mini U30GT</span>			
			<span class="text2"><ul>
            <li>Операционная система Android 4.0.4</li>
            <li>Материал корпуса Пластик</li>
            <li>Вес 590гр</li>
            <li>Тип экрана IPS</li>
            <li>Диагональ 7 дюймов</li>
            <li>Размер изображения 1024 x 600 пикселя</li>
            </ul></span>
            <span class="pricez">цена 5 120 p.</span>
            </a>										
		</div>                                                                                              
	  </div>  
</div>
<!-- end -->