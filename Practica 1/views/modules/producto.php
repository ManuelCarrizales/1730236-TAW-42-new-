<?php
	session_start();

	if (!$_SESSION["validar"]) {
		header("location: index.php?action=ingresar");
		exit();
	}

?>

<H1>PRODUCTOS</H1>

<TABLE>
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Descripcion</th>
			<th>Precio de venta</th>
			<th>Precio de compra</th>
			<th>Inventario</th>
			<th>¿Editar?</th>
			<th>¿Eliminar?</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$vistaUsuario = new MvcController();
			$vistaUsuario -> vistaProductosController();
			$vistaUsuario -> borrarProductoController();
		?>
	</tbody>
</TABLE>
<?php
	if (isset($_GET["action"])) {
		if ($_GET["action"] == "cambio") {
			echo "cambio exitoso";
		}
	}
?>