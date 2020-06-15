<?php

  session_start();
  if (!$_SESSION["validar"]) {
    header("location:index.php?action=ingresar");
  }

 ?>

 <h1>LISTADO DE CARRERAS</h1>

<table class="table table-condensed">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>¿Editar?</th>
      <th>¿Borrar?</th>
    </tr>
  </thead>
  <tbody>
    <center>
    <!--Boton para agregar un nuevo elemento-->
    <a href="index.php?action=nuevaCarrera"><button>Nueva carrera</button></a>
    </center>
    <?php

    $vistacarrera = new MvcController();
    $vistacarrera -> vistaCarrerasController();
    $vistacarrera -> borrarCarreraController();
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
