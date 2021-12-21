<?php

class FormEditor extends Form {

    private $keys;
    private $table;
    private $sql;

    public function __construct($con, $table_name, $thesql, $thekeys) {
        parent::__construct($con, $table_name);
        $this->keys = $thekeys;
        $this->table = $table_name;
        $this->sql = $thesql;
    }

    private function saveData() {
        $rregistro = $this->registros[$this->position];
        //UPDATE table SET field0=value0, field1=value1... WHERE key0=value0 AND key1=value1
        $thesql = "UPDATE " . $this->table . "SET ";
        foreach ($registro as $key => $value) {
            $thesql .= $key . '="' . $_POST[$key] . '",';
        }
        $thesql[strlen($thesql) - 1] = ' ';
        $thesql .= ' WHERE ';
        $first_time = true;
        for ($i = 0; $i < count($this->keys); $i++) {
            if (!$first_time) {
                $thesql .= ' AND ';
                $thesql .= $this->keys[$i] . '="' . $registro[$this->keys[$i]] . '"';
            }
            $first_time = false;
        }
        $this->connection->execute();
    }

    public function showForm() {
        $this->loadRegistro();
        if (isset($_POST["_enviar"])) {
            $this->saveData();
        }
        $this->baseForm;
    }

}
