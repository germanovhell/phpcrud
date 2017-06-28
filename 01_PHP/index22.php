<?php
/*
    Modifica el ejercicio anterior para pasarle un parámetro opcional que
    nos permita imprimir directamente la tabla en HTML.
*/

function multiplicar($numero, $parametro = null){
    
    if ($parametro != null) {
        for ($i=0; $i < 13 ; $i++) { 
            echo $i. " * ".$numero. " = ".($i*$numero)."<br>";
        }
    }
    
}


for ($i=1; $i < 13; $i++) { 
    echo "<h1>TABLA DE {$i} </h1><br>";
    multiplicar($i, true);
}

?>