<link href="design/{$settings->theme|escape}/css/flexslider.css" rel="stylesheet" type="text/css" media="screen"/>
<script src="design/{$settings->theme}/js/jquery.flexslider.js"></script>
<script>
{literal}
// Can also be used with $(document).ready()
$(document).ready(function() {
	$('.flexslider').flexslider({
		animation: "slide"
	});
});
{/literal}
</script>
<!-- Слайдер -->
<div class="flexslider">
	<ul class="slides">
		<li>
			<a href="#"><img src="design/{$settings->theme|escape}/images/slider1.jpg" /></a>
		</li>
		<li>
			<a href="#"><img src="design/{$settings->theme|escape}/images/slider2.jpg" /></a>
		</li>
		<li>
			<a href="#"><img src="design/{$settings->theme|escape}/images/slider3.jpg" /></a>
		</li>
	</ul>
</div>
<!-- end -->