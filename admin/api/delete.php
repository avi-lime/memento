<?php
include("../../global/api/conn.php");
$table = $_GET['table'];
$id = $_GET['id'];
$sql = "DELETE FROM $table WHERE id=$id";
mysqli_query($conn, $sql) or die(mysqli_error($conn));
mysqli_close($conn);
header("Location: ../$table");