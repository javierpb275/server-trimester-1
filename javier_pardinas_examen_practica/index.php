<?php

require_once 'Connection.php';
require_once 'Form.php';

ini_set('display_errors', 1);

$con = new Connection();
if ($con->connection)
    $form= new Form($con->connection, "cliente");
else
    echo "unable to connect to database";

 $form->show_form();
?>
