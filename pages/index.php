<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="../css/main.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
  
    .wrapper{
        width:90% ;
        display:flex;
        magin:auto;
        justify-conten:center ;
        /* align-items:; */

    }
    .navbar {
        margin-bottom: 0;
        border-radius: 0;
    }
    
    
    .row.content {height: 450px}
    
    
    .sidenav {
        padding-top: 20px;
        background-color: #f1f1f1;
        height: 100%;
    }
    .slider{
        height: 300px;
        border:1px solid black;
    }
    .container-main{
        width: 100%;
    }
    
   
    footer {
        background-color: #555;
        color: white;
        padding: 15px;

    }
    .fixed-card-img {
      width: 15rem;
      height: 150px; /* Điều chỉnh chiều cao tùy ý */
      /* object-fit: ; Giữ tỷ lệ ảnh và cắt bớt phần thừa */
    }
    
   
    @media screen and (max-width: 767px) {
        .sidenav {
        height: auto;
        padding: 15px;
        }
        .row.content {height:auto;} 
    }

    .card_item{
        width: 19%;
        height: 350px;
        border:1px solid black;
        margin:4PX;
        overflow: hidden;
        
    }

    .image_card{
        width: 100%;
        height: 200px;
        
    }
    .product_name{
        display: -webkit-box;
      -webkit-line-clamp: 2;   /* Giới hạn số dòng */
      -webkit-box-orient: vertical;
      overflow: hidden;        /* Ẩn phần văn bản thừa */
      text-overflow: ellipsis; 
      margin-top:10px;
        height:40px
    }


  </style>


</head>
<body> 
    <div class="wrapper container">
        <?php include("main.php") ?>
    </div>
</body>
</html>
