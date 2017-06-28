<?php

if (isset($_POST["enviar"])) {
    if (!empty($_POST["nombre"]) && strlen($_POST["nombre"]) <= 20  
            && !is_numeric($_POST["nombre"]) && !preg_match("/[0-9]/", $_POST["nombre"])) {
        echo $_POST["nombre"]."<br>";
    }
    if (!empty($_POST["apellidos"]) && !is_numeric($_POST["apellidos"]) && !preg_match("/[0-9]/", $_POST["apellidos"])) {
        echo $_POST["apellidos"]."<br>";
    }
    if (!empty($_POST["biografia"])) {
        echo $_POST["biografia"]."<br>";
    }
    if (!empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        echo $_POST["email"]."<br>";
    }
    if (!empty($_POST["contrasena"]) && strlen($_POST["contrasena"]) >=6) {
        echo sha1($_POST["contrasena"])."<br>";
    }
    if (!empty($_POST["rol"])) {
        echo $_POST["rol"]."<br>";
    }
    
    if(isset($_FILES["imagen"]) && !empty($_FILES["imagen"]["tmp_name"])){
        echo "La imagen ha llegado<br>";
    }
}

?>