<?php

function connect_db() {
    $db_connection = new mysqli("localhost", getenv("dbuser"), getenv("dbpassword"), getenv("dbname"));
    return $db_connection;
}

?>