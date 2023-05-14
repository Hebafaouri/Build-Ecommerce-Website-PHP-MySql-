<?php
require 'db.php';
$message = '';
if (isset ($_POST['name'])  && isset ($_POST['email']) && isset ($_POST['age'])&& isset ($_POST['password'])  ) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $age = $_POST['age'];
  $nameError = $passwordError = $emailError = $ageError ='';
  $regpass="/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,16}$/";
  $regem="^[_a-z0-9-]+(.[_a-z0-9-]+)@[a-z0-9-]+(.[a-z0-9-]+)(.[a-z]{2,3})$^";

  if ($_POST['name']==null || $_POST['email']==null || $_POST['password']==null || $_POST['age']==null || !preg_match($regem, $_POST['email']) || !preg_match($regpass, $_POST['password']) ){
  if($_POST['name']==null){
    $nameError='* the name fieled required';
  }

  if($_POST['email']==null){
    $emailError='* the email fieled required';
  } 

  if($_POST['password']==null){
    $passwordError='* the password fieled required';
  }
  if($_POST['age']==null){
    $ageError='* the age fieled required';
  }
  if (!preg_match($regem, $_POST['email']) && $_POST['email']!=null){
    $emailError='* the email fieled should have charctare and number and @';
  }
  if (!preg_match($regpass, $_POST['password']) && $_POST['password']!=null ){
    $passwordError='* the password at minmum 8 and maxemum 16 characters.<br> * should have spetial charctare, number, lowerletter , upper letter ';
  }
}





  else {
  $sql = 'INSERT INTO users (name, email, password, age) VALUES(:name, :email, :password, :age)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name, ':email' => $email,':password' => $password, ':age' => $age])) {
    $message = 'data inserted successfully';
    }
}
}


 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Create a person</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <p class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control">
          <p class="error1 form-group">
          <?php 
          if (isset($nameError)){
            echo $nameError;
          }
          ?>
          </p>
        
        <div class="form-group">
          <label for="email">Email</label>
          <input name="email" id="email" class="form-control" value="">
          <p class="error1 form-group">
          <?php 
          if (isset($emailError)){
            echo $emailError;
          }
          ?>
          </p>
        </div>
        <div class="form-group">
          <label for="age">Age</label>
          <input type="age" name="age" id="age" class="form-control">
          <p class="error1 form-group">
          <?php 
          if (isset($ageError)){
            echo $ageError;
          }
          ?>
          </p>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control">
          <p class="error1 form-group">
          <?php 
          if (isset($passwordError)){
            echo $passwordError;
          }
          ?>
          </p>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Create a person</button>
        </div>
      </form>
    </div>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
