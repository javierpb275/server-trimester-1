<?php
ini_set("session.cookie_lifetime", 3600);
session_start();
if (isset($_SESSION["variable"])) {
    echo 'session variable created';
} else {
    $_SESSION["variable"] = "whatever";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        ?>
    </body>
</html>
