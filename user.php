<?php
include("./functions/session.php");
user();
$role = $_SESSION["role"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>
        <?= $role ?>
    </p>
    <p>user</p>
</body>

</html>