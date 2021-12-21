<?php

require_once 'connections.inc.php';
session_start();
ini_set('display_errors', 1);
if (!isset($_SESSION["login"])) {
    header("Location: http://localhost/DWES/login_session/index.php");
}
echo "Welcome to the store: " . $_SESSION["login"] . '<br><br>';
try {
    $con = connect_db();
    if (isset($_POST["accept"])) {
        $the_post = $_POST;
        $query = $con->prepare("SELECT * FROM product WHERE id_product=:id");
        $query->bindParam(":id", $id);
        foreach ($the_post as $id => $quantity) {
            if (is_numeric($id) && $quantity > 0) {
                $query->execute();
                $product = $query->fetch();
                //var_dump($product);
                if ($product["stock"] < $quantity) {
                    echo "the product " . $product["name"] . " there is not enough stock<br><br>";
                } elseif ($quantity > 0) {
                    $product["quantity"] = $quantity;
                    $cart[] = $product;
                }
            }
        }
        $_SESSION["cart"] = $cart;
    }


    $result = $con->query("SELECT * FROM product");
    echo "<FORM method=POST action=${_SERVER["PHP_SELF"]}>";
    while ($product = $result->fetch()) {
        echo $product["name"] .
        ' Quantity:<input type=text name="' . $product["id_product"]
        . '"> stock(' . $product["stock"] . ')<br><br>';
    }
    echo '<input type=submit name="accept" value="Add to cart">';
    echo "</form>";
    
    
    //FORM TO SHOW CART
    echo "<form method=POST action='cart.php'>";
    echo "<input type=submit name='cart' value='show cart'/>";
    echo "</form>";
    
} catch (Exception $e) {
    echo $e->getMessage();
} finally {
    $con = null;
}
?>

