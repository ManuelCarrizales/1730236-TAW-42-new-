<h1>INGRESAR</h1>
<form method="post">
  <input type="text" placeholder="Cedula" name="cedulaIngreso" required>
  <input type="password" placeholder="Contrasena" name="passwordIngreso" required>
  <input type="submit" name="" value="Enviar">
</form>

<?php

  $ingreso = new MvcController();
  $ingreso -> ingresoUsuarioController();
  if (isset($_GET["action"])) {
    if ($_GET["action"] == "fallo") {
      echo "Fallo al ingresar";
    }
  }

 ?>
