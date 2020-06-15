<?php

  session_start();
  if (!$_SESSION["validar"]) {
    header("location:index.php?action=ingresar");
  }

 ?>

 <h1>LISTADO DE ESTUDIANTES</h1>

<table class="table table-condensed">
  <thead>
    <tr>
      <th>Cedula</th>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>Promedio</th>
      <th>Edad</th>
      <th>Fecha</th>
      <th>¿Editar?</th>
      <th>¿Borrar?</th>
    </tr>
  </thead>
  <tbody>
    <?php

    $vistaalumno = new MvcController();
    $vistaalumno -> vistaAlumnosController();
    $vistaalumno -> borrarUsuarioController();

    ?>
  </tbody>
</table>
<?php

  if (isset($_GET["action"])) {
    if ($_GET["action"] == "cambio") {
      echo "Cambio exitoso";
    }
  }

 ?>
