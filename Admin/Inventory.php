<!DOCTYPE html>
<html lang="en">
<?php
    include "conn.php";
    include "sidebar.php";
    include "navbar.php";
?>
<head>
    <meta charset="utf-8">
    <title>Inventory</title>
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
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Inventory</h6>
                        </div>
                    <div class="d-flex align-items-center mb-4">
                        <h6 class="mb-0">Add Items</h5>
                    </div>
                    <div class="row mb-3">
                    <form action="" method="post">
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
                                    <select class="form-select form-select-sm mb-3" style="width: 300px;" name="cat_select" id="cat_select" aria-label=".form-select-sm example">
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
                                    <label for="comp_select" class="col-sm-2 col-form-label">Sub-Category</label>
                                    <div class="col-sm-10">
                                    <select class="form-select form-select-sm mb-3" style="width: 300px;" name="subcatSelect" id="subcatSelect" aria-label=".form-select-sm example">
                                    <option selected="">Open this select menu</option>
                                    <?php 
                                        $query ="SELECT * FROM tblsubcat";
                                        $result = $conn->query($query);
                                        if($result->num_rows> 0){
                                          
                                            while($optionData=$result->fetch_assoc()){
                                            $subcatoption =$optionData['subCat_name'];
                                            $id =$optionData['subCat_id'];
                                        ?>
                                        <option value="<?php echo $id; ?>" ><?php echo $subcatoption; ?> </option>
                                    <?php
                                       }}
                                     ?>
            
                                    </select>
                                    
                                    </div>
                                </div>       
                                <div class="row mb-3">
                                    <label for="formFile"  class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                    <input class="form-control bg-dark" name="formFile" style="width: 500px;" type="file" id="formFile">
                                    </div>
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
                                <table class="table" >
                                    <?php 
                                     $sql = "SELECT * FROM tblproduct LEFT JOIN tblcategory ON tblproduct.catid=tblcategory.cat_id LEFT JOIN tblsubcat ON tblproduct.subcatid = tblsubcat.subCat_id";
                                     $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                     $output ="
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
                                    while($row = mysqli_fetch_assoc($result)){
                                        $output .= '<tr>'
                                        . '<th scope="row">' . $row['productid'] . '</td>'
                                        . '<td>' . $row['product_name'] . '</td>'
                                        . '<td> '. $row['product_price'] .'</td>'
                                        . '<td>' . $row['product_quantity'] . '</td>'
                                        . '<td>' . substr($row['product_desc'], 0, 50) . '...</td>'
                                        . '<td>' . $row['product_dis'] . '</td>'
                                        . '<td>' . $row['catid'] . '</td>'
                                        . '<td>' . $row['subcatid'] . '</td>'
                                        . '<td>' . $row['product_companyid'] . '</td>'
                                        . '<td>' . $row['product_series'] . '</td>'
                                        . '<td><img style="height:200px; width:200px" class="rounded" src="img/' . $row['product_img'] . '"></td>'
                                        . '<td><a role="button"  id="'.$row['productid'].'" ><i class="far fa-edit"></i></a>
                                           <a role="button" href="api/deleteprod.php?id='. $row['productid'].'" style="padding-left: 5px" ><i class="fa fa-trash"></i></a></td>'
                                        . '</tr>';
                                }
                                mysqli_close($conn);
                                echo $output;
                                ?>
                                </table>
                            </div>
                        </div>
            </div>
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>
        <?php 
include "footer.php";
?>
    </div>

    <script src="../Admin/js/jquery-3.4.1.min.js"></script>
    <script src="../Admin/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="js/main.js"></script>

</body>
<?php
if(isset($_REQUEST['btn_add'])){
    $name=$_REQUEST['Name'];
    $description=$_REQUEST['desc'];
    $price= $_REQUEST['price'];
    $discount=$_REQUEST['discount'];
    $quantity=$_REQUEST['quantity'];
    $catid=$_REQUEST['cat_select'];
    $subcatid = $_REQUEST['subcatSelect'];
    $product_img =$_REQUEST['formFile'];
    $product_series=$_REQUEST['Series'];
    $product_company=$_SESSION['username'];
    $idquery="SELECT id FROM tbladmin WHERE company='$product_company'";
    $result=mysqli_query($conn,$idquery);
    $data=mysqli_fetch_assoc($result);
    $product_companyid= $data['id'];
    echo $product_companyid;
    $query='INSERT INTO tblproduct (product_name, product_price, product_quantity,product_desc, product_dis, catid, subcatid, product_companyid, product_img,product_series) VALUES ("'.$name.'",'.$price.','.$quantity.',"'.$description.'",'.$discount.','.$catid.','.$subcatid.','.$product_companyid.',"'.$product_img.'","'.$product_series.'")';  
    echo $query;
    if(mysqli_query($conn,$query) or die(mysqli_error($conn))){
    echo "<script> 
    $(function(){
        $('<div> ".$name." added Successfully </div>').insertBefore('#btn_add').delay(3000).fadeOut(function(){
            $(this).remove();
        });
    });</script>";
 }else{
    echo"<script>alert('kuch nahi hota loda');</script>";
 }
}
?>
</html>