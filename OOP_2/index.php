<?php
require_once 'Connection.php';
require_once 'Form.php';
ini_set("session.cookie_lifetime", 120);

$con = new Connection();

if ($con->connection) {
    $form = new Form($con->connection, "user");
} else {
    echo 'unable to connect to db';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>OOP 2</title>
    </head>
    <body>
        <?php
        $form->showForm();
        ?>
    </body>
</html>
