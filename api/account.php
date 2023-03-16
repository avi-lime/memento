<?php
if (!isset($_REQUEST["id"]))
    header("location: ../index");

include("../global/api/conn.php");

$id = $_REQUEST["id"];
$name = mysqli_real_escape_string($conn, $_REQUEST["name"]);
$phno = mysqli_real_escape_string($conn, $_REQUEST["phno"]);
$email = mysqli_real_escape_string($conn, $_REQUEST["email"]);

mysqli_query($conn, "UPDATE user SET name='$name', mobileno='$phno', email='$email' WHERE id=$id");
echo "Changes saved.";

?>