<?php

class Conexion {
    public $conexion;
    public function __construct() {
        try {
            $usuario = "examen";
            $password = "abc123..";
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            $this->conexion = new PDO("mysql:host=localhost;dbname=clasicos", $usuario, $password, $opciones);
            $this->conexion= setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $this->conexion;
    }

    public function destruct() {
        $this->connection = null;
    }

}
