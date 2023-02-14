<?php 
include 'connect.php';
 session_start();
  
 if(isset($_POST['submit'])){

    $email =  $_POST['email'];
    $pass = $_POST['password'];
    $realPassword=hash('sha256', $pass);
 
    $select_users = mysqli_query($conn, "SELECT * FROM `customers` WHERE email = '$email' AND password = '$realPassword'") or die('query failed');
 
    if(mysqli_num_rows($select_users) > 0){
 
       $row = mysqli_fetch_array($select_users,MYSQLI_ASSOC);
 
       if($row['user_type'] == 'admin'){
 
         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:admin_panel.php');

      }else if($row['user_type'] == 'user'){
 
          $_SESSION['user_name'] = $row['name'];
          $_SESSION['user_email'] = $row['email'];
          $_SESSION['user_id'] = $row['id'];
          header('location:home.php');
 
       }
       mysqli_free_result( $select_users );
    }else{
       $message[] = 'incorrect email or password!';
    }
 
 }
 else{
    $message[] = 'incorrect email or password!';
 }

  


include'close.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="form">
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

}?>
    

<div class="center">
      <h1>Login</h1>
      <form method="post">
        <div class="txt_field">
          <input type="email" name="email" required>
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" required>
          <span></span>
          <label>Password</label>
        </div>
       
       
        <input type="submit" value="Login" name="submit" class="Submitbtn">
        <div class="signup_link">
          Not a member? <a href="signup.php">Signup</a>
        </div>
        <div class="signup_link">
          
        </div>
      </form>
    </div>

   
</body>
</html>