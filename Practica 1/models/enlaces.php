<?php  
//modelo de enlaces web
class Paginas{
	public static function enlacesPaginasModel($enlaces){
			if($enlaces == "ingresar" || $enlaces == "usuarios" || $enlaces == "registros" || $enlaces == "producto" || $enlaces == "registrarProducto" || $enlaces == "editar" || $enlaces == "editarProducto" || $enlaces == "categorias"  || $enlaces == "registrarCategoria" || $enlaces == "editarCategoria"){
				$modules = "views/modules/".$enlaces.".php";
			}
			else if($enlaces == "index"){
				$modules = "views/modules/registro.php";
			}
			else if($enlaces == "ok"){
				$modules = "views/modules/registro.php";
			}
			else if($enlaces == "okproduct"){
				$modules = "views/modules/producto.php";
			}
			else if($enlaces == "okcategoria"){
				$modules = "views/modules/categorias.php";
			}
			else if($enlaces == "fallo"){
				$modules = "views/modules/ingresar.php";
			}
			else if($enlaces == "cambio"){
				$modules = "views/modules/usuarios.php";
			}
			else if($enlaces == "cambioproduct"){
				$modules = "views/modules/producto.php";
			}
			else if($enlaces == "cambiocategoria"){
				$modules = "views/modules/categorias.php";
			}
			else if($enlaces == "salir"){
				$modules = "views/modules/salir.php";
			}else{
				$modules = "views/modules/registro.php";
			}
			return $modules;
		}
}
?>