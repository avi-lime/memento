<?php
include_once "../conn.php";
if (isset($_POST['id'])) {
    $table = $_POST['table'];
    $id = $_POST['id'];
    $id_name=$_POST['idname'];
    $query = "SELECT * FROM $table WHERE $id_name=$id";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
}
