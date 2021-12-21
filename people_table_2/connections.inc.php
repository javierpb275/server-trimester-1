<?php

function connect_db() {
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    $db_connection = new PDO('mysql:host=localhost;dbname=' . getenv("dbname"), getenv("dbuser"), getenv("dbpassword"), $options);
    $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db_connection;
}

?>