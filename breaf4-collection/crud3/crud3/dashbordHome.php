<?php
require 'config.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="dashboardHome.css">
    </head>
    <body>

 
        <div class="option">
            <div class="logo">
                <div class="dashboto-logo">
                    <p>B</p>
                    <p>LO</p>
                </div>
                <p class="logo rog">BLONION</p>
                <p class="logo">DAPP</p>
            </div>

            <!-- <p class="tagline">Helping you track your crypto portfolio. <bold>HODL</bold> to the Moon!</p> -->
            <button class="main">Crypto Dashboard</button>
            <div class="clear"></div>
            <ul class="menu">
                <a href="">
                 
                    Dashboard
                    </a>
                    <a href="index.php">
                        
                        Users</a>
                    <a href="indexProduct.php">Product</a>
                   <a href="indexCategories.php"> Categories</a>
              
                
               
            </ul>
        </div>
        
        <div class="dashboard-heading">
            <div class="panel">
                <i class="fa fa-bell">
                    <bold>1</bold>
                </i>
                <div ng-app="app" ng-controller="coin">
                    <p class="btc-price">{{priceGBP}}</p>
                </div>
            </div>
            <div class="all">
                <div class="starter-stats">
                    <div class="blok">
                        <i class="fa fa-money"></i>
                        <div class="no">
                            <p>Total Customers </p>
                            <p>20</p>
                        </div>
                    </div>
        
                    <div class="blok">
                        <i class="fa fa-money kl"></i>
                        <div class="no">
                            <p>Total Products</p>
                            <p>10</p>
                        </div>
                    </div>
        
                    <div class="blok">
                        <i class="fa fa-money pl"></i>
                        <div class="no">
                            <p>Total Orders</p>
                            <p>8 </p>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="gains">
                        <canvas id="myChart"></canvas>
                    </div>
        
                </div>
        
            </div>
        
        </div>
        <?php
// Calculate total number of customers
$sql = "SELECT COUNT(*) as total_customers FROM users";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_assoc($result);
$total_customers = $row['total_customers'];

// Calculate total number of products
$sql = "SELECT COUNT(*) as total_products FROM products";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_assoc($result);
$total_products = $row['total_products'];

// Calculate total number of orders
$sql = "SELECT COUNT(*) as total_orders FROM orders";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_assoc($result);
$total_orders = $row['total_orders'];

// Display results
echo "Total Customers: " . $total_customers . "<br>";
echo "Total Products: " . $total_products . "<br>";
echo "Total Orders: " . $total_orders . "<br>";
?>

<script src="dashboard.js"></script>
</body>
</html>