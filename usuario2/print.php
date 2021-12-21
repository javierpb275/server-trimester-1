<?php

require_once 'Conexion.php';
require_once 'Formulario.php';
ini_set('display_errors', 1);

$con = new Conexion();
if ($con->conexion)
    $formulario = new Formulario($con->conexion, "cliente");
else
    echo "No se pudo conectar a la BD";


 $formulario->mostrarFormulario();
?>