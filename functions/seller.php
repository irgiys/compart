<?php
    include("koneksi.php");
    function addAddress($data){
        global $conn;
        $addressLine = $data["address_line"];
        $city = $data["city"];
        $sellerId = $data["seller_id"];
        $postalCode = $data["postal_code"];
        $query = "INSERT INTO seller_address (`id`, `address_line`, `city`, `postal_code`, `seller_id`) VALUES (NULL,'$addressLine', '$city', '$postalCode', '$sellerId')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    };
    function updateAddress($data){
        global $conn;
        $addressLine = $data["address_line"];
        $city = $data["city"];
        $postalCode = $data["postal_code"];
        $sellerId = $data["seller_id"];
        $query = "UPDATE `seller_address` SET `address_line` = '$addressLine', `city`= '$city', `postal_code` = '$postalCode' WHERE `seller_address`.`seller_id` = $sellerId";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
