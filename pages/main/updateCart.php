<?php
include(__DIR__ . '/../../config/config.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href = 'http://localhost/WatchStore/pages/login.php';</script>";
    exit();
}

$cart_item_id = $_POST['cart_item_id'] ?? null;
$action = $_POST['action'] ?? '';
$quantity = $_POST['quantity'] ?? 1;

if (!$cart_item_id) {
    die("❌ Lỗi: Không tìm thấy sản phẩm cần cập nhật.");
}

$sql = "SELECT ci.product_id, ci.quantity AS current_quantity, p.minimumOrderQuantity AS available_stock 
        FROM cart_items ci
        JOIN products p ON ci.product_id = p.id
        WHERE ci.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cart_item_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die("❌ Lỗi: Sản phẩm không tồn tại.");
}

$current_quantity = $product['current_quantity'];
$available_stock = $product['available_stock'];


if ($action == 'increase') {
    if ($current_quantity + 1 > $available_stock) {
        echo "<script> window.location.href='http://localhost/watchStore/pages/index.php?page=cart';</script>";
        exit();
    }
    $quantity = $current_quantity + 1;
} elseif ($action == 'decrease') {
    $quantity = max(1, $current_quantity - 1); 
}


$update_sql = "UPDATE cart_items SET quantity = ? WHERE id = ?";
$update_stmt = $conn->prepare($update_sql);
$update_stmt->bind_param("ii", $quantity, $cart_item_id);

if ($update_stmt->execute()) {
    // header("Location: http://localhost/watchStore/pages/index.php?page=cart");3
    echo "<script> window.location.href='http://localhost/watchStore/pages/index.php?page=cart';</script>";

} else {
    echo "<script>alert('❌ Lỗi khi cập nhật số lượng.'); window.location.href='http://localhost/watchStore/pages/index.php?page=cart';</script>";
}

$update_stmt->close();
$conn->close();
?>
