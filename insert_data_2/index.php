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


        $con = connect_db();
        if (!$con->connect_errno) {
            try {
                $name = $lastname = "";
                $query = $con->stmt_init();
                $query->prepare("insert into user (id_user, name, lastname) values (null, ?, ?)");
                $query->bind_param("ss", $name, $lastname);
                $name = "paco";
                $lastname = "paquito";
                $query->execute();
                $name = "maria";
                $lastname = "mery";
                $query->execute();
                if ($query->error != null)
                    throw new Exception($query->error);
            } catch (Exception $ex) {
                echo $ex->getMessage();
            } finally {
                $query->close();
                $con->close();
            }
        }
        ?>
    </body>
</html>