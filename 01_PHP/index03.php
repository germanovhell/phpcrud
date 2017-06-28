<?php
for ($i=1; $i <=30; $i++) { 
    $cuadrado = $i*$i;
    if ($cuadrado % 2 == 0) {
        echo "El cuadrado de ".$i." es = ".$cuadrado." y es un numero par <br>";
    }
    else
        echo "El cuadrado de ".$i." es = ".$cuadrado." y es un numero impar <br>";
}
?>