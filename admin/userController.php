<div class="container-fluid d-flex">

    <form class="row g-1" style="width: 400px;" method="POST" enctype="multipart/form-data">
        <div class="col-md-12">
            <label for="inputName" class="form-label">Họ tên</label>
            <input type="text" class="form-control" id="inputName" name="inputName" required>
        </div>
        <div class="col-12">
            <label for="inputEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputEmail" name="inputEmail" required>
        </div>
        <div class="col-md-12">
            <label for="inputUserName" class="form-label">Tên tài khoản</label>
            <input type="text" class="form-control" id="inputUserName" name="inputUserName" required>
        </div>
        <div class="col-md-12">
            <label for="inputPassWord" class="form-label">Password</label>
            <input type="password" class="form-control" id="inputPassWord" name="inputPassWord" required>
        </div>
        <div class="col-md-12">
            <label for="inputPassWord2" class="form-label">Nhập lại password</label>
            <input type="password" class="form-control" id="inputPassWord2" name="inputPassWord2" required>
        </div>
        <div class="col-md-12">
            <label for="selectUser" class="form-label">Quyền truy cập</label>
            <select name="selectUser" class="form-select" id=""> 
                <option value="false">Người dùng</option>
                <option value="true">Admin</option>
            </select>
        </div>
        <div class="col-md-12">
            <button type="submit" name="addUser" class="btn btn-primary">Đăng ký người dùng</button>
        </div>
    </form>

    <div class="container mt-4">
        <h2>Danh sách người dùng</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Tài khoản</th>
                    <th>Password</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                include('../config/config.php');

                if (isset($_GET['delete'])) {
                    $deleteId = intval($_GET['delete']); 
                    $deleteQuery = "DELETE FROM user WHERE id = $deleteId";
                    if($conn->query($deleteQuery)){
                        echo "<script>alert('Xoá người dùng thành công!'); window.location.href='index.php?page=userManager';</script>";
                    } else {
                        echo "<script>alert('Lỗi khi xoá: " . $conn->error . "');</script>";
                    }
                }


                $fetchQuery = "SELECT * FROM user";
                $result = $conn->query($fetchQuery);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        $active = ($row['admin'] == 1) ? "Admin" : "Người dùng";
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['fullName'] . "</td>
                                <td>" . $row['email'] . "</td>
                                <td>" . $row['username'] . "</td>
                                <td>" . $row['password'] . "</td>
                                <td>" . $active . "</td>
                                <td>
                                    <a href='index.php?page=userManager&delete=" . $row['id'] . "' 
                                       onclick=\"return confirm('Bạn có chắc chắn muốn xoá người dùng này không?');\" 
                                       class='btn btn-danger btn-sm'>Xoá</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Không có dữ liệu</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addUser"])) {
        $fullName = trim($_POST["inputName"]);
        $email = trim($_POST["inputEmail"]);
        $username = trim($_POST["inputUserName"]);
        $password = $_POST["inputPassWord"];
        $confirmPassword = $_POST["inputPassWord2"];
        $role = $_POST["selectUser"]; 


        if ($password !== $confirmPassword) {
            echo "<script>alert('Mật khẩu không khớp!');</script>";
        } else {
          
            $checkQuery = "SELECT * FROM user WHERE username = '$username'";
            $result = $conn->query($checkQuery);
            if ($result->num_rows > 0) {
                echo "<script>alert('Tên tài khoản đã tồn tại!');</script>";
                echo "<script>window.location.href = 'index.php?page=userManager';</script>";
            } else {
               
                $admin = ($role === "true") ? 1 : 0;

        
                $insertQuery = "INSERT INTO user (fullName, email, username, password, admin)
                                VALUES ('$fullName', '$email', '$username', '$password', '$admin')";
                
                if ($conn->query($insertQuery) === TRUE) {
                    echo "<script>alert('Đăng ký thành công!');</script>";
                    echo "<script>window.location.href = 'index.php?page=userManager';</script>";
                } else {
                    echo "<script>alert('Lỗi khi đăng ký: " . $conn->error . "');</script>";
                }
            }
        }
    }
    ?>
</div>
