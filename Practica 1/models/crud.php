<?php  
require_once "conexion.php";
//heredar la clase conexion.php para poder accesar y utilizar la conexion a la base de datos, se extiende cuando se requiere manipular una funcion o un metodo, en este caso manipularemos la funcion "conectar" de models/conexion.php

class Datos extends Conexion
{
	//registro de usuarios 
	public static function registroUsuarioModel($datosModel, $tabla){
		//prepare() prepara la sentencia de SQL para que sea ejecutada por el metodo POSTantement la sentencia de SQL se puede contener desde cero para ejecutar mas parametros 

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, password, email) VALUES (:usuario,:password,:email)");

		//bindParam() vincula una variable de PHP a un parametro de sustitucion con nombre correspondiente a la sentencia SQL que fue usada para preparar la sentencia 

		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);

		//regresar a una respuesta satosfactoria o no

		if ($stmt->execute()) {
			return "success";
		}else{
			return "error";
		}

		$stmt->close();

	}

	//modelo ingreso usuario model
	public static function ingresoUsuarioModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT usuario, password FROM $tabla WHERE usuario = :usuario");
		$stmt -> bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->execute();
		//fetch() obtiene una fila de un conjunto de resultados asociado al objeeto %stmt
		return $stmt->fetch();

		$stmt->close();
	}

	//modelo vista usuarios
	public static function vistaUsuariosModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id, usuario, password, email FROM $tabla");
		$stmt->execute();
		//fetchAll() obtiene todas las filas de un conjunto asociado al objeto PDO statmnet (stmt)
		return $stmt->fetchAll();
		$stmt->close(); 
	}

	//modelo editar usuario
	public static function editarUsuarioModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id, usuario, password, email FROM $tabla WHERE id=:id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
	//modelo actuializar usuario
	public static function actualizarUsuarioModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario =:usuario, password = :password, email = :email WHERE id = :id");
		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	//modelo borrar usuario
	public static function borrarUsuarioModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}
}


?>