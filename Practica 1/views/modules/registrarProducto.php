<?php
	include_once "controllers/controller.php";
	session_start();

	if (!$_SESSION["validar"]) {
		header("location: index.php?action=ingresar");
		exit();
	}
	
	$registro = new MvcController();
	$registro -> registroProductoController();
?>
<h1> REGISTRO DE PRODUCTO </h1>

	<form method="POST">
		<input type="text" placeholder="Producto" name="productoRegistro" required>
		<input type="text" placeholder="Descripcion" name="descripcionRegistro" required>
		<input type="number" placeholder="Precio de Venta" name="pvRegistro" required>
		<input type="number" placeholder="Precio de Compra" name="pcRegistro" required>
		<input type="number" placeholder="Inventario" name="inventarioRegistro" required>
		<input type="submit" value="Enviar">
	</form>
<?php
?>