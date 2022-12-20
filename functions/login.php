<?php
include "koneksi.php";
session_start();
function login($data)
{
    global $conn;
    if (isset($data["username"])) {
        $username = $data["username"];
        $password = $data["password"];
        $role = $data["role"];
        $remember = isset($data["check"]);
        if ($role == 1) {
            $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
        }
        if ($role == 2) {
            $result = mysqli_query($conn, "SELECT * FROM seller WHERE username = '$username'");
        }
        if ($role == 3) {
            $result = mysqli_query($conn, "SELECT * FROM `admin` WHERE username = '$username'");
        }
        // cek username 
        if (mysqli_num_rows($result) === 1) {
            // cek password
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"])) {
                $_SESSION["fullname"] = $row["fullname"];
                $_SESSION["id"] = $row["id"];
                $_SESSION["role"] = $role;
                if ($remember) {
                    // buat cookie
                    setcookie("id", $row['id'], time() + 3600);
                    setcookie("key", hash("sha256", $row["id"]), time() + 3600);
                    setcookie("role", $role, time() + 3600);
                    setcookie("fullname", $row["fullname"], time() + 3600);
                }
                if ($role == 1) {
                    header("location:index.php");
                }
                if ($role == 2) {
                    header("location:dashboard.php");
                }
                if ($role == 3) {
                    header("location:dashboard_admin.php");
                }
                return $row;
            }
        }
    }
    return false;
}
