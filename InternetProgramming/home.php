<?php

include 'connect.php';

session_start();

$user_id = $_SESSION['user_id'];



if(!isset($user_id)){
   header('location:login.php');
}
if(isset($_POST['add_to_cart'])){

   $Book_name = $_POST['Book_name'];
   $Book_price = $_POST['Book_price'];
   $Book_image = $_POST['Book_image'];
   $Book_quantity = $_POST['Book_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = ' $Book_name ' AND customer_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(customer_id, name, price, quantity, image) VALUES('$user_id', '$Book_name', '$Book_price', '$Book_quantity', '$Book_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php   include 'nav.php';?>

<div class="imgtop">
      <div style="margin: auto; margin-bottom: initial !important;">
        <h1 id="booktest">Books you can’t resist </h1>
        <h3 id="booktest">Pick yours now</h3>
        <p id="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit.<br>
            ipsa quia corrupti expedita! Cumque
            necessitatibus harum enim error deserunt
        </p>
      </div>
        <button id="btnmore"><a href="products.php">More  Products</a></button>
    </div>

    <h1 id="latest">Latest Books</h1>
    <hr>
    <section class="products">

 

   <div class="box-container">

      <?php  
         $select_books = mysqli_query($conn, "SELECT * FROM `books` LIMIT 6") or die('query failed');
         if(mysqli_num_rows( $select_books ) > 0){
            while($fetch_books = mysqli_fetch_assoc( $select_books )){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_books['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_books['name']; ?></div>
      <div class="price">$<?php echo $fetch_books['price']; ?></div>
      <input type="number" min="1" name="Book_quantity" value="1" class="qty">
      <input type="hidden" name="Book_name" value="<?php echo $fetch_books['name']; ?>">
      <input type="hidden" name="Book_price" value="<?php echo $fetch_books['price']; ?>">
      <input type="hidden" name="Book_image" value="<?php echo $fetch_books['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn" >
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no  Books  added yet!</p>';
      }
      ?>
   </div>

</section>
     <div>

     </div>
     <h1 id="about_txt">About Us</h1>
     <div class="about">
        <div>
             <img src="/images/pic1.jpg" alt="pic1" width="400px">
        </div>
        <div>
            <p id="text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Dolorem pariatur odit atque quasi eaque nemo iusto, 
            sed veritatis voluptatum aperiam soluta minus hic! Minima
             vitae praesentium repellendus, 
             eius illum explicabo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Dolorem pariatur odit atque quasi eaque nemo iusto, 
            sed veritatis voluptatum aperiam soluta minus hic! Minima
             vitae praesentium repellendus, 
            eius illum explicabo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Dolorem pariatur odit atque quasi eaque nemo iusto, 
            sed veritatis voluptatum aperiam soluta minus hic! Minima
             vitae praesentium repellendus, 
             eius illum explicabo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Dolorem pariatur odit atque quasi eaque nemo iusto, 
            sed veritatis voluptatum aperiam soluta minus hic! Minima
             vitae praesentium repellendus, 
            eius illum explicabo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Dolorem pariatur odit atque quasi eaque nemo iusto, 
            sed veritatis voluptatum aperiam soluta minus hic! Minima
             vitae praesentium repellendus, 
             eius illum explicabo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Dolorem pariatur odit atque quasi eaque nemo iusto, 
            sed veritatis voluptatum aperiam soluta minus hic! Minima
             vitae praesentium repellendus, 
            eius illum explicabo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Dolorem pariatur odit atque quasi eaque nemo iusto, 
            sed veritatis voluptatum aperiam soluta minus hic! Minima
             vitae praesentium repellendus, 
             eius illum explicabo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Dolorem pariatur odit atque quasi eaque nemo iusto, 
            sed veritatis voluptatum aperiam soluta minus hic! Minima
             vitae praesentium repellendus, 
            eius illum explicabo!
        </p>
        </div>

     </div>

     <?php   include 'footer.php';?>
</body>

</html>
</body>
</html>