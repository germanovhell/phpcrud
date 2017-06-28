<?php
/*
    Mostrar los numeros múltiplos de un número pasado por URL entre 1 y 100
*/
if (isset($_GET["numero"]) && is_numeric($_GET["numero"]) ) {
    $numero = $_GET["numero"];
}else{
    $numero = 12;
    echo "<p>Numero defecto = ".$numero."</P><br>";   
}

for ($i=1; $i <= 100; $i++) { 
    if ($i % $numero == 0) {
        echo "Es multiplo ".$i." de ".$numero."<br>";
    }
}

?>