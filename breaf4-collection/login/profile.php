<?php 
require "db.php";
session_start();
if(isset($_SESSION['email']) && isset($_SESSION['password'])){

    $email = $_SESSION['email'];
    $password = $_SESSION['password'];

    $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';
    $statement = $connection->prepare($sql);
    $statement->execute([':email' => $email, ':password' => $password]);
    $user = $statement->fetch(PDO::FETCH_OBJ);

    $sql2 = 'SELECT * FROM products';
    $statement2 = $connection->prepare($sql2);
    $statement2->execute();
    $products = $statement2->fetchAll(PDO::FETCH_OBJ);

    if(isset($_POST['logout'])){
      session_unset();
      header("location: login.php");
      exit();
    }

    require "header.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>My Profile Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
  <body>
  <div class="container">
  <div class="row justify-content-center mt-5">
    <div class="col-sm-8 col-md-3">
      <div class="card">
        <img class="card-img-top" src="<?php echo htmlspecialchars($user->avatar); ?>" alt="My Profile Picture">
        <div class="card-body">
          <h5 class="card-title"><?php echo htmlspecialchars($user->name); ?></h5>
          <p class="card-text"><?php echo htmlspecialchars($user->email); ?></p>
          <p class="card-text"><?php echo htmlspecialchars($user->address); ?></p>
          <p class="card-text"><?php echo htmlspecialchars($user->contact); ?></p>
          <a href="edit.php?id=<?php echo htmlspecialchars($user->id); ?>" class="btn btn-outline-secondary">Edit Your Information</a>
        </div>
      </div>
      <form method="post">
      <input class="btn btn-danger" type="submit" name="logout" method="POST" value="log out" onclick="return confirm('Are you sure you want to log out?')">
      </form>
    </div>
    <div class="col-sm-8 col-md-9">
      <div class="card">
        <div class="card-header">
          <h2>My Account / MY Order</h2>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>number</th>
                <th>Items</th>
                <th>image</th>
                <th>Price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; foreach($products as $person): ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $person->product_name; ?></td>
                  <td> <img src="<?= $person->product_image; ?>" width="100px" height="100px"> </td>
                  <td><?= $person->product_price; ?></td>
                  <td>
                    <a href="payment.php?id=<?= $person->id ?>" class="btn btn-outline-secondary">Payment</a><br><br>
                    <a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete.php?id=<?= $person->id ?>" class='btn btn-danger'>Delete</a>
                  </td>
                </tr>
              <?php $i++; endforeach; ?>
            </tbody>
          </table>
          <div><?php
          $sql3 = 'SELECT SUM(product_price) FROM products';
          $statement3 = $connection->prepare($sql3);
          $statement3->execute();
          $result = $statement3->fetch(PDO::FETCH_NUM);
          $count = $result[0];
          echo "Total Price: " . $count;
          ?>
            <a href="payment.php?id=<?= $person->id ?>" class="btn btn-outline-secondary">Payment Now</a><br><br>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
    <?php } else {
    echo "you should log in to see this page";
} ?>

