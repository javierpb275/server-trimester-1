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
            $result = $con->query("SELECT * FROM user");
            $result->bindColumn(1, $name);
            $result->bindColumn(2, $lastname);
            while ($user = $result->fetch(PDO::FETCH_BOUND) ){
                echo $name. " / " . $lastname . "<br>";
                //var_dump($user);echo "<br>";
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        } finally {
            $con = null;
        }
        ?>
    </body>
</html>
