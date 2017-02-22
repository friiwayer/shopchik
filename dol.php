<?php
if(isset($_POST['upc']))
{$file = 'http://www.cbr.ru/scripts/XML_daily.asp';
$feil = file_get_contents($file);
$ro = new SimpleXMLElement($feil);
return $ro->Valute[9]->Value;}
?>