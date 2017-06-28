<?php
/*
Crea un script PHP que tenga tres variables, una tipo array, otra tipo
string y otra boleana y que imprima un mensaje según el tipo de variable que sea
*/

$arreglo = array("as",12);
$booleano = true;
$texto = "variable string";

if (is_array($arreglo)) {
    echo "Es un array <br>";
}

if(is_bool($booleano)){
    echo "Es un booleano <br>";
}
if (is_string($texto)) {
    echo "Es un string <br>";
}
?>