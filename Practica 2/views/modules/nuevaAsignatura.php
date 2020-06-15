<h1>REGISTRO DE ASIGNATURAS</h1>
<!--Formulario para ingresar un nuevo elemento-->
<form method="post">
  <td><B>Carrera</B></td>
  <td>
  <select name="nombreCarrera">
    <?php
    $respuesta = Datos::datosCarreraModel();
    foreach ($respuesta as $row => $item) {
      $idCarrera = $item['id'];
      $nombreCarrera = $item['nombre'];
      echo "<option value='$idCarrera'>".$nombreCarrera."</option>";
    }
    ?>
  </td> </select>
  <br>
  <td><B>Universidad</B></td>
  <td>
  <select name="nombreUniversidad">
    <?php
    $respuesta = Datos::datosUniversidadModel();
    foreach ($respuesta as $row => $item) {
      $idUniversidad = $item['id'];
      $nombreUniversidad = $item['nombre'];
      echo "<option value='$idUniversidad'>".$nombreUniversidad."</option>";
    }
    ?>
  </td> </select>
  <input type="submit" value="Enviar">
</form>

<?php

  //Enviar los parametros del registro de empresas al controlador
  $registro = new MvcController();
  $registro -> registroAsignaturaController();

  if (isset($_GET["action"])) {
    if ($_GET["action"] == "asignadoOK") {
      echo "Registro exitoso";
    }
  }

 ?>
