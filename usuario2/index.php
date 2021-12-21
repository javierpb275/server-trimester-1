<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo '<form action="' . $_SERVER["PHP_SELF"] . '" method="post" >';
        echo '<input  value = "Mostrar clientes" type="submit" name="_MOSTRAR_">';
        echo '<input  value = "Editar clientes" type="submit" name="_EDITAR_">';
        echo '<input  value = "Borar clientes" type="submit" name="_BORRAR_">';
        echo '<input  value = "Añadir clientes" type="submit" name="_INSERTAR_">';
        echo '</form>';

        if (isset($_POST["_MOSTRAR_"])) {
            
            header("Location:http://localhost/DWES/usuario2/print.php");
            exit();
        }
        if (isset($_POST["_EDITAR_"])) {
            header("Location:http://localhost/DWES/usuario2/edit.php");
            exit();
        }
        if (isset($_POST["_BORRAR_"])) {
            header("Location:http://localhost/DWES/usuario2/delete.php");
            exit();
        }
        if (isset($_POST["_INSERTAR_"])) {
            header("Location:http://localhost/DWES/usuario2/insertar.php");
            exit();
        }
        ?>
    </body>
</html>
