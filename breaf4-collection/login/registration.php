<?php
include "function.php";

if(!empty($_SESSION["id"])){
  header("Location: index.php");
}
$register = new Register();
$error = "";

if(isset($_POST["submit"])){
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];
  $avatar = $_POST['avatar'];
  $address = $_POST['address'];
  $contact = $_POST['contact'];

  if(empty($name) || empty($email) || empty($password) || empty($confirmpassword) ||empty($avatar) || empty($contact) || empty($address)){
    $error = "All fields are required.";
  }
  elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error = "Invalid email format.";
  }
  elseif(strlen($password) < 6){
    $error = "Password must be at least 6 characters long.";
  }
  elseif($password !== $confirmpassword){
    $error = "Passwords do not match.";
  }
  else {
    $result = $register->registration($name, $email, $password, $confirmpassword, $contact, $avatar, $address);

    if($result == 1){
      // echo "<script> alert('Registration Successful'); </script>";
    }
    elseif($result == 10){
      $error = "Username or Email Has Already Taken";
    }
    elseif($result == 100){
      $error = "Password Does Not Match";
    }
  }
}

// rest of the code remains the same as before

include "header.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registration</title>
    <script src="validation.js"></script>
    <link rel="stylesheet" href="signup.css">
  </head>

  <body>
    <h2 >Sigin Up</h2>
    <form name="registrationForm" action="" id="form1" method="post" autocomplete="off" >
    <?php if($error !== ""){ ?>
      <div style="color: red;" ><?php echo $error; ?></div>
    <?php } ?>
  <div>
    <label for="">Name : </label>
    <input type="text" name="name" id="fullname" >
    <?php if(isset($error) && strpos($error, "name") !== false){ ?>
      <p style="color: red;" id="error-name"><?php echo $error; ?></p>
    <?php } ?>
  </div>

  <div>
    <label for="">Email : </label>
    <input type="text" name="email" id="email" >
    <?php if(isset($error) && strpos($error, "email") !== false){ ?>
      <p style="color: red;" id="error-email"><?php echo $error; ?></p>
    <?php } ?>
  </div>
  <div>
    <label for="">Address : </label>
    <input type="text" name="address" id="address" >
    <?php if(isset($error) && strpos($error, "address") !== false){ ?>
      <p style="color: red;" id="error-address" ><?php echo $error; ?></p>
    <?php } ?>
  </div>
  <div>
    <label for="">mobile : </label>
    <input type="text" name="contact" id="mobile" >
    <?php if(isset($error) && strpos($error, "contact") !== false){ ?>
      <p style="color: red;" id="error-contact" ><?php echo $error; ?></p>
    <?php } ?>
  </div>
  <div>
    <label for="">Password : </label>
    <input type="password" id="password" name="password">
    <?php if(isset($error) && strpos($error, "password") !== false){ ?>
      <p style="color: red;" id="error-password" ><?php echo $error; ?></p>
    <?php } ?>
  </div>
  <div>
    <label for="">Confirm Password : </label>
    <input type="password" name="confirmpassword" id="confpassword">
    <?php if(isset($error) && strpos($error, "confirmpassword") !== false){ ?>
      <p style="color: red;" id="error-match" ><?php echo $error; ?></p>
    <?php } ?>
  </div>
  <div>
    <label for="">Image : </label>
    <input type="file" name="avatar" id="image" >
    <?php if(isset($error) && strpos($error, "avatar") !== false){ ?>
      <p style="color: red;" id="error-image" ><?php echo $error; ?></p>
    <?php } ?>
  </div>
  <button type="submit" name="submit" id="but1">Register</button>
</form>

    <br> <br>
    <a href="login.php">Login</a>
    <script src="register.js"></script>
  </body>
</html>
<?php include "footer.php" ?>