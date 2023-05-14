<?php
session_start(); // Add this line to start the session

require "db.php";

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $min_price = $_POST['min_price'];
    $max_price = $_POST['max_price'];

    // Modify the SQL query to include a WHERE clause for price
    $stmt = $connection->prepare("SELECT * FROM products WHERE price >= :min_price AND price <= :max_price");
    $stmt->bindParam(':min_price', $min_price);
    $stmt->bindParam(':max_price', $max_price);
} else {
    // If no filter is applied, fetch all products
    $stmt = $connection->prepare("SELECT * FROM products");
}

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Filter</title>
  <!-- Link to Bootstrap stylesheet -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-4">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-inline mb-4">
      <div class="form-group mr-2">
        <label for="min_price" class="mr-2">Minimum price:</label>
        <input type="text" id="min_price" name="min_price" class="form-control">
      </div>
      <div class="form-group mr-2">
        <label for="max_price" class="mr-2">Maximum price:</label>
        <input type="text" id="max_price" name="max_price" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Filter</button>
    </form>
    <div class="row">
      <?php foreach ($results as $row): ?>
        <div class="col-md-4">
          <div class="card mb-4">
            <img src="<?php echo $row['avatar']; ?>" alt="Product Image" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['name']; ?></h5>
              <p class="card-text">Price: <?php echo $row['price']; ?></p>
              <button class="btn btn-success">Add to Cart</button>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <!-- Link to jQuery and Bootstrap JavaScript -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

