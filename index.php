<?php
session_start();
// $fullname = $_SESSION["fullname"];
if(isset($_GET["logout"]) == "false"){
    echo "<script>
            alert('logout dulu')
        </script>
    ";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
        <link rel="stylesheet" href="css/custom.min.css" />
    </head>
    <body>
        <h1>
            <!-- <?= $fullname ?> -->
        </h1>
        <p class="bg-primary">Hello world</p>
        <button></button>
        <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>
