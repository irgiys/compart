<?php
include("./functions/koneksi.php");
include("./functions/session.php");


$id = $_GET['id'];
$deleted_at = date("Y-m-d H:i:s");
$query = "UPDATE `product` SET `deleted_at` = '$deleted_at' WHERE `product`.`id` = $id";
mysqli_query($conn, $query);
$conn->close();
if ($_SESSION["role"] === '3') {
    admin();
    header('location:admin_dashboard.php');
    exit;
}
if ($_SESSION["role"] === '2') {
    seller();
    header("location:dashboard.php");
    exit;
}
