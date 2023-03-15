<?php
if (!isset($_POST["name"]) || !isset($_POST["email"]) || !isset($_POST["password"])) {
    header("location: ../admin");
} else {

    include("../../global/api/conn.php");

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sanitized_name = mysqli_real_escape_string($conn, $name);
    $sanitized_email = mysqli_real_escape_string($conn, $email);
    $sanitized_password = mysqli_real_escape_string($conn, $password);

    $hashed_password = password_hash($sanitized_password, PASSWORD_DEFAULT);

    if ($_POST['id'] == '') {
        $sql = "INSERT INTO admin (username,email,password) VALUES ('$sanitized_name','$sanitized_email', '$hashed_password')";
    } else {
        $sql = "UPDATE admin SET name='$sanitized_name', email='$sanitized_email' WHERE id=" . $_POST['id'];
    }

    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    header("location: ../admin");
}

?>