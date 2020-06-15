<?php
//INDEX. Vamos a mostrar la salida de las vistas al usuario
//tambien vamos a enviar las acciones del usuario al controlador

require_once 'models/enlaces.php';
require_once 'models/crud.php';
require_once 'controllers/controller.php';

//Para ver el template se hace la peticion desde el controlador

//Creamos un objeto
$mvc = new MvcController();

//Mostrar la funcion o metodo pagina disponible en controlers/controller.php
$mvc -> pagina();

 ?>
