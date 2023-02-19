<?php
include("../../global/api/conn.php");
if (isset($_REQUEST['query'])) {
    $query = $_REQUEST["query"];
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $array = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($array, json_encode($row));
    }
    echo json_encode($array);
}
mysqli_close($conn);