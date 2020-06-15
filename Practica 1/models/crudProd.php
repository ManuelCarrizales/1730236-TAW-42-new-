<?php
//se llama a la clase conexion para poder usar la base de datos
require_once "conexion.php";
class Datos2 extends Conexion {

	//registro de productos
	public static function registroProductoModel($datosModel, $tabla){
		//se prepara la sentencia con prepare
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, descripcion, pv, pc, inventario) VALUES (:nombre, :descripcion, :pv, :pc, :inventario)");
		//se vincula una variable de php a un parametro de sustitucion con bindParam
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":pv", $datosModel["pv"], PDO::PARAM_INT);
		$stmt->bindParam(":pc", $datosModel["pc"], PDO::PARAM_INT);
		$stmt->bindParam(":inventario", $datosModel["inventario"], PDO::PARAM_INT);
		//regresar una respuesta 
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}

	//Registro de categoria
	public static function registroCategoriaModel($datosModel, $tabla){
		//se prepara la sentencia con prepare
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre) VALUES (:nombre)");
		//se vincula una variable de php a un parametro de sustitucion con bindParam
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		//regresar una respuesta
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}

	//modelo vista productos
	public static function vistaProductosModel($tabla){
		$stmt=Conexion::conectar()->prepare("SELECT id, nombre, descripcion, pv, pc, inventario FROM $tabla");
		$stmt->execute();
		//fetchall obtiene todas las filas de un conjunto de resultados
		return $stmt->fetchAll();
		$stmt->close();
	}

	//modelo vista categorias
	public static function vistaCategoriasModel($tabla){
		$stmt=Conexion::conectar()->prepare("SELECT id, nombre FROM $tabla");
		$stmt->execute();

		//fetchall obtiene todas las filas de un conjunto de resultados
		return $stmt->fetchAll();

		$stmt->close();
	}

	//modelo editar producto
	public static function editarProductoModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id, nombre, descripcion, pv, pc, inventario FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	//modelo editar categoria
	public static function editarCategoriaModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id, nombre FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	//modelo actualizar producto
	public static function actualizarProductoModel($datosModel, $tabla){
		$stmt=Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, descripcion = :descripcion, pv = :pv, pc = :pc, inventario = :inventario WHERE id = :id ");
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":pv", $datosModel["pv"], PDO::PARAM_INT);
		$stmt->bindParam(":pc", $datosModel["pc"], PDO::PARAM_INT);
		$stmt->bindParam(":inventario", $datosModel["inventario"], PDO::PARAM_INT);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();

	}

	//modelo actualizar categoria
	public static function actualizarCategoriaModel($datosModel, $tabla){
		$stmt=Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre WHERE id = :id ");
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();

	}

	//modelo borrar producto
	public static function borrarProductoModel($datosModel, $tabla){
		$stmt=Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	//modelo borrar categoria
	public static function borrarCategoriaModel($datosModel, $tabla){
		$stmt=Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

}

?>