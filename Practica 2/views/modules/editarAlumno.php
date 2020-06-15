<?php
session_start();
if(!$_SESSION["validar"]){
    header("location:index.php?action=ingresar");
    exit();
}
?>
<h1>EDITAR ESTUDIANTE</h1>
<form method="post">

    <?php
    // Llamo los elementos para mostrar el formulario y actualizar
    $editarAlumno = new MvcController();
    $editarAlumno -> editarUsuarioController();
    $editarAlumno -> actualizarUsuarioController();
    ?>
</form>
