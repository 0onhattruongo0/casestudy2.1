<?php
include './connect.php';
$id = $_GET['id'];


$result = mysqli_query($con, "delete from orders where id_order='$id'");
mysqli_close($con);
if ($result) {
    header("location:./order_listing.php");
}
