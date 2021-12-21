<?php

class Formulario {

    protected $tabla;
    protected $keys;
    protected $conexion;
    protected $registros;
    protected $posicion;
    private $sql;
    protected $consulta;

    public function __construct($con, $tabla) {
        session_start();
        if (isset($_SESSION['_posicion_'])) {
            $this->posicion = $_SESSION['_posicion_'];
        } else {
            $this->posicion = 0;
            $_SESSION['_posicion_'] = $this->posicion;
        }
        if ($con == null) {
            throw Exception("La conexión no esta abierta");
        }
        $this->conexion = $con;
        $this->tabla = $tabla;
    }

    protected function cargarRegistros() {
        $this->consulta = $this->conexion->query("SELECT * FROM $this->tabla");
        $this->registros = $this->consulta->fetchall(PDO::FETCH_ASSOC);
    }

    protected function abrirFormulario() {
        echo'<form method=POST action=' . $_SERVER["PHP_SELF"] . '>';
    }

    protected function cerrarFormulario() {
        echo '</form>';
    }

    public function mostrarFormulario() {
        $this->cargarRegistros();
        $this->FormularioBase();
        $this->cerrarFormulario();
    }

    protected function FormularioBase() {
        if (isset($_POST["_atras_"])) {
            if ($this->posicion > 0) {
                $this->posicion--;
                $_SESSION["_posicion_"] = $this->posicion;
            }
        } elseif (isset($_POST["_adelante_"])) {
            if ($this->posicion < count($this->registros) - 1) {
                $this->posicion++;
                $_SESSION["_posicion_"] = $this->posicion;
            }
        }

        $registro = $this->registros[$this->posicion];
        echo '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';
        foreach ($registro as $nombre_campo => $valor) {
            echo $nombre_campo . ':<input type="text" name="' . $nombre_campo . '" value="' . $valor . '"> <br>';
            //$registro["nombre_campo"].'"> <br>';
        }

        //       echo '</form>';

        echo "<table border=0><tr><td><FORM method=POST action='" . $_SERVER["PHP_SELF"] . "'>";
        echo "<input type=submit name='_atras_' value='<-'>";
        echo "</FORM></td>";
        echo "<td><FORM method=POST action='" . $_SERVER["PHP_SELF"] . "'>";
        echo "<input type=submit name='_adelante_' value='->'>";
        echo "</FORM></td></tr></table>";
    }

    private function actualizarDatos() {
        //UPDATE tabla SET campo0=valor0 , campo1=valor1 ...
        // WHERE key0=valorkey0  AND key1=valorkey1
        $record = $this->registros[$this->posicion];
        $sql = "UPDATE " . $this->tabla . " SET ";
        foreach ($record as $campo => $valor) {
            $sql .= ($campo . '="' . $_POST[$campo]) . '",';
        }
        $sql[strlen($sql) - 1] = ' ';
        $sql .= " WHERE ";
        $first = true;
        for ($i = 0; $i < count($this->keys); $i++) {
            if (!$first)
                $sql .= " AND ";
            $sql .= ($this->keys[$i] . "='" . $record[$this->keys[$i]]) . "'";
            $first = false;
        }
        $this->conexion->exec($sql);
        //echo $sql;
    }

    private function obtenerMetadatos() {
        $this->tabla = $this->consulta->getColumnMeta(0)['table']; //Sobre la consulta ya abierta obtenemos los metadatos de la primera columna para ver de que tabla viene. 
        for ($i = 0; $i < $this->consulta->columnCount(); $i++) {//Nos recorremos los campos para ver cuales son de la primary key
            $flags = $this->consulta->getColumnMeta($i)['flags'];
            foreach ($flags as $valor) {  //En este bucle examinamos las flags para ver si nos viene la que indica que el campo es parte de la primary key
                if (strcmp($valor, "primary_key") == 0)
                    $this->keys[] = $this->consulta->getColumnMeta($i)['name']; //si es primary key lo añadimos a nuestra lista de campos que van en la parte WHERE del UPDATE
            }
        }
    }

    public function formularioupdate() { //Esto es para editar 
        $this->cargarRegistros();
        $this->obtenerMetadatos();
        if (isset($_POST["_enviar_"])) {
            $this->actualizarDatos();
            $this->cargarRegistros();
        }
        $this->FormularioBase();
        echo "<input type=submit name='_enviar_' value='Guardar'>";
        $this->cerrarFormulario();
    }

    public function deleteRegistro() {
        //muestra el formulario y borra el registro
        $this->cargarRegistros();
        $this->obtenerMetadatos();
        //var_dump($this->registros);
        echo '<br><br>';
        echo'<form method=POST action=' . $_SERVER["PHP_SELF"] . '>';
        foreach ($this->registros as $key => $value) {

            echo "<input  value='" . $value["customerNumber"] . "' type='checkbox' name='check[]' >";
            echo $value["customerNumber"] . "/" . $value["customerName"] . "/" . $value["phone"] . "<br>";
        }
        echo'<input type="submit" name="borrador" value=borrar >';
        echo '</form>';
        if (isset($_POST['borrador'])) {
            $check = $_POST['check'];
            foreach ($check as $clave => $valor) {

                $this->conexion->exec("DELETE FROM cliente where customerNumber=$valor");
                //var_dump($valor);
            }
            echo "Done";
        }
    }

    public function insertarDatos() {

        $this->cargarRegistros();
        $this->obtenerMetadatos();

        $record = $this->registros[0];
        $this->abrirFormulario();
        foreach ($record as $key => $value) {

            echo $key . "<input type=text name=$key><br>";
        }

        if (isset($_POST["_enviar_"])) {
            //INSERT INTO tabla (campo1,campo2,) VALUES (valor1,valor2)
            //valor1,,,,,,
            $sql = "INSERT INTO " . $this->tabla . "(";
            foreach ($record as $campo => $valor) {
                //if (isset($_POST[$campo])) {
                    $sql .= $campo . ",";
                //}
            }
            $sql[strlen($sql) - 1] = ' ';
            $sql .= ") VALUES (";
            foreach ($record as $campo => $valor) {
                $sql .= "'".$_POST[$campo]."',";
                //if (isset($_POST[$campo])) {
                    //$sql .= ",";
                //}
            }
            $sql[strlen($sql) - 1] = " ";
            $sql .= ")";

            //echo $sql;
            $this->conexion->exec($sql);
            echo "<br>La query se ha ejecutado<br>";
            
            }
        echo "<br><input type=submit name='_enviar_' value='Insertar'><br>";
        
        $this->cerrarFormulario();
    }

}
