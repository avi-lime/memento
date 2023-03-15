<?php
if (!isset($_POST["name"])) {
    header("location: ../category");
} else {

    include("../../global/api/conn.php");

    $name = $_POST['name'];
    $sanitized_name = mysqli_real_escape_string($conn, $name);

    if (file_exists($_FILES['imgfile']["tmp_name"]) && is_uploaded_file($_FILES["imgfile"]["tmp_name"])) {

        // delete old file before uploading -- save storage
        if ($_POST['id'] != '') {
            // fetch old image
            $result = mysqli_query($conn, "SELECT image FROM category WHERE id=" . $_POST['id']);
            $row = mysqli_fetch_assoc($result);
            $oldPicture = "../../global/assets/images/" . $row["image"];
            unlink($oldPicture);
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
        $sql = "INSERT INTO category (name, image) VALUES ('$sanitized_name','$image')";
    } else {
        $sql = "UPDATE category SET name='$sanitized_name'";
        if ($image != "default.png")
            $sql .= ", image='$image'";

        $sql .= "WHERE id=" . $_POST['id'];
    }

    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    header("location: ../category");
}

?>