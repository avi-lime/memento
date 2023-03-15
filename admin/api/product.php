<?php
if (!isset($_POST["name"]) || !isset($_POST["desc"])) {
    header("location: ../product");
} else {
    include("../../global/api/conn.php");

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $cat = $_POST['cat'];
    $discount = $_POST['discount'];
    $subcat = $_POST['subcat'];
    $image = "";


    if ($_POST['id'] == '') {
        $sql = "INSERT INTO product (name,description,price,quantity,discount,cat_id,subcat_id) VALUES ('$name','$desc',$price,$qty,$discount,$cat,$subcat)";
        mysqli_query($conn, $sql) or die(mysqli_error($conn));

        // get inserted item's id
        $result = mysqli_query($conn, "SELECT MAX(id) AS id FROM product");
        $row = mysqli_fetch_assoc($result);
        $id = $row["id"];

        // upload and insert images
        foreach ($_FILES["imgfile"]["name"] as $key => $name) {
            $temp = explode(".", $_FILES["imgfile"]["name"][$key]);
            $image = round(microtime(true)) . $key . '.' . end($temp);
            move_uploaded_file($_FILES["imgfile"]["tmp_name"][$key], "../../global/assets/images/" . $image);

            mysqli_query($conn, "INSERT INTO product_images (image, product_id) VALUES ('$image', $id)");
        }
    } else {
        $id = $_POST["id"];
        $sql = "UPDATE product SET name='$name', description='$desc', price=$price, quantity=$qty, discount=$discount, cat_id=$cat, subcat_id=$subcat WHERE id=" . $id;
        mysqli_query($conn, $sql) or die(mysqli_error($conn));

        // check for image updates
        $fileNames = array_filter($_FILES['imgfile']['name']);
        if (!empty($fileNames)) {
            // delete existing files
            $result = mysqli_query($conn, "SELECT image FROM product_images WHERE id=" . $id);
            while ($row = mysqli_fetch_assoc($result))
                unlink("../../global/assets/images/" . $row["image"]);
            mysqli_query($conn, "DELETE FROM product_images WHERE product_id= $id");

            // upload and insert images
            foreach ($_FILES["imgfile"]["name"] as $key => $name) {
                $temp = explode(".", $_FILES["imgfile"]["name"][$key]);
                $image = round(microtime(true)) . $key . '.' . end($temp);
                move_uploaded_file($_FILES["imgfile"]["tmp_name"][$key], "../../global/assets/images/" . $image);

                mysqli_query($conn, "INSERT INTO product_images (image, product_id) VALUES ('$image', $id)");
            }
        }
    }

    header("location: ../product");
}