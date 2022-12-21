<?php
    include("koneksi.php");
    function addAddress($data){
        global $conn;
        $addressLine = $data["address_line"];
        $city = $data["city"];
        $userId = $data["user_id"];
        $postalCode = $data["postal_code"];
        $query = "INSERT INTO user_address (`id`, `address_line`, `city`, `postal_code`, `user_id`) VALUES (NULL,'$addressLine', '$city', '$postalCode', '$userId')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    };
    function updateAddress($data){
        global $conn;
        $addressLine = $data["address_line"];
        $city = $data["city"];
        $postalCode = $data["postal_code"];
        $userId = $data["user_id"];
        $query = "UPDATE `user_address` SET `address_line` = '$addressLine', `city`= '$city', `postal_code` = '$postalCode' WHERE `user_address`.`user_id` = $userId";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
?>