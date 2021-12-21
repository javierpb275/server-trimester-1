<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        ini_set('display_errors', 1);
        require_once 'connections.int.php';
        echo '<form action="' . $_SERVER["PHP_SELF"] . '"method="post">';
        echo 'Name: <input type="text" name="name"> <br>';
        echo 'LastName: <input type="text" name="lastname"> <br>';
        echo '<input type="submit" name="accept" value="Insert"> <br>';
        echo '<form>';
        if (count($_POST) > 0) {
            $con = connect_db();
            if (!$con->connect_errno) {
                try {
                    $query = $con->stmt_init();
                    $query->prepare("insert into user (id_user, name, lastname) values (null, ?, ?)");
                    $query->bind_param("ss", $_POST["name"], $_POST["lastname"]);
                    $query->execute();
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                } finally {
                    $query->close();
                    $con->close();
                }
            }
        }
        ?>
    </body>
</html>
