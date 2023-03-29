<?php
if (!isset($_POST["name"])) {
    header("location: ../slider");
} else {

    include("../../global/api/conn.php");

    $name = $_POST['name'];
    $cat_id=$_POST['cat'];
    $subcat_id=$_POST['subcat'];
    $sanitized_subcat_id=mysqli_real_escape_string($conn,$subcat_id);
    $sanitized_name = mysqli_real_escape_string($conn, $name);
    $sanitized_cat_id= mysqli_real_escape_string($conn,$cat_id);

    if (file_exists($_FILES['imgfile']["tmp_name"]) && is_uploaded_file($_FILES["imgfile"]["tmp_name"])) {

        // delete old file before uploading -- save storage
        if ($_POST['id'] != '') {
            // fetch old image
            $result = mysqli_query($conn, "SELECT image FROM slider WHERE id=" . $_POST['id']);
            $row = mysqli_fetch_assoc($result);
            $oldPicture = "../../global/assets/slider/". $row["image"];
            unlink($oldPicture);
        }

        // upload new file
        $temp = explode(".", $_FILES["imgfile"]["name"]);
        $image = round(microtime(true)) . '.' . end($temp);
        move_uploaded_file($_FILES["imgfile"]["tmp_name"], "../../global/assets/slider/" . $image);

    } else {
        $image = "default.png";
    }

    $image = mysqli_real_escape_string($conn, $image);

    if ($_POST['id'] == '') {
        if($sanitized_subcat_id!=-1){
            $sql="INSERT INTO slider (content,cat_id,subcat_id,image) VALUES ('$sanitized_name',$sanitized_cat_id,$sanitized_subcat_id,'$image')";
        }else{
        $sql = "INSERT INTO slider (content,cat_id,image) VALUES ('$sanitized_name',$sanitized_cat_id,'$image')";
    }} else {
        $sql = "UPDATE slider SET content='$sanitized_name'";
        if ($image != "default.png")
            $sql .= ", image='$image'";

        $sql .= "WHERE id=" . $_POST['id'];
    }

    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    header("location: ../slider");
}