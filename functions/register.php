<?php
include "koneksi.php";
function register($data){
    global $conn;
    $fullname = htmlspecialchars($data["fullname"]);       
    $username = $data["username"];       
    $email = $data["email"];       
    $password = mysqli_real_escape_string($conn, $data["password"]);   
    $role = $data["role"] == "1" ? "customer" : "seller";
    $stats = $role == "1" ? 1 : 2;

    // cek username belum ada di tb_users
    $result = mysqli_query($conn, "SELECT username FROM tb_users WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)){
        return false;
    }
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO tb_users (`id`, `fullname`, `username`, `email`, `password`, `role`, `stats`, `balance`)
                VALUES (NULL, '$fullname', '$username', '$email', '$password', '$role', '$stats', 1000)";
    mysqli_query($conn, $query);    
    return  mysqli_affected_rows($conn);
}
?>