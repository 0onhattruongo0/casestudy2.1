<?php
include './connect.php';

if (!empty($_GET['action']) && $_GET['action'] == 'sea') {
    if (isset($_REQUEST['sear'])) {
        $search = $_POST['tim'];
    }
}

$item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : "10";
$current_page = !empty($_GET['page']) ? $_GET['page'] : "1";
$offset = ($current_page - 1) * $item_per_page;
if (!empty($search)) {

    $orders = mysqli_query($con, "SELECT * FROM casestudy.orders where Name like '%$search%' order by id_order desc limit $item_per_page  offset $offset ;");
} else {

    $orders = mysqli_query($con, "SELECT * FROM casestudy.orders order by id_order desc limit $item_per_page  offset $offset ;");
}
$totalproduct = mysqli_query($con, "select * from casestudy.orders");
$totalRecords = $totalproduct->num_rows;
$totalPage = ceil($totalRecords / $item_per_page);

?>

<div>
    <h2 class="header__menu text-center">Danh sách đơn hàng</h2>

    <table class="table table-bordered table-dark text-center mt-3">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Tên Khách Hàng</th>
            <th scope="col">Địa chỉ</th>
            <th scope="col">Phone</th>
            <th scope="col">Ngày mua</th>
            <th scope="col">Delete</th>
            <th scope="col">In đơn</th>

        </tr>
        <?php

        while ($row = mysqli_fetch_array($orders)) {
        ?>
            <tr>
                <td scope="row"><?= $row['id_order'] ?></td>
                <td><?= $row['Name'] ?></td>
                <td><?= $row['address'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= date('d/m/Y H:i', $row['created_time']) ?></td>
                <td><a class="btn btn-danger" href="Xl_delete-order.php?id=<?= $row['id_order'] ?>">Delete</a></td>
                <td><a class="btn btn-danger" href="order_print.php?id=<?= $row['id_order'] ?>">In đơn</a></td>
            </tr>

        <?php
        }
        ?>


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