<?php

class Paginas{
  public function enlacesPaginasModel($enlaces){
    if ($enlaces == "ingresar" || $enlaces == "alumnos" || $enlaces == "universidades"
    || $enlaces == "nuevaUniversidad" || $enlaces == "editarUniversidad"
    || $enlaces == "editarAlumno" || $enlaces == "carreras" || $enlaces == "nuevaCarrera"
    || $enlaces == "editarCarrera" || $enlaces == "asignaturas" || $enlaces == "nuevaAsignatura"
    || $enlaces == "editarAsignatura") {

      $module = "views/modules/".$enlaces.".php";

    // Aqui es donde se ven reflejados los cambios de las acciones
    // editar, borrar, actualizar
    } else if ($enlaces == "index") {
      $module = "views/modules/registro.php";

    } else if ($enlaces == "ok") {
      $module = "views/modules/registro.php";

    } else if ($enlaces == "universidadOK") {
      $module = "views/modules/universidades.php";

    } else if ($enlaces == "cambioUniversidad") {
      $module = "views/modules/universidades.php";

    } else if ($enlaces == "cambioAlumno") {
      $module = "views/modules/alumnos.php";

    } else if ($enlaces == "carreraOK") {
      $module = "views/modules/carreras.php";

    } else if ($enlaces == "cambioCarrera") {
      $module = "views/modules/carreras.php";

    } else if ($enlaces == "asignadoOK") {
      $module = "views/modules/asignaturas.php";

    } else if ($enlaces == "cambioAsignado") {
      $module = "views/modules/asignaturas.php";

    } else if ($enlaces == "cambio") {
      $module = "views/modules/alumnos.php";

    }

    return $module;
    //Incluir los URL de las vistas para cada parametro
    //del if respecto a los enlaces

  }
}

?>
