<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of formulario
 *
 * @author mike
 */
class Formulario {
    //put your code here
    
    protected $conexion;
    protected $registros;
    protected $posicion;
    private $sql;
    
    public function __construct($con,$thesql) {
        session_start();
        if (isset($_SESSION['_posicion_'])){
            $this->posicion=$_SESSION['_posicion_'];
        }else{
           $this->posicion=0;
           $_SESSION['_posicion_']=$this->posicion;
        }
        if ($con==null){
            throw Exception("La conexión no esta abierta");
        }
        $this->conexion=$con;
        $this->sql=$thesql;
    }
    protected function cargarRegistros(){
        $consulta=$this->conexion->query($this->sql);
        $this->registros=$consulta->fetchall(PDO::FETCH_ASSOC);
    }
    protected function cerrarFormulario(){
        echo '</form>';
    }
    
    protected function formularioBase(){
        if (isset($_POST["_atras_"])){
            if ($this->posicion>0){
                $this->posicion--;
                $_SESSION["_posicion_"]=$this->posicion;
            }
        }elseif (isset($_POST["_adelante_"])){
            if ($this->posicion<count($this->registros)-1){
                $this->posicion++;
                $_SESSION["_posicion_"]= $this->posicion;
            }
        }

        $registro=$this->registros[$this->posicion];
        echo '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';
        
        foreach($registro as $campo => $valor){
           echo $campo.'<input type="text" name="'.$campo.'" value="'.
                $valor.'"> <br>';
        }

        //echo '</form>';
        
        echo "<table border=0><tr><td><FORM method=POST action='". $_SERVER["PHP_SELF"] ."'>";
        echo "<input type=submit name='_atras_' value='<-'>";
        echo "</FORM></td>";
        echo "<td><FORM method=POST action='". $_SERVER["PHP_SELF"] ."'>";
        echo "<input type=submit name='_adelante_' value='->'>";
        echo "</FORM></td></tr></table>";
    }
    
    public function mostrarFormulario(){
        $this->cargarRegistros();
        $this->formularioBase();
        $this->cerrarFormulario();
    }
}

?>
