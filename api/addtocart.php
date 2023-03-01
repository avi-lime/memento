<?php 
include ("../global/api/conn.php");
session_start();
if(isset($_REQUEST['id']) && isset($_REQUEST['quantity']) && isset($_REQUEST['size'])){
    $id=$_REQUEST['id'];
    $userid=$_SESSION['user'];
    $quantity=$_REQUEST['quantity'];
    $size=$_REQUEST['size'];
    $rows=mysqli_num_rows(mysqli_query($conn,$check));
        $sql='INSERT INTO cart(product_id,quantity,size,user_id) VALUES('.$id.','.$quantity.',"'.$size.'",'.$userid.')';
        mysqli_query($conn,$sql) or die(mysqli_error($conn));    
}
?>