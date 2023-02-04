<?php
include("template/header.php");
include("../global/api/conn.php");

if (!isset($_SESSION["super"]) || $_SESSION["super"] != 1) {
    header("location: dashboard.php");
}

?>
<div class="card">
    <h1>Sub-Categories</h1>
    <hr>

    <button type="button" class="my-btn" data-bs-toggle="modal" data-bs-target="#modal" id="btnAdd">
        Add Sub-Category
    </button>

    <!-- Add/Edit Sub-Category Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="mdlLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="mdlLabel">
                        Add Sub-Category
                    </h5>
                    <button type="button" class="btn-close-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i></button>
                </div>

                <form action="api/subcat.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group mb-3">
                            <label>Category: *</label>
                            <select name='cat' id='cat' class="form-select" aria-label="Default select example"
                                required>
                                <option selected disabled value="-1">Select a Category</option>
                                <?php

                                $query = "SELECT * FROM category";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
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
    $table = "subcat";
    $sql = "SELECT id, name, image, (SELECT name FROM category WHERE category.id=subcat.cat_id) AS cat FROM $table ";
    $result = mysqli_query($conn, $sql);
    ?>
    <div class="list row container-fluid justify-content-between">
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
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-black text-white border-white">
                                <b>Category:</b>
                                <?php echo $row["cat"] ?>
                            </li>
                        </ul>
                        <!-- <p class="card-text line-clamp"><?php //echo $row["description"] ?></p> -->
                        <div class="btn-group w-100" role="group" aria-label="Actions">
                            <!-- <button type="button" class="btn my-btn">View</button> -->
                            <a id="<?php echo $row["id"] ?>" role="button" class="btn my-btn btn-edit">Update</a>
                            <a role="button" href="api/delete.php?table=<?php echo $table ?>&id=<?php echo $row['id'] ?>"
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

        $('.btn-edit').click(function () {
            var id = $(this).attr("id");
            $.ajax({
                url: 'api/fetch.php',
                method: 'POST',
                data: {
                    id: id,
                    table: "subcat"
                },
                dataType: "json",
                success: function (data) {
                    $("#id").val(data.id);
                    $("#name").val(data.name);
                    $('#cat').val(data.cat_id);
                    $("#mdlLabel").text("Edit Sub-Category");
                    $("#btnSubmit").text("Update");
                    $("#modal").modal('show');
                }
            })
        })
        $('#btnAdd').click(function () {
            $("#id").val("");
            $("#name").val("");
            $("#cat").val(-1);
            $("#imgfile").val("");
            $("#mdlLabel").text("Add Sub-Category");
            $("#btnSubmit").text("Add");
        })
    })
</script>
<?php include("template/footer.html") ?>