<?php

session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie("id", "", time() - 3600 , "/compart");
setcookie("key", "", time() - 3600 , "/compart");
setcookie("role", "", time() - 3600 , "/compart");
setcookie("fullname", "",time() - 3600 , "/compart");

var_dump($_COOKIE);
header("location:../login.php");
exit;
?>