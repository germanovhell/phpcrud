<?php
/*
    Calcular el factorial de un numero dado
*/
$factorial=1;
$numero = 5;

for ($i=1; $i <= $numero ; $i++) { 
    $factorial *=  ($i);
}
echo "El factorial de ".$numero." es = ".$factorial;


?>