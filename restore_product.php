<?php 
include("./functions/koneksi.php");
include("./functions/session.php");
include("./functions/product.php");
seller();
$id = $_GET['id'];
$modified_at = date("Y-m-d H:i:s");

$query = "UPDATE `product` SET `modified_at` = '$modified_at', `deleted_at` = NULL WHERE `product`.`id` = $id";
mysqli_query($conn, $query);
$conn->close();
header("location:archive.php");
?>