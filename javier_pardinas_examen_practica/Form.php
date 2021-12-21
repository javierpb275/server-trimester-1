<?php

class Form {

    protected $table_name;
    protected $connection;
    protected $rows;
    protected $position;
    protected $query;

    public function __construct($con, $table_name) {
        if ($con == null) {
            throw Exception("connection is not open");
        }
        $this->connection = $con;
        $this->table_name = $table_name;
    }

    protected function load_rows() {
        $this->query = $this->connection->query("SELECT * FROM $this->table_name");
        $this->rows = $this->query->fetchall(PDO::FETCH_ASSOC);
    }

    public function show_form() {
        $this->load_rows();
        $this->base_form();
    }

    protected function base_form() {

        ini_set("session.cookie_lifetime", 300);
        session_start();

        if (!isset($_SESSION["number_rows"])) {
            $_SESSION["number_rows"] = 4;
        }

        if (isset($_POST["set_number_rows"])) {
            $_SESSION["number_rows"] = $_POST["input_number_rows"];
            $_SESSION["position_exam"] = 0;
        }

        if (!isset($_SESSION["position_exam"])) {
            $_SESSION["position_exam"] = 0;
        }
        
        if (isset($_POST["forward_exam"])) {
            if ($_SESSION["position_exam"] + $_SESSION["number_rows"] < count($this->rows)) {
                $_SESSION["position_exam"] += $_SESSION["number_rows"];
            }
        }

        if (isset($_POST["backwards_exam"])) {
            if ($_SESSION["position_exam"] > 0) {
                $_SESSION["position_exam"] -= $_SESSION["number_rows"];
            }
        }

        $row = $this->rows[0];

        echo "<table border=1><tr>";
        foreach ($row as $key => $value) {
            if (!is_numeric($key))
                echo "<th>$key</th>";
        }
        echo "</tr>";

        for ($i = $_SESSION["position_exam"]; $i < $_SESSION["position_exam"] + $_SESSION["number_rows"]; $i++) {
            echo '<tr>';
            foreach ($this->rows[$i] as $key => $value) {
                if (!is_numeric($key))
                    echo "<th>$value</th>";
            }
            echo '</tr>';
        }

        echo '</table>';

        echo "<table border=0><tr><td><FORM method=POST action='" . $_SERVER["PHP_SELF"] . "'>";
        echo "<input type=submit name='backwards_exam' value='<-'>";
        echo "</FORM></td>";
        echo "<td><FORM method=POST action='" . $_SERVER["PHP_SELF"] . "'>";
        echo "<input type=submit name='forward_exam' value='->'>";
        echo "</FORM></td></tr></table>";
        echo "<FORM method=POST action='" . $_SERVER["PHP_SELF"] . "'>";
        echo "<input type=text name='input_number_rows' value='" . $_SESSION["number_rows"] . "'>";
        echo "<input type=submit name='set_number_rows' value='set number rows'>";
        echo "</FORM>";
    }

}
