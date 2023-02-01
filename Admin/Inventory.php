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
                                       <textarea class="form-control" name="dec" id="dec" style="height: 150px;"></textarea>   
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
                                            $query="select cat_name from tblcategory";
                                            $result=mysqli_query($conn,$query);
                                            if($result->num_rows > 0){
                                                while($optiondata=$result->fetch_assoc()){
                                                    $option = $optiondata['cat_name'];    
                                        ?>
                                        <?php 
                                      if(!empty($courseName) && $courseName== $option){
                                        ?>
                                        <option value="<?php echo $option; ?>" selected><?php echo $option; ?> </option>
                                        <?php 
                                    continue;
                                       }?>
                                        <option value="<?php echo $option; ?>" ><?php echo $option; ?> </option>
                                       <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                    </div>
                                    <label for="comp_select" class="col-sm-2 col-form-label">Company</label>
                                    <div class="col-sm-10">
                                    <select class="form-select form-select-sm mb-3" style="width: 300px;" id="comp_select" aria-label=".form-select-sm example">
                                        <option selected="">Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    </div>
                                </div>       
                                <div class="row mb-3">
                                    <label for="formFile"  class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                    <input class="form-control bg-dark" name="formFile" style="width: 500px;" type="file" id="formFile">
                                    </div>
                                </div>                       

                                <button type="submit" class="btn btn-primary">Add Product </button>
                            </form>
                    </div>
                </div>
            </div>
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>
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
</html>