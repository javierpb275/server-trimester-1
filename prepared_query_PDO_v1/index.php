<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        ini_set('display_errors', 1);
        require_once 'connections.inc.php';

        try {
            $con = connect_db();
            $sql = "SELECT name, lastname FROM user WHERE name=:name AND lastname=:lastname";
            $query = $con->prepare($sql /*array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY)*/);
            $query->bindParam(":name", $name, PDO::PARAM_STR);
            $query->bindParam(":lastname", $lastname, PDO::PARAM_STR);
            $name = "pepe";
            $lastname = "rodriguez";
            $query->execute();
            while ($user = $query->fetch()) {
                echo $user["name"]."/".$user["lastname"]. "<br>";
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        } finally {
            
            $con = null;
        }
        ?>
    </body>
</html>
