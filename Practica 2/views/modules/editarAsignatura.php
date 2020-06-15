<?php
session_start();
if(!$_SESSION["validar"]){
    header("location:index.php?action=ingresar");
    exit();
}
?>
<h1>EDITAR EMPRESA</h1>
<form method="post">

    <?php
    // Llamo los elementos para mostrar el formulario y actualizar
    $editarAsignado = new MvcController();
    $editarAsignado -> editarAsignaturaController();
    $editarAsignado -> actualizarAsignaturaController();
    ?>
</form>
