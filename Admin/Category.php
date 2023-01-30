
<?php
    include "conn.php";
    include "sidebar.php";
    include "navbar.php";
?>
<head><title>Category</title></head>
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center mb-4">
                        <h6 class="mb-0">Add Category</h6>
                    </div>
                    <div class="row mb-3">
                    <form method="post" action="">
                                <div class="row mb-3">
                                    <label for="cat_name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" required name="cat_name" id="cat_name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="formFile"  class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                    <input class="form-control bg-dark" required name="formFile" id="formFile" style="width: 500px;" type="file" id="formFile">
                                </div>
                                <img src="" id="imageprev" name="imageprev" hidden class="img-container-fluid" alt="" style="height: 250px; width:250px; margin-left:170px;">   
                                </div>                       
                                <button type="submit" id="btn_addcat" name="btn_addcat" class="btn btn-primary">Add Category</button>
                                </form>
                    </div>
                </div>  
            </div>
            <!-- TABLE -->
            <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">All Category</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <?php 
                                     $sql = "SELECT * FROM tblcategory";
                                     $result = mysqli_query($conn, $sql);
                                     $output ="
                                     <thead>
                                     <tr>
                                         <th scope='col'>ID</th>
                                         <th scope='col'>Name</th>
                                         <th scope='col'>Image</th>
                                         <th scope='col'>Action</th>
                                     </tr>
                                 </thead>";
                                    while($row = mysqli_fetch_assoc($result)){
                                        $output .= '<tr>'
                                        . '<th scope="row">' . $row['cat_id'] . '</td>'
                                        . '<td>' . $row['cat_name'] . '</td>'
                                        . '<td><img style="height:100px;width:100px" class="rounded" src="img/' . $row['cat_img'] . '"></td>'
                                        . '<td><a  data-toggle="modal" data-target="#exampleModal" role="button"  id="'.$row['cat_id'].'" ><i class="far fa-edit"></i></a>
                                           <a role="button" href="api/deletecat.php?id='.$row['cat_id'].'" style="padding-left: 5px" ><i class="fa fa-trash"></i></a></td>'
                                        . '</tr>';
                                }
                                mysqli_close($conn);
                                echo $output;
                                ?>
                                </table>
                            </div>
                        </div>
            </div>
            <!-- edit/add -->
        <!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        Update Category
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="">
                                <div class="row mb-3">
                                    <label for="cat_name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" required name="cat_name" id="cat_name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="formFile"  class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                    <input class="form-control bg-dark" required name="formFile" id="formFile" style="width: 300px;" type="file" id="formFile">
                                </div>
                                </div>                       
                                </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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
if(isset($_REQUEST['btn_addcat'])){
    $name=$_REQUEST['cat_name'];
    $img_name=$_REQUEST['formFile'];
    if(mysqli_query($conn,"insert into tblcategory(cat_name,cat_img) value('$name','$img_name')")){
    echo "<script> 
    $(function(){
        $('<div> ".$name." added Successfully </div>').insertBefore('#btn_addcat').delay(3000).fadeOut(function(){
            $(this).remove();
        });
    });</script>";
}
}
?>
