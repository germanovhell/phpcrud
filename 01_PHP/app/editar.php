<!--- Crea un formulario HTML con los siguientes campos:
- Nombre
- Apellidos
- Biografía
- Email
- Contraseña
- Imagen-->
<?php
include 'includes/redirect.php';
?>
<?php 
require_once "includes/header.php";
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

function devolverValue($datos , $campo, $textarea = false){
  
    if ($textarea != false) {
      echo $datos[$campo]; 
    }else {
      echo "value='{$datos[$campo]}'";
    }
}
if(!isset($_GET["id"]) || empty($_GET["id"]) || !is_numeric($_GET["id"])){
    header("Location:index.php");
}

$id = $_GET["id"]; 
$user_query = mysqli_query($db, "SELECT * FROM usuarios where usuario_id = {$id}");
$user = mysqli_fetch_assoc($user_query);

if (!isset($user["usuario_id"]) || empty($user["usuario_id"])) {
    header("Location:index.php");
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
    // if (!empty($_POST["contrasena"]) && strlen($_POST["contrasena"]) >=6) {
    //     $validar_pass = true;
    // }else {
    //   $validar_pass = false;
    //   $error["contrasena"] = "Introduce una contraseña de mas de 6 carácteres.";
    // }
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
          $subirArchivo = move_uploaded_file($_FILES["imagen"]["tmp_name"], "includes/uploads/".$nombreArchivo);

          $imagen = $nombreArchivo;
          if ($subirArchivo) {
            $imagenUp =  true;
          }else {
            $imagenUp = false;
            $error["imagen"] = "La imagen no se ha subido correctamente";
          }
        }
    }


    // update en la BD
    if (count($error)==0) {
      $sql = "UPDATE usuarios SET nombre = '{$_POST["nombre"]}',"
          ."apellidos = '{$_POST["apellidos"]}',"
          ."biografia = '{$_POST["biografia"]}',"
          ."email = '{$_POST["email"]}',";
          if (isset($_POST["contrasena"]) && !empty($_POST["contrasena"])) {
               $sql.="contrasena'".sha1($_POST["contrasena"])."',";  
          } 

          if (isset($_FILES["imagen"]) && !empty($_FILES["imagen"]["tmp_name"])) {
               $sql.="imagen = '{$imagen}',";  
          } 

          $sql.="rol = '{$_POST["rol"]}' WHERE usuario_id = {$user["usuario_id"]}";
      $update = mysqli_query($db, $sql); 

      if ($update) { // verifica que se actualicen los datos para mostrar los datos nuevos en pantalla
        $user_query = mysqli_query($db, "SELECT * FROM usuarios where usuario_id = {$id}");
        $user = mysqli_fetch_assoc($user_query);
      }
    }else {
      $update = false;
    }
}

?>
<a href="index.php" class="btn btn-success">Volver</a> 
<h1>Editar usuario <?php echo $user["usuario_id"]." - ".$user["nombre"]." - ".$user["apellidos"]; ?> </h1>

<?php
  if (isset($_POST["enviar"]) &&  count($error)==0 &&  $update!= false) { ?>
      <div class="alert alert-success">EL usuario se ha actualizado correctamente </div>
  <?php }elseif (isset($_POST["enviar"]) ) {?>
       <div class="alert alert-danger">EL usuario NO se ha actualizado </div>
  <?php }
?>

<div class="form-group">
<form action="" method="POST" enctype="multipart/form-data">

  <label for="">Nombre</label>
  <input type="text" name="nombre" id="" class="form-control" placeholder="" aria-describedby="helpId" <?php devolverValue($user,"nombre"); ?> />
  <small id="helpId" class="text-muted">Help text</small>
  <?php echo mostrarError($error, "nombre"); ?>
  <br>

  <label for="">Apellidos</label>
  <input type="text" name="apellidos" id="" class="form-control" placeholder="" aria-describedby="helpId" <?php devolverValue($user,"apellidos"); ?> />
  <small id="helpId" class="text-muted">Help text</small> 
  <?php echo mostrarError($error, "apellidos"); ?><br>

  <label for="">Biografía</label>
  <textarea rows="2" cols="" name="biografia" class="form-control" placeholder="" aria-describedby="helpId"><?php devolverValue($user,"biografia",true); ?></textarea>
  <small id="helpId" class="text-muted">Help text</small>
  <?php echo mostrarError($error, "biografia"); ?> <br>

  <label for="">Email</label>
  <input type="text" name="email" id="" class="form-control" placeholder="" aria-describedby="helpId" <?php devolverValue($user, "email"); ?>>
  <small id="helpId" class="text-muted">Help text</small> 
  <?php echo mostrarError($error, "email"); ?> <br>

  <label for="">Contraseña</label>
  <input type="password" name="contrasena" id="" class="form-control" placeholder="" aria-describedby="helpId">
  <small id="helpId" class="text-muted">Help text</small> 
  <?php echo mostrarError($error, "contrasena"); ?> <br>

  <label for="">Actualizar Imagen de perfil</label>
  <input type="file" name="imagen" id="imagen" class="form-control" placeholder="" aria-describedby="helpId" >
  <?php if($user["imagen"] != null) {?>
  Imagen de perfil: <img src="includes/uploads/<?php echo $user["imagen"] ?>" width="140" height="100" alt="Imagen de perfil">
   <?php } ?> <br>

  <label for="">ROL</label>
    <select name="rol" class="form-control">
            <option value="Usuario" <?php if ($user["rol"]=="Usuario") {echo "selected='selected'"; }?>>Usuario</option>
            <option value="Administrador" <?php if ($user["rol"]=="Administrador") {echo "selected='selected'"; }?>>Administrador</option>
        </select>
  <small id="helpId" class="text-muted">Help text</small> 
  <?php echo mostrarError($error, "rol"); ?> <br>
    <input type="submit" class="btn btn-success" name="enviar" id="" aria-describedby="helpId" placeholder="">
       
</form>

</div>