<?php

require_once 'connections.inc.php';

try {
    $con = connect_db();
    if (isset($_GET["id"])) {
        $query = $con->prepare("SELECT * FROM user WHERE id_user=:id");
        $query->bindParam(":id", $id);
        $id = $_GET["id"];
        $query->execute();
        $user = $query->fetch();
        if ($user) {
            echo '<form action="' . $_SERVER["PHP_SELF"] . '"method="post">';
            echo 'Name: <input type="text" name="name" value="' . $user["name"] . '"> <br>';
            echo 'LastName: <input type="text" name="lastname" value="' . $user["lastname"] . '"> <br>';
            echo '<input type="hidden" name="id" value="' . $user["id_user"] . '"> <br>';
            echo '<input type="submit" name="accept" value="Update"> <br>';
            echo '<form>';
        }
    } else {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $lastname = $_POST["lastname"];
        $query = $con->prepare('UPDATE user SET name=:name, lastname=:lastname WHERE id_user=:id');
        $query->bindParam(":id", $id);
        $query->bindParam(":name", $name);
        $query->bindParam(":lastname", $lastname);
        $users_updated = $query->execute();
        echo $users_updated . " user has been updated";
    }
} catch (PDOException $ex) {
    echo $ex->getMessage();
} finally {
    $query = null;
    $con = null;
}
?>

