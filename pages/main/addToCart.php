<?php
include(__DIR__ . "/../../config/config.php");
session_start();

// Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: /watchStore/pages/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_GET['product_id'] ?? null;
$quantity = $_GET['quantity'] ?? 1;

if (!$product_id) {
    die("❌ Lỗi: Không có sản phẩm được chọn.");
}

function getOrCreateCart($conn, $user_id) {
    $sql = "SELECT id FROM cart WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cart = $result->fetch_assoc();

    if ($cart) {
        return $cart['id'];
    } else {
        $sql = "INSERT INTO cart (user_id) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->insert_id;
    }
}

function getCartItem($conn, $cart_id, $product_id) {
    $sql = "SELECT id FROM cart_items WHERE cart_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $cart_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

/**
 * Thêm sản phẩm mới vào giỏ hàng
 */
function addNewCartItem($conn, $cart_id, $product_id, $quantity) {
    $sql = "INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $cart_id, $product_id, $quantity);
    return $stmt->execute();
}


$cart_id = getOrCreateCart($conn, $user_id);


$cart_item = getCartItem($conn, $cart_id, $product_id);

if ($cart_item) {

    echo "<script>alert('⚠️ Sản phẩm đã có trong giỏ hàng!'); window.location.href='cart.php';</script>";
} else {
    if (addNewCartItem($conn, $cart_id, $product_id, $quantity)) {
        echo "<script>alert('✅ Sản phẩm đã được thêm vào giỏ hàng!'); window.location.href='cart.php';</script>";
    } else {
        echo "<script>alert('❌ Lỗi khi thêm sản phẩm vào giỏ hàng.'); window.location.href='cart.php';</script>";
    }
}
header("Location: /watchStore/pages");
$conn->close();
?>
