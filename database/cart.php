<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../asset/css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <?php
    include "connect.php";
    $error = false;
    $success = false;
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    if (isset($_GET['action'])) {
        function update_cart($add = false)
        {
            foreach ($_POST['quantity'] as $id => $quantity) {
                if ($quantity == 0) {
                    unset($_SESSION['cart'][$id]);
                } else {
                    if ($add) {
                        $_SESSION['cart'][$id] += $quantity;
                    } else {
                        $_SESSION['cart'][$id] = $quantity;
                    }
                }
            }
        }
        switch ($_GET['action']) {
            case "add":
                update_cart(true);
                header('location:./cart.php');
                break;
            case "delete":
                if (isset($_GET['id'])) {
                    unset($_SESSION['cart'][$_GET['id']]);
                }
                header('location:./cart.php');
                break;
            case "submit":
                if (isset($_POST['update_click'])) {
                    update_cart();
                } elseif (isset($_POST['order_click'])) {
                    if (empty($_POST['Name'])) {
                        $error = "Bạn chưa nhập tên người nhận.";
                    } elseif (empty($_POST['phone'])) {
                        $error = "Bạn chưa nhập số điện thoại người nhận.";
                    } elseif (empty($_POST['address'])) {
                        $error = "Bạn chưa nhập địa chỉ người nhận.";
                    } elseif (empty($_POST['quantity'])) {
                        $error = "Giỏ hàng rỗng.";
                    }
                    if ($error == false) {
                        $products = mysqli_query($con, "select * from product where id_product in (" . implode(",", array_keys($_POST['quantity'])) . ")");
                        $total = 0;
                        $order_product = array();
                        while ($row = mysqli_fetch_array($products)) {
                            $order_product[] = $row;
                            $total += $row['price'] * $_POST['quantity'][$row['id_product']];
                        }
                        $insert_order = mysqli_query($con, "INSERT INTO `casestudy`.`orders` (`Name`, `phone`, `address`, `note`, `total`, `created_time`, `last_update`) VALUES ('" . $_POST['Name'] . "', '" . $_POST['phone'] . "', '" . $_POST['address'] . "', '" . $_POST['note'] . "', '" . $total . "', '" . time() . "', '" . time() . "');");
                        $orderID = $con->insert_id;
                        $insert_string = "";
                        foreach ($order_product as $key => $products) {
                            $insert_string .= "('" . $orderID . "','" . $products['id_product'] . "','" . $_POST['quantity'][$products['id_product']] . "','" . $products['price'] . "','" . time() . "','" . time() . "')";
                            if ($key != count($order_product) - 1) {
                                $insert_string .= ",";
                            }
                        };

                        $insert_order = mysqli_query($con, "INSERT INTO `casestudy`.`orders_detail` (`id_order`, `id_product`, `quanlity`, `price`, `created_time`, `last_update`) VALUES " . $insert_string . "; ");
                        if ($insert_order == true) {
                            unset($_SESSION['cart']);
                            $success = "Bạn đã đặt hàng thành công";
                        }
                    }
                }

                break;
        }
    }
    if (!empty($_SESSION['cart'])) {
        $products = mysqli_query($con, "select * from product where id_product in (" . implode(",", array_keys($_SESSION['cart'])) . ")");
    }

    ?>
    <div class="pb-5">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="../index.php"><img src="../asset/img/logo.png" alt=""></a>
            <button class="navbar_home navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="login.php">Đăng nhập</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0 form-search" action="index.php?action=sea" method="post">
                    <input class="form-control mr-sm-2" type="text" name="tim" placeholder="Search" aria-label="Search">

                    <input class="btn btn-outline-secondary my-2 my-sm-0" type="submit" name="sear" value="Search">
                </form>

            </div>
            <div class="cart">
                <a href="cart.php" class="btn btn-outline-secondary">GIỎ HÀNG</a>
            </div>
        </nav>

        <hr style="margin-top: 80px;" />

        <div class="container border border-secondary rounded">
            <h1 class="text-center">CART</h1>
            <div class="text-danger">
                <?= (!empty($error)) ? $error : "" ?>
                <?= (!empty($success)) ? $success : "" ?>
            </div>
            <hr>
            <form action="cart.php?action=submit" method="post">
                <table class="table table-bordered table-dark text-center">
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên Sản Phẩm</th>
                        <th class="d-none d-md-block" scope="col">Ảnh sản phẩm</th>
                        <th scope="col">Đơn giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thành tiền</th>
                        <th scope="col">Xóa</th>
                    </tr>
                    <?php
                    if (isset($products) & (isset($_SESSION['cart']))) {

                        $total = 0;
                        $num = 1;
                        while ($row = mysqli_fetch_array($products)) { ?>
                            <tr>
                                <td scope="row"><?= $num ?></td>
                                <td><?= $row['Name'] ?> </td>
                                <td class="d-none d-md-block"><img src="../asset/img/<?= $row['img'] ?>" alt="" style="width:100px"></td>
                                <td>Giá:<?= $row['price'] ?>$ </td>
                                <td><input class="text-center" type="text" size="1" value="<?= $_SESSION['cart'][$row['id_product']] ?>" name="quantity[<?= $row['id_product'] ?>]"></td>
                                <td><?= $row['price'] * $_SESSION['cart'][$row['id_product']] ?>$</td>
                                <td><a class="text-decoration-none btn btn-outline-danger" href="cart.php?action=delete&id=<?= $row['id_product'] ?>">Delete</a></td>
                            </tr>
                        <?php
                            $total += $row['price'] * $_SESSION['cart'][$row['id_product']];
                            $num++;
                        } ?>
                        <tr>
                            <td scope="row"></td>
                            <td><strong> Tổng Tiền </strong></td>
                            <td class="d-none d-md-block"></td>
                            <td></td>
                            <td></td>
                            <td style="color: red;"><strong><?= $total ?>$</strong></td>
                            <td></td>
                        </tr>
                    <?php
                    } ?>

                </table class="container-fluid">
                <div class="d-flex justify-content-end">

                    <input class="btn btn-outline-dark" type="submit" name="update_click" value="Cập nhật">
                </div>

                <hr>
                <div class="container pb-3">
                    <h2 class="text-center text-danger">Thông tin khách hàng</h2>

                    <div class="form-group">
                        <label class="ml-3">Name:</label>
                        <input type="text" class="form-control" value="" name="Name" placeholder="Enter Name">

                    </div>

                    <div class="form-group">
                        <label class="ml-3">Phone:</label>
                        <input type="number" class="form-control" value="" name="phone" placeholder="Enter Phone">

                    </div>

                    <div class="form-group">
                        <label class="ml-3">Address:</label>
                        <input type="text" class="form-control" value="" name="address" placeholder="Enter Address">

                    </div>
                    <div class="form-group">
                        <label class="ml-3">Note:</label>
                        <input type="text" class="form-control" value="" name="note" placeholder="Enter Note">

                    </div>
                    <br><br>
                    <input class="btn btn-danger " type="submit" name="order_click" value="Mua Hàng">

                </div>
            </form>
        </div>
    </div>
    <div>
        <?php include "footer.php" ?>
    </div>

</body>

</html>