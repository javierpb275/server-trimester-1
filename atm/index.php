<!DOCTYPE html>
<html>
    <head>
        <title>ATM</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form method="post" action="index.php">
            Introduce amount:<br>  
            <input type="text" name="withdrawAmount" /><br />
            <input type="submit" name="submit" value="Submit me!" />
        </form>
        <div>
            <?php
            $notes = array(
                (object) array(
                    'amount' => 10,
                    'quantity' => 50,
                ),
                (object) array(
                    'amount' => 20,
                    'quantity' => 40,
                ),
                (object) array(
                    'amount' => 50,
                    'quantity' => 30,
                ),
                (object) array(
                    'amount' => 100,
                    'quantity' => 20,
                ),
                (object) array(
                    'amount' => 200,
                    'quantity' => 10,
                ),
                (object) array(
                    'amount' => 500,
                    'quantity' => 5,
                ),
            );

            function calculate($value) {
                if (isset($_REQUEST['withdrawAmount'])) {
                    if ($value > $notes[5]->amount and $notes[5]->quantity > 0) {
                        
                    }
                }
            }
            ?>
        </div>
    </body>
</html>
