<?php
/*
    Añadir valores en un array mientras que su longitud sea menor a 100 y que se muestre su info por pantalla
*/

$arreglo = array();

for ($i=0; $i < 100; $i++) { 
    array_push($arreglo, $i);
   // $arreglo[] = $i;
}

var_dump($arreglo);

?>