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
    <title>login</title>
</head>

<body>



    <?php
    session_start();
    include './connect.php';
    $error = false;
    if (isset($_POST['username']) & isset($_POST['password'])) {
        $result = mysqli_query($con, "Select `id_user`,`username`,`Name`,`email`,`birthday` from `user` WHERE (`username` ='" . $_POST['username'] . "' AND `password` = md5('" . $_POST['password'] . "'))");
        if (!$result) {
            mysqli_error($con);
        } else {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['current_user'] = $user;
        }
        mysqli_close($con);
        if ($error != false || $result->num_rows == 0) {
    ?>
            <div class="container__login text-center">
                <h3>Thông báo</h3>
                <h5 class="text-danger"><?= !empty($error) ? $error : "Thông tin đăng nhập ko đúng"  ?> </h5>
                <a class="btn btn-outline-danger" href="login.php">Quay lại</a>
            </div>
        <?php
            exit;
        }
        ?>
    <?php
    }
    ?>

    <?php if (empty($_SESSION['current_user'])) { ?>

        <div class="container__login">
            <form action="./login.php" method="Post">
                <h3>LOGIN</h3>
                <input type="text" name="username" value="" placeholder="UseName" />
                <input type="password" name="password" value="" placeholder="Password" />
                <div class="btn_box">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>


    <?php } else {
        $currentUser = $_SESSION['current_user'];
    ?>
        <?php include "./product_list.php" ?>
    <?php } ?>

</body>

</html>