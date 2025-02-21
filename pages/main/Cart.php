<?php 
    
    include(__DIR__ . '/../../config/config.php');
    // session_start();
   
    if (!isset($_SESSION['user_id'])) {
        // header('ocation: login.php');
        echo "<script>
         window.location.href = 'http://localhost/watchStore/pages/login.php';
        </script>";
        exit();
    }
    $user_id = $_SESSION['user_id'];
    $cart_items = [];
    $total_price = 0;
    $total_quantity = 0;

    // Truy vấn để lấy sản phẩm trong giỏ hàng
    $sql = "SELECT ci.id as cart_item_id, p.id as product_id, p.name, p.price, p.image, ci.quantity 
            FROM cart_items ci
            JOIN cart c ON ci.cart_id = c.id
            JOIN products p ON ci.product_id = p.id
            WHERE c.user_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Lưu dữ liệu vào mảng
    while ($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
        $total_price += $row['price'] * $row['quantity'];
        $total_quantity += $row['quantity'];
    }
    // $deleteCart=$_POST['deleteCartItem']??"";

    if(isset($_GET['deleteCart'])){
        $IdItemcart=$_GET['deleteCart'];
        $sql_remove= "DELETE FROM cart_items WHERE id = $IdItemcart";
        if($conn->query($sql_remove) === true){
            echo "<script> window.location.href='index.php?page=cart';</script>";
        } else {
        echo "<script>alert('❌ Lỗi khi xóa sản phẩm.'); window.location.href='index.php?page=cart';</script>";
        }
        // header("localhost: index.php?page=cart");
        exit();
    }



    $stmt->close();
?>

<div class="container-fluid d-flex">   
    <h1 style="margin-left:230px">Giỏ hàng</h1> 
    <div class="container-main" style="width:1000px; margin:10px auto;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Giá gốc</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                <?php if (count($cart_items) > 0): ?>
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['product_id']); ?></td>
                            <td><img style="width: 50px; height: 60px;" src="http://localhost/WatchStore/admin/uploads/<?php echo htmlspecialchars($item['image']); ?>" alt=""></td>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td><?php echo number_format($item['price']); ?>đ</td>
                            <td style="width: 150px;">
                                <div class="d-flex">
                                    
                                <form method="POST" action="./main/updateCart.php" style="display:inline-flex;">
                                            <input type="hidden" name="cart_item_id" value="<?php echo $item['cart_item_id']; ?>">

                                            <button type="submit" name="action" value="decrease" style="width:30px;">-</button>
                                            <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" style="width:60px; text-align:center;" min="1">
                                            <button type="submit" name="action" value="increase" style="width:30px;">+</button>
                                        </form>
                                        <?php 
                                        ?>
                                    <!-- </form> -->
                                </div>
                            </td>
                            <td><?php echo number_format($item['price'] * $item['quantity']); ?>đ</td>
                            <td>
                                <!-- <form method="POST" action="index.php?page=cart">
                                    <input type="hidden" name="delete_itemid" value="<?php echo $item['cart_item_id']; ?>">
                                    <button type="submit" name="deleteCartItem" class="btn btn-danger">Xóa</button>
                                </form> -->
                                <a href="index.php?page=cart&deleteCart=<?php echo $item['cart_item_id']; ?>" class="btn btn-danger"> Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Giỏ hàng trống</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center">
            <h4>Tổng giá (<?php echo $total_quantity; ?> sản phẩm): <?php echo number_format($total_price); ?>đ</h4>
            <button class="btn btn-primary">Mua hàng</button>
        </div>
    </div>
</div>
