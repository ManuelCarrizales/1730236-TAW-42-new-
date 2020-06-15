<?php

    class Paginas{
        public function enlacesPaginasModel($enlacesModel){
			if ($enlacesModel == "ingresar" || $enlacesModel == "usuarios" || $enlacesModel == "inventario" || $enlacesModel == "categorias" || $enlacesModel == "tablero" || $enlacesModel == "ventas" || $enlacesModel == "salir" || $enlacesModel == "inventario") {
				$module = "views/modules/".$enlacesModel.".php";
			} else if ($enlacesModel == "index") {
				$module = "views/modules/tablero.php";
			} else {
				$module = "views/modules/tablero.php";
			}

			return $module;

            //Incluir los URLS de las vistas para cada uno de los parametros
            //del if respecto a los  $enlaces
        }
    }
?>