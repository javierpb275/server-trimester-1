<?php
require_once 'connections.inc.php';
if (isset($_COOKIE["position"])) {
    $position = $_COOKIE["position"];
} else {
    $position = 0;
}
$con = connect_db();
$query = $con->prepare("SELECT * FROM product");
$query->execute();
$products = $query->fetchAll();

if ($_POST["adelante"]) {
    setcookie("position", $position += 1, time() + (3600 * 24 * 365));
} elseif ($_POST["atras"]) {
    setcookie("position", $position -= 1, time() + (3600 * 24 * 365));
}

if ($position > count($products)-1) {
    setcookie("position", $position = 0, time() + (3600 * 24 * 365));
} elseif ($position < 0) {
    setcookie("position", $position = count($products)-1, time() + (3600 * 24 * 365));
}

$product = $products[$position];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';
        echo 'Product:<input type="text" name="name" value="' .
        $product["name"] . '"> <br>';
        echo 'Stock<input type="text" name="stock" value="' .
        $product["stock"] . '"> <br>';
        echo '</form>';
        echo "<FORM method=POST action='index.php'>";
        echo "<input type=submit name='adelante' value='->'>";
        echo "</FORM>";
        echo "<FORM method=POST action='index.php'>";
        echo "<input type=submit name='atras' value='<-'>";
        echo "</FORM>";
        ?>
    </body>
</html>
