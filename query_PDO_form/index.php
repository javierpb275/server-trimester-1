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
                if (empty($_POST['name']) || empty($_POST["lastname"])) {
                    echo "you must fill out all the fields<br>";
                } else {
                    $con = connect_db();
                    $sql = "SELECT name, lastname FROM user WHERE name=:name AND lastname=:lastname";
                    $query = $con->prepare($sql);
                    $query->bindParam(":name", $name, PDO::PARAM_STR);
                    $query->bindParam(":lastname", $lastname, PDO::PARAM_STR);
                    $name = $_POST["name"];
                    $lastname = $_POST["lastname"];
                    $query->execute();
                    while ($user = $query->fetch()) {
                        echo $user["name"] . "/" . $user["lastname"] . "<br>";
                    }
                }
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            } finally {
                $query=null;
                $con = null;
            }
        }
        ?>
    </body>
</html>
