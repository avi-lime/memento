<?php
    include "conn.php";
    include "sidebar.php";
    include "navbar.php";
?>
<head>
    <title>DarkPan - Bootstrap 5 Admin Template</title>
</head>

            <!-- Navbar End -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Dashboard</h6>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail3">
                        </div>
                    </div>
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