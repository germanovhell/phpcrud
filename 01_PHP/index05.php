<?php
/*
Imprimir por pantalla la tabla de multiplicar del número pasado en un parámetro GET por la url
*/

if (isset( $_GET["numero"] ) && is_numeric($_GET["numero"]) ) {
    $numero = $_GET["numero"];
}else {
    $numero = 4;
    echo "Numero por defecto = ".$numero;
}

echo "<h2> Tabla de multiplicar de ".$numero."</h2>";

for ($i=0; $i <= 10; $i++ ) {
    echo $i." * " .$numero. " = ".($i*$numero)."<br>"; 
} 

?>