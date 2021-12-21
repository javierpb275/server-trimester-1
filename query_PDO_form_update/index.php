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

        echo '<form action="' . $_SERVER["PHP_SELF"] . '"method="post">';
        echo 'Name: <input type="text" name="name"> <br>';
        echo 'LastName: <input type="text" name="lastname"> <br>';
        echo '<input type="submit" name="accept" value="Search"> <br>';
        echo '<form>';

        if (count($_POST) > 0) {

            try {

                $wheres = array();
                $params = array();
                if (!empty($_POST['name'])) {
                    $wheres[] = 'user.name = :name';
                    $params[':name'] = $_POST['name'];
                }
                if (!empty($_POST['lastname'])) {
                    $wheres[] = 'user.lastname = :lastname';
                    $params[':lastname'] = $_POST['lastname'];
                }

                $sql = "SELECT * FROM user AS user";

                if (!empty($wheres)) {
                    $sql .= " WHERE " . implode(' AND ', $wheres);
                }

                $con = connect_db();

                $query = $con->prepare($sql);

                $query->execute($params);

                while ($user = $query->fetch()) {
                    echo '<a href="edit.php?id=' . $user["id_user"] . '">';
                    echo $user["name"] . "/" . $user["lastname"] . "<br>";
                    echo '</a>';
                }
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            } finally {
                $query = null;
                $con = null;
            }
        }
        ?>
    </body>
</html>
