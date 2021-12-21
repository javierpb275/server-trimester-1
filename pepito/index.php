<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'connections.int.php';

        $db_connection = connect_db();
        
        $db_connection->autocommit(true);//able/unable automatic transaction
        //mysqli_commit(), mysqli_rollback(),

        if (!$db_connection->connect_errno) {

            $query = $db_connection->query('SELECT * FROM user');

            do {
                $user = $query->fetch_object();
                if ($user) {
                    echo $user->id_user . ' / ' . $user->name . ' / ' . $user->lastname . '<br>';
                }
            } while ($user);
        } else {
            print $db_connection->connect_errno;
        }
        ?>
    </body>
</html>
