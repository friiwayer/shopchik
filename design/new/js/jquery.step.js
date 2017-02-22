/*
	* jQuery :step() selector
	* written by Alen Grakalic
	* http://cssglobe.com
*/

jQuery.expr[':'].step = function(node,index,meta){
	var $index = index;
	var $meta = meta[3].toString().split(',');
	var $step = parseInt($meta[0]);	
	var $start = ($meta.length > 1) ? $meta[1] : 0;
	if ($start != 0) $start -= 1;
	return ( ( ($index-$start) / $step ) == Math.floor( ( ($index-$start) / $step ) ) && ( ($index-$start) >= 0 )  );	
};