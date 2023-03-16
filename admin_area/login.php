<!DOCTYPE>
<html>
<head>
  <title>Login Form</title>
  <link rel="stylesheet" type="text/css" href="styles/login_style.css" media="all"/>
</head>
<body>
<div class="login-page">
  <div class="form">
   <h2 style="color: white; text-align: center;"> <?php echo @$_GET['not_admin']; ?> </h2>
   
   <h2 style="color: white; text-align: center;"> <?php echo @$_GET['logged_out']; ?> </h2>
   <h1>Admin Login</h1>
    <form  class="login-form" method="post" action="login.php">
      <input type="text" name="email" placeholder="Email" required="required"/>
      <input type="password" name="pass" placeholder="password" required="required"/>
      <button type="submit" name="login">login</button>
     
    </form>
  </div>
</div>
</body>
</html>

<?php
session_start();
include("includes/db.php");
if(isset($_POST['login'])){
  //protect from being script theft
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $sel_user = "select * from admins where user_email = '$email' AND user_pass='$pass' ";
  $run_user = mysqli_query($con,$sel_user);
  $check_user = mysqli_num_rows($run_user);

if($check_user==0){
  echo "<script>alert('Password or Email is wrong, try again')</script>";
}else{
  $_SESSION['user_email'] = $email;
  echo "<script>window.open('index.php?logged_in=You have successfully logged in','_self')</script>";

}
}

?>