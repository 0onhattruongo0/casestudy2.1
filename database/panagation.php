<?php
if ($current_page > 2) {
    $fist_page = 1;
?>
    <li class="page-item"> <a class="page-link text-secondary" href="?per_page=<?= $item_per_page ?>&page=<?= $fist_page ?>">Fist</a> </li>
<?php
}
?>

<?php
if ($current_page > 1) {
    $prev_page = $current_page - 1;

?>
    <li class="page-item"> <a class="page-link text-secondary" href="?per_page=<?= $item_per_page ?>&page=<?= $prev_page ?>">Frev</a> </li>
<?php
}
?>

<?php
for ($i = 1; $i <= $totalPage; $i++) { ?>
    <?php if ($i != $current_page) { ?>

        <?php if ($i > $current_page - 2 && $i < $current_page + 2) { ?>
            <li class="page-item"> <a class="page-link text-secondary" href="?per_page=<?= $item_per_page ?>&page=<?= $i ?>"><?= $i ?></a> </li>
        <?php } ?>
    <?php } else { ?>
        <li class="page-item"> <strong class="page-link text-secondary"><?= $current_page ?> </strong> </li>

    <?php } ?>
<?php
}

?>

<?php
if ($current_page < $totalPage) {
    $next_page = $current_page + 1;

?>
    <li class="page-item"> <a class="page-link text-secondary" href="?per_page=<?= $item_per_page ?>&page=<?= $next_page ?>">Next</a> </li>
<?php
}
?>

<?php
if ($current_page < $totalPage - 1) {

?>
    <li class="page-item"> <a class="page-link text-secondary" href="?per_page=<?= $item_per_page ?>&page=<?= $totalPage ?>">Last</a> </li>
<?php
}
?>