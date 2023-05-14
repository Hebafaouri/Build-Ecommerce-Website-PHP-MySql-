<?php 

if(isset($_POST['signup'])){
   header("location: signup.php");
}
if(isset($_POST['login'])){
    header("location: login.php");
 }
 

?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

</style>
</head>
<body>

<h1 style= "color:green">Welcom page</h1>

<form  method="post">
  <div class="container">
    <button type="submit" name="login">Login</button>
    <button type="submit" name="signup">Signup</button>
  </div>
</form>

</body>
</html>
