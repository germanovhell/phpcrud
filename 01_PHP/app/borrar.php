<?php

session_start();

if (isset($_SESSION["logeado"])  && $_SESSION["logeado"]["rol"] == "Administrador" ) {
    require_once "includes/conectarBD.php";

    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $borrar = mysqli_query($db, "DELETE FROM usuarios WHERE usuario_id = {$id}");


    }
}
header("Location: index.php");
?>