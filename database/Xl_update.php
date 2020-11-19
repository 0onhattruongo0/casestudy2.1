<?php

include './connect.php';
$id = $_POST['id'];
$name = $_POST['Name'];
$img = $_POST['img'];
$price = $_POST['price'];


$result = mysqli_query($con, "update product set Name='$name', img='$img', price = '$price' where id_product='$id'");

mysqli_close($con);

if ($result) {
    header("location:login.php");
}
