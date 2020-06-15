<h1>REGISTRO DE ESTUDIANTES</h1>

<form method="post">
  <input type="text" placeholder="Cedula" name="cedulaRegistro" required>
  <input type="text" placeholder="Nombre" name="nombreRegistro" required>
  <input type="text" placeholder="Apellido" name="apellidoRegistro" required>
  <input type="number" placeholder="Promedio" name="promedioRegistro" required>
  <input type="number" placeholder="Edad" name="edadRegistro" required>
  <input type="date" name="fechaRegistro" required>
  <input type="text" placeholder="Contraseña" name="contrasenaRegistro" required>
  <input type="submit" value="Enviar">
</form>

<?php

  //Enviar los parametros del registro al controlador
  $registro = new MvcController();
  $registro -> registroAlumnoController();

  if (isset($_GET["action"])) {
    if ($_GET["action"] == "ok") {
      echo "Registro exitoso";
    }
  }

 ?>
