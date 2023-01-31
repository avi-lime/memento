<?php
include "conn.php";
include "sidebar.php";
include "navbar.php";
?>

<head>
    <title>Inventory</title>
</head>
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Inventory</h6>
        </div>
        <div class="d-flex align-items-center mb-4">
            <h6 class="mb-0">Add Items</h5>
        </div>
        <div class="row mb-3">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <label for="Name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="Name" class="form-control" id="Name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="dec" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="desc" id="desc" style="height: 150px;"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="price" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="price" style="width: 80px" id="price">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="discount" class="col-sm-2 col-form-label">Discount Rate</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="discount" style="width: 80px" id="discount">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="text" name="quantity" class="form-control" style="width: 80px;" id="quantity">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="cat_select" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <select class="form-select form-select-sm mb-3 category" style="width: 300px;" name="cat_select" id="cat_select" aria-label=".form-select-sm example">
                            <option selected="">Open this select menu</option>
                            <?php
                            $query = "select * from tblcategory";
                            $result = mysqli_query($conn, $query);
                            if ($result->num_rows > 0) {
                                while ($optiondata = $result->fetch_assoc()) {
                                    $option = $optiondata['cat_name'];
                                    $optionvalue = $optiondata['cat_id'];
                            ?>
                                    <?php
                                    if (!empty($courseName) && $courseName == $option) {

                                    ?>
                                        <option value="<?php echo $optionvalue; ?>" selected><?php echo $option; ?> </option>
                                    <?php
                                        continue;
                                    } ?>
                                    <option value="<?php echo $optionvalue; ?>"><?php echo $option; ?> </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <label for="comp_select" class="col-sm-2 col-form-label">Sub-Category</label>
                    <div class="col-sm-10">
                        <select class="form-select form-select-sm mb-3 subcatSelect" style="width: 300px;" name="subcatSelect" id="subcatSelect" disabled aria-label=".form-select-sm example">
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="formFile" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                        <input class="form-control bg-dark" name="formFile" style="width: 500px;" type="file" id="formFile">
                    </div>
                    <img src="" id="imageprev" name="imageprev" hidden class="img-container-fluid" alt="" style="height: 250px; width:250px; margin-left:170px;">
                </div>
                <div class="row mb-3">
                    <label for="Series" class="col-sm-2 col-form-label">Series</label>
                    <div class="col-sm-10">
                        <input type="text" name="Series" style="width: 500px;" class="form-control" id="Series">
                    </div>
                </div>

                <button type="submit" id="btn_add" name="btn_add" class="btn btn-primary">Add Product </button>
            </form>
        </div>
    </div>
</div>
<!-- table -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">All Product</h6>
        <div class="table-responsive">
            <table class="table">
                <?php
                $sql = "SELECT * FROM tblproduct LEFT JOIN tblcategory ON tblproduct.catid=tblcategory.cat_id LEFT JOIN tblsubcat ON tblproduct.subcatid = tblsubcat.subCat_id LEFT JOIN tbladmin ON tblproduct.product_companyid = tbladmin.id ORDER BY productid ASC";
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                $output = "
                                     <thead>
                                     <tr>
                                         <th scope='col'>ID</th>
                                         <th scope='col'>Name</th>
                                         <th scope='col'>Price</th>
                                         <th scope='col'>Quantity</th>
                                         <th scope='col'>Description</th>
                                         <th scope='col'>Discount</th>
                                         <th scope='col'>Category Id</th>
                                         <th scope='col'>SubCategory Id</th>
                                         <th scope='col'>Company Id</th>
                                         <th scope='col'>Series</th>
                                         <th scope='col'>Image</th>
                                         <th scope='col'>Action</th>
                                     </tr>
                                 </thead>";
                while ($row = mysqli_fetch_assoc($result)) {
                    $output .= '<tr>'
                        . '<th scope="row">' . $row['productid'] . '</td>'
                        . '<td>' . $row['product_name'] . '</td>'
                        . '<td> ₹' . $row['product_price'] . '</td>'
                        . '<td>' . $row['product_quantity'] . '</td>'
                        . '<td>' . substr($row['product_desc'], 0, 50) . '...</td>'
                        . '<td>' . $row['product_dis'] . '</td>'
                        . '<td>' . $row['cat_name'] . '</td>'
                        . '<td>' . $row['subCat_name'] . '</td>'
                        . '<td>' . $row['company'] . '</td>'
                        . '<td>' . $row['product_series'] . '</td>'
                        . '<td><img style="height:100px; width:100px" class="rounded" src="img/' . $row['product_img'] . '"></td>'
                        . '<td><a role="button" class="me-2 btn-edit" data-toggle="modal" data-target="#exampleModal"  id="' . $row['productid'] . '" ><i class="far fa-edit"></i></a>
                            <a role="button" href="api/deleteprod.php?id=' . $row['productid'] . '" style="padding-left: 5px" ><i class="fa fa-trash"></i></a></td>'
                        . '</tr>';
                }
                echo $output;
                ?>
            </table>
        </div>
    </div>
</div>
<!-- edit model -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="Inventory.php" enctype="multipart/form-data">
                <div class="modal-header">
                    Update Category
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <input type="hidden" name="id" id="id">
                        <div class="row mb-3">
                            <label for="Name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="editName" class="form-control" id="editName">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="dec" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="editdesc" id="editdesc" style="height: 150px; padding-left:20px"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="editprice" style="width: 80px" id="editprice">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="discount" class="col-sm-2 col-form-label">Discount Rate</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="editdiscount" style="width: 80px" id="editdiscount">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                            <div class="col-sm-10">
                                <input type="text" name="editquantity" class="form-control" style="width: 80px;" id="editquantity">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="cat_select" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select class="form-select form-select-sm mb-3 editcat_select" style="width: 300px;" name="editcat_select" id="editcat_select" aria-label=".form-select-sm example">
                                    <option selected="">Open this select menu</option>
                                    <?php
                                    $query = "select * from tblcategory";
                                    $result = mysqli_query($conn, $query);
                                    if ($result->num_rows > 0) {
                                        while ($optiondata = $result->fetch_assoc()) {
                                            $option = $optiondata['cat_name'];
                                            $optionvalue = $optiondata['cat_id'];
                                    ?>
                                            <?php
                                            if (!empty($courseName) && $courseName == $option) {

                                            ?>
                                                <option value="<?php echo $optionvalue; ?>" selected><?php echo $option; ?> </option>
                                            <?php
                                                continue;
                                            } ?>
                                            <option value="<?php echo $optionvalue; ?>"><?php echo $option; ?> </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <label for="comp_select" class="col-sm-2 col-form-label">Sub-Category</label>
                            <div class="col-sm-10">
                                <select class="form-select form-select-sm mb-3 editsubcatSelect" style="width: 300px;" name="editsubcatSelect" id="editsubcatSelect" disabled aria-label=".form-select-sm example">
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="formFile" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input class="form-control bg-dark" name="editimg" style="width: 300px;" type="file" id="editimg">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="Series" class="col-sm-2 col-form-label">Series</label>
                            <div class="col-sm-10">
                                <input type="text" name="editseries" style="width: 300px;" class="form-control" id="editseries">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" id="btnedit" name="btnedit" class="btn btn-primary" value="Save">
                    </div>
            </form>
        </div>
    </div>
</div>
<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>
<?php
include "footer.php";
?>
</div>
<script>
    $(document).ready(function() {
        formFile.onchange = evt => {
            const [file] = formFile.files
            if (file) {
                imageprev.hidden = false;
                imageprev.src = URL.createObjectURL(file)
            }
        }
        $('#cat_select').change(function() {
            var cat_id = $(this).val();
            console.log(cat_id);
            $.ajax({
                url: "api/fetchsub.php",
                method: 'POST',
                data: {
                    id: cat_id
                },
                success: function(data) {
                    $("#subcatSelect").attr('disabled', false)
                    $('#subcatSelect').html(data);
                }
            })
        })
        $('.btn-edit').click(function() {
            var id = $(this).attr("id");
            console.log(id);
            $.ajax({
                url: 'api/fetch.php',
                method: 'POST',
                data: {
                    id: id,
                    table: "tblproduct",
                    idname: "productid"
                },
                dataType: "json",
                success: function(data) {
                    $("#id").val(data.productid);
                    $("#editName").val(data.product_name);
                    $("#editprice").val(data.product_price);
                    $("#editquantity").val(data.product_quantity);
                    $("#editdesc").val(data.product_desc);
                    $("#editdiscount").val(data.product_dis);
                    $("#editcat_select").val(data.catid);
                    $("#editsubcatSelect").attr('disabled', false);
                    fillsub(data.catid, data.subcatid);
                    $("#editseries").val(data.product_series);
                }
            })
        })
        $('#editcat_select').change(function() {
            var cat_id = $(this).val();
            console.log(cat_id);
            $.ajax({
                url: "api/fetchsub.php",
                method: 'POST',
                data: {
                    id: cat_id
                },
                success: function(data) {
                    $("#editsubcatSelect").attr('disabled', false)
                    $('#editsubcatSelect').html(data);
                }
            })
        })

        function fillsub(id, sub_id) {
            sub_id = sub_id || null;
            $.ajax({
                url: "api/fetchsub.php",
                method: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    $(".editsubcatSelect").attr('disabled', false)
                    $(".editsubcatSelect").html(data);
                    if (sub_id != null) $(".editsubcatSelect").val(sub_id);
                }
            })
        }
    })
</script>
<?php
if (isset($_REQUEST['btn_add'])) {
    $image = $_FILES['formFile']['name'];
    $tempimg = $_FILES['formFile']['tmp_name'];
    $path = "img/" . $image;
    move_uploaded_file($tempimg, $path);
    $name = $_REQUEST['Name'];
    $description = $_REQUEST['desc'];
    $price = $_REQUEST['price'];
    $discount = $_REQUEST['discount'];
    $quantity = $_REQUEST['quantity'];
    $catid = $_REQUEST['cat_select'];
    $subcatid = $_REQUEST['subcatSelect'];
    $product_series = $_REQUEST['Series'];
    $product_company = $_SESSION['username'];
    $idquery = "SELECT id FROM tbladmin WHERE company='$product_company'";
    $result = mysqli_query($conn, $idquery);
    $data = mysqli_fetch_assoc($result);
    $product_companyid = $data['id'];
    $query = 'INSERT INTO tblproduct (product_name, product_price, product_quantity,product_desc, product_dis, catid, subcatid, product_companyid, product_img,product_series) VALUES ("' . $name . '",' . $price . ',' . $quantity . ',"' . $description . '",' . $discount . ',' . $catid . ',' . $subcatid . ',' . $product_companyid . ',"' . $image . '","' . $product_series . '")';
    if (mysqli_query($conn, $query) or die(mysqli_error($conn))) {
        echo "<script> 
    $(function(){
        $('<div> " . $name . " added Successfully </div>').insertBefore('#btn_add').delay(3000).fadeOut(function(){
            $(this).remove();
        });
    });</script>";
    } else {
        echo "<script>alert('kuch nahi hota loda');</script>";
    }
}
if (isset($_REQUEST['btnedit'])) {
    $name = $_REQUEST['editName'];
    $id = $_REQUEST['id'];
    $description = $_REQUEST['editdesc'];
    $price = $_REQUEST['editprice'];
    $quantity = $_REQUEST['editquantity'];
    $discount = $_REQUEST['editdiscount'];
    $catid = $_REQUEST['editcat_select'];
    $subcatid = $_REQUEST['editsubcatSelect'];
    $product_series = $_REQUEST['editseries'];
    $image = $_FILES["editimg"]["name"];
    $tempimg = $_FILES["editimg"]["tmp_name"];
    $path = 'img/' . $image;
    move_uploaded_file($tempimg, $path);
    $sql = 'UPDATE tblproduct SET 
    product_name="' . $name . '",
    product_price=' . $price . ',
    product_quantity=' . $quantity . ', product_desc="' . $description . '",
    product_dis=' . $discount . ',
    catid=' . $catid . ',
    subcatid=' . $subcatid . ',
    product_series="' . $product_series . '",product_img="' . $image . '" WHERE productid=' . $id . '';
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if (mysqli_query($conn, $sql)) {
?>
        <script>
            alert("product Updated")
        </script>
<?php
echo "<meta http-equiv='refresh' content='0'>";  
    }
}
?>