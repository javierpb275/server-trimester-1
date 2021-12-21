<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>people table</title>
    </head>
    <body>
        <?php
;
        require_once 'connections.inc.php';
        ini_set("session.cookie_lifetime", 300);
        session_start();

        try {
            $con = connect_db();
            $query = $con->query("SELECT * FROM user");
            $users = $query->fetchAll();

            if (!isset($_SESSION["position"])) {
                $_SESSION["position"] = 0;
            }

            if (isset($_POST["forward"])) {
                if ($_SESSION["position"] + 4 < count($users)) {
                    $_SESSION["position"] += 4;
                }
            }

            if (isset($_POST["backwards"])) {
                if ($_SESSION["position"] > 0) {
                    $_SESSION["position"] -= 4;
                }
            }

            $user = $users[0];
  
            echo "<table border=1><tr>";
            foreach ($user as $key=> $value) {
                if (!is_numeric($key))
                    echo "<th>$key</th>";
            }
            echo "</tr>";
            
            for ($i=$_SESSION["position"]; $i<$_SESSION["position"]+4; $i++) {
               echo '<tr>';
               foreach ($users[$i] as $key=> $value) {
                   if (!is_numeric($key))
                    echo "<th>$value</th>";
               }
               echo '</tr>';
            }
            
            echo '</table>';

            echo "<form method=POST action='index.php'>";
            echo "<input type=submit name='backwards' value='<'/>";
            echo "<input type=submit name='forward' value='>'/>";
            echo "</form>";
        } catch (Exception $ex) {
            echo $ex->getMessage();
        } finally {
            $con = null;
        }
        ?>
    </body>
</html>
