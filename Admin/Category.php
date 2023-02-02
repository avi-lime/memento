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

    <button type="button" class="my-btn" data-bs-toggle="modal" data-bs-target="#modal" id="btnAdd">
        Add Category
    </button>

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
    <table id="table" class="table table-responsive text-center">
        <caption>List of Categories</caption>
        <?php
        // filling up the table
        $table = "category";
        $sql = "SELECT * FROM $table ";
        $result = mysqli_query($conn, $sql);
        $output = '<thead>'
            . '<tr>'
            . '<th>ID</th>'
            . '<th>Name</th>'
            . '<th>Image</th>'
            . '<th>Action</th>'
            . '</tr>'
            . '</thead>'
            . '<tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= '<tr>'
                . '<th scope="row">' . $row['id'] . '</td>'
                . '<td>' . $row['name'] . '</td>'
                . "<td><img style='height:200px; object-fit:cover' class='rounded' alt='img' src='../global /assets/images/" . $row['image'] . "'></td>"
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