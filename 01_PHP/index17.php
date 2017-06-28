<?php
/*  
El cálculo del factorial se realiza en un bucle que va disminuyendo el
valor de una variable y multiplicando todos los valores entre sí, como ya hemos
visto anteriormente.
Aprovechando este patrón puede crear una función que realice la factorial del
número que le pasemos por parámetro, ahorrando así líneas de código.
*/

function factorial($valor){
    $factotial = 1;
    for ($i=$valor; $i >0 ; $i--) { 
        $factotial *= $i;
    }
    return $factotial;
}

echo "<h1> Calcular factorial </h1><br>";
$numero = 5;
echo "<p> El factorial de ".$numero." es ".factorial($numero);
?>