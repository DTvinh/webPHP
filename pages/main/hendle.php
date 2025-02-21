<?php
session_start();
include(__DIR__ . "/../../config/config.php");

function checkLogin($username, $password) {
    global $conn; 

  
    $checkQuery = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($checkQuery);
    
    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc(); 
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['fullName'] = $user['fullName'];
            $_SESSION['admin'] = $user['admin']; 
            // echo $user['fullName'];
            // echo  $_SESSION['username'];
            return true; // Đăng nhập thành công
        } else {
            return false; 
        }
    } else {
        return false; 
    }
}

function ensureLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

function logout(){
    $_SESSION = array();
    session_destroy();
}
?>


