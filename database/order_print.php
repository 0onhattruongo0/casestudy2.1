<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="../asset/css/style.css"> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    if (!empty($_SESSION['current_user'])) {
        include "connect.php";
        $orders = mysqli_query($con, "select orders.Name,orders.phone,orders.address,orders_detail.*, product.Name as product_Name from orders
    inner join orders_detail on orders_detail.id_order = orders.id_order
    inner join product on product.id_product= orders_detail.id_product
    where orders.id_order=" . $_GET['id']);
        $orders = mysqli_fetch_all($orders, MYSQLI_ASSOC);
    }
    ?>
    <div class="position-relative text-center m-auto border border-secondary" style="width:400px;">
        <div>
            <h2>Chi tiết đơn hàng</h2>
            <label for="">Người nhận:</label><span><?= $orders[0]['Name'] ?></span><br>
            <label for="">Số điện thoại:</label><span><?= $orders[0]['phone'] ?></span><br>
            <label for="">Địa chỉ:</label><span><?= $orders[0]['address'] ?></span><br>
        </div>
        <hr>
        <h3>Danh sách sản phẩm</h3>
        <div>
            <?php
            $total_quantity = 0;
            $total_money = 0;
            foreach ($orders as $row) {
            ?>
                <div>
                    <span><?= $row['product_Name'] ?></span>
                    <br>
                    <span>SL:<?= $row['quanlity'] ?></span>

                </div>
            <?php
                $total_money += ($row['price'] * $row['quanlity']);
                $total_quantity += $row['quanlity'];
            }
            ?>
        </div>
        <hr>
        <div>
            <label for="">Tổng số lượng:<?= $total_quantity ?></label>- <label for="">Tổng tiền:<?= $total_money ?>$</label>
        </div>
    </div>
</body>

</html>