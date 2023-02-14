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
                <a href="login.php">
                    <li>Login</li>
                </a>
                
                
            </ul>

        </nav>

        <div class="search">
            
           
               <a href="logout.php" id="logout">Logout</a> 

        </div>

    </div>
   


</body>

</html>