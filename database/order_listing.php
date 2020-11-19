<?php
session_start();
if (isset($_SESSION['current_user'])) {
    $currentUser = $_SESSION['current_user'];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../asset/css/style.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title>Document</title>
    </head>

    <body>
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                <a class="navbar-brand btn btn-danger" href="login.php"> <?= $currentUser['Name'] ?></a>
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
                            <a class="nav-link disabled" href="./edit.php">Đổi mật khẩu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="./logout.php">Đăng xuất</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0 form-search" action="order_listing.php?action=sea" method="post">
                        <input class="form-control mr-sm-2" type="text" name="tim" placeholder="Search" aria-label="Search">

                        <input class="btn btn-outline-secondary my-2 my-sm-0" type="submit" name="sear" value="Search">
                    </form>

                </div>
            </nav>






            <hr style="margin-top: 80px;" />
            <div class="container-fluid pb-5">
                <div class="row">
                    <div class="col-lg col-lg-2 ">

                        <ul class="list-group">
                            <h4 class="header__menu">Danh mục</h4>
                            <li class="list-group-item">
                                <a href="login.php"> Danh sách sản phẩm </a>
                            </li>
                            <li class="list-group-item">
                                <a href="order_listing.php"> Danh sách đơn hàng </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg col-lg-10 d-flex-lg justify-content-lg-center">
                        <?php include "./order.php" ?>
                    </div>
                </div>
            </div>
        </div>


    </body>

    </html>
<?php } else {
    header('location:./login.php');
}
?>