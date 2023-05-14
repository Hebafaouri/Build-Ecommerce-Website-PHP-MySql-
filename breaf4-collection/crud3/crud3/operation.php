<?php
require 'config.php';

if (isset($_POST['submit'])) {

    $amount = $_POST['amount'];
    $select = $_POST['select'];
    $id = $_POST['id'];

    $allemployed = isset($_POST['allemployed']) ? true : false;
    if ($select == "increase") {
        if ($allemployed == true) {
            $sql = "UPDATE employees SET salary = salary + $amount";
            $statement = $mysqli->prepare($sql);
            $statement->execute();
        } else {
            $sql = "UPDATE employees SET salary = salary + $amount WHERE id = $id";
            $statement = $mysqli->prepare($sql);
            $statement->execute();
        }
    }
    if ($select == "decrease") {
        if ($allemployed == true) {
            $sql = "UPDATE employees SET salary = salary - $amount";
            $statement = $mysqli->prepare($sql);
            $statement->execute();
        } else {
            $sql = "UPDATE employees SET salary = salary - $amount WHERE id = $id";
            $statement = $mysqli->prepare($sql);
            $statement->execute();
        }
    }

    header("Location: index.php");
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
            <div><label for="amount">Amount</label></div>
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
            <div> <label for="name">Select</label></div>
            <select name="select" id="">
                <option value="decrease">decrease</option>
                <option value="increase">increace</option>
            </select>
            <p class="error1 form-group">
                <?php
                if (isset($selectError)) {
                    echo $selectError;
                }
                ?>
            </p>
        </div>
        <div class="form-group">
            <div> <label for="age">employed id</label></div>
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
            <div> <label for="age">ALL employed </label></div>
            <input type="checkbox" name="allemployed" id="allemployed" class="form-control">
            <p class="error1 form-group">
                <?php
                if (isset($allemployedError)) {
                    echo $allemployedError;
                }
                ?>
            </p>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info" id="edit" name="submit">edit</button>
        </div>
    </form>

    <script>
        const checkbox = document.getElementById('allemployed');
        const noneDiv = document.getElementById('employed');

        checkbox.addEventListener('change', function () {
            if (this.checked) {
                noneDiv.style.display = 'none';
            } else {
                noneDiv.style.display = 'block';
            }
        });

    </script>
</body>

</html>