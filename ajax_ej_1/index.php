<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ajax example 1</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
        <script>
            const validate_data = () => {
                //const theIdValue = document.getElementById("id").value;
                let theId = $("#id").val();
                let theName = $("#name").val();
                $.ajax({
                    type: "POST",
                    url: "check_id.php",
                    data: `id_producto=${theId}&nombre=${theName}`,
                    success: (result) => {
                        $("#mipanel").html(result);
                        //document.getElementById("mipanel").innerHTML=result;
                        //alert(`Result: ${result}`);
                    }
                })
            }
            $(document).ready(() => {
                $("#id").blur(() => {
                    validate_data();
                })
            });
        </script>
        <form action="" method="POST">
            ID: <input type="text" id="id"/>
            NAME : <input type="text" id="name"/>
        </form>
        <div id="mipanel"></div>
        <?php
        ?>
    </body>
</html>
