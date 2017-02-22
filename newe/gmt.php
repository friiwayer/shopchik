<?php
$gmt = 3600*-0;
$hour = gmdate("H", time() + $gmt);
$minutes = gmdate("i", time() + $gmt);
$cur_d = gmdate("d", time() + $gmt);
echo $cur_d." ".$hour.":".$minutes;
?>