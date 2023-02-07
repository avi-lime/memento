<?php
include("template/header.php");
include("../global/api/conn.php");

if (!isset($_SESSION["super"]) || $_SESSION["super"] != 1) {
    header("location: dashboard.php");
}

?>
<div class="card">
    <h1>Categories</h1>
    <hr>


    <div class="actions">
        <button type="button" class="my-btn" data-bs-toggle="modal" data-bs-target="#modal" id="btnAdd">
            Add Category
        </button>
        <input type="text" class="search-bar" name="search" id="search" data-table="category" placeholder="Search...">
    </div>

    <!-- Add/Edit Products Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="mdlLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="mdlLabel">
                        Add Category
                    </h5>
                    <button type="button" class="btn-close-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i></button>
                </div>

                <form action="api/category.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label>Name: *</label>
                            <input required id="name" name="name" type="text" class="form-control mb-3">
                        </div>
                        <div class="form-group">
                            <label>Image: </label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="imgfile" id="imgfile" required
                                    accept=".png,.jpg,.jpeg">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" type="reset" data-bs-dismiss="modal">Cancel</button>
                        <button name="btnSubmit" type="submit" class="btn" id="btnSubmit">Add</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <?php
    $table = "category";
    $sql = "SELECT * FROM $table ";
    $result = mysqli_query($conn, $sql);
    ?>
    <div class="list row container-fluid" id="list">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="p-1 col-xl-4 col-md-6 col-sm-12 mb-1">
                <div class="card bg-black text-white">
                    <img src="../global/assets/images/<?php echo $row["image"] ?>" alt="" class="card-img-top"
                        style="object-fit: cover" height="300px">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $row["id"] . ". " . $row["name"] ?>
                        </h5>
                        <div class="btn-group w-100" role="group" aria-label="Actions">
                            <!-- <button type="button" class="btn my-btn">View</button> -->
                            <a id="<?php echo $row["id"] ?>" role="button" class="btn my-btn btn-edit">Update</a>
                            <a role="button" href="api/delete.php?table=<? echo $table ?>&id=<?php echo $row['id'] ?>"
                                class="btn my-btn">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</div>
<script>
    $(document).ready(function () {

        $("#table").DataTable();
        $('.btn-edit').click(function () {
            var id = $(this).attr("id");
            $.ajax({
                url: 'api/fetch.php',
                method: 'POST',
                data: {
                    id: id,
                    table: "category"
                },
                dataType: "json",
                success: function (data) {
                    $("#id").val(data.id);
                    $("#name").val(data.name);
                    $("#mdlLabel").text("Edit Category");
                    $("#btnSubmit").text("Update");
                    $("#modal").modal('show');
                }
            })
        })
        $('#btnAdd').click(function () {
            $("#id").val("");
            $("#name").val("");
            $("#imgfile").val("");
            $("#mdlLabel").text("Add Category");
            $("#btnSubmit").text("Add");
        })
    })
</script>
<?php include("template/footer.html") ?>