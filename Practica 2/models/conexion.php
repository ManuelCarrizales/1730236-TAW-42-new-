<?php

  class Conexion{
    public function conectar(){
      //new PDO('mysql:host=localhost;dbname=prueba', $usuario, $contraseña);
      $link = new PDO("mysql:host=localhost;dbname=practica2","admin","a2d1cdc90c55bf40d6954a6774a93e0702a7c65a30ec6860");
      return $link;
    }
  }

 ?>
