<?php

class Form {

    private $connection;
    private $registros;
    private $position;
    private $table_name;

    public function __construct($con, $table_name) {
        session_start();
        if ($_SESSION['_position_']) {
            $this->position = $_SESSION['_position_'];
        } else {
            $this->position = 0;
            $_SESSION['_position_'] = $this->position;
        }
        if (!$con) {
            throw Exception("no open connection");
        }
        $this->connection = $con;
        $this->table_name = $table_name;
    }

    private function loadRegistros() {
        $query = $this->connection->query("SELECT * FROM $this->table_name");
        $this->registros = $query->fetchall(PDO::FETCH_ASSOC);
    }
    
    private function updateRegistro($column_name, $row_value, $registro) {
        $query = $this->connection->prepare("UPDATE $this->table_name SET $column_name=:$row_value WHERE $registro[0]=$this->position");
        $query->execute();
    }

    public function showForm() {
        $this->loadRegistros();
        if (isset($_POST["_backwards_"])) {
            if ($this->position > 0) {
                $this->position--;
                $_SESSION["_position_"] = $this->position;
            }
        } elseif (isset($_POST["_forward_"])) {
            if ($this->position < count($this->registros) - 1) {
                $this->position++;
                $_SESSION["_position_"] = $this->position;
            }
        }
        $registro = $this->registros[$this->position];

        echo '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';
        foreach ($registro as $key => $value) {
            if (!is_numeric($key)) {
                echo $key . '<input type="text" name="' . $key . '" value="' .
                $value . '"> <br>';
                if ($_POST["_update_"]) {
                    $this->updateRegistro($key, $_POST[$key], $registro);
                }
            }
        }
        echo '</form>';

        echo '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';
        echo "<input type=submit name='_forward_' value='->'>";
        echo "</FORM>";
        echo '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';
        echo "<input type=submit name='_backwards_' value='<-'>";
        echo "</FORM>";
        echo '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';
        echo "<input type=submit name='_update_' value='update'>";
        echo "</FORM>";
    }

}

?>
