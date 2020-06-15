<?php

  session_start();
  if (!$_SESSION["validar"]) {
    header("location:index.php?action=ingresar");
  }

 ?>

 <h1>LISTADO DE UNIVERSIDADES</h1>

<table class="table table-condensed">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Localidad</th>
      <th>¿Editar?</th>
      <th>¿Borrar?</th>
    </tr>
  </thead>
  <tbody>
    <center>
    <!--Boton para agregar un nuevo elemento-->
    <a href="index.php?action=nuevaUniversidad"><button>Nueva universidad</button></a>
    </center>
    <?php

    $vistauniversidad = new MvcController();
    $vistauniversidad -> vistaUniversidadesController();
    $vistauniversidad -> borrarUniversidadController();
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
