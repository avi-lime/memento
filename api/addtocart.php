<?php
include("../global/api/conn.php");
session_start();
$userid = isset($_SESSION['user'])? $_SESSION['user'] : "";
if($userid==""){
    $message= "To add product on cart please <a href='login'>Login</a>";
}else if (isset($_REQUEST['id']) && isset($_REQUEST['quantity']) && isset($_REQUEST['size']) && !isset($_REQUEST["update"])) {
    // INSERT
    $id = $_REQUEST['id'];
    $quantity = (int) $_REQUEST['quantity'];
    $size = $_REQUEST['size'];
    $check = 'SELECT * FROM cart WHERE user_id=' . $userid . ' AND product_id=' . $id . ' AND size="' . $size . '"';
    $result = mysqli_query($conn, $check);
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {
        $sql = "UPDATE cart SET quantity=quantity + $quantity WHERE user_id=$userid AND product_id=$id AND size='$size' ";
        mysqli_query($conn, $sql) or die(mysqli_errno($conn));
        $message = "Item increased by 1";
    } else {
        $sql = 'INSERT INTO cart(product_id,quantity,size,user_id) VALUES(' . $id . ',' . $quantity . ',"' . $size . '",' . $userid . ')';
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $message = "Product added to cart.";
    }

} else if (isset($_REQUEST['cartid'])) {
    // DELETE
    $cartid = $_REQUEST['cartid'];
    if ($cartid == "empty_cart")
        $sql = "DELETE FROM cart WHERE user_id = $userid";
    else
        $sql = "DELETE FROM cart WHERE id=$cartid";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $message = "Deleted!";

} else if (isset($_REQUEST["update"]) && $_REQUEST["update"] == true) {
    // UPDATE
    $id = $_REQUEST['id'];
    $quantity = (int) $_REQUEST['quantity'];
    $size = $_REQUEST['size'];
    $sql = "UPDATE cart SET quantity=$quantity, size='$size' WHERE id=$id";
    mysqli_query($conn, $sql) or die(mysqli_errno($conn));
    $message = "Cart updated";

}

echo $message;
?>