
<?php
include'connect.php';

if(isset($_POST['submit']))
{
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword=$_POST['cpassword'];
$user_type = $_POST['user_type'];

$duplicate=mysqli_query($conn,"select* from customers where name='$name' and email='$email'");
if (mysqli_num_rows($duplicate)>0)
{
header("Location: signup.php?message=User name or Email id already exists.");
$message[] = 'user Already exist';
}else  if($password != $cpassword){
       $message[] = 'password are not matching';
    }
    else{
      
      $real_pass = hash('sha256', $cpassword);
       $res = mysqli_query($conn,"INSERT INTO customers (name,surname,email,password,user_type) VALUES ('$name', '$surname', '$email', '$real_pass','$user_type')");
       if ($res === TRUE) 
       header('location:login.php');
       else 
             printf("Could not insert record: %s\n", mysqli_error($conn));


      
    }
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>
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
      <h1>Sign Up</h1>
      <form method="post">
        <div class="txt_field">
          <input type="text" name="name" required>
          <span></span>
          <label>Name</label>
        </div>
        <div class="txt_field">
          <input type="text" name="surname" required>
          <span></span>
          <label>surname</label>
        </div>
        <div class="txt_field">
          <input type="email" name="email" required>
          <span></span>
          <label>email</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" required>
          <span></span>
          <label>Password</label>
        </div>
        <div class="txt_field">
          <input type="password" name="cpassword" required>
          <span></span>
          <label>confirm password</label>
        </div>
        <div class="txt_field">
        <select name="user_type" class="box">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>
      </div>
        <input type="submit" value="Sign up" name="submit" class="Submitbtn">
        <div class="signup_link">
          Already a member? <a href="login.php">Signup</a>
        </div>
      </form>
    </div>

 
</div>
</body>
</html>