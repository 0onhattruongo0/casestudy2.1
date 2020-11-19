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
    <script src="../asset/javascrips/javascripts.js"></script>
    <?php
    include "./connect.php";
    $result = mysqli_query($con, "SELECT * FROM product where id_product =" . $_GET['id']);
    $product = mysqli_fetch_assoc($result);
    $imglibrary = mysqli_query($con, "SELECT * FROM library_img where id_product =" . $_GET['id']);
    $product['images'] = mysqli_fetch_all($imglibrary, MYSQLI_ASSOC);


    ?>
    <div>
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
                        <a class="nav-link disabled" href="#">Đăng nhập</a>
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

        <div class="container pb-5">
            <h2 class="text-center">Chi tiết sản phẩm</h2>
            <hr>
            <div class="row">
                <div class="col-12  col-md-7 product_detail-img">
                    <div class="product_detail img-magnifier-container"><img id="expandedImg" src="../asset/img/<?= $product['img'] ?>" alt=""></div>
                    <div class="galery_img-all container d-flex galery_img-all">

                        <?php
                        foreach ($product['images'] as $img) { ?>
                            <div class="col-6 galery_img"><img src="../asset/img/<?= $img['image'] ?>" alt="" onclick="myFunction(this);"></div>
                        <?php } ?>

                    </div>

                </div>
                <div class="col-12  col-md-5 mt-5 product_detail-name">
                    <h1><?= $product['Name'] ?></h1>
                    <div>
                        <span class="text-danger font-weight-bold">Giá:<?= $product['price'] ?>$</span>
                        <div class="d-none d-md-block">
                            <br>
                            <pre>
Mỗi bộ sản phẩm bao gồm:

Nón:
- 100% Cotton
- Freesize
- Thiết kế đồ họa bởi 5THEWAY Team
- Freesize
Ứng dụng VieON:
- Thẻ Giftcode xem gói VIP 1 Tháng
                            </pre>
                        </div>

                        <div>
                            <form action="cart.php?action=add" method="post">
                                <input class="text-center" type="text" value="1" name="quantity[<?= $product['id_product'] ?>]" size="2">
                                <br>
                                <br>
                                <div>

                                    <input class="btn btn-dark" type="submit" value="Thêm vào giỏ hàng">
                                </div>
                            </form>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>



    </div>
    <?php include "footer.php" ?>
    </div>
</body>


</html>