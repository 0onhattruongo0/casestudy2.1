<?php
include './connect.php';
if (isset($_SESSION['current_user'])) {


    if (!empty($_GET['action']) && $_GET['action'] == 'sea') {
        if (isset($_REQUEST['sear'])) {
            $search = $_POST['tim'];
        }
    }

    $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : "8";
    $current_page = !empty($_GET['page']) ? $_GET['page'] : "1";
    $offset = ($current_page - 1) * $item_per_page;
    if (!empty($search)) {

        $product = mysqli_query($con, "SELECT * FROM casestudy.product where Name like '%$search%' order by id_product asc limit $item_per_page  offset $offset ;");
    } else {

        $product = mysqli_query($con, "SELECT * FROM casestudy.product order by id_product asc limit $item_per_page  offset $offset ;");
    }
    $totalproduct = mysqli_query($con, "select * from casestudy.product");
    $totalRecords = $totalproduct->num_rows;
    $totalPage = ceil($totalRecords / $item_per_page);

?>

    <div>
        <h2 class="header__menu text-center">PRODUCTS</h2>
        <div class="d-flex justify-content-end mt-3 mb-3">
            <div class="btn btn-danger "><a class="text-light " href="add_product.php">Thêm sản phẩm</a></div>
        </div>

        <table class="table table-bordered table-dark text-center">
            <tr>
                <th scope="col">Tên sản phẩm</th>
                <th class="d-none d-md-block" scope="col">Image</th>
                <th scope="col">Giá</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>

            </tr>
            <?php

            while ($row = mysqli_fetch_array($product)) {
            ?>
                <tr>
                    <td scope="row"><strong><?= $row['Name'] ?></strong></td>
                    <td class="d-none d-md-block"><img src="../asset/img/<?= $row['img'] ?>" style="width:100px" alt=""></td>
                    <td>
                        <div>Giá:<?= $row['price'] ?>$</div>
                    </td>
                    <td><a class="btn btn-danger " href="update.php?id=<?= $row['id_product'] ?>">Edit</a></td>
                    <td><a class="btn btn-danger " href="delete.php?id=<?= $row['id_product'] ?>"> Delete </a></td>
                </tr>

            <?php } ?>


        </table>
        <div class="pagi_position">
            <ul class="pagination">
                <?php
                include "panagation.php" ?>
            </ul>
        </div>
        <?php include "footer.php";
        ?>
    </div>

<?php
} else {
    header('location:./login.php');
} ?>