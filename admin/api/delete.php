<?php
include("../../global/api/conn.php");
$table = $_REQUEST['table'];
$id = $_REQUEST['id'];

// if image exists then delete it
if ($table == "product")
    $select_query = "SELECT image FROM product_images WHERE product_id =" . $id;
else
    $select_query = "SELECT image FROM $table WHERE id=" . $id;

if ($result = mysqli_query($conn, $select_query)) {

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['image']) {
            $oldPicture = "../../global/assets/images/" . $row["image"];
            unlink($oldPicture);
        }
    }
}

$sql = "DELETE FROM $table WHERE id=$id";
mysqli_query($conn, $sql) or die(mysqli_error($conn));
header("location: ../$table");
?>