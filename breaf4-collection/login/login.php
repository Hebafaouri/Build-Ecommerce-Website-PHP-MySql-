<?php 
require "function.php";

$massgerror = '';

if(isset($_POST['email']) && isset($_POST['password'])){
  $email = $_POST['email'];
  $password = $_POST['password'];

  $object = new Login ();
  $result = $object->login($email,$password);

  if($result == 1){
    echo "<script> alert('Login Successful'); </script>";
    $_SESSION['email']= $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
    header("location: profile.php");
    exit();
  } else if($result == 10){
    $massgerror = "Username or Email Has Already Taken";
  } else {
    $massgerror = "Invalid Email or Password";
  }
}
?>

<?php require 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="login.css">
</head>
<body>
<form method="POST" >
  <div class="container">
    <label for="uname"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email">

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password">
    
    <p class="error1" style="color:#f44336"><?php echo $massgerror; ?></p>
    
    <button type="submit" class="btn btn-danger">Login</button>
  </div>
</form>
</body>
</html>
<?php include "footer.php" ?>