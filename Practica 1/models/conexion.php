<?php
 class Conexion{
 	public static function conectar(){
 		$link = new PDO("mysql:host=localhost;dbname=twamvc","admin","a2d1cdc90c55bf40d6954a6774a93e0702a7c65a30ec6860");
 		return $link;
 	}
 }
?>