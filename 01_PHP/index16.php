<?php
/*  
    Crea un array con el contenido de la siguiente tabla:
            Frutas      Deportes         Idiomas
            Manzana     Futbol          Español
            Naranja     Tenis            Inglés
            Sandia      Baloncesto       Francés
            Fresa       Beisbol           Italiano
*/

$matriz = array(
    "frutas" => array("manzana","naranja","sandia","Fresa"),
    "Deportes" => array("Futbol", "Tenis", "Baloncesto", "Besibol"),
    "Idiomas" => array("Español","Ingles", "Frances","Italiano")
);
var_dump($matriz);
echo "Frutas  Deportes   Idiomas<br>";
for ($i=0; $i < 4; $i++) { 
       
        echo $matriz["frutas"][$i]." - ";
        echo $matriz["Deportes"][$i]." - ";
        echo $matriz["Idiomas"][$i];
        echo "<br>";
    
}

?>