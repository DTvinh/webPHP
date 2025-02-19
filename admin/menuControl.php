<div>
<?php
  $page = $_GET['page'] ?? '';
  
  if ($page == 'userManager') {
    
      include('./userController.php');  
    }
    else if ($page == 'productManager') {
    
    include('./productController.php');
    }
?>

</div>