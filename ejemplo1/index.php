<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ejemplo1</title>
    </head>
    <body>
        <form method="get">
            rows:  <input type="text" name="rows" /><br />
            columns: <input type="text" name="columns" /><br />
            <input type="submit" name="submit" value="Submit me!" />
        </form>
        <?php
        if (isset($_REQUEST['rows']) && isset($_REQUEST['columns'])) {
            $c = 0;
            print "<table style='border:solid black 1px;'>";
            for ($a = 0; $a < $_REQUEST['rows']; $a++) {
                print "<tr style='border:solid black 1px;'>";
                for ($b = 0; $b < $_REQUEST['columns']; $b++) {
                    print "<td style='border:solid black 1px;'>";
                    print $c;
                    print "</td>";
                    $c++;
                }
                print "</tr>";
            }

            print "</table>";
        } else {
            print 'missing rows and columns';
        }
        ?>
    </body>
</html>
