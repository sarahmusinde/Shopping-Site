<?php

include 'connect.php';

$id = $_GET['edit'];

if(isset($_POST['update_product'])){

    $Book_name = $_POST['Book_name'];
    $Book_price = $_POST['Book_price'];
    $Book_year = $_POST['year'];
    $Book_author = $_POST['author'];
   
    $Book_image = $_FILES['product_image']['name'];
    $Book_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $Book_image_folder = 'uploaded_img/'.$Book_image ;

   if(empty($Book_name) || empty($Book_price) || empty($Book_image)|| empty($Book_year)|| empty($Book_author)){
    $message[] = 'please fill the input';   
   }else{

      $update_data = "UPDATE books SET name='Book_name',publishedYear=' $Book_year',Author='$Book_author',price=''$Book_price', image='$BOOK_image'  WHERE id = '$id'";
      $upload = mysqli_query($conn, $update_data);

      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         header('location:admin_panel.php');
      }else{
         $$message[] = 'please fill out all!'; 
      }

   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '<span class="message">'.$message.'</span>';
      }
   }
?>

<div class="container">


<div class="admin-product-form-container centered">

   <?php
      
      $select = mysqli_query($conn, "SELECT * FROM books WHERE id = '$id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form method="post" >
      <h3 class="title">Product update </h3>
      <input type="text" placeholder="enter product name" name="Book_name" class="box">
         <input type="text" placeholder="Author" name="author" class="box">
         <input type="number" placeholder="published year" name="year" class="box">
         <input type="number" placeholder="enter product price" name="Book_price" class="box">
        
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
      <input type="submit" value="update product" name="update_product" class="btn">
      <a href="admin_page.php" class="btn">go back!</a>
   </form>
   


   <?php }; ?>

   

</div>

</div>

</body>
</html>