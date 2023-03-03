<?php
include("template/header.php");
include("../global/api/conn.php");

if (!isset($_SESSION["super"]) || $_SESSION["super"] != 1) {
    $super = false;
} else {
    $super = true;
}


?>
<div class="card">
    <h1>Sub-Categories</h1>
    <hr>

    <div class="actions">
        <?php if ($super) { ?>
            <button type="button" class="my-btn" data-bs-toggle="modal" data-bs-target="#modal" id="btnAdd">
                Add Sub-Category
            </button>
        <?php } ?>
        <div class="sort">
            <select class="nice-select" name="sort" id="sort">
                <option value="ORDER BY id" selected>ID, 1-9</option>
                <option value="ORDER BY id DESC">ID, 9-1</option>
                <option value="ORDER BY name">Name, A-Z</option>
                <option value="ORDER BY name DESC">Name, Z-A</option>
                <option value="ORDER BY cat">Category, A-Z</option>
                <option value="ORDER BY cat DESC">Category, Z-A</option>
            </select>
        </div>
        <input type="text" class="search-bar" name="search" id="search" data-table="subcat" placeholder="Search...">
    </div>

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

                <div class="modal-body">
                    <form id="form" action="api/subcat.php" method="post" enctype="multipart/form-data">
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
                                    accept=".png,.jpg,.jpeg,.webp">
                            </div>
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

    <!-- list of items -->
    <div class="list row" id="list">
    </div>

</div>
<script>
    // fetch before load
    fetch_filter_sort()

    $(document).ready(function () {

        // fetch and fill on edit - pre-appending
        $('#list').on("click", "a.btn-edit", function () {
            var id = $(this).attr("id");
            $.ajax({
                url: 'api/fetch.php',
                method: 'POST',
                data: {
                    query: "SELECT * FROM subcat WHERE id=" + id
                },
                dataType: "json",
                success: function (data) {
                    let parsedData = $.parseJSON(data[0]);
                    $("#id").val(parsedData.id);
                    $("#name").val(parsedData.name);
                    $("#cat").val(parsedData.cat_id);
                    $("#imgfile").attr("required", false);
                    $("#mdlLabel").text("Edit Sub-Category");
                    $("#btnSubmit").text("Update");
                    $("#modal").modal('show');
                }
            })
        })

        //delete
        $("#list").on("click", "a.btn-del", function () {
            var id = $(this).attr("id");
            $.ajax({
                url: "api/delete.php",
                method: "POST",
                data: {
                    table: "subcat",
                    id: id
                },
                success: function (data) {
                    fetch_filter_sort();
                }
            })
        })

        // sort
        $("#sort").change(function () {
            fetch_filter_sort();
        });


        // search
        $("#search").keyup(function () {
            fetch_filter_sort();
        })

        // reset form on add
        $('#btnAdd').click(function () {
            $("#id").val("");
            $("#name").val("");
            $("#cat").val(-1);
            $("#imgfile")
                .val("")
                .attr("required", true);
            $("#mdlLabel").text("Add Sub-Category");
            $("#btnSubmit").text("Add");
        })
    })


    function fetch_filter_sort(table) {
        let params = "";
        let search = $("#search").val();
        let sort_by = $("#sort").val();
        if (search != "") params += ` WHERE name LIKE '%${search}%' OR id LIKE '${search}%'`;
        params += ` ${sort_by}`
        $.ajax({
            url: 'api/fetch.php',
            method: 'POST',
            data: {
                query: `SELECT id, name, image, (SELECT name FROM category WHERE category.id=subcat.cat_id) AS cat FROM subcat ` + params
            },
            dataType: "json",
            success: function (data) {
                let content = ""
                data.forEach(item => {
                    let parsedItem = $.parseJSON(item);
                    content += `
                        <div class="p-1 col-xl-4 col-md-6 col-sm-12 mb-1">
                            <div class="card bg-black text-white">
                                <img src="../global/assets/images/${parsedItem.image}" alt="" class="card-img-top"
                                    style="object-fit: cover" height="300px">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        ${parsedItem.id}. ${parsedItem.name}
                                    </h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item bg-black text-white border-white">
                                            <b>Category:</b>
                                            ${parsedItem.cat}
                                        </li>
                                    </ul>
                                    <?php if ($super) { ?>
                                                    <div class="btn-group w-100" role="group" aria-label="Actions">
                                                        <!-- <button type="button" class="btn my-btn">View</button> -->
                                                        <a id="${parsedItem.id}" role="button" class="btn my-btn btn-edit">Update</a>
                                                        <a role="button" id="${parsedItem.id}" class="btn my-btn btn-del">Delete</a>
                                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        `;
                })
                $("#list").html(content)
            }
        })
    }
</script>
<?php include("template/footer.html") ?>