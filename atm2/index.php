<!DOCTYPE html>
<html>
    <head>
        <title>ATM</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>
            <?php
            if (isset($_POST["amount"])) {
                $notes20 = $notes10 = $notes5 = 0;
                $notes20_available = 20;
                $notes10_available = 40;
                $notes5_available = 80;
                $remaining_cost = $_POST["amount"];
                /*
                  $notes20 = intdiv($remaining_cost, 20);

                  if ($notes20 <= $notes20_available) {
                  $notes20_available = $notes20;
                  } else {
                  $notes20 = $notes20_available;
                  $notes20_available = 0;
                  }
                  $remaining_cost -= $notes20 * 20;

                  //--------------------

                  $notes10 = intdiv($remaining_cost, 10);

                  if ($notes10 <= $notes10_available) {
                  $notes10_available = $notes10;
                  } else {
                  $notes10 = $notes10_available;
                  $notes10_available = 0;
                  }
                  $remaining_cost -= $notes10 * 10;

                  //--------------------

                  $notes5 = intdiv($remaining_cost, 5);

                  if ($notes5 <= $notes5_available) {
                  $notes5_available = $notes5;
                  } else {
                  $notes5 = $notes5_available;
                  $notes5_available = 0;
                  }
                  $remaining_cost -= $notes5 * 5; */

                $notes20 = calculate_notes($notes20_available, $remaining_cost, 20);
                $notes10 = calculate_notes($notes10_available, $remaining_cost, 10);
                $notes5 = calculate_notes($notes5_available, $remaining_cost, 5);

                if ($remaining_cost > 0) {
                    printf("cannot withdraw that amount");
                } else {
                    printf("%d notes of €20<br>", $notes20);
                    printf("%d notes of €10<br>", $notes10);
                    printf("%d notes of €5<br>", $notes5);
                }
            } else {
                echo '<form action="index.php" method="post">';
                echo 'withdrawed amount:<input type="text" name="amount"><br>';
                echo '<input type="submit" name="accept" value="withdraw">';
                echo '</form';
            }

            function calculate_notes(&$notes_available, &$amount, $divisor) {
                $wanted_notes = intdiv($amount, $divisor);
                if ($wanted_notes <= $notes_available) {
                    $notes_available -= $wanted_notes;
                } else {
                    $wanted_notes = $notes_available;
                    $notes_available = 0;
                }
                $amount -= $wanted_notes * $divisor;
                return $wanted_notes;
            }
            ?>
        </div>
    </body>
</html>
