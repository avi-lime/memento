<?php
session_start();
include("../global/api/conn.php");
$userid = $_SESSION['user'];
if (isset($_REQUEST['payment'])) {
    $paymentmethod = $_REQUEST['payment'];
    $pincode;
    $state;
    $city;
    $country;
    $addressname;
    $address;
    $addresssql = 'INSERT INTO address(addressname,address,user_id,city,state,landmark,pincode) VALUES()';
    $ordersql = 'INSERT INTO order(user_id,product_id) VALUES(' . $userid . ',' . $id . ')';
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
} else {
}
?>