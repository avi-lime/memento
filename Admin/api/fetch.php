<?php
include("../../global/api/conn.php");
if (isset($_POST['id'])) {
    $table = $_POST['table'];
    $id = $_POST['id'];
    $query = "SELECT * FROM $table WHERE id=$id";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
}
mysqli_close($conn);