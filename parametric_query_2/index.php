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
            $con = connect_db();
            if (!$con->connect_errno) {
                try {
                    $query = $con->stmt_init();
                    $chain_query = "SELECT name, lastname FROM user";
                    if (!empty($_POST["name"])) {
                        $chain_query .= " WHERE name=?";
                        if (!empty($_POST["lastname"])) {
                            $chain_query .= " AND lastname=?";
                        }
                    } else {
                        if (!empty($_POST["lastname"])) {
                            $chain_query .= " WHERE lastname=?";
                        }
                    }
                    $query->prepare($chain_query);
                    if (!empty($_POST["name"]) and empty($_POST["lastname"])) {
                        $query->bind_param("s", $_POST["name"]);
                    } else if (empty($_POST["name"]) and (!empty($_POST["lastname"]))) {
                        $query->bind_param("s", $_POST["lastname"]);
                    } else if (!empty($_POST["lastname"]) and (!empty($_POST["lastname"]))) {
                        $query->bind_param("ss", $_POST["name"], $_POST["lastname"]);
                    }

                    $query->bind_result($name, $lastname);
                    $query->execute();
                    while ($query->fetch()) {
                        echo ("Name: " . $name . " LastName: " . $lastname);
                    };
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
