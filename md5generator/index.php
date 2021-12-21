<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo '<form action="' . $_SERVER["PHP_SELF"] . '"method="post">';
        echo 'Introduzca unacadena: <input type="text" name="chain"> <br>';
        echo '<input type="submit" name="generate" value="Generate"> <br>';
        echo '<form>';
        if (isset($_POST["generate"])) {
            $mimd5 = md5($_POST["chain"]);
            echo "Your hash md5 is $mimd5";
        }
        ?>
    </body>
</html>
