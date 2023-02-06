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
    <table id="table" class="table table-responsive text-center">
        <caption>List of Products</caption>
        <?php
        // filling up the table
        $table = "product";
        $sql = "SELECT id, name,
            (SELECT name FROM category WHERE category.id=product.cat_id) AS cat,
            (SELECT name FROM subcat WHERE subcat.id=product.subcat_id) AS sub,
            price, quantity, discount, img, description FROM product
            ";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $output = '<thead>'
            . '<tr>'
            . '<th>ID</th>'
            . '<th>Name</th>'
            . '<th>Category</th>'
            . '<th>Sub-Category</th>'
            . '<th>Description</th>'
            . '<th>Price</th>'
            . '<th>Discount</th>'
            . '<th>Quantity</th>'
            . '<th>Image</th>'
            . '<th>Action</th>'
            . '</tr>'
            . '</thead>'
            . '<tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= '<tr>'
                . '<th scope="row">' . $row['id'] . '</td>'
                . '<td>' . $row['name'] . '</td>'
                . '<td>' . $row['cat'] . '</td>'
                . '<td>' . $row['sub'] . '</td>'
                . '<td >' . $row['description'] . '</td>'
                . '<td>₹' . $row['price'] . '</td>'
                . '<td>' . $row['discount'] . '</td>'
                . '<td>' . $row['quantity'] . '</td>'
                . "<td><img style='height:200px; object-fit:cover' class='rounded' alt='img' src='../global /assets/images/" . $row['img'] . "'></td>"
                . '<td>'
                . '<a class="me-2 btn-edit" role="button" id="' . $row["id"] . '" style="color: var(--white)"><i class="fa-solid fa-pen"></i></a>'
                . '<a role="button" href="api/delete.php?table=' . $table . '&id=' . $row['id'] . '" style="color: var(--white)"><i class="fa-solid fa-trash"></i></a>'
                . '</td>'
                . '</tr>';
        }
        $output .= "</tbody>";
        echo $output;
        ?>
    </table>
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
                    table: "subcat"
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