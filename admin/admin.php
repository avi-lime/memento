<?php
if (!isset($_SESSION["super"]) || $_SESSION["super"] != 1) {
    redirect("dashboard.php");
}
include("template/header.php");
include("../global/api/conn.php");


?>
<div class="card">
    <h1>Admin</h1>
    <hr>


    <div class="actions">
        <button type="button" class="my-btn" data-bs-toggle="modal" data-bs-target="#modal" id="btnAdd">
            Add Admin
        </button>
    </div>

    <!-- Add/Edit Products Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="mdlLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="mdlLabel">
                        Add Admin
                    </h5>
                    <button type="button" class="btn-close-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i></button>
                </div>

                <div class="modal-body">
                    <form id="form" action="api/admin.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label>Name: *</label>
                            <input required id="name" name="name" type="text" class="form-control mb-3">
                        </div>

                        <div class="form-group">
                            <label>E-mail: *</label>
                            <input required id="email" name="email" type="email" class="form-control mb-3">
                        </div>

                        <div class="form-group">
                            <label>Password: *</label>
                            <input required id="password" name="password" type="password" class="form-control mb-3">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button form="form" class="btn" type="reset" data-bs-dismiss="modal">Cancel</button>
                    <button form="form" name="btnSubmit" type="submit" class="btn" id="btnSubmit">Add</button>
                </div>

            </div>
        </div>
    </div>

    <table id="table" class="table table-responsive text-center">
        <caption>List of Admins</caption>
        <?php
        // filling up the table
        $table = "admin";
        $sql = "SELECT * FROM $table ";
        $result = mysqli_query($conn, $sql);


        $output = '<thead>'
            . '<tr>'
            . '<th>ID</th>'
            . '<th>Name</th>'
            . '<th>Email</th>'
            // . '<th>Image</th>'
            . '<th>Action</th>'
            . '</tr>'
            . '</thead>'
            . '<tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= '<tr>'
                . '<th scope="row">' . $row['id'] . '</td>'
                . '<td>' . $row['username'] . '</td>'
                . '<td>' . $row['email'] . '</td>'
                // . "<td><img style='height:200px; width:200px; object-fit:cover' class='rounded-circle' alt='img' src='../assets/images/" . $row['image'] . "'></td>"
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
                    table: "admin"
                },
                dataType: "json",
                success: function (data) {
                    $("#id").val(data.id);
                    $("#name").val(data.username);
                    $("#email").val(data.email);
                    $("#password").attr("type", "text");
                    $("#password").val(data.password);
                    $("#password").attr("type", "password");
                    $("#mdlLabel").text("Edit Admin");
                    $("#btnSubmit").text("Update");
                    $("#modal").modal('show');
                }
            })
        })
        $('#btnAdd').click(function () {
            $("#id").val("");
            $("#name").val("");
            $("#email").val("");
            $("#password").val("");
            $("#imgfile").val("");
            $("#mdlLabel").text("Add Admin");
            $("#btnSubmit").text("Add");
        })
    })
</script>
<?php include("template/footer.html") ?>