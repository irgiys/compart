<?php
include("./functions/koneksi.php");
include("./functions/session.php");

user();
$id = $_GET["id"];
$userId = $_SESSION["id"];
$query = "DELETE FROM cart_item WHERE user_id = '$userId' AND id = '$id'";
mysqli_query($conn, $query);
$conn->close();
header("location:cart.php");
