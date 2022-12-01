<?php
include "koneksi.php";
session_start();
function login($data){
    global $conn;
    if(isset($data["username"])){
        $username = $data["username"];
        $password = $data["password"];
        $role = $data["role"];
        if($role == 1){
            $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
        }
        if($role == 2){
            $result = mysqli_query($conn, "SELECT * FROM seller WHERE username = '$username'");
        }
        // cek username 
        if(mysqli_num_rows($result) === 1){
            // cek password
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row["password"])){
                $role == 1 ? header("location:index.php") : header("location:dashboard.php");
                return $row;
            }
        }
    }
    return false;
}
?>