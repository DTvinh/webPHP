<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <Link rel="stylesheet" href="../css/login.css">
   
</head>
<body>
        
<div class="login-page">
    <div class="form">
        <!-- <form class="register-form">
            <input type="text" placeholder="name"/>
            <input type="password" placeholder="password"/>
            <input type="text" placeholder="email address"/>
            <button>create</button>
            <p class="message">Already registered? <a href="#">Sign In</a></p>
        </form> -->
        <form class="login-form" action="" method="post">
            <input type="text" placeholder="username" name='username'/>
            <input type="password" placeholder="password" name='password'/>
            <button  type="submit" name="login" >login</button>
            <p class="message">Not registered? <a href="#">Create an account</a></p>
        </form>
    </div>

    <?php 
        include('./main/hendle.php');
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
            $username = trim($_POST["username"]);
            $password = $_POST["password"];
            if (checkLogin($username, $password)) {
                echo "<script>
                    window.location.href = 'http://localhost/watchStore/pages';
                </script>";
            } else {
                echo "<script>alert('Sai tên đăng nhập hoặc mật khẩu');</script>";
            }
        }
    ?>
    </div>
    <script>
        $('.message a').click(function(){
        $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
        });
    </script>
</body>

</html>