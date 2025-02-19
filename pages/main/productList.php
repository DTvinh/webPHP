<?php 
    // Kết nối đến database
    include(__DIR__ . "/../../config/config.php");
    // Lấy giá trị 'gioitinh' từ URL (nếu có)
    $idSex = $_GET['gioitinh'] ?? '';
    $products = [];
    $result;

    if ($idSex != '') {
        // Lệnh SQL lấy thông tin sản phẩm theo giới tính (hoặc thuộc tính objectUsed)
        $sql = "SELECT p.id, p.name, p.price, p.image
                FROM products p 
                WHERE objectUsed = '$idSex'";
        $result = $conn->query($sql);

        // if ($result && $result->num_rows > 0) {
        //     // Lưu kết quả vào mảng products
        //     while ($row = $result->fetch_assoc()) {
        //         $products[] = $row;
        //     }
        // }
    }
    else{

        $sql = "SELECT *
        FROM products ";
    $result = $conn->query($sql);

//     if ($result && $result->num_rows > 0) {
//     // Lưu kết quả vào mảng products
//     while ($row = $result->fetch_assoc()) {
//         $products[] = $row;
//     }
//    }
    }
?>

<div class="col-sm-9 text-left">
    <h1>Danh sách sản phẩm</h1>

    <select class="form-select" aria-label="Select example">
        <option>--chọn giá--</option>

    </select>
    
    <div class="container-main">
    <?php
        if ($result->num_rows > 0) {
            while ($product = $result->fetch_assoc()) {?>
                  <div class="card_item col-10 col-sm-2">
                    <img class="image_card" src="http://localhost/WatchStore/admin/uploads/<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <p class="product_name"><?php echo htmlspecialchars($product['name']); ?></p>
                        <p class="text-danger"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</p>
                        <button class="btn btn-primary">Add to cart</button>
                    </div>
                </div>


        <?php   
        }}
        ?>
    </div>
</div>



<!-- <div class="col-sm-9 text-left">
    <h1>Danh sách sản phẩm</h1>

    <select class="form-select" aria-label="Select example">
        <option>--chọn giá--</option>

    </select>
    
    <div class="container-main">
        <?php if (!empty($products)):
                foreach ($products as $product): ?>
                <div class="card_item col-10 col-sm-2">
                    <img class="image_card" src="http://localhost/WatchStore/admin/uploads/<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <p class="product_name"><?php echo htmlspecialchars($product['name']); ?></p>
                        <p class="text-danger"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</p>
                        <button class="btn btn-primary">Add to cart</button>
                    </div>
                </div>
            <?php endforeach; ?>
            
        <?php else: ?>
            <p>Không có sản phẩm</p>
        <?php endif; ?>

    </div>
</div> -->
