<!DOCTYPE html>
<html lang="en">
<?php
    include "conn.php";
    include "sidebar.php";
    include "navbar.php";
?>
<head>
    <meta charset="utf-8">
    <title>SubCategory</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/icon.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="css/fontgoogle.css" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="css/all.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../Admin/css/all.min.css" crossorigin>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
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
                                        <input type="text" class="form-control" name="subcat_name"  required name="subcat_name" id="cat_name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="cat_select" class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                    <select class="form-select form-select-sm mb-3" style="width: 300px;" name="subcat_select" id="subcat_select" aria-label=".form-select-sm example">
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
                                      $sql = "SELECT subCat_id AS id, subCat_name,cat_name,subCat_img FROM tblsubcat LEFT JOIN tblcategory ON tblsubcat.cat_id=tblcategory.cat_id";
                                     $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                     $output ="
                                     <thead>
                                     <tr>
                                         <th scope='col'>ID</th>
                                         <th scope='col'>Name</th>
                                         <th scope='col'>CategoryID</th>
                                         <th scope='col'>Image</th>
                                         <th scope='col'>Action</th>
                                     </tr>
                                 </thead>";
                                    while($row = mysqli_fetch_assoc($result)){
                                        $output .= '<tr>'
                                        . '<th scope="row">' . $row['id'] . '</td>'
                                        . '<td>' . $row['subCat_name'] . '</td>'
                                        . '<td>' . $row['cat_name'] . '</td>'
                                        . '<td><img style="height:200px;width:200px" class="rounded" src="img/' . $row['subCat_img'] . '"></td>'
                                        . '<td><a role="button"  id="'.$row['id'].'" ><i class="far fa-edit"></i></a>
                                           <a role="button" href="api/deletecat.php?id='.$row['id'].'" style="padding-left: 5px" ><i class="fa fa-trash"></i></a></td>'
                                        . '</tr>';
                                }
                                mysqli_close($conn);
                                echo $output;
                                ?>
                                </table>
                            </div>
                        </div>
            </div>                                      
        <!---Main content-->
<!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>
        <?php 
        include "footer.php";
        ?>
    </div>
<!-- JavaScript Libraries -->
    <script src="../Admin/js/jquery-3.4.1.min.js"></script>
    <script src="../Admin/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
<!-- image preview -->
<script>
    formFile.onchange = evt => {
        const [file] = formFile.files
        if (file) {
        imageprev.hidden=false;
        imageprev.src = URL.createObjectURL(file)
        }
    }
    </script>
<?php
if(isset($_REQUEST['btn_add'])){
    $name=$_REQUEST['subcat_name'];
    $img_name=$_REQUEST['formFile'];
    $catid = $_REQUEST['subcat_select'];
    if(mysqli_query($conn,"insert into tblsubcat(subCat_name,cat_id,subCat_img) value('$name','$catid','$img_name')")){
    echo "<script> 
    $(function(){
        $('<div> ".$name." added Successfully </div>').insertBefore('#btn_addcat').delay(3000).fadeOut(function(){
            $(this).remove();
        });
    });</script>";
}
}
?>
</html>