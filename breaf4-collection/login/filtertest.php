<?php
session_start(); // Add this line to start the session

require "db.php";

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $min_price = $_POST['min_price'];
    $max_price = $_POST['max_price'];

    // Modify the SQL query to include a WHERE clause for price
    $stmt = $connection->prepare("SELECT * FROM products WHERE product_price >= :min_price AND product_price <= :max_price");
    $stmt->bindParam(':min_price', $min_price);
    $stmt->bindParam(':max_price', $max_price);
} else {
    // If no filter is applied, fetch all products
    $stmt = $connection->prepare("SELECT * FROM products");
}

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Display the filtered products in the cart
foreach ($results as $row) {
    // Add a product to the cart
    $product = array(
        'id' => $row['avatar'],
        'name' => $row['name'],
        'price' => $row['price'],
        'quantity' => 1
    );
    
    if (is_array($_SESSION['cart'])) {
        array_push($_SESSION['cart'], $product);
    } else {
        $_SESSION['cart'] = array($product);
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="min_price">Minimum price:</label>
    <input type="text" id="min_price" name="min_price">
    <label for="max_price">Maximum price:</label>
    <input type="text" id="max_price" name="max_price">
    <button type="submit">Filter</button>
</form>
<?php if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])): ?>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['cart'] as $item): ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['price']; ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo $item['price'] * $item['quantity']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</body>
</html>