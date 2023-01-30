<?php
include "../conn.php";
$id = $_REQUEST['id'];
$sql = "DELETE FROM tblcategory WHERE cat_id=$id";
mysqli_query($conn, $sql) or die(mysqli_error($conn));
header("location:../Category.php");