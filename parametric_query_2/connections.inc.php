<?php

function connect_db() {
    $db_connection = new mysqli("localhost", getenv("dbuser"), getenv("dbpassword"), getenv("dbname"));
    $db_connection->set_charset("utf8");
    return $db_connection;
}

?>