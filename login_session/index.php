<?php
require_once 'connections.inc.php';
ini_set("session.cookie_lifetime", 60);
session_start();
if (isset($_SESSION["login"])) {
    header("Location: http://localhost/DWES/login_session/store.php");
} elseif (isset($_POST["accept"])) {
    $con = connect_db();
    $query = $con->prepare("SELECT login, password FROM login WHERE login=:login");
    $query->bindParam(":login", $login);
    $login = $_POST["login"];
    $query->execute();
    if ($user = $query->fetch()) {
        $md5 = md5($_POST["password"]);
        if (strcmp($md5, $user["password"]) == 0) {
            $_SESSION["login"] = $user["login"];
            header("Location: http://localhost/DWES/login_session/store.php");
        }
    } else {
        echo 'wrong credentials';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>the store</title>
    </head>
    <body>
        <script>
            const validate_data = () => {
                //const theIdValue = document.getElementById("id").value;
                let theLogin = $("#login").val();
                let thePassword = $("#password").val();
                $.ajax({
                    type: "POST",
                    url: "store.php",
                    data: `login=${theLogin}&password=${thePassword}`,
                    success: (result) => {
                        $("#mipanel").html(result);
                        //document.getElementById("mipanel").innerHTML=result;
                        //alert(`Result: ${result}`);
                    }
                })
            }
            $(document).ready(() => {
                $("#id").blur(() => {
                    validate_data();
                })
            });
        </script>
        <form method="POST">
            Login: <input type="text" id="login"/><br>
            Password: <input type="text" id="password"/><br>
            <input type="submit" id="button_submit" value="Login"/><br>
        </form>
        <div id="mipanel"></div>
        <?php
        echo '<form action="' . $_SERVER["PHP_SELF"] . '"method="post">';
        echo 'Login: <input type="text" name="login"> <br>';
        echo 'Password: <input type="password" name="password"> <br>';
        echo '<input type="submit" name="accept" value="Login"> <br>';
        echo '<form>';
        ?>
    </body>
</html>
