<?php 
include ("../global/api/conn.php");
session_start();
if(isset($_REQUEST['id'])){
    $id=$_REQUEST['id'];
    $userid=$_SESSION['user'];
    $sql='INSERT INTO wishlist(user_id,product_id) VALUES('.$userid.','.$id.')';
    mysqli_query($conn,$sql) or die(mysqli_error($conn));
}
?>