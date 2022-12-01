<?php
include "koneksi.php";
function register($data){
    global $conn;
    $fullname = htmlspecialchars($data["fullname"]);       
    $username = $data["username"];       
    $email = $data["email"];       
    $role = $data["role"];
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $created_at = date("Y-m-d", time());
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // cek username belum ada di user dan buat query
    if ($role == 1) {
        $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
        $query = "INSERT INTO user (`id`, `fullname`, `username`, `password`, `email`, `balance`, `created_at`, `modified_at`)
        VALUES (NULL, '$fullname', '$username', '$password', '$email', 0, '$created_at', $created_at)";
    }
    // cek username belum ada di seller dan buat query
    if ($role == 2) {
        $result = mysqli_query($conn, "SELECT username FROM seller WHERE username = '$username'");
        $query = "INSERT INTO seller (`id`, `fullname`, `username`, `password`, `email`, `balance`, `created_at`, `modified_at`)
        VALUES (NULL, '$fullname', '$username', '$password', '$email', 0, '$created_at', $created_at)";
    }
    // jika username sudah ada kembalikan fungsi false/0
    if(mysqli_fetch_assoc($result)){
        return false;
    }
    mysqli_query($conn, $query);    
    return  mysqli_affected_rows($conn);
}
?>