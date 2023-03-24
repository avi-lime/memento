<?php
session_start();
include("../global/api/conn.php");
$userid = $_SESSION['user'];
    $pincode=mysqli_real_escape_string($conn,$_REQUEST['pincode']);
    $state=mysqli_real_escape_string($conn,$_REQUEST['state']);
    $city=mysqli_real_escape_string($conn,$_REQUEST['city']);
    $country=mysqli_real_escape_string($conn,$_REQUEST['country']);
    $addressname=mysqli_real_escape_string($conn,$_REQUEST['addressname']);
    $address=mysqli_real_escape_string($conn,$_REQUEST['address']);
    $addresssql = "INSERT INTO address(addressname,address,user_id,city,state,country,pincode) VALUES('$addressname','$address',$userid,'$city','$state','$country',$pincode)";
    mysqli_query($conn, $addresssql) or die(mysqli_error($conn));
?>