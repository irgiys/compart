<?php
include "koneksi.php";
function login($data){
    global $conn;
    if(isset($data["username"])){
        $username = $data["username"];
        $password = $data["password"];
        $result = mysqli_query($conn, "SELECT * FROM tb_users WHERE username = '$username'");
        // cek username 
        if(mysqli_num_rows($result) === 1){
            // cek password
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row["password"])){
                header("location:index.php");
                return true;
            }
        }
    }
    return false;
}
?>