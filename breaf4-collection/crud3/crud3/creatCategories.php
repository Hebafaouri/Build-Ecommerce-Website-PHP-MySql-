<?php
// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$name_categories = $description=  "";
$name_categories_err = $description_err =  "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_name_categories = trim($_POST["name_categories"]);
    if (empty($input_name_categories)) {
        $name_categories_err = "Please enter a name.";
    } elseif (!filter_var(trim($_POST["name_categories"]), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z'-.\s ]+$/")))) {
        $name_categories_err = 'Please enter a valid name.';
    } else {
        $name_categories = $input_name_categories;
    }
    // Validate code
    $input_description = trim($_POST["description"]);
    if (empty($input_description)) {
        $description_err = "Please enter a name.";
    } elseif (!filter_var(trim($_POST["description"]), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z'-.\s ]+$/")))) {
        $description_err = 'Please enter a valid name.';
    } else {
        $description = $input_description;
    }

    
    // Check input errors before inserting in database
    // if (empty($name_err) && empty($avatar_err) && empty($email_err) && empty($address_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO products (product_name, product_code , product_price, product_image,product_qty) VALUES (?,  ?,? ,?,?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_name_categories, $param_description);

            // Set parameters
            $param_name_categories = $name_categories;
            $param_description= $description;
            
        
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
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
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add user record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_categories_err)) ? 'has-error' : ''; ?>">
                            <label> Name Categories</label>
                            <input type="text" name="name_categories" class="form-control" value="<?php echo $name_categories; ?>">
                            <span class="help-block">
                                <?php echo $name_categories_err; ?>
                            </span>
                        </div>

                        <div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                            <label>description</label>
                            <input type="text" name="description" class="form-control" value="<?php echo $description; ?>">
                            <span class="help-block">
                                <?php echo $description_err; ?>
                            </span>
                        </div>
                     

                      
                        <input type="submit" class="btn btn-danger" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>