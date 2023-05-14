<?php
// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$name = $avatar = $address = $email = $contact = $password = "";
$name_err = $avatar_err = $address_err = $email_err = $contact_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } elseif (!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z'-.\s ]+$/")))) {
        $name_err = 'Please enter a valid name.';
    } else {
        $name = $input_name;
    }
    // Validate address
    $input_address = trim($_POST["address"]);
    if (empty($input_address)) {
        $address_err = "Please enter a address.";

    } else {
        $address = $input_address;
    }

    // Validate address
    $input_avatar = trim($_POST["avatar"]);
    if (empty($input_avatar)) {
        $avatar_err = "Please enter a img.";

    } else {
        $avatar = $input_avatar;
    }
// Validate email
$input_email = trim($_POST["email"]);
if (empty($input_email)) {
    $email_err = "Please enter a address.";

} else {
    $email = $input_email;
}
// Validate password
$input_password = trim($_POST["password"]);
if (empty($input_password)) {
    $password_err = "Please enter a address.";

} else {
    $password= $input_password;
}
    // Check input errors before inserting in database
    if (empty($name_err) && empty($avatar_err) && empty($email_err) && empty($address_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO users (name, avatar , address, email,contact,password) VALUES (?,  ?,? ,?,?,?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssss", $param_name, $param_avatar, $param_address, $param_email, $param_contact, $param_password);

            // Set parameters
            $param_name = $name;
            $param_avatar = $avatar;
            $param_address = $address;
            $param_email = $email;
            $param_contact = $contact;
            $param_password = $password;
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
}
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
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block">
                                <?php echo $name_err; ?>
                            </span>
                        </div>

                        <div class="form-group <?php echo (!empty($contact_err)) ? 'has-error' : ''; ?>">
                            <label>Mobile</label>
                            <input type="text" name="contact" class="form-control">
                            <span class="help-block">
                                <?php echo $contact_err; ?>
                            </span>
                        </div>
                     

                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control">
                            <span class="help-block">
                                <?php echo $address_err; ?>
                            </span>
                        </div>
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control">
                            <span class="help-block">
                                <?php echo $email_err; ?>
                            </span>
                        </div>
                       
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                            <span class="help-block">
                                <?php echo $password_err; ?>
                            </span>
                        </div>
                        <div class="form-group <?php echo (!empty($avatar_err)) ? 'has-error' : ''; ?>">
                            <label>Image</label>
                            <input type="file" name="avatar" class="form-control" value="<?php echo $avatar; ?>">
                            <span class="help-block">
                                <?php echo $avatar_err; ?>
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