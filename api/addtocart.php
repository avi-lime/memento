<?php 
include ("../global/api/conn.php");
session_start();
if(isset($_REQUEST['id']) && isset($_REQUEST['quantity']) && isset($_REQUEST['size'])){
    $id=$_REQUEST['id'];
    $userid=$_SESSION['user'];
    $quantity=(int)$_REQUEST['quantity'];
    $size=$_REQUEST['size'];
    $check='SELECT * FROM cart WHERE user_id='.$userid.' AND product_id='.$id.' AND size="'.$size.'"';
    $result=mysqli_query($conn,$check);
    $rows=mysqli_num_rows($result);
    if($rows>0){
        $sql="UPDATE cart SET quantity=quantity + $quantity WHERE user_id=$userid AND product_id=$id AND size='$size' ";
        mysqli_query($conn,$sql) or die(mysqli_errno($conn));
        $message="Item ince by 1";
    }else{
        $sql='INSERT INTO cart(product_id,quantity,size,user_id) VALUES('.$id.','.$quantity.',"'.$size.'",'.$userid.')';
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
        $message="Product added to cart.";    
    }
}
echo $message;
?>