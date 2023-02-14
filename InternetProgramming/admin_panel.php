<?php

include 'connect.php';
 session_start();

   if(isset($_POST['add_product'])){

      $Book_name = $_POST['Book_name'];
      $Book_price = $_POST['Book_price'];
      $Book_year = $_POST['year'];
      $Book_author = $_POST['author'];
  
      $Book_image = $_FILES['image']['name'];
      $Book_image_tmp_name = $_FILES['image']['tmp_name'];
      $Book_image_folder = 'uploaded_img/'.$Book_image ;
  
      if(empty($Book_name) || empty($Book_price) || empty($Book_image)|| empty($Book_year)|| empty($Book_author)){
          $message[] = 'please fill the input';
      }else{
         
          if ($_FILES['image']['size'] > 5000000) {
              $message[] = "File size exceeds the maximum allowed limit of 2MB.";
          }
         
          $allowed = array("image/jpeg", "image/png", "image/jpg");
          if (!in_array($_FILES['image']['type'], $allowed)) {
              $message[] = "Only jpeg, png, and jpg files are allowed.";
          }
          
          $fileExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
          $allowedExt = array("jpeg", "png", "jpg");
          if (!in_array($fileExt, $allowedExt)) {
              $message[] = "Only jpeg, png, and jpg files are allowed.";
          }
         
          if ($_FILES['image']['error'] != 0) {
              switch ($_FILES['image']['error']) {
                  case 1:
                      $message[] = "The file is too large.";
                      break;
                  case 2:
                      $message[] = "The file is too large.";
                      break;
                  case 3:
                      $message[] = "The file was only partially uploaded.";
                      break;
                  case 4:
                      $message[] = "No file was uploaded.";
                      break;
                  case 6:
                      $message[] = "Missing a temporary folder.";
                      break;
                  case 7:
                      $message[] = "Failed to write file to disk.";
                      break;
                  case 8:
                      $message[] = "A PHP extension stopped the file upload.";
                      break;
              }
          }
  
          if(empty($message)){

      $insert = "INSERT INTO books(name,publishedYear,Author, price, image) VALUES(' $Book_name', '$Book_year','$Book_author',' $Book_price ', '$Book_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($Book_image_tmp_name,  $Book_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }
      }
};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM books WHERE id = $id");
   header('location:admin_panel.php');
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin pannel</title>


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


   <link rel="stylesheet" href="css/style.css">

</head>
<body>


 <?php include 'headerAdmin.php'; ?>
 
   
<div class="container">

   <div class="admin-product-form-container">

      <form  method="post" enctype='multipart/form-data'>
         <h3>add a new Book</h3>
         <input type="text" placeholder="enter product name" name="Book_name" class="box">
         <input type="text" placeholder="Author" name="author" class="box">
         <input type="number" placeholder="published year" name="year" class="box">
         <input type="number" placeholder="enter product price" name="Book_price" class="box">
        
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="image" class="box">
         <input type="submit" class="btn" name="add_product" value="add product">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM books");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>product image</th>
            <th>product name</th>
            <th>product price</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td>$<?php echo $row['price']; ?></td>
            <td>
               <a href="update.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
               <a href="admin_panel.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>


</body>
</html>