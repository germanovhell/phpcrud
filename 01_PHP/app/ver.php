<?php
include 'includes/redirect.php';
?>

<?php require_once 'includes/header.php'; ?>

<?php 
if(!isset($_GET["id"]) || empty($_GET["id"]) || !is_numeric($_GET["id"])){
    header("Location:index.php");
}

$id = $_GET["id"]; 
$user_query = mysqli_query($db, "SELECT * FROM usuarios where usuario_id = {$id}");
$user = mysqli_fetch_assoc($user_query);

if (!isset($user["usuario_id"]) || empty($user["usuario_id"])) {
    header("Location:index.php");
}
?>
<hr>
<div class="row">
 <?php if($user["imagen"] != null) {?>
 <div class="col-sm-3">
   
      <img src="includes/uploads/<?php echo $user["imagen"] ?>" width="140" height="100" alt="Imagen de perfil">
   
 </div>
<?php } ?> 
 <div class="col-sm-9">
    <h3><strong><?php echo $user["nombre"]." ".$user["apellidos"];  ?>  </strong></h3>
    <p>Email <?php echo $user["email"]; ?></p>
    <p>Biografia <?php echo $user["biografia"]; ?></p>
 </div>
</div>
<hr>
<a href="index.php" class="btn btn-success"> Volver</a>

 <?php require_once 'includes/footer.php'; ?>