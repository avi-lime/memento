<?php
include "../conn.php";
$id = $_REQUEST['id'];
$sql = "DELETE FROM tblsubcat WHERE subCat_id=$id";
mysqli_query($conn, $sql) or die(mysqli_error($conn));
mysqli_close($conn);
