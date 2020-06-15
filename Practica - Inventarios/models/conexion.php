<?php
    class Conexion{

        public function conectar(){
            //$link = new PDO("mysql:host=localhost;dbname=datos", "root", "");
            try{
                $link = new PDO("mysql:host=localhost;dbname=simple_stock", "admin", "a2d1cdc90c55bf40d6954a6774a93e0702a7c65a30ec6860");
            }catch (PDOException $e){
                print "¡Error!: " . $e->getMessage() . "<br/>";
                die();
            }
            return $link;

        }
    }

?>