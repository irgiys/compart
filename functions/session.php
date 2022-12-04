<?php
session_start();
// role 1 = customer
// role 2 = seller
function user(){
    if(!isset($_SESSION["role"]) || $_SESSION["role"] !== "1"){
        header("location:login.php");
        exit;
    }
}
function seller($url = "login.php"){
    if(!isset($_SESSION["role"]) || $_SESSION["role"] !== "2"){
        header("location:$url");
        exit;
    }
}
$_SESSION["fullname"];
$_SESSION["id"];
?>