<?php
include("../global/api/conn.php");
session_start();
$userid = $_SESSION['user'];
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $sql = 'INSERT INTO wishlist(user_id,product_id) VALUES(' . $userid . ',' . $id . ')';
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
} elseif (isset($_REQUEST['wishlistid'])) {
    $wishlist = $_REQUEST['wishlistid'];
    $sql = 'DELETE FROM wishlist WHERE id='.$wishlist.'';
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    header("Refresh:0");
    ?>
    <script> location.reload();</script>
    <?php
}
?>
