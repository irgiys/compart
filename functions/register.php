<?php
include "koneksi.php";
function register($data)
{
    global $conn;
    $fullname = htmlspecialchars($data["fullname"]);
    $username = htmlspecialchars($data["username"]);
    $email = htmlspecialchars($data["email"]);
    $role = $data["role"];
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $created_at = date("Y-m-d H:i:s");
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // buat query sql
    if ($role == 1) {
        $query = "INSERT INTO user (`id`, `fullname`, `username`, `password`, `email`, `balance`, `created_at`, `modified_at`)
        VALUES (NULL, '$fullname', '$username', '$password', '$email', 0, '$created_at', '$created_at')";
    }
    if ($role == 2) {
        $query = "INSERT INTO seller (`id`, `fullname`, `username`, `password`, `email`, `balance`, `created_at`, `modified_at`)
        VALUES (NULL, '$fullname', '$username', '$password', '$email', 0, '$created_at', '$created_at')";
    }
    if ($role == 3) {
        $query = "INSERT INTO `admin` (`id`, `fullname`, `username`, `password`, `email`, `balance`, `created_at`, `modified_at`)
        VALUES (NULL, '$fullname', '$username', '$password', '$email', 0, '$created_at', '$created_at')";
    }
    $result1 = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username' OR email = '$email'");
    $result2 = mysqli_query($conn, "SELECT username FROM seller WHERE username = '$username' OR email = '$email'");
    $result3 = mysqli_query($conn, "SELECT username FROM `admin` WHERE username = '$username' OR email = '$email'");
    // jika username / email sudah ada kembalikan fungsi false/0
    if (mysqli_fetch_assoc($result1) || mysqli_fetch_assoc($result2) || mysqli_fetch_assoc($result3)) {
        return false;
    }
    mysqli_query($conn, $query);
    return  mysqli_affected_rows($conn);
}
