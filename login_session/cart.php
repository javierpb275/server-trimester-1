<?php
require_once 'connections.inc.php';
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: http://localhost/DWES/login_session/index.php");
} elseif (isset($_SESSION["cart"]) and count($_SESSION["cart"]) > 0) {
    $cart = $_SESSION["cart"];
    foreach ($cart as $item) {
        echo "Name: " . $item["name"] . " Quantity: " . $item["quantity"] . "<br>";
    }

    echo "<form method=POST action='cart.php'>";
    echo "<input type=submit name='pay' value='PAY'/>";
    echo "</form>";
    
    if (isset($_POST["pay"])) {
        $con = connect_db();
        foreach ($cart as $item) {
            $query=$con->prepare('UPDATE product SET stock="'.$item["quantity"] .'" WHERE name="'.$item["name"].'"');
        }
        echo "Thanks for your purchase!";
    }
    
} else {
    echo "cart is empty!";
}
?>

