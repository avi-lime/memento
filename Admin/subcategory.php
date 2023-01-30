<!DOCTYPE html>
<html lang="en">
<?php
include "conn.php";
include "sidebar.php";
include "navbar.php";
?>

<head>
    <title>SubCategory</title>
</head>

<body>

    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center mb-4">
                <h6 class="mb-0">Add SubCategory</h6>
            </div>
            <div class="row mb-3">
                <form method="post" action="">
                    <div class="row mb-3">
                        <label for="cat_name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="subcat_name" required name="subcat_name" id="cat_name">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="cat_select" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select class="form-select form-select-sm mb-3" style="width: 300px;" name="subcat_select" id="subcat_select" aria-label=".form-select-sm example">
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
                    </div>
                    <div class="row mb-3">
                        <label for="formFile" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input class="form-control bg-dark" required name="formFile" id="formFile" style="width: 500px;" type="file" id="formFile">
                        </div>
                        <img src="" id="imageprev" name="imageprev" hidden class="img-container-fluid" alt="" style="height: 250px; width:250px; margin-left:170px;">
                    </div>
                    <button type="submit" id="btn_add" name="btn_add" class="btn btn-primary">Add Category</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">All Sub-Category</h6>
            <div class="table-responsive">
                <table class="table">
                    <?php
                    $sql = "SELECT * FROM tblsubcat LEFT JOIN tblcategory ON tblsubcat.cat_id=tblcategory.cat_id ORDER BY subCat_id ASC";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    $output = "
                                     <thead>
                                     <tr>
                                         <th scope='col'>ID</th>
                                         <th scope='col'>Name</th>
                                         <th scope='col'>CategoryID</th>
                                         <th scope='col'>Image</th>
                                         <th scope='col'>Action</th>
                                     </tr>
                                 </thead>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $output .= '<tr>'
                            . '<th scope="row">' . $row['subCat_id'] . '</td>'
                            . '<td>' . $row['subCat_name'] . '</td>'
                            . '<td>' . $row['cat_name'] . '</td>'
                            . '<td><img style="height:100px;width:100px" class="rounded" src="img/' . $row['subCat_img'] . '"></td>'
                            . '<td><a class="me-2 btn-edit" data-toggle="modal" data-target="#exampleModal" role="button"  id="' . $row['subCat_id'] . '" ><i class="far fa-edit"></i></a>
                                <a role="button" href="api/deletesubcat.php?id=' . $row['subCat_id'] . '" style="padding-left: 5px" ><i class="fa fa-trash"></i></a></td>'
                            . '</tr>';
                    }
                    echo $output;
                    ?>
                </table>
            </div>
        </div>
    </div>
    <!---Main content-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    Update Sub-Category
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" action="">
                                <div class="row mb-3">
                                    <label for="cat_name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="editsubcat_name"  required name="editsubcat_name" id="cat_name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="cat_select" class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                    <select class="form-select form-select-sm mb-3" style="width: 300px;" name="editsubcat_select" id="editsubcat_select" aria-label=".form-select-sm example">
                                        <option selected="">Open this select menu</option>
                                        <?php 
                                            $query="select * from tblcategory";
                                            $result=mysqli_query($conn,$query);
                                            if($result->num_rows > 0){
                                                while($optiondata=$result->fetch_assoc()){
                                                    $option = $optiondata['cat_name'];  
                                                    $optionvalue = $optiondata['cat_id'];
                                        ?>
                                        <?php 
                                      if(!empty($courseName) && $courseName== $option){
                                        ?>
                                        <option value="<?php echo $optionvalue; ?>" selected><?php echo $option; ?> </option>
                                        <?php 
                                    continue;
                                       }?>
                                        <option value="<?php echo $optionvalue; ?>" ><?php echo $option; ?> </option>
                                       <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                    </div>
                                </div>   
                                <div class="row mb-3">
                                    <label for="formFile"  class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                    <input class="form-control bg-dark" required name="editimg" id="editimg" type="file" id="formFile">
                                </div>
                                </div>                       
                                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    <!-- image preview -->
    <script>
        formFile.onchange = evt => {
            const [file] = formFile.files
            if (file) {
                imageprev.hidden = false;
                imageprev.src = URL.createObjectURL(file)
            }
        }
        formFile.onchange = evt => {
            const [file] = formFile.files
            if (file) {
                imageprev.hidden = false;
                imageprev.src = URL.createObjectURL(file)
            }
        }
        $('.btn-edit').click(function() {
            var id = $(this).attr("id");
            console.log(id);
            $.ajax({
                url: 'api/fetch.php',
                method: 'POST',
                data: {
                    id: id,
                    table: "tblsubcat",
                    idname: "subCat_id"
                },
                dataType: "json",
                success: function(data) {
                    $("#id").val(data.subCat_id);
                    $("#editsubcat_name").val(data.subCat_name);
                    $("#editsubcat_select").val(data.cat_id);
                }
            })
        })
    </script>
    <?php
    if (isset($_REQUEST['btn_add'])) {
        $image = $_FILES['formFile']['name'];
        $tempimg = $_FILES['formFile']['tmp_name'];
        $path = "img/" . $image;
        move_uploaded_file($tempimg, $path);
        $name = $_REQUEST['subcat_name'];
        $catid = $_REQUEST['subcat_select'];
        if (mysqli_query($conn, "insert into tblsubcat(subCat_name,cat_id,subCat_img) value('$name','$catid','$image')")) {
            echo "<script> 
    $(function(){
        $('<div> " . $name . " added Successfully </div>').insertBefore('#btn_addcat').delay(3000).fadeOut(function(){
            $(this).remove();
        });
    });</script>";
        }
    }
    ?>