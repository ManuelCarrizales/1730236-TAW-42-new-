<?php

  session_start();
  if (!$_SESSION["validar"]) {
    header("location:index.php?action=ingresar");
  }

 ?>

 <h1>LISTADO DE ASIGNATURAS</h1>

<table class="table table-condensed">
  <thead>
    <tr>
      <th>Carrera</th>
      <th>Universidad</th>
      <th>¿Editar?</th>
      <th>¿Borrar?</th>
    </tr>
  </thead>
  <tbody>
    <center>
    <!--Boton para agregar un nuevo elemento-->
    <a href="index.php?action=nuevaAsignatura"><button>Nueva asignatura</button></a>
    </center>
    <?php

    $vistaasignatura = new MvcController();
    $vistaasignatura -> vistaAsignaturaController();
    $vistaasignatura -> borrarAsignaturaController();
    //$vistaempresa -> actualizarEmpresaController();

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
