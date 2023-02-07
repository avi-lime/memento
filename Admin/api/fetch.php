<?php
include("../../global/api/conn.php");
if (isset($_REQUEST['query'])) {
    $query = $_REQUEST["query"];
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $array = array();
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($array, json_encode($row));
        }
        echo json_encode($array);
    }
}
mysqli_close($conn);