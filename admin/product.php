<?php
include("template/header.php");
include("../global/api/conn.php");

if (!isset($_SESSION["super"]) || $_SESSION["super"] != 1) {
    header("location: dashboard.php");
}

?>
<div class="card">
    <h1>Products</h1>
    <hr>

    <div class="actions">
        <button type="button" class="my-btn" data-bs-toggle="modal" data-bs-target="#modal" id="btnAdd">
            Add Product
        </button>
        <input type="text" class="search-bar" name="search" id="search" data-table="product" placeholder="Search...">
    </div>

    <!-- Add/Edit Product Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="mdlLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="mdlLabel">
                        Add Product
                    </h5>
                    <button type="button" class="btn-close-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i></button>
                </div>

                <form action="api/product.php" method="post" enctype="multipart/form-data">
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

                        <div class="form-group mb-3">
                            <label>Sub-Category: *</label>
                            <select name='subcat' id='subcat' class="form-select" required disabled>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Name: *</label>
                            <input required id="name" name="name" type="text" class="form-control mb-3">
                        </div>
                        <div class="form-group">
                            <label>Description: *</label>
                            <textarea required id="desc" name="desc" rows="3" class="form-control mb-3"> </textarea>
                        </div>
                        <div class="form-group">
                            <label>Series: *</label>
                            <input required id="price" name="price" type="text" class="form-control mb-3">
                        </div>
                        <div class="form-group">
                            <label>Price (₹): *</label>
                            <input required id="price" name="price" type="text" class="form-control mb-3">
                        </div>
                        <div class="form-group">
                            <label>Quantity: *</label>
                            <input required id="qty" name="qty" type="text" class="form-control mb-3">
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
    $table = "product";
    $sql = "SELECT id, name,
            (SELECT name FROM category WHERE category.id=product.cat_id) AS cat,
            (SELECT name FROM subcat WHERE subcat.id=product.subcat_id) AS sub,
            price, quantity, discount, img, description FROM product
            ";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    ?>
    <div class="list row container-fluid">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="p-1 col-xl-4 col-md-6 col-sm-12 mb-1">
                <div class="card bg-black text-white">
                    <img src="../global/assets/images/<?php echo $row["img"] ?>" alt="" class="card-img-top"
                        style="object-fit: cover" height="300px">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $row["id"] . ". " . $row["name"] ?>
                        </h5>
                        <p class="card-text line-clamp">
                            <?php echo $row["description"] ?>
                        </p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-black text-white border-white">
                                <b>Category:</b>
                                <?php echo $row["cat"] ?>
                            </li>
                            <li class="list-group-item bg-black text-white border-white">
                                <b>Sub-Category:</b>
                                <?php echo $row["sub"] ?>
                            </li>
                            <li class="list-group-item bg-black text-white border-white">
                                <b>Price:</b> ₹
                                <?php echo $row["price"] ?>
                            </li>
                            <li class="list-group-item bg-black text-white border-white">
                                <b>Discount:</b>
                                <?php echo $row["discount"] ?>
                            </li>
                            <li class="list-group-item bg-black text-white border-white">
                                <b>Quantity:</b>
                                <?php echo $row["quantity"] ?>
                            </li>
                        </ul>
                        <div class="btn-group w-100" role="group" aria-label="Actions">
                            <button type="button" class="btn my-btn">View</button>
                            <a id="<?php echo $row["id"] ?>" role="button" class="btn my-btn btn-edit">Edit</a>
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

        $("#table").DataTable();

        $('#cat').change(function () {
            var id = $(this).val();
            fillsub(id);
        })


        $('.btn-edit').click(function () {
            var id = $(this).attr("id");
            $.ajax({
                url: 'api/fetch.php',
                method: 'POST',
                data: {
                    id: id,
                    table: "product"
                },
                dataType: "json",
                success: function (data) {
                    $("#id").val(data.id);
                    $("#name").val(data.name);
                    $('#desc').val(data.description);
                    $('#price').val(data.price);
                    $('#qty').val(data.quantity);
                    $('#cat').val(data.cat_id);
                    $("#subcat").attr('disabled', false);
                    fillsub(data.cat_id, data.subcat_id);
                    $("#mdlLabel").text("Edit Product");
                    $("#btnSubmit").text("Update");
                    $("#modal").modal('show');
                }
            })
        })
        $('#btnAdd').click(function () {
            $("#id").val("");
            $("#name").val("");
            $("#desc").val("");
            $("#price").val("");
            $("#qty").val("");
            $("#cat").val(-1);
            $("#subcat").html("");
            $("#subcat").attr('disabled', true);
            $("#imgfile").val("");
            $("#mdlLabel").text("Add Product");
            $("#btnSubmit").text("Add");
        })

        function fillsub(id, sub_id) {
            sub_id = sub_id || null;
            $.ajax({
                url: "api/fetchsub.php",
                method: 'POST',
                data: {
                    id: id
                },
                success: function (data) {
                    $("#subcat").attr('disabled', false)
                    $("#subcat").html(data);
                    if (sub_id != null) $("#subcat").val(sub_id);
                }
            })
        }
    })
</script>
<?php include("template/footer.html") ?>