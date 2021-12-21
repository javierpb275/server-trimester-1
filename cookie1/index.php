<?php
if (isset($_COOKIE["visits_number"])) {
    $visits = $_COOKIE["visits_number"];
} else {
    $visits = 0;
}
if (isset($_COOKIE["last_date"])) {
    $last_time = $_COOKIE["last_date"];
} else {
    $last_time = time();
}
setcookie("last_date", time(), time() + (3600 * 24 * 365));
setcookie("visits_number", $visits += 1, time() + (3600 * 24 * 365));
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>cookie 1</title>
    </head>
    <body>
        <?php
        echo "you have visited this page on the: " . date('m/d/Y h:i:s a', $last_time);
        echo "you have visited this page " . $visits . " times";
        ?>
    </body>
</html>
