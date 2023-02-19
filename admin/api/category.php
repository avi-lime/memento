<?php
if (!isset($_POST["name"])) {
    header("Location: ../category.php");
} else {

    include("../../global/api/conn.php");

    $name = $_POST['name'];
    $sanitized_name = mysqli_real_escape_string($conn, $name);

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
        $sql = "INSERT INTO category (name, image) VALUES ('$sanitized_name','$image')";
    } else {
        $sql = "UPDATE category SET name='$sanitized_name'";
        if ($image != "default.png") {
            $sql .= ", image='$image'";
        }
        $sql .= "WHERE id=" . $_POST['id'];
    }

    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    header("Location: ../category.php");
}