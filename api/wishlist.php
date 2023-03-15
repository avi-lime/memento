<?php
session_start();
include("../global/api/conn.php");
$userid = $_SESSION['user'];
if (isset($_REQUEST['id']) && isset($_REQUEST["action"]) && $_REQUEST["action"] == "wishlist") {
    $id = $_REQUEST['id'];
    $sql = 'INSERT INTO wishlist(user_id,product_id) VALUES(' . $userid . ',' . $id . ')';
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $message = "Product added to wishlist!";
} elseif (isset($_REQUEST["action"]) && $_REQUEST["action"] == "delete") {
    if (isset($_REQUEST['wishlistid'])) {
        $wishlist = $_REQUEST['wishlistid'];
        $sql = 'DELETE FROM wishlist WHERE id=' . $wishlist . '';
        redirect("../wishlist");
    } else {
        $id = $_REQUEST["id"];
        $sql = 'DELETE FROM wishlist WHERE product_id=' . $id . '';
    }
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $message = "Product removed from wishlist!";
}
echo $message;
?>