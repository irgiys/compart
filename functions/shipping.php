<?php
include("./koneksi.php");
include("./session.php");

seller();
$id = $_GET["id"];
$userId = $_SESSION["id"];
$query = "UPDATE `checkout_session` SET `status` = '1'  WHERE  seller_id = '$userId' AND id = '$id'";
mysqli_query($conn, $query);
$conn->close();
header("location:../order.php");
