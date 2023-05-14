<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once 'config.php';
    
    // Prepare a select statement
    $sql = "SELECT * FROM products WHERE id = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $product_name = $row["product_name"];
                    
                    $product_code=$row["product_code"];
                    $product_price=$row["product_price"];
                    $product_image=$row["product_image"];
                    $product_qty=$row["product_qty"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $mysqli->close();
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="container mt-5">

<div class="row">
    <div class="card-body">
        <form id="search-form">
            <!-- <div class="mb-3">
                <label for="search-input">Search By ID</label>
                <input type="text" class="form-control" id="search-input" name="id">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <div id="search-result"></div>
    </div> -->
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label> Product Name</label>
                        <p class="form-control-static"><?php echo $row["product_name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Product Code</label>
                        <p class="form-control-static"><?php echo $row["product_code"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Product Price</label>
                        <p class="form-control-static"><?php echo $row["product_price"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Product Image</label>
                        <p class="form-control-static"><?php echo $row["product_image"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Product QTY</label>
                        <p class="form-control-static"><?php echo $row["product_qty"]; ?></p>
                    </div>
                    
                    <div class="form-group">
                        <label>Type Product </label>
                        <p class="form-control-static"><?php echo $row["type_product"]; ?></p>
                    </div>
                    <p><a href="indexProduct.php" class="btn btn-danger">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
    <script>
        $(document).ready(function () {
            // Submit search form using AJAX
            $('#search-form').submit(function (event) {
                event.preventDefault();
                var student_id = $('#search-input').val();
                $.ajax({
                    type: 'GET',
                    url: 'search.php',
                    data: {
                        id: student_id
                    },
                    success: function (response) {
                        $('#search-result').html(response);
                    }
                });
            });
        });
    </script>
</body>
</html>
