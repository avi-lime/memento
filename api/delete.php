<?php
include("../global/api/conn.php");
$table = $_REQUEST['table'];
$id = $_REQUEST['id'];
$sql = "DELETE FROM $table WHERE id=$id";
mysqli_query($conn, $sql) or die(mysqli_error($conn));
?>