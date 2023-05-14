<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .cart-qty {
            width: 80px;
            height: 38px;
            padding: 6px 12px;
            font-size: 16px;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        .cart-qty:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25);
        }
        
        .form-submit {
            position: relative;
        }

        .pcode {
            width: 200px;
            height: 38px;
            padding: 6px 12px;
            font-size: 16px;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            animation: shake 0.5s ease-in-out 0.1s forwards;
        }

        .pcode:focus {
            animation: none;
            border-color: #80bdff;
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25);
        }

        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            50% { transform: translateX(10px); }
            75% { transform: translateX(-10px); }
            100% { transform: translateX(0); }
        }
    </style>
</head>
<body>
    <div class="card-footer p-1">
        <form action="" class="form-submit">
            <div class="row p-2">
                <div class="col-md-6 py-1 pl-4">
                    <b>Quantity : </b>
                </div>
                <div class="col-md-6">
                    <input type="number" class="form-control pqty cart-qty" value="<?= $row['product_qty'] ?>">
                </div>
            </div>
            <input type="hidden" class="pid" value="<?= $row['id'] ?>">
            <input type="hidden" class="pname" value="<?= $row['product_name'] ?>">
            <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
            <input type="text" class="form-control pcode" placeholder="Enter promo code">
            <input type="hidden" class="pimage" value="<?= $row['product_image'] ?>">
        </form>
    </div>
</body>
</html>
