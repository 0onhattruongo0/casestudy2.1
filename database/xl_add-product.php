<?php
include './connect.php';

if (isset($_POST['Name']) && isset($_POST['img']) && isset($_POST['price'])) {


    $Name = $_POST['Name'];
    $img = $_POST['img'];
    $price = $_POST['price'];
    $result = mysqli_query($con, "insert into product(Name,img,price) values ('$Name','$img','$price')");
}


mysqli_close($con);

if ($result) {
    header("location:login.php");
}
