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
        <div class="sort">
            <select class="nice-select" name="sort" id="sort">
                <option value="ORDER BY id" selected>ID, 1-9</option>
                <option value="ORDER BY id DESC">ID, 9-1</option>
                <option value="ORDER BY name">Name, A-Z</option>
                <option value="ORDER BY name DESC">Name, Z-A</option>
            </select>
        </div>
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
                                <input type="file" class="form-control" name="imgfile" id="imgfile"
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
    <div class="list row container-fluid" id="list">

    </div>

</div>
<script>
    function fetch_filter_sort() {
        let params = "";
        let search = $("#search").val();
        let sort_by = $("#sort").val();
        if (search != "") params += ` WHERE name LIKE '%${search}%'`;
        params += ` ${sort_by}`
        $.ajax({
            url: 'api/fetch.php',
            method: 'POST',
            data: {
                query: "SELECT * FROM category " + params
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
                                    <div class="btn-group w-100" role="group" aria-label="Actions">
                                        <!-- <button type="button" class="btn my-btn">View</button> -->
                                        <a id="${parsedItem.id}" role="button" class="btn my-btn btn-edit">Update</a>
                                        <a role="button" id="${parsedItem.id}" class="btn my-btn btn-del">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                })
                $("#list").html(content)
            }
        })
    }

    // sort

    $("#sort").change(function () {
        fetch_filter_sort();
    });

    // search

    $("#search").keyup(function () {
        fetch_filter_sort();
    })

    // fetch

    $(document).ready(function () {
        fetch_filter_sort();

        $('#list').on("click", "a.btn-edit", function () {
            var id = $(this).attr("id");
            $.ajax({
                url: 'api/fetch.php',
                method: 'POST',
                data: {
                    query: "SELECT * FROM category WHERE id=" + id
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

        $("#list").on("click", "a.btn-del", function () {
            var id = $(this).attr("id");
            $.ajax({
                url: "api/delete.php",
                method: "POST",
                data: {
                    table: "category",
                    id: id
                },
                success: function (data) {
                    fetch_filter_sort();
                }
            })
        })
    })


    $('#btnAdd').click(function () {
        $("#id").val("");
        $("#name").val("");
        $("#imgfile").val("");
        $("#mdlLabel").text("Add Category");
        $("#btnSubmit").text("Add");
    })

    $("select").change(function () {
        let sort_as = $(this).val();

    })


</script>
<?php include("template/footer.html") ?>