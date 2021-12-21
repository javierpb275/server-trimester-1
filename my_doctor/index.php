<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>My Doctor</title>
    </head>
    <body>
        <form method="POST" id="symptoms-form" action="index.php">
            <input type="checkbox" id="cough-checkbox" value="cough" name="cough"> 
            <label for="cough-checkbox">cough</label>
            <input type="checkbox" id="dizzy-checkbox" value="dizzy" name="dizzy"> 
            <label for="dizzy-checkbox">dizzy</label>
            <input type="checkbox" id="headache-checkbox" value="headache" name="headache"> 
            <label for="headache-checkbox">headache</label>
            <input type="checkbox" id="stomachache-checkbox" value="stomachache" name="stomachache"> 
            <label for="stomachache-checkbox">stomachache</label>
            <input type="checkbox" id="chest-pain-checkbox" value="chest-pain" name="chest-pain"> 
            <label for="chest-pain-checkbox">chest pain</label>
            <input type="submit" value="Get Diagnosis" name="submitButton">
        </form>

        <?php
        $diagnosises_array = array(
            "cough" => "You have a cold.",
            "dizzy" => "You have the flu.",
            "headache" => "You have migraines.",
            "stomachache" => "You are constipated.",
            "chest-pain" => "You are having a heart attack."
        );

        function returnDiagnosis() {
            global $diagnosises_array;
            if (count($_POST) == 2) { //when 1 symptom is selected
                foreach ($diagnosises_array as $key => $value) {
                    if (isset($_POST[$key])) {
                        echo $value . "<br>";
                        return;
                    }
                }
            } elseif (count($_POST) == 3) { //when 2 symptoms are selected
                returnDiagnosisWith2Symptoms();
            } elseif (count($_POST) == 4) { //when 3 symptoms are selected
                returnDiagnosisWith3Symptoms();
            } elseif (count($_POST) == 5) { //when 4 symptoms are selected
                echo"You are basically dieing";
            } elseif (count($_POST) > 5) { //when all symptoms are selected
                echo "You have COVID-19";
            } else { //if no symptom selected
                echo "You look great!";
            }
        }

        function returnDiagnosisWith2Symptoms() {
            if (isset($_POST["cough"]) and isset($_POST["dizzy"])) {
                echo "You have cancer";
            } elseif (isset($_POST["cough"]) and isset($_POST["headache"])) {
                echo "You have a brain tumor";
            } elseif (isset($_POST["cough"]) and isset($_POST["stomachache"])) {
                echo "You have a brain tumor";
            } elseif (isset($_POST["cough"]) and isset($_POST["chest-pain"])) {
                echo "You have lung cancer";
            } elseif (isset($_POST["dizzy"]) and isset($_POST["stomachache"])) {
                echo "You have diarrhea";
            } elseif (isset($_POST["dizzy"]) and isset($_POST["chest-pain"])) {
                echo "You have lung cancer";
            } elseif (isset($_POST["dizzy"]) and isset($_POST["headache"])) {
                echo "You have AIDS";
            } elseif (isset($_POST["headache"]) and isset($_POST["stomachache"])) {
                echo "You have the flu";
            } elseif (isset($_POST["headache"]) and isset($_POST["chest-pain"])) {
                echo "You have lung cancer";
            } elseif (isset($_POST["stomachache"]) and isset($_POST["chest-pain"])) {
                echo "You have eaten rotten food";
            } else {
                echo "You look awful. Get some rest.";
            }
        }

        function returnDiagnosisWith3Symptoms() {
            if (isset($_POST["cough"]) and isset($_POST["dizzy"]) and isset($_POST["headache"])) {
                echo "You have the flu";
            } elseif (isset($_POST["cough"]) and isset($_POST["headache"]) and isset($_POST["stomachache"])) {
                echo "You have the flu";
            } elseif (isset($_POST["cough"]) and isset($_POST["stomachache"]) and isset($_POST["chest-pain"])) {
                echo "You have etaten rotten food";
            } elseif (isset($_POST["dizzy"]) and isset($_POST["headache"]) and isset($_POST["stomachache"])) {
                echo "You have the flu";
            } else {
                echo "You look awful. Get some rest.";
            }
        }


        if (isset($_POST["submitButton"])) {
            returnDiagnosis();
        }
        ?>
    </body>
</html>
