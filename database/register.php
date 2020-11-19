<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/mainadmin.css" />
    <link rel="stylesheet" href="../asset/css/resetcss.css" />
    <title>Document</title>
</head>

<body>
    <?php
    include "connect.php";
    $error = false;
    if (isset($_GET['action']) && $_GET['action'] == 'reg') {
        if (isset($_POST['username']) & isset($_POST['password'])) {
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $birthday = $_POST['birthday'];
            $result = mysqli_query($con, "INSERT INTO `casestudy`.`user` (`username`, `password`, `Name`, `email`, `address`, `birthday`) VALUES ('" . $_POST['username'] . "', '" . Md5($_POST['password']) . "', '$fullname', '$email', '$address', '$birthday');");
            if (!$result) {
                if (strpos(mysqli_error($con), "Duplicate entry") !== FALSE) {
                    $error = "Tài khoản đã tồn tại. Bạn vui lòng chọn tài khoản khác.";
                }
            }
            mysqli_close($con);
            if ($error != false) {
    ?>
                <div class="login">
                    <h1>Thông báo</h1>
                    <h4><?= $error ?></h4>
                    <a href="./register.php">Quay lại</a>
                </div>
            <?php
            } else {
            ?>
                <div class="login">
                    <h1><?= ($error !== false) ? $error : "Đăng ký tài khoản thành công" ?></h1>
                    <a href="./index.php">Đăng nhập</a>
                </div>
        <?php
            }
        }
    } else {

        ?>
        <div class="login">
            <h1>Đăng ký</h1>
            <form action="register.php?action=reg" method="post">
                <label>Username:</label></br>
                <input type="text" name="username" value=""><br />
                <label>Password:</label></br>
                <input type="password" name="password" value="" /></br>
                <label>Họ tên:</label></br>
                <input type="text" name="fullname" value="" /><br />
                <label>Email:</label></br>
                <input type="email" name="email" value="" /><br />
                <label>Address:</label></br>
                <input type="text" name="address" value="" /><br />
                <label>Birthday:</label></br>
                <input type="date" name="birthday" value="" /><br />
                <br>
                <input type="submit" value="Create">
            </form>
        </div>
    <?php } ?>
</body>

</html>