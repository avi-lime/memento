<?php 
include "../global/api/conn.php";
session_start();
$userid=mysqli_real_escape_string($conn,$_SESSION['user']);
$amount=mysqli_real_escape_string($conn,$_REQUEST['amount']);
$addressid=mysqli_real_escape_string($conn,$_REQUEST['addressid']);
$status=mysqli_real_escape_string($conn,$_REQUEST['status']);
$date=mysqli_real_escape_string($conn,$_REQUEST['date']);
$success=mysqli_real_escape_string($conn,$_REQUEST['success']);
if($success=="false"){
    $success="Failed";
}else{
    $success="Completed";
}
if($_REQUEST['orderid']){
$orderid=mysqli_real_escape_string($conn,$_REQUEST['orderid']);
}else{
$orderid=mysqli_real_escape_string($conn,$_SESSION['razorpay_order_id']);
}
$sql="SELECT * FROM cart WHERE user_id=$userid";
$result=mysqli_query($conn,$sql) or die(mysqli_errno($conn));
while($product=mysqli_fetch_assoc($result)){
    $productid=mysqli_real_escape_string($conn,$product['product_id']);
    $quantity=mysqli_real_escape_string($conn,$product['quantity']);
    $size=mysqli_real_escape_string($conn,$product['size']);
    // echo $productid."      quantity".$quantity."     size".strtoupper($size)."    Amount ". $amount."   ".$addressid.'    '.$status.'       '.$date.'   '.$success .'  '.$orderid.'  ';
     $sql="INSERT INTO orders(order_id,user_id,product_id,address_id,amount,date,quantity,size) VALUES('$orderid',$userid,$productid,$addressid,$amount,'$date',$quantity,'$size')";
    //  echo $sql;
     mysqli_query($conn,$sql) or die(mysqli_error($conn));
}
$sql="INSERT INTO payment(order_id,transaction_date,payment_mode,status,amount) VALUES('$orderid','$date','$status','$success',$amount)";
mysqli_query($conn,$sql) or die(mysqli_error($conn));
if($success=="Completed"){
$sql="DELETE FROM cart WHERE user_id=$userid";
mysqli_query($conn,$sql) or die(mysqli_error($conn));
}
?>