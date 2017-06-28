<!--- Crea un formulario HTML con los siguientes campos:
- Nombre
- Apellidos
- Biografía
- Email
- Contraseña
- Imagen-->
<?php
session_start();
  if (!isset($_SESSION["logeado"])) {
      header("Location: ../login.php");
  }
?>

<?php 
require_once "header.php";
?>

<?php
$error = array();
function mostrarError($error,$campo){
  if(isset($error[$campo]) && !empty($campo)){
    $alerta = '<div class="alert alert-danger">'.$error[$campo].'</div>';
  }else {
    $alerta = "";
  }
  return $alerta;
}

function devolverValue($error , $campo, $textarea = false){
  if (isset($error) && count($error)>= 1 && isset($_POST[$campo])) {
    if ($textarea = true) {
      echo $_POST[$campo]; 
    }else {
      echo "value='{$_POST[$campo]}'"; 
    }
    
    }
}

if (isset($_POST["enviar"])) {
   $error = array();
    if (!empty($_POST["nombre"]) && strlen($_POST["nombre"]) <= 20  
            && !is_numeric($_POST["nombre"]) && !preg_match("/[0-9]/", $_POST["nombre"])) {
       $validar_nombre = true;
    }else {
      $validar_nombre = false;
       $error["nombre"] = "El nombre no es válido.";
    }
    if (!empty($_POST["apellidos"]) && !is_numeric($_POST["apellidos"]) && !preg_match("/[0-9]/", $_POST["apellidos"])) {
        $validar_apellido = true;
    }else {
      $validar_apellido = false;
      $error["apellidos"] = "Los apellidos no son válidos.";
    }
    if (!empty($_POST["biografia"])) {
        $valida_bio = true;
    }else {
       $valida_bio = false;
       $error["biografia"] = "La biografía no puede estar vacia.";
    }
    if (!empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $valida_email = true;
    }else {
      $valida_email = false;
      $error["email"]= "Introduce un email correcto.";
    }
    if (!empty($_POST["contrasena"]) && strlen($_POST["contrasena"]) >=6) {
        $validar_pass = true;
    }else {
      $validar_pass = false;
      $error["contrasena"] = "Introduce una contraseña de mas de 6 carácteres.";
    }
    if (isset($_POST["rol"])  && !empty($_POST["rol"])) {
        $validar_rol = true;
    }else {
      $validar_rol = false;
      $error["rol"] = "Selcciona un rol de usuario.";
    }
    
    $imagen = null;
    if(isset($_FILES["imagen"]) && !empty($_FILES["imagen"]["tmp_name"])){
        if (!is_dir("uploads")) {
          $dir = mkdir("uploads",777,true);
        }else {
          $dir = true;
        }

        if ($dir = true) {
          $nombreArchivo = time()."-".$_FILES["imagen"]["name"];
          $subirArchivo = move_uploaded_file($_FILES["imagen"]["tmp_name"], "uploads/".$nombreArchivo);

          $imagen = $nombreArchivo;
          if ($subirArchivo) {
            $imagenUp =  true;
          }else {
            $imagenUp = false;
            $error["imagen"] = "La imagen no se ha subido correctamente";
          }
        }
    }

    //insertar ususario en BD
    if (count($error)==0) {
      $sql = "INSERT INTO usuarios VALUES(NULL,'{$_POST["nombre"]}', '{$_POST["apellidos"]}', '{$_POST["biografia"]}', '{$_POST["email"]}', '".sha1($_POST["contrasena"])."','{$_POST["rol"]}', '{$imagen}')";
      $insertar = mysqli_query($db, $sql); 
    }else {
      $insertar = false;
    }
}

?>
<a href="../index.php" class="btn btn-success">Volver</a> 
<h1>Formulario</h1>
<?php
if (isset($_POST["enviar"]) &&  count($error)==0 &&  $insertar!= false) { ?>
  <div class="alert alert-success">EL usuario se ha enviado correctamente </div>
<?php }
?>
<div class="form-group">
<form action="" method="POST" enctype="multipart/form-data">

  <label for="">Nombre</label>
  <input type="text" name="nombre" id="" class="form-control" placeholder="" aria-describedby="helpId" <?php devolverValue($error, "nombre"); ?> >
  <small id="helpId" class="text-muted">Help text</small>
  <?php echo mostrarError($error, "nombre"); ?>
  <br>

  <label for="">Apellidos</label>
  <input type="text" name="apellidos" id="" class="form-control" placeholder="" aria-describedby="helpId" <?php devolverValue($error, "apellidos"); ?>>
  <small id="helpId" class="text-muted">Help text</small> 
  <?php echo mostrarError($error, "apellidos"); ?><br>

  <label for="">Biografía</label>
  <textarea rows="2" cols="" name="biografia" class="form-control" placeholder="" aria-describedby="helpId"><?php devolverValue($error, "biografia",true); ?></textarea>
  <small id="helpId" class="text-muted">Help text</small>
  <?php echo mostrarError($error, "biografia"); ?> <br>

  <label for="">Email</label>
  <input type="text" name="email" id="" class="form-control" placeholder="" aria-describedby="helpId" <?php devolverValue($error, "email"); ?>>
  <small id="helpId" class="text-muted">Help text</small> 
  <?php echo mostrarError($error, "email"); ?> <br>

  <label for="">Contraseña</label>
  <input type="password" name="contrasena" id="" class="form-control" placeholder="" aria-describedby="helpId" <?php devolverValue($error, "contrasena"); ?>>
  <small id="helpId" class="text-muted">Help text</small> 
  <?php echo mostrarError($error, "contrasena"); ?> <br>

  <label for="">Imagen</label>
  <input type="file" name="imagen" id="imagen" class="form-control" placeholder="" aria-describedby="helpId" >
  <small id="helpId" class="text-muted">Help text</small> <br>

  <label for="">ROL</label>
    <select name="rol" class="form-control">
            <option value="Usuario">Usuario</option>
            <option value="Administrador">Administrador</option>
        </select>
  <small id="helpId" class="text-muted">Help text</small> 
  <?php echo mostrarError($error, "rol"); ?> <br>
    <input type="submit" class="btn btn-success" name="enviar" id="" aria-describedby="helpId" placeholder="">
       
</form>

</div>