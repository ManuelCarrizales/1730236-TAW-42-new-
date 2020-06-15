
<?php
/*El index, en el mostraremos la salida de las vistas al usuario y tambien
 a traves de el enviaremos als distintas acciones que el usuario envie al controlador
 */
ob_start();
require_once "controllers/controller.php";
require_once "models/enlaces.php";
require_once "models/crud.php";


//para poder ver el template se hace la peticion mediante el controlador.

//Creamos un objeto
$mvc = new MvcController();

//Mostrar la funcion o método "página" disponible en controllers/controller.php
$mvc -> pagina();


?>