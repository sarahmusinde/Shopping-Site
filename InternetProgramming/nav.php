<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="myProjects/webProject/icofont/css/icofont.min.css">
    <script src="https://kit.fontawesome.com/92d70a2fd8.js" crossorigin="anonymous"></script>
    <title>Bookstore</title>
</head>

<body>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" id="icon1" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }

}

?>

    <div class="main-nav">
        <div class="logo-img">
            <img src="./images/logo.png" alt="logo1"  id="logo">
        </div>
        <nav class="navigation">
            <ul class="list-content">
                <a href="home.php">
                    <li id="home">Home </li>
                </a>
                <a href="products.php">
                    <li>Shop</li>
                </a>
                <a href="cart.php">
                    <li> cart</li>
                </a>
                <a href="orders.php">
                    <li>Orders</li>
                </a>
                
                <a href="#about_txt">
                    <li>About</li>
                </a>
                
            </ul>

        </nav>

        <div class="search">
            <div><a href="search.php" class="fas fa-search"></a></div>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <div><i class="fa-solid fa-cart-shopping" id="cart"></i></div>&nbsp&nbsp
               <a href="logout.php" id="logout">Logout</a> 

        </div>

    </div>
   


</body>

</html>