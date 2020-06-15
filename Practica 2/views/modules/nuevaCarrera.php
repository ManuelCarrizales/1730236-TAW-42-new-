<h1>REGISTRO DE CARRERAS</h1>
<!--Formulario para ingresar un nuevo elemento-->
<form method="post">
  <input type="text" placeholder="Nombre de la carrera" name="nombreCarrera" required>
  <input type="submit" value="Enviar">
</form>

<?php

  //Enviar los parametros del registro de empresas al controlador
  $registro = new MvcController();
  $registro -> registroCarreraController();

  if (isset($_GET["action"])) {
    if ($_GET["action"] == "carreraOK") {
      echo "Registro exitoso";
    }
  }

 ?>
