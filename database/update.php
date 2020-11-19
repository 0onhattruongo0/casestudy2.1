<?php
include './connect.php';
$id = $_GET['id'];


$edit = mysqli_query($con, "select * from product where id_product='$id'") or die("loi");


$ed = mysqli_fetch_array($edit);

mysqli_close($con);



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../asset/css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div class="container__login">

        <form action="Xl_update.php" method="post">
            <h3> UPDATE</h3>
            <input type="hidden" name="id" value="<?= $id ?>">
            Name:
            <input type="text" name="Name" value="<?= $ed['Name'] ?>">
            Image:
            <input type="file" name="img" value="<?= $ed['img'] ?>">
            Price:
            <input type="number" name="price" value="<?= $ed['price'] ?>">

            <div class="btn_box">
                <button type="submit">UPDATE</button>
            </div>

        </form>
    </div>
</body>

</html>