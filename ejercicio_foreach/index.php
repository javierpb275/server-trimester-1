<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST" id="form1">
            <label>
                <input type="checkbox" id="function0" value="function0" name="function0"> 
                function0
            </label><br>
            <input type="checkbox" id="function1" value="function1" name="function1"> 
            <label for="function1">function1</label>
        </form>
        <button type="submit" form="form1" value="Submit">Submit</button>

        <?php

        function function0() {
            echo "function0";
        }

        function function1() {
            echo "function1";
        }

        $functions_array = array(
            "function0" => function0,
            "function1" => function1,
        );

        if (isset($_POST["function0"])) {
            $functions_array["function0"]();
        }
        if (isset($_POST["function1"])) {
            $functions_array["function1"]();
        }


        /*
          foreach ($_SERVER as $key => $value) {
          print "<table style='border:solid black 1px;'>";
          print "<tr style='border:solid black 1px;'>";
          print "<td style='border:solid black 1px;'>";
          print $key;
          print "</td>";
          print "<td style='border:solid black 1px;'>";
          print $value;
          print "</td>";
          print "</tr>";
          print "</table>";
          }

          $my_array["key1"]["key2"] = "hello";
          print_r($my_array);

          $my_array["function_1"] = function_1;
          $my_array["function_1"]();

          function function_1() {
          echo 'HELLO';
          }

         */
        ?>
    </body>
</html>
