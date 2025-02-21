
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
        </button>
        <a class="navbar-brand" href="index.php">Logo</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
        <!-- <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Projects</a></li>
            <li><a href="#">Contact</a></li>
        </ul> -->
       
        <ul class="nav navbar-nav navbar-right d-flex ">
            <form class="nav navbar-nav " style="margin:10px;">
                    <div class=" d-flex ">
                        <input type="text" class="" placeholder="" style=" height:36px">
                        <button class="btn btn-primary">Tìm kiếm </button>
                    </div>
            </form>
            <li class="d-flex"> <div class="input-group">
                
            
            </li>
            <li><a href="index.php?page=cart"><span class="glyphicon glyphicon glyphicon-shopping-cart"></span> Giỏ hàng </a></li>
            
            <?php 
                include('./main/hendle.php');
                
               
                if (isset($_SESSION['username'])) {
                    // echo "Đăng nhập với tài khoản: " . $_SESSION['username'];
                    echo"<li><a href='#'><span class='glyphicon glyphicon-user'></span>".$_SESSION['username']." </a></li>";
                    echo" <li><a href='index.php?logout=true'><span class='glyphicon glyphicon-log-in'></span> Logout</a></li>";
                } else {
                    echo" <li><a href='index.php?logout=true'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";

                }
                if(isset($_GET['logout'])==true){
                    logout();
                    echo "<script>
                    window.location.href = 'http://localhost/watchStore/pages/login.php';
                        </script>";
                }
                
            ?>
            <!-- <li><a href="#"><span class="glyphicon glyphicon-user"></span> Tài khoản </a></li> -->

            <!-- <li><a href="index.php?logout=true"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> -->

        </ul>
        </div>

    </div>
</nav>