<?php
session_start();
include("../global/api/conn.php");
$userid = $_SESSION['user'];
$pincode = mysqli_real_escape_string($conn, $_REQUEST['pincode']);
$state = mysqli_real_escape_string($conn, $_REQUEST['state']);
$city = mysqli_real_escape_string($conn, $_REQUEST['city']);
$country = mysqli_real_escape_string($conn, $_REQUEST['country']);
$addressname = mysqli_real_escape_string($conn, $_REQUEST['addressname']);
$address = mysqli_real_escape_string($conn, $_REQUEST['address']);
$default = mysqli_real_escape_string($conn, $_REQUEST['default']);
$id = mysqli_real_escape_string($conn, $_REQUEST['id']);
$message = "";

$sql = "SELECT * FROM address WHERE user_id=$userid AND is_default=$default";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($addressdetails = mysqli_fetch_assoc($result)) {
        $addressid = $addressdetails['id'];
        $sql = "UPDATE address SET is_default=0 WHERE id=$addressid";
        mysqli_query($conn, $sql);
    }
} else {
    $default = 1;
}

if ($id == '') {
    $sql = "INSERT INTO address(addressname,address,user_id,city,state,country,pincode,is_default) VALUES('$addressname','$address',$userid,'$city','$state','$country',$pincode,$default)";
    $message = "address save" + $id;
} else {
    $sql = "UPDATE address SET addressname='$addressname', address='$address', user_id=$userid, city='$city', state='$state', country='$country', pincode=$pincode,is_default=$default WHERE id=$id";
    $message = "Update";
}

mysqli_query($conn, $sql) or die(mysqli_error($conn));
?>