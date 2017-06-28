<?php
/*
    Comprobar si una variable esta vacia, si lo esta, rellenarla con texto en minúsculas y mostrarlo convertido
    en mayusculas y negrita
*/
$variable = "";

if (empty($variable)) {
    $variable = "holi";
    echo "<strong>" .$variable."</strong><br><br>";
    $grande = strtoupper($variable);
     echo "<strong>" .$grande."</strong><br><br>";
}else
     echo "<strong>Variable esta rellena </strong><br><br>";
?>