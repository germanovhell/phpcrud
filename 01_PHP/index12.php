<?php
/*
 Mostrar la direccion ip del usuario que visista la web y si usa FIrefox que de la bienvenida
*/

$ip =  $_SERVER["REMOTE_ADDR"];
$navegador = $_SERVER["HTTP_USER_AGENT"];

echo "Tu IP es = ".$ip;

if (strstr($navegador, "Firefox")) {
    echo "<h1>Estas usando el navegador Firefox </h1>";
}else
    echo "<h1>Otro navegador Chrome o Opera</h1>";
?>