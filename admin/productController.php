<div class="container-fluid">
    <form class="row g-3" method="POST" action="" enctype="multipart/form-data">
        <div class="col-md-6">
            <label for="inputName" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="inputName" name="inputName" required>
        </div>
        <div class="col-md-6">
            <label for="inputPrice" class="form-label">Giá</label>
            <input type="text" class="form-control" id="inputPrice" name="inputPrice">
        </div>
        <div class="col-12">
            <label for="inputDescription" class="form-label">Mô tả</label>
            <input type="text" class="form-control" id="inputDescription" name="inputDescription">
        </div>
        <div class="col-md-6">
            <label for="inputShellMaterial" class="form-label">Chất liệu dây</label>
            <input type="text" class="form-control" id="inputShellMaterial" name="inputShellMaterial">
        </div>
        <div class="col-md-3">
            <label for="inputAmount" class="form-label">Số lượng</label>
            <input type="number" class="form-control" id="inputAmount" name="inputAmount">
        </div>
        <div class="col-md-3">
            <label for="selectObjectUsed" class="form-label">Đối tượng sử dụng</label>
            <select id="selectObjectUsed" class="form-select" name="selectObjectUsed">
                <option value='0'>Nam</option>
                <option value='1'>Nữ</option>
                <option value='2'>Cặp đôi</option>

            </select>
        </div>
        <div class="col-md-3">
            <label for="selectCategoris" class="form-label">Loại</label>
            <select id="selectCategoris" class="form-select" name="selectCategoris">
                <option>Đồng hồ cơ</option>
                <option>Đồng hồ điện tử</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="selectBrands" class="form-label">Thương hiệu</label>
            <select id="selectBrands" class="form-select" name="selectBrands">
                <option>Đồng hồ cơ</option>
                <option>Đồng hồ điện tử</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="inputPromotion" class="form-label">Giảm giá</label>
            <input type="text" class="form-control" id="inputPromotion" name="inputPromotion">
        </div>
        <div class="col-md-2">
            <label for="inputImage" class="form-label">Ảnh</label>
            <input type="file" class="form-control" id="inputImage" name="inputImage">
        </div>
        <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary">Thêm sản phẩm</button>
        </div>
    </form>

    <div class="container mt-5">
        <h2>Danh sách sản phẩm </h2>
                    
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Thương hiệu</th>
                <th>Số lượng</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Truy vấn JOIN giữa bảng products và brands để lấy tên thương hiệu
            include("../config/config.php");
            $sql = "SELECT p.id, p.name, p.price, p.image,p.minimumOrderQuantity, b.name AS brand_name 
                    FROM products p 
                    JOIN brands b ON p.brand_id = b.id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td><img src='uploads/" . $row['image'] . "' style='width:50px; height:50px' alt=''></td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $row['brand_name'] . "</td>";
                    echo "<td>" . $row['minimumOrderQuantity'] . "</td>";
                    // Thêm nút xóa với liên kết chứa tham số delete
                    echo "<td>
                            <a href='productController.php?delete=" . $row['id'] . "' class='btn btn-danger' onclick=\"return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');\">Xóa</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Không có sản phẩm nào</td></tr>";
            }



            if (isset($_GET['delete'])) {
                $delete_id = intval($_GET['delete']);
                $sql_delete = "DELETE FROM products WHERE id = $delete_id";

                if ($conn->query($sql_delete) === TRUE) {
                    echo "<script>
                    window.location.href = 'index.php?page=productManager';
                     </script>";
                    exit;
                } else {
                    echo "Lỗi xóa sản phẩm: " . $conn->error;
                }
            }
            ?>
        </table>
    </div>
    <?php 
        // Bật hiển thị lỗi khi debug
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        include("../config/config.php");
           
        if (isset($_POST['submit'])) {
            $inputNameProduct = $_POST['inputName'];
            $inputPrice = $_POST['inputPrice'];
            $inputDescription = $_POST['inputDescription'];
            $inputShellMaterial = $_POST['inputShellMaterial'];
            $inputAmount = $_POST['inputAmount'];
            $selectObjectUsed = $_POST['selectObjectUsed'];
            $selectBrands = $_POST['selectBrands'];
            $inputPromotion = $_POST['inputPromotion'];
            // Xử lý upload ảnh
            $image = $_FILES['inputImage']['name'];
            $image_tmp = $_FILES['inputImage']['tmp_name'];
            $image = time().'_'.$image;
            
            // Câu lệnh SQL đã được sửa
            $sql_add = "INSERT INTO products (category_id, name, price, description, image, shellMaterial, objectUsed, minimumOrderQuantity, promotion, brand_id)
                        VALUES ('1', '$inputNameProduct', '$inputPrice', '$inputDescription', '$image', '$inputShellMaterial', '$selectObjectUsed', '$inputAmount', '$inputPromotion', '1')";

            if($conn->query($sql_add) === true){
                move_uploaded_file($image_tmp, 'uploads/'.$image);
                echo "<script>
                    window.location.href = 'index.php?page=productManager';
                     </script>";

                exit;
            } else {
                echo "Lỗi: " . $conn->error;
            }
        }

    ?>
</div>
