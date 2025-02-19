<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Simple Sidebar - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/adminPage.css" rel="stylesheet" />
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <?php include("menu.php") ?>
            <!-- Page content wrapper-->

            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-primary" id="sidebarToggle">Toggle Menu</button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item active"><a class="nav-link" href="#!">Home</a></li>
                                <!-- <li class="nav-item"><a class="nav-link" href="#!">Link</a></li> -->
                                <li class="nav-item ">
                                </li>
                                <li class="nav-item"><span class="glyphicon glyphicon-log-out"></span> <a class="nav-link" href="index.php?logout=true">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                <?php 
                    include('./handle.php');
                    include('./menuControl.php');
                    ensureLoginAdmin();
                    if(isset($_GET['logout'])==true){
                        logout();
                        echo "<script>
                        window.location.href = 'http://localhost/watchStore/admin/loginAdmin.php';
                         </script>";
                    }
                    echo $_SESSION['fullName'];
                    // ensureLogin();
                ?>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/admin.js"></script>
    </body>
</html>
