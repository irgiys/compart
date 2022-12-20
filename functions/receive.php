<?php
include("./koneksi.php");
include("./session.php");

user();
$id = $_GET["id"];
$productId = $_GET["product_id"];
$quantity = $_GET["quantity"];
$total = $_GET["total"];
$userId = $_SESSION["id"];
$modified_at = date("Y-m-d H:i:s");
$queryCheckout = "UPDATE `checkout_session` SET `status` = '2', `modified_at` = '$modified_at' WHERE  user_id = '$userId' AND id = '$id'";
mysqli_query($conn, $queryCheckout);

$queryProduct = "SELECT inventory_id FROM product WHERE id = '$productId'";
$invetoryId = mysqli_query($conn, $queryProduct);
$invetoryId = mysqli_fetch_assoc($invetoryId);
$invetoryId = $invetoryId["inventory_id"];

$queryInventory = "UPDATE `product_inventory` SET `quantity` = `quantity` - $quantity, `sold` = `sold` + $quantity WHERE id = '$invetoryId'";
mysqli_query($conn, $queryInventory);
$conn->close();
// var_dump();
var_dump($quantity);
var_dump($total);
var_dump($productId);
header("location:../checkout_status.php");
