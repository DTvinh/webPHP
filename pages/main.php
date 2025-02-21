<div class="container-main ">

    <?php include("nav.php") ?>
    <?php 
        if(isset($_GET['page'])){
            include("./main/Cart.php");
        }
        else{
            include("./main/index.php");
        }
    
    ?>
</div>