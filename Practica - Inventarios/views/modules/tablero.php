<?php 
	/* Se verifica que exista una sesion, en caso de que no sea así, se muestra el login */
	if (!isset($_SESSION['validar'])) {
		header("location:index.php?action=ingresar");
		exit();
	}
	$tablero = new MvcController();
	$tablero->contarFilas();
?>