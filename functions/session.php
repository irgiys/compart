<?php
session_start();
// role 1 = customer
// role 2 = seller
// role 3 = admin
function user()
{
    if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "1") {
        header("location:login.php");
        exit;
    }
}
function seller($url = "login.php")
{
    if ($_SESSION["role"] === "3") {
        exit;
    }
    if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "2") {
        header("location:$url");
        exit;
    }
}
function admin($url = "login.php")
{
    if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "3") {
        header("location:$url");
        exit;
    }
}
