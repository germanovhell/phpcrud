<?php
  session_start();
  if (isset($_SESSION["logeado"])) {
      header("Location: index.php");
  }
?>
<?php require_once 'includes/header.php'; ?>
<h1>Login de Usuario</h1>

<?php if (isset($_SESSION["error_login"])) { ?>
  <div class="alert alert-danger" role="alert">
    <strong><?=$_SESSION["error_login"] ?></strong>
  </div>
<?php }  ?>

<div class="form-group">
  <form action="loginUsuario.php" method="POST" enctype="multipart/form-data">
      <label for="email">Email</label>
      <input type="email" name="email" id="" class="form-control" placeholder="" aria-describedby="helpId">
      <label for="contrasena">Contraseña</label>
      <input type="password" name="contrasena" id="" class="form-control" placeholder="" aria-describedby="helpId">
      <br>
      <input type="submit" name="enviar"  value="Entrar" id="" class="form-control btn btn-success" >
      
  </form>
</div>

<?php require_once 'includes/footer.php'; ?>

