<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pruebas de Orientación a objetos</title>
    </head>
    <body>
        <?php
        ini_set('display_errors', 1);
        require_once 'product.php';
        try {

            $p = new Producto();
            $p->nombre = 'Samsung Galaxy S';

//            $a = clone($p);
//            $a = serialize($p);
//            echo $a.'<br>';
//            if($a==$p){
//                echo 'true';
//            }else{
//                echo 'falso';
//            }
            //$a = & $p;
//            $a=new Producto();
//            $b=clone($a);
//            
//            echo 'a: '.$a->getID().'<br>';
//            echo 'b: '.$b->getID().'<br>';
//            echo get_class($a).'<br>';
//            echo 'El número de productos es: '.Producto::mostrarnumproductos();
//            $c=null;
//            echo '<br>El número de productos es: '.Producto::mostrarnumproductos();
            //forma de llamar a métodos estáticos:
            //Producto::deciradios();
            //Métodos publicos:
            //$producto = new Producto();
            //$producto->nombre="Hola";
            //$producto->mostrarnombre();
//            $producto->bandera=true;
//            if($producto->bandera){
//                echo $producto->bandera;
//            }else {
//                echo $producto->bandera;
//            }
//
//            if($a==null){
//                echo $a.' es null';
//            }else{
//                echo $a;
//            }
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            $con = null;
        }
        ?>
    </body>
</html>
