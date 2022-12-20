<?php
include("./session.php");
include("./koneksi.php");
user();
var_dump($_POST);
$cartId = $_POST["cart_id"];
$status = $_POST["status"];
$quantity = $_POST["quantity"];
$total = $_POST["total"];
$productId = $_POST["product_id"];
$sellerId = $_POST["seller_id"];
$userId = $_POST["user_id"];
$created_at = date("Y-m-d H:i:s");

$queryCheckout = "INSERT INTO `checkout_session` (`id`, `status`, `quantity`, `total`, `created_at`, `deleted_at`, `product_id`, `seller_id`, `user_id`) VALUES (NULL, '$status', '$quantity', '$total', '$created_at', NULL, '$productId', '$sellerId', '$userId') ";
mysqli_query($conn, $queryCheckout);
$queryCart = "DELETE FROM cart_item WHERE id = '$cartId'";
mysqli_query($conn, $queryCart);
$conn->close();

// INSERT INTO `checkout_session` (`id`, `status`, `quantity`, `total`, `created_at`, `deleted_at`, `product_id`, `seller_id`, `user_id`) VALUES (NULL, '0', '13', '12', NULL, NULL, '43', '5', '9');
header('location:../checkout_status.php');
