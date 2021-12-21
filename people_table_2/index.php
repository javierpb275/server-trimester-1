<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>people table 2</title>
    </head>
    <body>
        <?php
        ini_set('display_errors', 1);
        require_once 'connections.inc.php';
        $con = connect_db();
        $result = $con->query("SELECT * FROM user");
        //https://www.allphptricks.com/create-simple-pagination-using-php-and-mysqli/
        ?>
    </body>
</html>
