<h1>REGISTRO DE UNIVERSIDADES</h1>
<!--Formulario para ingresar un nuevo elemento-->
<form method="post">
  <input type="text" placeholder="Nombre de la universidad" name="nombreUniversidad" required>
  <input type="text" placeholder="Localidad" name="localidad" required>
  <input type="submit" value="Enviar">
</form>

<?php

  //Enviar los parametros del registro de empresas al controlador
  $registro = new MvcController();
  $registro -> registroUniversidadController();

  if (isset($_GET["action"])) {
    if ($_GET["action"] == "universidadOK") {
      echo "Registro exitoso";
    }
  }

 ?>
