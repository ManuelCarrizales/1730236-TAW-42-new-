<?php

  require_once 'conexion.php';

  /*Hereda la clase conexion para poder utilizarla, se extiende cuando se
  requiere manipular, en este caso se va a manipular la funcion "conectar"*/
  class Datos extends Conexion {

    public function ingresoUsuarioModel($datosModel, $tabla){
      $stmt = Conexion::conectar() -> prepare("SELECT cedula, password FROM $tabla WHERE
      cedula = :cedula");

      $stmt -> bindParam(":cedula", $datosModel["cedula"], PDO::PARAM_STR);
      $stmt ->execute();

      //Utilizar fetch() al obtener resultados asociados al objeto
      return $stmt -> fetch();
      $stmt -> close();
    }

    //-----------------ALUMNOS
    public function vistaAlumnosModel($tabla){
     $stmt = Conexion::conectar() -> prepare("SELECT id, cedula, nombre, apellidos,
     promedio, edad, fecha FROM $tabla");

     $stmt -> execute();

     //Utilizamos fetch()
     return $stmt -> fetchAll();
     $stmt -> close();
   }

    public function vistaUsuariosModel($tabla){
      $stmt = Conexion::conectar() -> prepare("SELECT id, cedula, nombre, apellidos, promedio, edad, fecha
      FROM $tabla");

      $stmt -> execute();

      //Utilizamos fetch()
      return $stmt -> fetchAll();
      $stmt -> close();
    }

    public function registroAlumnoModel($datosModel, $tabla){
      //Preparar la sentencia SQL a travez de PDO para ejecutarla

      $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla(cedula, nombre,
        apellidos, promedio, edad, fecha, password) VALUES
      (:cedula, :nombre, :apellidos, :promedio, :edad, :fecha, :password)");

      /*Utilizaremos bindParam() el cual vincula una variable o propiedad PHP a un
      parametro de sustitucion correspondiente de la sentencia de SQL que fue usada para
      preparar la sentencia*/

      $stmt -> bindParam(":cedula", $datosModel["cedula"], PDO::PARAM_STR);
      $stmt -> bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
      $stmt -> bindParam(":apellidos", $datosModel["apellido"], PDO::PARAM_STR);
      $stmt -> bindParam(":promedio", $datosModel["promedio"], PDO::PARAM_STR);
      $stmt -> bindParam(":edad", $datosModel["edad"], PDO::PARAM_STR);
      $stmt -> bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
      $stmt -> bindParam(":password", $datosModel["password"], PDO::PARAM_STR);

      if ($stmt -> execute()) {
        return "success";
      } else {
        return "error";
      }

      $stmt -> close();

    }

    public function editarUsuarioModel($datosModel, $tabla){
      $stmt = Conexion::conectar() -> prepare("SELECT id, cedula, nombre, apellidos, promedio, edad, fecha, password
      FROM $tabla WHERE id = :id");
      $stmt -> bindParam(":id", $datosModel, PDO::PARAM_INT);
      $stmt -> execute();

      return $stmt -> fetch();
      $stmt -> close();

    }

    public function actualizarUsuarioModel($datosModel, $tabla){
      $stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET cedula = :cedula,
      nombre = :nombre, apellidos = :apellidos, promedio = :promedio, edad = :edad, fecha = :fecha, password = :password WHERE id = :id");

      $stmt -> bindParam(":cedula", $datosModel["cedula"], PDO::PARAM_STR);
      $stmt -> bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
      $stmt -> bindParam(":apellidos", $datosModel["apellidos"], PDO::PARAM_STR);
      $stmt -> bindParam(":promedio", $datosModel["promedio"], PDO::PARAM_STR);
      $stmt -> bindParam(":edad", $datosModel["edad"], PDO::PARAM_STR);
      $stmt -> bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
      $stmt -> bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
      $stmt -> bindParam(":id", $datosModel["id"], PDO::PARAM_STR);
      if ($stmt -> execute()) {
        return "succes";
      } else {
        return "error";
      }

      $stmt -> close();
    }

    public function borrarUsuarioModel($datosModel, $tabla){
     $stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE id = :id");
     $stmt -> bindParam(":id", $datosModel, PDO::PARAM_STR);

     if ($stmt -> execute()) {
       return "ok";
     } else {
       return "error";
     }

     $stmt -> close();

   }


    //-----------------UNIVERSIDADES

    //Vista proveedores
    public function vistaUniversidadesModel($tabla){
      $stmt = Conexion::conectar() -> prepare("SELECT id, nombre, localidad FROM $tabla");

      $stmt -> execute();

      //Utilizamos fetch()
      return $stmt -> fetchAll();
      $stmt -> close();
    }

    //Registro empresas
    public function registroUniversidadModel($datosModel, $tabla){
      //Preparar la sentencia SQL a travez de PDO para ejecutarla

      $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla(nombre, localidad) VALUES
      (:nombre, :localidad)");

      /*Utilizaremos bindParam() el cual vincula una variable o propiedad PHP a un
      parametro de sustitucion correspondiente de la sentencia de SQL que fue usada para
      preparar la sentencia*/

      $stmt -> bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
      $stmt -> bindParam(":localidad", $datosModel["localidad"], PDO::PARAM_STR);

      if ($stmt -> execute()) {
        return "success";
      } else {
        return "error";
      }

      $stmt -> close();

    }

    //Editar universidad
    public function editarUniversidadModel($datosModel, $tabla){
      $stmt = Conexion::conectar() -> prepare("SELECT id, nombre, localidad
      FROM $tabla WHERE id = :id");
      $stmt -> bindParam(":id", $datosModel, PDO::PARAM_INT);
      $stmt -> execute();

      return $stmt -> fetch();
      $stmt -> close();

    }

    //Actualizar universidad
    public function actualizarUniversidadModel($datosModel, $tabla){
      $stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET nombre = :nombre,
        localidad = :localidad
        WHERE id = :id");

      $stmt -> bindParam(":id", $datosModel["id"], PDO::PARAM_STR);
      $stmt -> bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
      $stmt -> bindParam(":localidad", $datosModel["localidad"], PDO::PARAM_STR);

      if ($stmt -> execute()) {
        return "succes";
      } else {
        return "error";
      }

      $stmt -> close();
    }

    //Borrar universidad
    public function borrarUniversidadModel($datosModel, $tabla){
      $stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE id = :id");
      $stmt -> bindParam(":id", $datosModel, PDO::PARAM_STR);

      if ($stmt -> execute()) {
        return "ok";
      } else {
        return "error";
      }

      $stmt -> close();

    }

    //-----------------CARRERAS

    //Vista proveedores
    public function vistaCarrerasModel($tabla){
      $stmt = Conexion::conectar() -> prepare("SELECT id, nombre FROM $tabla");

      $stmt -> execute();

      //Utilizamos fetch()
      return $stmt -> fetchAll();
      $stmt -> close();
    }

    //Registro empresas
    public function registroCarreraModel($datosModel, $tabla){
      //Preparar la sentencia SQL a travez de PDO para ejecutarla

      $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla(nombre) VALUES
      (:nombre)");

      /*Utilizaremos bindParam() el cual vincula una variable o propiedad PHP a un
      parametro de sustitucion correspondiente de la sentencia de SQL que fue usada para
      preparar la sentencia*/

      $stmt -> bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);

      if ($stmt -> execute()) {
        return "success";
      } else {
        return "error";
      }

      $stmt -> close();

    }

    //Editar carrera
    public function editarCarreraModel($datosModel, $tabla){
      $stmt = Conexion::conectar() -> prepare("SELECT id, nombre
      FROM $tabla WHERE id = :id");
      $stmt -> bindParam(":id", $datosModel, PDO::PARAM_INT);
      $stmt -> execute();

      return $stmt -> fetch();
      $stmt -> close();

    }

    //Actualizar universidad
    public function actualizarCarreraModel($datosModel, $tabla){
      $stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET nombre = :nombre
        WHERE id = :id");

      $stmt -> bindParam(":id", $datosModel["id"], PDO::PARAM_STR);
      $stmt -> bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);

      if ($stmt -> execute()) {
        return "succes";
      } else {
        return "error";
      }

      $stmt -> close();
    }

    //Borrar carrera
    public function borrarCarreraModel($datosModel, $tabla){
      $stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE id = :id");
      $stmt -> bindParam(":id", $datosModel, PDO::PARAM_STR);

      if ($stmt -> execute()) {
        return "ok";
      } else {
        return "error";
      }

      $stmt -> close();

    }


    //--------------------------------------
    // Obtengo los datos para mostrar en el dropdown
    public function datosUniversidadModel(){
      $stmt = Conexion::conectar() -> prepare("SELECT id, nombre FROM universidad");
      $stmt -> execute();

      return $stmt -> fetchAll();
      $stmt -> close();
    }

    public function datosCarreraModel(){
      $stmt = Conexion::conectar() -> prepare("SELECT id, nombre FROM carrera");
      $stmt -> execute();

      return $stmt -> fetchAll();
      $stmt -> close();
    }
    //--------------------------------------
    //Vista asignatura
    public function vistaAsignaturaModel($tabla){
      $stmt = Conexion::conectar() -> prepare("SELECT a.id, c.nombre AS carrera,
        u.nombre AS universidad FROM
        $tabla a
        INNER JOIN carrera c ON a.id_carrera = c.id
        INNER JOIN universidad u ON a.id_universidad = u.id");

        $stmt -> execute();

        //Utilizamos fetch()
        return $stmt -> fetchAll();
        $stmt -> close();
      }

      //Registro empresas
      public function registroAsignaturaModel($datosModel, $tabla){
        //Preparar la sentencia SQL a travez de PDO para ejecutarla

        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla(id_carrera, id_universidad) VALUES
        (:id_carrera, :id_universidad)");

        /*Utilizaremos bindParam() el cual vincula una variable o propiedad PHP a un
        parametro de sustitucion correspondiente de la sentencia de SQL que fue usada para
        preparar la sentencia*/

        $stmt -> bindParam(":id_carrera", $datosModel["carrera"], PDO::PARAM_STR);
        $stmt -> bindParam(":id_universidad", $datosModel["universidad"], PDO::PARAM_STR);


        if ($stmt -> execute()) {
          return "success";
        } else {
          return "error";
        }

        $stmt -> close();

      }

      //Borrar carrera
      public function borrarAsignaturaModel($datosModel, $tabla){
        $stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt -> bindParam(":id", $datosModel, PDO::PARAM_STR);

        if ($stmt -> execute()) {
          return "ok";
        } else {
          return "error";
        }

        $stmt -> close();

      }

      //Actualizar asignatura
      public function actualizarAsignadoModel($datosModel, $tabla){
        $stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET id_carrera = :id_carrera,
          id_universidad = :id_universidad
          WHERE id = :id");

        $stmt -> bindParam(":id_carrera", $datosModel["id_carrera"], PDO::PARAM_STR);
        $stmt -> bindParam(":id_universidad", $datosModel["id_universidad"], PDO::PARAM_STR);
        $stmt -> bindParam(":id", $datosModel["id"], PDO::PARAM_STR);

        if ($stmt -> execute()) {
          return "succes";
        } else {
          return "error";
        }

        $stmt -> close();
      }



  }

 ?>
