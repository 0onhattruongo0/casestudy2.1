<?php
include './connect.php';
$id = $_GET['id'];


$result = mysqli_query($con, "delete from product where id_product='$id'");
mysqli_close($con);
if ($result) {
    header("location:./login.php");
}
