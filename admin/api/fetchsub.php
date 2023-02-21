<?php
include("../../global/api/conn.php");
$query = "SELECT * FROM subcat WHERE cat_id=" . $_REQUEST["id"];
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$output = "<option value='-1'>Select a Sub-Category</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $output .= "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
}
echo $output;