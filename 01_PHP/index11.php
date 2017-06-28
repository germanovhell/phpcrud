<?php
/*
    Crear un array con numeros
    1- recorrer el array y mostrar
    2- Ordenar y mostrar
    3- Mostrar longitud
    4- Buscar en array
*/

$numeros = array(45,12,53,1,100);

echo "Recorrer  y mostrarlo <br>";

foreach ($numeros as $num) {
    echo $num;
    echo "<br>";
}

echo "<br>Ordenar  y mostrar <br>";

sort($numeros);
for ($i=0; $i < count($numeros) ; $i++) { 
    echo $numeros[$i];
    echo "<br>";
}

echo "<br>Longitud del array = ".count($numeros); 

echo "<br> Buscar en el array <br>";
if (!array_search(45, $numeros)) {
    echo "No existe en el array<br>";
}else
    echo "El número si existe en el array<br>";
?>