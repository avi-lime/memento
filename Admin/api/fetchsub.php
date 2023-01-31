<?php
include "../conn.php";
$id= $_POST["id"];
$query = "SELECT * FROM tblsubcat WHERE cat_id=" .$id;
$result = mysqli_query($conn, $query);
$output = "<option value='-1'>Select a Sub-Category</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $output .= "<option value='" . $row["subCat_id"] . "'>" . $row["subCat_name"] . "</option>";
}
echo $output;
?>