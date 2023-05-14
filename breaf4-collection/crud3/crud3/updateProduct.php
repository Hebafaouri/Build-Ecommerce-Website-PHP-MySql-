<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$product_name = $product_code = $product_price = $product_image = $product_qty = $type_product= "";
$product_name_err = $product_code_err = $product_price_err = $product_image_err = $product_qty_err =$type_product_err= "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_product_name = trim($_POST["product_name"]);
    if (empty($input_product_name)) {
        $product_name_err = "Please enter a name.";
    } elseif (!filter_var(trim($_POST["product_name"]), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z'-.\s ]+$/")))) {
        $product_name_err = 'Please enter a valid name.';
    } else {
        $product_name = $input_product_name;
    }
    // Validate code
    $input_product_code = trim($_POST["product_code"]);
    if (empty($input_product_code)) {
        $product_code_err = "Please enter a name.";
    } elseif (!filter_var(trim($_POST["product_code"]), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z'-.\s ]+$/")))) {
        $product_code_err = 'Please enter a valid name.';
    } else {
        $product_code = $input_product_code;
    }

    // Validate price
    $input_product_price = trim($_POST["product_price"]);
    if (empty($input_product_price)) {
        $product_price_err = "Please enter a name.";
    } elseif (!filter_var(trim($_POST["product_price"]), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z'-.\s ]+$/")))) {
        $product_price_err = 'Please enter a valid name.';
    } else {
        $product_price = $input_product_price;
    }
// Validate image
$input_product_image = trim($_POST["product_image"]);
if (empty($input_product_image)) {
    $product_image_err = "Please enter a name.";
} elseif (!filter_var(trim($_POST["product_image"]), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z'-.\s ]+$/")))) {
    $product_image_err = 'Please enter a valid name.';
} else {
    $product_image = $input_image_code;
}
// Validate password
$input_product_qty = trim($_POST["product_qty"]);
if (empty($input_product_qty)) {
    $product_qty_err = "Please enter a name.";
} elseif (!filter_var(trim($_POST["product_qty"]), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z'-.\s ]+$/")))) {
    $product_qty_err = 'Please enter a valid name.';
} else {
    $product_qty = $input_qty_code;
}

$input_type_product = trim($_POST["type_product"]);
if (empty($input_type_product )) {
    $type_product_err = "Please enter a name.";
} elseif (!filter_var(trim($_POST["type_product"]), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z'-.\s ]+$/")))) {
    $type_product_err = 'Please enter a valid name.';
} else {
    $type_product = $type_product_code;
}  
    // Check input errors before inserting in database
    if(empty($name_err) &&  empty($name_err)){
        // Prepare an insert statement
        $sql = "UPDATE products SET product_name=? WHERE id=?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_product_name, $param_id);
            
            // Set parameters
            $param_product_name = $product_name;
            
          
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: indexProduct.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM products WHERE id = ?";
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
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
                    $type_product =$row["type_product"];
                   
                } else{
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group <?php echo (!empty($product_name_err)) ? 'has-error' : ''; ?>">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control" value="<?php echo $product_name; ?>">
                            <span class="help-block">
                                <?php echo $product_name_err; ?>
                            </span>
                        </div>

                        <div class="form-group <?php echo (!empty($product_code_err)) ? 'has-error' : ''; ?>">
                            <label>Product Code</label>
                            <input type="text" name="product_code" class="form-control" value="<?php echo $product_code; ?>">
                            <span class="help-block">
                                <?php echo $product_code_err; ?>
                            </span>
                        </div>
                     

                        <div class="form-group <?php echo (!empty($product_price_err)) ? 'has-error' : ''; ?>">
                            <label>Product Price</label>
                            <input type="text" name="product_price" class="form-control" value="<?php echo $product_price; ?>">
                            <span class="help-block">
                                <?php echo $product_price_err; ?>
                            </span>
                        </div>
                        <div class="form-group <?php echo (!empty($product_image_err)) ? 'has-error' : ''; ?>">
                            <label>Product Image</label>
                            <input type="text" name="product_image" class="form-control" value="<?php echo $product_image; ?>">
                            <span class="help-block">
                                <?php echo $product_image_err; ?>
                            </span>
                        </div>
                       
                        <div class="form-group <?php echo (!empty($product_qty_err)) ? 'has-error' : ''; ?>">
                            <label>Product Image</label>
                            <input type="text" name="product_qty" class="form-control" value="<?php echo $product_qty; ?>">
                            <span class="help-block">
                                <?php echo $product_qty_err; ?>
                            </span>
                        </div>
                       
                        <div class="form-group <?php echo (!empty($type_product_err)) ? 'has-error' : ''; ?>">
                            <label>Product Type</label>
                            <input type="text" name=" type_product " class="form-control" value="<?php echo $type_product ; ?>">
                            <span class="help-block">
                                <?php echo $type_product_err; ?>
                            </span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-danger" value="Submit">
                        <a href="indexProduct.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>