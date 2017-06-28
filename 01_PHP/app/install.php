<?php
require_once 'includes/conectarBD.php';

$sql = "CREATE TABLE IF NOT EXISTS usuarios(
          usuario_id int(255)  AUTO_INCREMENT not null,
          nombre varchar(50),
          apellidos varchar(255),
          biografia text,
          email varchar(255),
          contrasena varchar(255),
          rol varchar(20),
          imagen varchar(255),
          CONSTRAINT pk_usuario PRIMARY KEY (usuario_id)
        );";

$crear_usuarios_tabla = mysqli_query($db, $sql);

$sql = "INSERT INTO usuarios VALUES(NULL,'Victor', 'Robles', 'Desarrollador', 'robles@gmail.com', '".sha1("contrasena")."','Usuario', NULL) ";
$insertar1 = mysqli_query($db, $sql);

$sql = "INSERT INTO usuarios VALUES(NULL,'Juan', 'Lopez', 'Desarrollador', 'lopez@gmail.com', '".sha1("contrasena")."','Usuario', NULL) ";
$insertar2 = mysqli_query($db, $sql);

$sql = "INSERT INTO usuarios VALUES(NULL,'Pedro', 'Piedra', 'Desarrollador', 'piedra@gmail.com', '".sha1("contrasena")."','Usuario', NULL) ";
$insertar3 = mysqli_query($db, $sql);

$sql = "INSERT INTO usuarios VALUES(NULL,'Lucas', 'Money', 'Desarrollador', 'money@gmail.com', '".sha1("contrasena")."','Usuario', NULL) ";
$insertar4 = mysqli_query($db, $sql);


if ($crear_usuarios_tabla) {
     echo "La tabla usuarios se ha creado correctamente";
}else {
    echo "Error "; 
}

?>
