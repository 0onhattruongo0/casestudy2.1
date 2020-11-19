<?php
include "database/connect.php";
session_start();

if (!empty($_GET['action']) && $_GET['action'] == 'sea') {
    if (isset($_REQUEST['sear'])) {
        $search = $_POST['tim'];
    }
}

if (!empty($search)) {

    $product_search = mysqli_query($con, "SELECT * FROM casestudy.product where Name like '%$search%' order by id_product asc;");
}

$item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : "8";
$current_page = !empty($_GET['page']) ? $_GET['page'] : "1";
$offset = ($current_page - 1) * $item_per_page;
$product1 = mysqli_query($con, "SELECT * FROM casestudy.product order by price desc limit  10 offset 0");
$product = mysqli_query($con, "SELECT * FROM casestudy.product order by id_product asc limit $item_per_page  offset $offset ;");
$totalproduct = mysqli_query($con, "select * from casestudy.product");
$totalRecords = $totalproduct->num_rows;
$totalPage = ceil($totalRecords / $item_per_page);

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="stylesheet" href="owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/assets/owl.theme.default.min.css">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="/owlcarousel/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <title>Home</title>
</head>

<body>
    <script>
        $(document).ready(function() {

            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 5
                    }
                }
            })
        });
    </script>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="index.php"><img src="asset/img/logo.png" alt=""></a>
        <button class="navbar_home navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
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
                    <a class="nav-link disabled" href="database/login.php">Đăng nhập</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0 form-search" action="index.php?action=sea" method="post">
                <input class="form-control mr-sm-2" type="text" name="tim" placeholder="Search" aria-label="Search">

                <input class="btn btn-outline-secondary my-2 my-sm-0" type="submit" name="sear" value="Search">
            </form>

        </div>
        <div class="cart">
            <a href="database/cart.php" class="btn btn-outline-secondary"> GIỎ HÀNG</a>
        </div>
    </nav>

    <hr style="margin-top: 80px;" />
    <div class="slide_img">
        <img src="./asset/img/slideshow_1.jpg" alt="" />
    </div>

    <?php if (empty($search)) { ?>
        <div class="title">
            <span class="product_hot"><img src="asset/img/hot.gif" alt=""></span>
            <h1>Sản phẩm nổi bật</h1>
            <span class="product_hot"><img src="asset/img/hot.gif" alt=""></span>
        </div>
        <div class="slide_owl">
            <div class="owl-carousel owl-theme">
                <?php

                while ($row1 = mysqli_fetch_array($product1)) {
                ?>
                    <div class="item">
                        <div class="product rounded">
                            <div class="product_overlay">
                                <div class="products_img"><img src="asset/img/<?= $row1['img'] ?>" alt=""></div>
                                <div class="products_Name"><?= $row1['Name'] ?></div>
                                <div class="products_price"><?= $row1['price'] ?>$</div>
                                <div class="overlay">
                                    <div class="overlay_link">
                                        <a href="database/detail.php?id=<?= $row1['id_product'] ?>">Xem thêm</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
        <div class="title">
            <span class="product_hot"><img src="asset/img/hot.gif" alt=""></span>
            <h1>Tất cả sản phẩm</h1>
            <span class="product_hot"><img src="asset/img/hot.gif" alt=""></span>
        </div>
        <div class="container pb-5">
            <div class="row">
                <?php

                while ($row = mysqli_fetch_array($product)) {
                ?>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <div class="product rounded">
                            <div class="product_overlay">
                                <div class="products_img"><img src="asset/img/<?= $row['img'] ?>" alt=""></div>
                                <div class="products_Name"><?= $row['Name'] ?></div>
                                <div class="products_price"><?= $row['price'] ?>$</div>
                                <div class="overlay">
                                    <div class="overlay_link">
                                        <a href="database/detail.php?id=<?= $row['id_product'] ?>">Xem thêm</a>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                <?php
                }
                ?>
            </div>
            <div class="pagi_position">
                <ul class="pagination">
                    <?php
                    include "database/panagation.php" ?>
                </ul>
            </div>

        </div>

    <?php } else { ?>


        <div class="container pb-5">
            <div class="row">
                <?php

                while ($row = mysqli_fetch_array($product_search)) {
                ?>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <div class="product">
                            <div class="product_overlay">
                                <div class="products_img"><img src="asset/img/<?= $row['img'] ?>" alt=""></div>
                                <div class="products_Name"><?= $row['Name'] ?></div>
                                <div class="products_price"><?= $row['price'] ?>$</div>
                                <div class="overlay">
                                    <div class="overlay_link">
                                        <a href="database/detail.php?id=<?= $row['id_product'] ?>">Xem thêm</a>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                <?php
                }
                ?>
            </div>

        <?php } ?>

        <?php include "database/footer.php" ?>
</body>


</html>