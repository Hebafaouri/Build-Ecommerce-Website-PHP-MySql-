<?php require "db.php"; ?>
<?php 
if(isset($_POST['input'])){
$input = $_POST['input'];
$query = "SELECT * FROM products WHERE name LIKE '{$input}%'";
$statement = $connection->prepare($sql);
$statement->execute();
$person = $statement->fetch(PDO::FETCH_OBJ);
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

    <input type="text" id="live-search">
    <div id="search-result"></div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
        $("#live-search").keyup(function(){
            var input = $(this).val();
            if(input != ""){
                $.ajax({
                    url:"liveSearch.php",
                    method:"POST",
                    data:{input:input},

                    success:function(data){
                        $("#search-result").html(data);
                    }
                });
            }else {
                $("#search-result").css("desplay","none");
            }
        });
    });
  </script>
</body>
</html>
