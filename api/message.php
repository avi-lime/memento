<?php
include("../global/api/conn.php");
if (isset($_REQUEST["email"])) {
    $email = mysqli_real_escape_string($conn, $_REQUEST['email']);
    $name = mysqli_real_escape_string($conn, $_REQUEST['name']);
    $message = mysqli_real_escape_string($conn, $_REQUEST['message']);
    $replied_to = isset($_REQUEST["replied_to"]) ? $_REQUEST["replied_to"] : "null";
    $replied_by = isset($_REQUEST["replied_by"]) ? $_REQUEST["replied_by"] : "null";

    $sql = "INSERT INTO messages (name, email, message, replied_to, replied_by) VALUES ('$name', '$email', '$message', $replied_to, $replied_by)";
    echo $sql;
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if ($replied_to != null) {
        $sql = "UPDATE messages SET replied=1 WHERE id=" . $replied_to;
        mysqli_query($conn, $sql) or die(mysqli_error($conn));

    }
}
?>