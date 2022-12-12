<?php
include("koneksi.php");
function addChart($data){
    global $conn;
    $amount = $data["amount"];
    $quantity = $data["quantity"];
    $created_at = date("Y-m-d H:i:s");

    $product_id = $data["product_id"];
    $user_id = $data["user_id"];


    // cek apakah sudah ada product yang sama di chart
    $cekQuery = "SELECT product_id, user_id FROM cart_item WHERE product_id = '$product_id' AND user_id = '$user_id'";
    $result = mysqli_query($conn, $cekQuery);
    if(mysqli_fetch_assoc($result) !== NULL){
        $query = "UPDATE `cart_item` 
                SET `amount` = `amount` + $amount, `quantity` = `quantity` + $quantity, `modified_at` = '$created_at'
                WHERE product_id = '$product_id' AND user_id = '$user_id'";
        mysqli_query($conn, $query);
        return false;
    }

    // jika tidak tambahkan cart 
    $query = "INSERT INTO `cart_item` (`id`, `amount`, `quantity`, `created_at`, `modified_at`, `deleted_at`, `product_id`, `user_id`) VALUES (NULL, '$amount', '$quantity', '$created_at', NULL, NULL, '$product_id', '$user_id')";

    $result2  =   mysqli_query($conn, $query);
    var_dump($result2);
    return  mysqli_affected_rows($conn);
}
addChart($_POST);
$id = $_POST["product_id"];
$url = "/compart/detail_product.php?id=" . $id;
header("location:$url")
?>