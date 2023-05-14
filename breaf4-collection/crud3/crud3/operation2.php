<?php
// Connect to the database
include 'config.php';

// Retrieve the employee's leave data
if (isset($_POST['submit'])) {

    $amount = $_POST['amount'];

    $id = $_POST['id'];
    if ($amount>14) {

            $sql = "UPDATE employees SET salary = salary /30 * $amount WHERE id=$id";
            $sql = "UPDATE employees SET offdays = offdays-$amount  WHERE id=$id";
            $statement = $mysqli->prepare($sql);
            $statement->execute();
    
            // echo "successful";
    }else{
        $sql = "UPDATE employees SET offdays = offdays-$amount  WHERE id=$id";
        $statement = $mysqli->prepare($sql);
        $statement->execute();
        // echo "not update" ;
    }
    // header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .form1 {
            display: flex;
            flex-direction: column;
        }

        .form1 div {
            margin-left: 20px;
        }

        .edit {
            height: 80px;
            width: 80px;
        }
    </style>
</head>

<body>
    <form method="post" class="form1">
        <div class="form-group">
            <div><label for="amount">Leaves Days</label></div>
            <input type="number" name="amount" id="amount" class="form-control">
            <p class="error1 form-group">
                <?php
                if (isset($amountError)) {
                    echo $amountError;
                }
                ?>
            </p>
        </div>
       
        <div class="form-group">
            <div> <label for="age">employee id</label></div>
            <input type="number" name="id" id="employed" class="form-control">
            <p class="error1 form-group">
                <?php
                if (isset($idError)) {
                    echo $idError;
                }
                ?>
            </p>
        </div>
    
        <div class="form-group">
            <button type="submit" class="btn btn-info" id="submit" name="submit">Calculate salary</button>
        </div>
    </form>

</body>

</html>