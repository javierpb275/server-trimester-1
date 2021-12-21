<?php
  require_once 'conexion.php';
  require_once 'formulario.php';
  require_once 'formularioEditor.php';
  ini_set('display_errors', 1);
  $con=new Conexion();
  if ($con->conexion) $formulario= new FormularioEditor($con->conexion,"SELECT * from persona","persona",array("id_persona"));
    else echo "No se pudo conectar a la BD";
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        $formulario->mostrarFormulario();
        ?>
    </body>
</html>
