<?php
/*
    Utiliza la función filter_var para comprobar si el email que nos llega
    por la URL es un email valido.
*/

function validarEmail($email){
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $status = "valido";
    }else {
        $status = "no valido";
    }
    return $status;
}

$email = "";
if(isset($_GET["email"])) {
    $email = $_GET["email"];
}
echo validarEmail($email);

?>