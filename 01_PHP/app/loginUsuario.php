<?php
//conexión BD
session_start();
require_once "includes/conectarBD.php";

  if (isset($_POST["enviar"])) {
    $email = trim($_POST["email"]);
    $contrasena = sha1($_POST["contrasena"]);

    $sql = "SELECT * FROM usuarios where email = '{$email}' AND contrasena = '{$contrasena}'";
    $login = mysqli_query($db, $sql);

    if ($login && mysqli_num_rows($login) >=1) {
        $_SESSION["logeado"] = mysqli_fetch_assoc($login);  

        if (isset($_SESSION["error_login"])) {
            unset($_SESSION["error_login"]);
        }

        header("Location: index.php");
    }else {
      $_SESSION["error_login"]  = "Login Incorrecto!";
    }
  }
  header("Location: index.php");
?>
