<?php
	include_once "controllers/controller.php";
	session_start();

	if (!$_SESSION["validar"]) {
		header("location: index.php?action=ingresar");
		exit();
	}
	
	$registro = new MvcController();
	$registro -> registroCategoriaController();
?>
<h1> REGISTRO DE CATEGORIA </h1>

	<form method="POST">
		<input type="text" placeholder="Producto" name="categoriaRegistro" required>
		<input type="submit" value="Enviar">
	</form>

<?php
?>