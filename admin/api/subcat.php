<?php
if (!isset($_POST["name"]) || !isset($_POST["cat"])) {
    header("Location: ../subcat.php");
} else {

    include("../../global/api/conn.php");

    $name = $_POST['name'];
    $cat = $_POST['cat'];

    $sanitized_name = mysqli_real_escape_string($conn, $name);
    $sanitized_cat = mysqli_real_escape_string($conn, $cat);

    if (file_exists($_FILES['imgfile']["tmp_name"]) && is_uploaded_file($_FILES["imgfile"]["tmp_name"])) {
        $image = $_FILES["imgfile"]["name"];
        $tempimg = $_FILES["imgfile"]["tmp_name"];
        $path = '../../global/assets/images/' . $image;
        move_uploaded_file($tempimg, $path);
    } else {
        $image = "default.png";
    }

    $image = mysqli_real_escape_string($conn, $image);

    if ($_POST['id'] == '') {
        $sql = "INSERT INTO subcat (name, cat_id, image) VALUES ('$sanitized_name', $sanitized_cat,'$image')";
    } else {
        $sql = "UPDATE subcat SET name='$sanitized_name', cat_id='$sanitized_cat', image='$image' WHERE id=" . $_POST['id'];
    }

    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    header("Location: ../subcat.php");
}