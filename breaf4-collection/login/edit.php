<?php
require 'db.php';

$id = $_GET['id'];
$sql = 'SELECT * FROM users WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);

if (isset ($_POST['submit']))  {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $address = $_POST['address'];
  $avatar = $_POST['image'];
  $firstnameError = $lastnameError =$contactError =$emailError = $imageError ='';
  $regem="^[_a-z0-9-]+(.[_a-z0-9-]+)@[a-z0-9-]+(.[a-z0-9-]+)(.[a-z]{2,3})$^";

  if ($_POST['name']==null || $_POST['email']==null || $_POST['contact']==null || $_POST['address']==null || $_POST['image']==null  ||!preg_match($regem, $_POST['email']) ){
    if($_POST['name']==null){
      $firstnameError='* the first name fieled required';
    }
    if($_POST['email']==null){
      $emailError='* the email fieled required';
    }
    if($_POST['contact']==null){
      $contactError='* the mobile fieled required';
    }
    if($_POST['image']==null){
      $imageError='* the image fieled required';
    }
    if($_POST['address']==null){
      $addressError='* the address fieled required';
    }
    if (!preg_match($regem, $_POST['email']) && $_POST['email']!=null){
      $emailError='* the email fieled should have charctare and number and @';
    }
  }

  else {
    $sql = 'UPDATE users SET name=:name , email=:email, contact=:contact, avatar=:avatar , address=:address WHERE id=:id';
    $statement = $connection->prepare($sql);

    if ($statement->execute([':name' => $name , ':email' => $email ,':contact' => $contact ,':address'=> $address, ':avatar' => $avatar, ':id' => $id])) {
    header("Location: profile.php");
    }
  }
}

 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update person</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="name">Full name</label>
          <input value="<?= $person->name; ?>" type="text" name="name" id="name" class="form-control">
          <p class="error1 form-group">
          <?php 
          if (isset($firstnameError)){
            echo $firstnameError;
          }
          ?>
          </p>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input value="<?= $person->email; ?>" name="email" id="email" class="form-control">
          <p class="error1 form-group">
          <?php 
          if (isset($emailError)){
            echo $emailError;
          }
          ?>
          </p>
        </div>
        <div class="form-group">
          <label for="address">address</label>
          <input value="<?= $person->address; ?>" type="address" name="address" id="address" class="form-control">
          <p class="error1 form-group">
          <?php 
          if (isset($addressError)){
            echo $addressError;
          }
          ?>
          </p>
        </div>
        <div class="form-group">
          <label for="image">Image</label>
          <input type="file" value="<?= $person->image; ?>" name="image" id="image" class="form-control">
          <p class="error1 form-group">
          <?php 
          if (isset($imageError)){
            echo $imageError;
          }
          ?>
          </p>
        </div>
        <div class="form-group">
          <label for="mobile">mobile</label>
          <input type="mobile" value="<?= $person->contact; ?>" name="contact" id="contact" class="form-control">
          <p class="error1 form-group">
          <?php 
          if (isset($contactError)){
            echo $contactError;
          }
          ?>
          </p>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info" name="submit">Update information</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
