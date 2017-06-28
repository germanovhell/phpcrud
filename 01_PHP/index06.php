<?php
/*
 Crear un array con los meses del año y recorrerlo con un ciclo for
*/
$meses = array("Enero", "Febrero","Marzo","Abril","Mayo","Junio","Julio", "Agosto","Septiembre","Noviembre","Diciembre");
$total = sizeof($meses);
for ($i=0; $i < $total; $i++) { 
    echo $meses[$i]. "<br>";
}

?>