<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../asset/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include './connect.php';
    $error = false;
    if (isset($_GET['action']) && $_GET['action'] == 'edit') {
        if (isset($_POST['id_user']) && isset($_POST['old_password']) && isset($_POST['new_password']) && $_POST['old_password'] != "" && $_POST['new_password'] != "") {
            $userResult = mysqli_query($con, "Select * from `user` WHERE (`id_user` = " . $_POST['id_user'] . " AND `password` = '" . md5($_POST['old_password']) . "')");
            if ($userResult->num_rows > 0) {
                $result = mysqli_query($con, "UPDATE `user` SET `password` = MD5('" . $_POST['new_password'] . "') WHERE (`id_user` = " . $_POST['id_user'] . " AND `password` = '" . md5($_POST['old_password']) . "')");
            } else {
                $error = "Mật khẩu cũ không đúng.";
            }
            mysqli_close($con);
            if ($error !== false) {
    ?>
                <div class="container__login text-center">
                    <h3>Thông báo</h3>
                    <h4 class="text-danger"><?= $error ?></h4>
                    <a class="btn btn-outline-danger" href="./edit.php">Đổi lại mật khẩu</a>
                </div>
            <?php } else { ?>
                <div class="container__login text-center">
                    <h3><?= ($error !== false) ? $error : "Sửa tài khoản thành công" ?></h3>
                    <a class="btn btn-outline-danger" href="login.php">Quay lại tài khoản</a>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="container__login text-center">
                <h3>Vui lòng nhập đủ thông tin để sửa tài khoản</h3>
                <a class="btn btn-outline-danger" href="./edit.php">Quay lại sửa tài khoản</a>
            </div>
        <?php
        }
    } else {
        session_start();
        $user = $_SESSION['current_user'];
        if (!empty($user)) {
        ?>
            <div class="container__login">

                <form action="./edit.php?action=edit" method="Post">
                    <h3>Xin chào "<?= $user['Name'] ?>"<br> Bạn đang thay đổi mật khẩu</h3>
                    <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">

                    <input type="password" name="old_password" value="" placeholder="Password cũ" />

                    <input type="password" name="new_password" value="" placeholder="Password mới" />
                    <div class="btn_box">
                        <button type="submit">Đổi mật khẩu</button>
                    </div>
                </form>
            </div>



    <?php
        }
    }
    ?>
</body>

</html>