<?php
if(isset($_POST['upc']))
{$file = 'http://www.cbr.ru/scripts/XML_daily.asp';
$feil = file_get_contents($file);
$ro = new SimpleXMLElement($feil);
echo substr(str_replace(',', '.', $ro->Valute[9]->Value),0,-2);}
?>