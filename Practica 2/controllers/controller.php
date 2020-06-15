<?php

class MvcController{

  //Muestra plantilla
  public function pagina(){
    include 'views/template.php';
  }

  //Mostrar enlaces
  public function enlacesPaginasController(){

    if (isset($_GET["action"])) {
      $enlaces = $_GET["action"];
    } else {
      $enlaces = "index";
    }

    $respuesta = Paginas::enlacesPaginasModel($enlaces);
    include $respuesta;

  }

  public function ingresoUsuarioController(){
      if (isset($_POST["cedulaIngreso"])) {
        $datosController = array(
          'cedula' => $_POST["cedulaIngreso"],
          'password' => $_POST["passwordIngreso"]);

        $respuesta = Datos::ingresoUsuarioModel($datosController, "estudiante");
        //Validacion de la respuesta del modelo para ver si es un usuario correcto
        if ($respuesta["cedula"] == $_POST["cedulaIngreso"] &&
            $respuesta["password"] == $_POST["passwordIngreso"]) {
          session_start();
          $_SESSION["validar"] = true;
          header("location:index.php?action=alumnos");
        } else {
          header("location:index.php?action=fallo");
        }
      }
    }

  //-----------------ALUMNOS
  public function vistaAlumnosController(){
      $respuesta = Datos::vistaAlumnosModel("estudiante");

      /*El constructor foreach proporciona un modo sencillo de iterar sobre arrays,
      funciona solo con objetos y emitira un error al intentar con una propiedad diferente
      o no inicializada*/

      foreach ($respuesta as $row => $item) {
        echo '<tr>
              <td>'.$item["cedula"].'</td>
              <td>'.$item["nombre"].'</td>
              <td>'.$item["apellidos"].'</td>
              <td>'.$item["promedio"].'</td>
              <td>'.$item["edad"].'</td>
              <td>'.$item["fecha"].'</td>
              <td><a href="index.php?action=editarAlumno&id='.$item["id"].'"><button>Editar</button></a>
              </td>
              <td><a href="index.php?action=alumnos&idBorrarAlumno='.$item["id"].'"><button>Borrar</button></a></td>
              </tr>';
      }
    }

    public function registroAlumnoController(){

   if (isset($_POST["cedulaRegistro"])) {
     //Recibe a traves del metodo POST  el name (html) de usuario, password
     //y email, se almacenaran los datos en una variable tipo array con sus
     //respectivas propiedades (usuario, password, email)

     $datosController = array(
       'cedula' => $_POST['cedulaRegistro'],
       'nombre' => $_POST['nombreRegistro'],
       'apellido' => $_POST['apellidoRegistro'],
       'promedio' => $_POST['promedioRegistro'],
       'edad' => $_POST['edadRegistro'],
       'fecha' => $_POST['fechaRegistro'],
       'password' => $_POST['contrasenaRegistro']);

       //Se le dice un modelo llamado registroUsuarioModel los $datosController
       //que se van a almacenar, recibira 2 parametros: $datosController y el nombre
       //de la tabla a la que hay que guardar los datos

       $respuesta = Datos::registroAlumnoModel($datosController, "estudiante");

       //Se imprime en la vista la respuesta del modelo
       if ($respuesta == "success") {
         header("location:index.php?action=ok");
       } else {
         header("location:index.php");
       }
     }
   }


    public function editarUsuarioController(){
      $datosController = $_GET["id"];
      $respuesta = Datos::editarUsuarioModel($datosController, "estudiante");

      echo '<input type="hidden" value=" '.$respuesta["id"].' " name="idEditar">
      <input type="text" value=" '.$respuesta["cedula"]. '" name="cedulaEditar" required>
      <input type="text" value=" '.$respuesta["nombre"]. '" name="nombreEditar" required>
      <input type="text" value=" '.$respuesta["apellidos"]. '" name="apellidoEditar" required>
      <input type="text" value=" '.$respuesta["promedio"]. '" name="promedioEditar" required>
      <input type="text" value=" '.$respuesta["edad"]. '" name="edadEditar" required>
      <input type="date" value=" '.$respuesta["fecha"]. '" name="fechaEditar" required>
      <input type="text" value=" '.$respuesta["password"]. '" name="passwordEditar" required>
      <input type="submit" value="Actualizar" name="usuarioEditar" required>';
    }

    //Controlador actualizar usuario
    public function actualizarUsuarioController(){

      if (isset($_POST["usuarioEditar"])) {
        $datosController = array("id" => $_POST["idEditar"],
        'cedula' => $_POST['cedulaEditar'],
        'nombre' => $_POST['nombreEditar'],
        'apellidos' => $_POST['apellidoEditar'],
        'promedio' => $_POST['promedioEditar'],
        'edad' => $_POST['edadEditar'],
        'fecha' => $_POST['fechaEditar'],
        'password' => $_POST['passwordEditar']);

        $respuesta = Datos::actualizarUsuarioModel($datosController, "estudiante");

        //Recibimos respuesta del modelo
        if ($respuesta == "succes") {
          header("location:index.php?action=cambio");
        } else {
          echo "Error";
        }
      }
    }

    public function borrarUsuarioController(){

     if (isset($_GET["idBorrarAlumno"])) {

       $datosController = $_GET["idBorrarAlumno"];
       $respuesta = Datos::borrarUsuarioModel($datosController, "estudiante");

       //Recibimos respuesta del modelo
       if ($respuesta == "ok") {
         header("location:index.php?action=alumnos");
       }
     }
   }


    //-----------------UNIVERSIDADES

    //Vista de universidades
    public function vistaUniversidadesController(){
      $respuesta = Datos::vistaUniversidadesModel("universidad");

      /*El constructor foreach proporciona un modo sencillo de iterar sobre arrays,
      funciona solo con objetos y emitira un error al intentar con una propiedad diferente
      o no inicializada*/

      foreach ($respuesta as $row => $item) {
        echo '<tr>
        <td>'.$item["nombre"].'</td>
        <td>'.$item["localidad"].'</td>
        <td><a href="index.php?action=editarUniversidad&id='.$item["id"].'"><button>Editar</button></a>
        </td>
        <td><a href="index.php?action=universidades&idBorrarUniversidad='.$item["id"].'"><button>Borrar</button></a></td>
        </tr>';
      }
    }

    //Controlador registro de universidades
    public function registroUniversidadController(){

      if (isset($_POST["nombreUniversidad"])) {
        //Recibe a traves del metodo POST  el name (html) de id, nombre
        //se almacenaran los datos en una variable tipo array con sus
        //respectivas propiedades (id, nombre)

        $datosController = array(
          'nombre' => $_POST['nombreUniversidad'],
          'localidad' => $_POST['localidad']);

          //Se le dice un modelo llamado registroUsuarioModel los $datosController
          //que se van a almacenar, recibira 2 parametros: $datosController y el nombre
          //de la tabla a la que hay que guardar los datos

          $respuesta = Datos::registroUniversidadModel($datosController, "universidad");

          //Se imprime en la vista la respuesta del modelo
          if ($respuesta == "success") {
            header("location:index.php?action=universidadOK");
          } else {
            header("location:index.php");
          }
        }
      }

      //Controlador editar universidad
      public function editarUniversidadController(){
        $datosController = $_GET["id"];
        $respuesta = Datos::editarUniversidadModel($datosController, "universidad");

        echo '<input type="hidden" value=" '.$respuesta["id"].' " name="idEditarUniversidad">
        <input type="text" value=" '.$respuesta["nombre"]. '" name="nombreEditarUniversidad" required>
        <input type="text" value=" '.$respuesta["localidad"]. '" name="localidadEditarUniversidad" required>
        <input type="submit" value="Actualizar" name="universidadEditar" required>';
      }

      //Controlador actualizar universidad
      public function actualizarUniversidadController(){

        if (isset($_POST["universidadEditar"])) {
          $datosController = array(
            "id" => $_POST["idEditarUniversidad"],
            "nombre" => $_POST["nombreEditarUniversidad"],
            "localidad" => $_POST["localidadEditarUniversidad"]);

            $respuesta = Datos::actualizarUniversidadModel($datosController, "universidad");

            //Recibimos respuesta del modelo
            if ($respuesta == "succes") {
              header("location:index.php?action=cambioUniversidad");
            } else {
              echo "Error";
            }
          }
        }

        //Controlador borrar universidad
        public function borrarUniversidadController(){

          if (isset($_GET["idBorrarUniversidad"])) {

            $datosController = $_GET["idBorrarUniversidad"];
            $respuesta = Datos::borrarUniversidadModel($datosController, "universidad");

            //Recibimos respuesta del modelo
            if ($respuesta == "ok") {
              header("location:index.php?action=universidades");
            }
          }
        }

        //-----------------CARRERAS

        //Vista de carreras
        public function vistaCarrerasController(){
          $respuesta = Datos::vistaCarrerasModel("carrera");

          /*El constructor foreach proporciona un modo sencillo de iterar sobre arrays,
          funciona solo con objetos y emitira un error al intentar con una propiedad diferente
          o no inicializada*/

          foreach ($respuesta as $row => $item) {
            echo '<tr>
            <td>'.$item["nombre"].'</td>
            <td><a href="index.php?action=editarCarrera&id='.$item["id"].'"><button>Editar</button></a>
            </td>
            <td><a href="index.php?action=carreras&idBorrarCarrera='.$item["id"].'"><button>Borrar</button></a></td>
            </tr>';
          }
        }

        //Controlador registro de carreras
        public function registroCarreraController(){

          if (isset($_POST["nombreCarrera"])) {
            //Recibe a traves del metodo POST  el name (html) de id, nombre
            //se almacenaran los datos en una variable tipo array con sus
            //respectivas propiedades (id, nombre)

            $datosController = array(
              'nombre' => $_POST['nombreCarrera']);

              //Se le dice un modelo llamado registroUsuarioModel los $datosController
              //que se van a almacenar, recibira 2 parametros: $datosController y el nombre
              //de la tabla a la que hay que guardar los datos

              $respuesta = Datos::registroCarreraModel($datosController, "carrera");

              //Se imprime en la vista la respuesta del modelo
              if ($respuesta == "success") {
                header("location:index.php?action=carreraOK");
              } else {
                header("location:index.php");
              }
            }
          }

          //Controlador editar carrera
          public function editarCarreraController(){
            $datosController = $_GET["id"];
            $respuesta = Datos::editarCarreraModel($datosController, "carrera");

            echo '<input type="hidden" value=" '.$respuesta["id"].' " name="idEditarCarrera">
            <input type="text" value=" '.$respuesta["nombre"]. '" name="nombreEditarCarrera" required>
            <input type="submit" value="Actualizar" name="carreraEditar" required>';
          }

          //Controlador actualizar carrera
          public function actualizarCarreraController(){

            if (isset($_POST["carreraEditar"])) {
              $datosController = array(
                "id" => $_POST["idEditarCarrera"],
                "nombre" => $_POST["nombreEditarCarrera"]);

                $respuesta = Datos::actualizarCarreraModel($datosController, "carrera");

                //Recibimos respuesta del modelo
                if ($respuesta == "succes") {
                  header("location:index.php?action=cambioCarrera");
                } else {
                  echo "Error";
                }
              }
            }

            //Controlador borrar carrera
            public function borrarCarreraController(){

              if (isset($_GET["idBorrarCarrera"])) {

                $datosController = $_GET["idBorrarCarrera"];
                $respuesta = Datos::borrarCarreraModel($datosController, "carrera");

                //Recibimos respuesta del modelo
                if ($respuesta == "ok") {
                  header("location:index.php?action=carreras");
                }
              }
            }

            //-----------------ASIGNATURA
            //Vista de asignatura
            public function vistaAsignaturaController(){
              $respuesta = Datos::vistaAsignaturaModel("asignatura");

              /*El constructor foreach proporciona un modo sencillo de iterar sobre arrays,
              funciona solo con objetos y emitira un error al intentar con una propiedad diferente
              o no inicializada*/

              foreach ($respuesta as $row => $item) {
                echo '<tr>
                <td>'.$item["carrera"].'</td>
                <td>'.$item["universidad"].'</td>
                <td><a href="index.php?action=editarAsignatura&id='.$item["id"].'"><button>Editar</button></a>
                </td>
                <td><a href="index.php?action=asignaturas&idBorrarAsignatura='.$item["id"].'"><button>Borrar</button></a></td>
                </tr>';
              }
            }

            //Controlador registro de carreras
            public function registroAsignaturaController(){

              if (isset($_POST["nombreUniversidad"])) {
                //Recibe a traves del metodo POST  el name (html) de id, nombre
                //se almacenaran los datos en una variable tipo array con sus
                //respectivas propiedades (id, nombre)

                $datosController = array(
                  'carrera' => $_POST['nombreCarrera'],
                  'universidad' => $_POST['nombreUniversidad']);

                  //Se le dice un modelo llamado registroUsuarioModel los $datosController
                  //que se van a almacenar, recibira 2 parametros: $datosController y el nombre
                  //de la tabla a la que hay que guardar los datos

                  $respuesta = Datos::registroAsignaturaModel($datosController, "asignatura");

                  //Se imprime en la vista la respuesta del modelo
                  if ($respuesta == "success") {
                    header("location:index.php?action=asignadoOK");
                  } else {
                    header("location:index.php");
                  }
                }
              }

              //Controlador editar proveedor
              public function editarAsignaturaController(){
                $datosController = $_GET["id"];

                echo '<input type="hidden" value=" '.$_GET["id"].' " name="idAsignatura">';

                echo '<td><B>Carrera</B></td>
                <td>
                <select name="editarCarrera">
                '.
                $respuesta = Datos::datosCarreraModel();
                foreach ($respuesta as $row => $item) {
                  $idCarrera = $item['id'];
                  $nombreCarrera = $item['nombre'];
                  echo "<option value='$idCarrera'>".$nombreCarrera."</option>";
                }'
                </td> </select><br>';
                echo '<input type="hidden" name="vacio">';

                echo '<br><td><B>Universidad</B></td>
                <td>
                <select name="editarUniversidad">
                '.
                $respuestaDos = Datos::datosUniversidadModel();
                foreach ($respuestaDos as $row => $item) {
                  $idUniversidad = $item['id'];
                  $nombreUniversidad = $item['nombre'];
                  echo "<option value='$idUniversidad'>".$nombreUniversidad."</option>";
                }'
                </td> </select><br>';
                echo '<input type="submit" value="Actualizar" name="asignadoEditar" required>';
              }

              //Controlador actualizar proveedor
              public function actualizarAsignaturaController(){

                if (isset($_POST["asignadoEditar"])) {
                  $datosController = array(
                    "id" => $_POST["idAsignatura"],
                    "id_carrera" => $_POST["editarCarrera"],
                    "id_universidad" => $_POST["editarUniversidad"]);

                    $respuesta = Datos::actualizarAsignadoModel($datosController, "asignatura");

                    //Recibimos respuesta del modelo
                    if ($respuesta == "succes") {
                      header("location:index.php?action=cambioAsignado");
                    } else {
                      echo "Error";
                    }
                  }
                }

                //Controlador borrar carrera
                public function borrarAsignaturaController(){

                  if (isset($_GET["idBorrarAsignatura"])) {

                    $datosController = $_GET["idBorrarAsignatura"];
                    $respuesta = Datos::borrarAsignaturaModel($datosController, "asignatura");

                    //Recibimos respuesta del modelo
                    if ($respuesta == "ok") {
                      header("location:index.php?action=asignaturas");
                    }
                  }
                }

}

?>
