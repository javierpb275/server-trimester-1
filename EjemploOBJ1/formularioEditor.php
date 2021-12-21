<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of formularioEditor
 *
 * @author mike
 */
class FormularioEditor extends Formulario{
    //put your code here
    private $keys;
    private $tabla;
    public function __construct($con, $thesql,$thetable,$thekeys) {
        parent::__construct($con, $thesql);
        $this->keys=$thekeys;
        $this->tabla=$thetable;
        
    }
    private function guardarDatos(){
        $registro= $this->registros[$this->posicion];
        //UPDATE tabla SET campo0=valor0 , campo1=valor1 ...
        // WHERE key0=valorkey0  AND key1=valorkey1
        $thesql="UPDATE ".$this->tabla." SET ";
        foreach($registro as $campo=>$valor){
            $thesql.= $campo.'="'.$_POST[$campo].'",';
        }
        $thesql[strlen($thesql)-1]=' '; //nos cargamos la última coma
        $thesql.=' WHERE ';
        $primeravez=true;
        for($i=0;$i<count($this->keys);$i++){
            if (!$primeravez) $thesql.=' AND ';
            $thesql.=($this->keys[$i].'="'.$registro[$this->keys[$i]].'"');
            $primeravez=false;
        }
        $this->conexion->exec($thesql);
    }
    
    public function mostrarFormulario(){       
        $this->cargarRegistros();
        if (isset($_POST["_enviar_"])){
            $this->guardarDatos();
            $this->cargarRegistros();
        }
        $this->formularioBase();
        echo "<input type=submit name='_enviar_' value='Guardar'>";
        $this->cerrarFormulario();
    }
    
}
