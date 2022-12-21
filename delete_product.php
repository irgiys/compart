<?php 
include("./functions/koneksi.php");
include("./functions/session.php");
seller();

$id = $_GET['id'];
$sellerId = $_SESSION["id"];
$deleted_at = date("Y-m-d H:i:s");
$query = "DELETE FROM product WHERE id = '$id' AND seller_id = '$sellerId'";
mysqli_query($conn, $query);
$conn->close();
header("location:archive.php");
