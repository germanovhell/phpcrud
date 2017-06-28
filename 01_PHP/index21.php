<?php
/*
    Crea una función a la que le pases un número y te saque su tabla de
    multiplicar.
*/

function multiplicar($numero){
    for ($i=0; $i < 13 ; $i++) { 
        echo $i. " * ".$numero. " = ".($i*$numero)."<br>";
    }
}
for ($i=1; $i < 13; $i++) { 
    echo "<h1>TABLA DE {$i} </h1><br>";
    echo multiplicar($i);
}

?>