<?php
if (!isset($_POST["name"]) || !isset($_POST["email"]) || !isset($_POST["password"])) {
    header("Location: ../admin.php");
} else {

    include("../../global/api/conn.php");

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sanitized_name = mysqli_real_escape_string($conn, $name);
    $sanitized_email = mysqli_real_escape_string($conn, $email);
    $sanitized_password = mysqli_real_escape_string($conn, $password);

    $hashed_password = password_hash($sanitized_password, PASSWORD_DEFAULT);

    // $image = "";

    // if (file_exists($_FILES['imgfile']["tmp_name"]) && is_uploaded_file($_FILES["imgfile"]["tmp_name"])) {
//     $image = $_FILES["imgfile"]["name"];
//     $tempimg = $_FILES["imgfile"]["tmp_name"];
//     $path = '../../assets/images/' . $image;
//     move_uploaded_file($tempimg, $path);
// } else {
//     $image = "default.png";
// }

    // $image = mysqli_real_escape_string($conn,$image));

    if ($_POST['id'] == '') {
        $sql = "INSERT INTO admin (username,email,password) VALUES ('$sanitized_name','$sanitized_email', '$hashed_password')";
    } else {
        $sql = "UPDATE admin SET name='$sanitized_name', email='$sanitized_email' WHERE id=" . $_POST['id'];
    }

    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    header("Location: ../admin.php");
}