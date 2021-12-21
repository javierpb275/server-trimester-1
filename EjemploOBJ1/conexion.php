<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of conexion
 *
 * @author mike
 */
class Conexion {
    //put your code here
    public $conexion;
    public function __construct(){
     try{   
      $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
      $this->conexion= new PDO("mysql:host=localhost;dbname=".getenv("nombredb")
              , getenv("usuariodb"), getenv("passworddb"),$opciones);
      $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
     }catch(PDOException $e){
         $this->conexion=null;
     } 
            
    }
    public function __destruct(){
        $this->conexion=null;
    }
}
