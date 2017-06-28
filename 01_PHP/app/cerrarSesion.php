<?php
session_start();
if (isset($_SESSION["logeado"])) {
    unset($_SESSION["logeado"]); // destrute la sesión
    header("Location: login.php");
}

?>