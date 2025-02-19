<?php
session_start();
include('../config/config.php'); // Kết nối database

function checkLogin($username, $password) {
    global $conn; // Sử dụng biến kết nối CSDL

    // Truy vấn tài khoản
    $checkQuery = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($checkQuery);

    // Kiểm tra nếu tài khoản tồn tại
    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc(); // Lấy hàng kết quả dưới dạng mảng kết hợp
        if($user['admin']!=1){
            return false;
        }
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['fullName'] = $user['fullName'];
            $_SESSION['admin'] = $user['admin']; 
            echo $user['fullName'];
            echo  $_SESSION['username'];
            return true; // Đăng nhập thành công
        } else {
            return false; // Sai mật khẩu
        }
    } else {
        return false; // Tài khoản không tồn tại
    }
}

function ensureLoginAdmin() {
    if (!isset($_SESSION['fullName'])) {
        header("Location: loginAdmin.php");
    }
}

function logout(){
    $_SESSION = array();
    session_destroy();
}
?>


