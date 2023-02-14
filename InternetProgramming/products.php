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
   <title>shop</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   <div>
   <?php include 'nav.php'; ?>
   </div>


<div class="heading">
   <h3>our shop</h3>
</div>

<section class="products">

 

   <div class="box-container">

      <?php  
         $select_books = mysqli_query($conn, "SELECT * FROM `books`") or die('query failed');
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

 


</body>
</html>