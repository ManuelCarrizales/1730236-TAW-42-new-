<?php

  session_start();
  if (!$_SESSION["validar"]) {
    header("location:index.php?action=ingresar");
  }

 ?>

 <h1>LISTADO DE USUARIOS</h1>

<table class="table table-condensed">
  <thead>
    <tr>
      <th>Usuario</th>
      <th>Email</th>
      <th>Contrasena</th>
      <th>¿Editar?</th>
      <th>¿Borrar?</th>
    </tr>
  </thead>
  <tbody>
    <?php

    $vistausuario = new MvcController();
    $vistausuario -> vistaUsuariosController();
    //$vistausuario -> actualizarUsuarioController();
    $vistausuario -> borrarUsuarioController();

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
