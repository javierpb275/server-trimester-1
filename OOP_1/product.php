<?php

class Producto {

    private $atributos = array();
    public $nombre;
    private static $generadordeID = 0;
    private $identificador;

    public function getID() {
        return $this->identificador;
    }

    public function __clone() {
        self::$generadordeID++;
        $this->identificador = self::$generadordeID;
    }

    public function __construct() {
        self::$generadordeID++;
        $this->identificador = self::$generadordeID;
    }

    public function __destruct() {
        self::$generadordeID--;
        $this->identificador = self::$generadordeID;
    }

    public static function mostrarnumproductos() {
        return self::$numeroproductos;
    }

    public function mostrarnombre() {
        echo $this->nombre;
    }

    public static function deciradios() {
        echo 'Adios';
    }

    public function __get($atributo) {
        //return $this->atributos[$atributo];
        throw new Exception("El atributo no existe");
    }

    public function __set($atributo, $valor) {
        //$this->atributos[$atributo] = $valor;
        throw new Exception("El atributo no existe");
    }

}
?>

