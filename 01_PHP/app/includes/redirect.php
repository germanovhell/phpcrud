<?php
session_start();
if (!isset($_SESSION["logeado"])) {
    header("Location: login.php");
}

?>