<?php
include 'includes/redirect.php';
include 'includes/header.php';
?>
<hr>

<?php if(isset($_SESSION["logeado"])) { ?>
<div class="row">
    <div class="col-lg-10">
        <a href="includes/formulario.php" class="btn btn-primary">Crear nuevo usuario</a>
    </div>
    <div class="col-lg-2">
        <?php echo $_SESSION["logeado"]["nombre"]." ".$_SESSION["logeado"]["apellidos"]; ?>
        <a href="cerrarSesion.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>
</div>
<?php } ?>

<hr>
<?php
$usuarios = mysqli_query($db, "SELECT * FROM usuarios");
$numero_total_usuarios = mysqli_num_rows($usuarios);

if ($numero_total_usuarios > 0) {
    $filas_por_pagina = 3;
    $pagina = false;

    if (isset($_GET["pagina"])) {
        $pagina = $_GET["pagina"];
    }

    if (!$pagina) {
        $comienzo = 0;
        $pagina = 1;
    }else{
        $comienzo = ($pagina-1) * $filas_por_pagina;
    }

    $paginas_totales = ceil($numero_total_usuarios / $filas_por_pagina);

    $sql = "SELECT * FROM usuarios ORDER BY usuario_id DESC LIMIT {$comienzo}, {$filas_por_pagina};";
    $usuarios = mysqli_query($db, $sql);

}else {
    echo "No hay usuarios.";
}

?>

<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Ver/editar</th>
        </tr>
    </thead>
    <?php while ($filas = mysqli_fetch_assoc($usuarios)) { ?>

    <tbody>
        <tr>
            <td>  <?= $filas["nombre"]; ?></td>
            <td> <?= $filas["apellidos"]; ?> </td>
            <td> <?= $filas["email"]; ?> </td>
            <td> <a href="ver.php?id=<?= $filas["usuario_id"] ?>" class="btn btn-success">Ver</a> 
            
                  
                <?php if (isset($_SESSION["logeado"]) && $_SESSION["logeado"]["rol"]=="Administrador") { ?>
                    <a href="editar.php?id=<?= $filas["usuario_id"] ?>" class="btn btn-warning">Editar</a>
                    <a href="borrar.php?id=<?= $filas["usuario_id"] ?>" class="btn btn-danger">Borrar</a>
                <?php } ?>
                  
            </td>
        </tr>
    </tbody> 

    <?php } ?>
    
    
</table>

<?php if ($numero_total_usuarios >=1) { ?>
     <nav aria-label="Page navigation">
       <ul class="pagination">

       
         <li class="page-item">
           <a class="page-link" href="?pagina=<?=($pagina-1) ?>" aria-label="Previous">
             <span aria-hidden="true">&laquo;</span>
             <span class="sr-only">Previous</span>
           </a>
         </li>

         <?php for($i=1; $i <= $paginas_totales ; $i++) { ?>

             <?php if($pagina == $i){ ?>
                <li class="page-item disabled"><a class="page-link" href="#"> <?=$i?> </a></li>

             <?php }else{  ?>
             <li class="page-item"><a class="page-link" href="?pagina=<?=$i?>"> <?=$i ?> </a></li>

             <?php } ?>
         <?php } ?>
        
        <?php $pagina_actual = ($pagina+1);
                if ($pagina_actual <= $paginas_totales){ ?>
         <li class="page-item">
           <a class="page-link" href="?pagina=<?php echo $pagina_actual; ?>" aria-label="Next">
             <span aria-hidden="true">&raquo;</span>
             <span class="sr-only">Next</span>
           </a>
         </li>
        <?php } ?>
       </ul>
     </nav>

 <?php  }?>

<?php
include 'includes/footer.php';
?>