<?php
	session_start();

	if (!$_SESSION["validar"]) {
		header("location: index.php?action=ingresar");
		exit();
	}

?>

<H1>CATEGORIAS</H1>

<TABLE>
	<thead>
		<tr>
			<th>Nombre</th>
			<th>¿Editar?</th>
			<th>¿Eliminar?</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$vistaUsuario = new MvcController();
			$vistaUsuario -> vistaCategoriasController();
			$vistaUsuario -> borrarCategoriaController();
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