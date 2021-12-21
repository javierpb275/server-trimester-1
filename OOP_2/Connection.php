<?php

class Connection {

    public $connection;

    public function __construct() {
        try {
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            $this->connection = new PDO('mysql:host=localhost;dbname=' . getenv("dbname"), getenv("dbuser"), getenv("dbpassword"), $options);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            $this->connection = null;
        }
    }

    public function __destruct() {
        $this->connection = null;
    }

}

?>
