<?php
include("../../global/api/conn.php");
$table = $_REQUEST['table'];
$id = $_REQUEST['id'];

// if image exists then delete it
$result = mysqli_query($conn, "SELECT image FROM category WHERE id=" . $id);
$row = mysqli_fetch_assoc($result);
echo $row["image"];
if ($row['image']) {
    $oldPicture = "../../global/assets/images/" . $row["image"];
    unlink($oldPicture);
}

$sql = "DELETE FROM $table WHERE id=$id";
mysqli_query($conn, $sql) or die(mysqli_error($conn));
mysqli_close($conn);
// header("Location: ../$table");