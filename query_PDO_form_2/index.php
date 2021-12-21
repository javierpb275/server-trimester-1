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
                $con = connect_db();
                if (!isset($_POST["deleteUsers"])) {


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



                    $query = $con->prepare($sql);

                    $query->execute($params);

                    echo '<form method="POST" id="users-form" action=' . $_SERVER["PHP_SELF"] . '>';
                    while ($user = $query->fetch()) {

                        echo '<input type="checkbox" name="check[]" value=' . '"' . $user["id_user"] . '"' . '>';
                        echo '<label for=' . '"' . $user["id_user"] . '"' . '>' . $user["name"] . ' ' . $user["lastname"] . '</label>';
                        echo '<br>';
                    }
                    echo '<input type="submit" value="delete users" name="deleteUsers">';
                    echo '</form><br>';
                } else { //check if there's checkboxes if delete button is set
                    //var_dump($_POST);
                    $checks = $_POST["check"];
                    $query = $con->prepare("DELETE FROM user WHERE id_user=:id");
                    $query->bindParam(":id", /* $param_id */ $id, PDO::PARAM_INT);

                    foreach ($checks as $id) {
                        //$param_id = $id;
                        $query->execute();
                    }
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
