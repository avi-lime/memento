<?php
if (!isset($_POST["name"]) || !isset($_POST["cat"])) {
    header("location: ../subcat");
} else {

    include("../../global/api/conn.php");

    $name = $_POST['name'];
    $cat = $_POST['cat'];

    $sanitized_name = mysqli_real_escape_string($conn, $name);
    $sanitized_cat = mysqli_real_escape_string($conn, $cat);

    if (file_exists($_FILES['imgfile']["tmp_name"]) && is_uploaded_file($_FILES["imgfile"]["tmp_name"])) {
        // delete old file before uploading -- save storage
        if ($_POST['id'] != '') {
            // fetch old image
            $result = mysqli_query($conn, "SELECT image FROM subcat WHERE id=" . $_POST['id']);
            $row = mysqli_fetch_assoc($result);
            unlink("../../global/assets/images/" . $row["image"]);
        }

        // upload new file
        $temp = explode(".", $_FILES["imgfile"]["name"]);
        $image = round(microtime(true)) . '.' . end($temp);
        move_uploaded_file($_FILES["imgfile"]["tmp_name"], "../../global/assets/images/" . $image);
    } else {
        $image = "default.png";
    }

    $image = mysqli_real_escape_string($conn, $image);

    if ($_POST['id'] == '') {
        $sql = "INSERT INTO subcat (name, cat_id, image) VALUES ('$sanitized_name', $sanitized_cat,'$image')";
    } else {
        $sql = "UPDATE subcat SET name='$sanitized_name', cat_id='$sanitized_cat'";
        if ($image != "default.png")
            $sql .= ", image='$image'";

        $sql .= " WHERE id=" . $_POST['id'];
    }

    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    header("location: ../subcat.php");
}