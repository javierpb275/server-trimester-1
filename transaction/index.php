<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>transaction</title>
    </head>
    <body>
        <?php
        require_once 'connections.inc.php';

        echo '<form method="POST" action="index.php">';
        echo '<input type="submit" name="commit" value="commit"';
        echo '<form/>';

        echo '<form method="POST" action="index.php">';
        echo '<input type="submit" name="rollback" value="rollback"';
        echo '<form/>';

        if (isset($_POST["commit"])) {
            try {
                $con = connect_db();
                $con->beginTransaction();
                $con->exec("UPDATE product_store SET stock=stock-7 WHERE id_store=1 AND id_product=2");
                $con->exec("UPDATE product_store SET stock=stock+7 WHERE id_store=2 AND id_product=2");
                $con->commit();
            } catch (PDOException $ex) {
                $con->rollBack();
                echo "Error transaction";
            } finally {
                $con = null;
            }
        }

        if (isset($_POST["rollback"])) {
            $con = connect_db();
            $con->beginTransaction();
            $con->exec("UPDATE product_store SET stock=stock-7 WHERE id_store=1 AND id_product=2");
            $con->exec("UPDATE product_store SET stock=stock+7 WHERE id_store=2 AND id_product=2");
            $con->rollBack();
            $con = null;
        }
        ?>
    </body>
</html>
