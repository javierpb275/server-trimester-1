<?php

require_once 'Connection.php';

$con = new Connection();

if ($con->connection) {

    if ($_POST["id_producto"]) {
        $query = $con->connection->prepare("SELECT * FROM producto WHERE productCode=:id_producto");
        $query->bindParam(":product_id", $id_producto);
        $id_producto = $_POST["id_producto"];
        $query->execute();

        if ($product = $query->fetch()) {
            echo $product["productName"];
        }
         
    }

    echo '<br>';

    if ($_POST["nombre"]) {
        echo 'the name is ' . $_POST["nombre"];
    }
} else {
    echo "unable to connect to database";
}
    







