<?php
include("template/header.php");
include("../global/api/conn.php");

if (!isset($_SESSION["super"]) || $_SESSION["super"] != 1) {
    redirect("dashboard");
}

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
            . '<th>Action</th>'
            . '</tr>'
            . '</thead>'
            . '<tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= '<tr>'
                . '<th scope="row">' . $row['id'] . '</td>'
                . '<td>' . $row['username'] . '</td>'
                . '<td>' . $row['email'] . '</td>'
                . '<td>'
                . '<a class="btn-del" role="button" id="' . $row["id"] . '" style="color: var(--white)"><i class="fa-solid fa-trash"></i></a>'
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

        $("#table").on("click", "a.btn-del", function () {
            var id = $(this).attr("id");
            $.ajax({
                url: "api/delete.php",
                method: "POST",
                data: {
                    table: "admin",
                    id: id
                },
                success: function (data) {
                    location.reload();
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