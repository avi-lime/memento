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
    <h1>Products</h1>
    <hr>

    <div class="actions">
        <button type="button" class="my-btn" data-bs-toggle="modal" data-bs-target="#modal" id="btnAdd">
            Add Product
        </button>
        <div class="sort">
            <select class="nice-select" name="sort" id="sort">
                <option value="id" selected>ID, 1-9</option>
                <option value="id DESC">ID, 9-1</option>
                <option value="name">Name, A-Z</option>
                <option value="name DESC">Name, Z-A</option>
                <option value="cat">Category, A-Z</option>
                <option value="cat DESC">Category, Z-A</option>
                <option value="sub">Sub-Category, A-Z</option>
                <option value="sub DESC">Sub-Category, Z-A</option>
            </select>
        </div>
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

                <div class="modal-body">
                    <form action="api/product.php" id="form" method="post" enctype="multipart/form-data">
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
                            <label>Price (₹): *</label>
                            <input required id="price" name="price" type="number" class="form-control mb-3">
                        </div>
                        <div class="form-group">
                            <label>Quantity: *</label>
                            <input required id="qty" name="qty" type="number" class="form-control mb-3">
                        </div>
                        <div class="form-group">
                            <label>Discount: *</label>
                            <input required id="discount" name="discount" type="number" class="form-control mb-3">
                        </div>
                        <div class="form-group">
                            <label>Image: *</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="imgfile[]" id="imgfile" required multiple
                                    accept=".png,.jpg,.jpeg,.webp">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn" form="form" type="reset" data-bs-dismiss="modal">Cancel</button>
                    <button name="btnSubmit" form="form" type="submit" class="btn" id="btnSubmit">Add</button>
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

        // change subcat on cat change
        $('#cat').change(function () {
            var id = $(this).val();
            fillsub(id);
        })

        // fetch and fill on edit - pre-appending
        $('#list').on("click", "a.btn-edit", function () {
            var id = $(this).attr("id");
            $.ajax({
                url: 'api/fetch.php',
                method: 'POST',
                data: {
                    query: "SELECT * FROM product WHERE id=" + id
                },
                dataType: "json",
                success: function (data) {
                    let parsedData = $.parseJSON(data[0]);
                    $("#id").val(parsedData.id);
                    $("#name").val(parsedData.name);
                    $('#desc').val(parsedData.description);
                    $('#price').val(parsedData.price);
                    $('#qty').val(parsedData.quantity);
                    $('#discount').val(parsedData.discount);
                    $("#cat").val(parsedData.cat_id);
                    $("#imgfile").attr("required", false);
                    $("#subcat").attr('disabled', false);
                    fillsub(parsedData.cat_id, parsedData.subcat_id);
                    $("#mdlLabel").text("Edit Product");
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
                    table: "product",
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
            $("#desc").val("");
            $("#price").val("");
            $("#qty").val("");
            $("#discount").val("");
            $("#cat").val(-1);
            $("#subcat").html("");
            $("#subcat").attr('disabled', true);
            $("#imgfile")
                .val("")
                .attr("required", true);
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

    function fetch_filter_sort() {
        let params = "";
        let search = $("#search").val();
        let sort_by = "ORDER BY " + $("#sort").val();
        if (search != "") params += ` WHERE name LIKE '%${search}%' OR id LIKE '${search}%' OR cat_id = (SELECT id FROM category WHERE category.name LIKE '%${search}%') OR subcat_id = (SELECT id FROM subcat WHERE subcat.name LIKE '%${search}%')`;
        params += ` ${sort_by}`
        $.ajax({
            url: 'api/fetch.php',
            method: 'POST',
            data: {
                query: `SELECT product.id, name,
                (SELECT name FROM category WHERE category.id=product.cat_id) AS cat,
                (SELECT name FROM subcat WHERE subcat.id=product.subcat_id) AS sub,
                price, quantity, discount, description FROM product
                ` + params
            },
            dataType: "json",
            success: function (data) {
                let content = ""
                data.forEach(item => {
                    let parsedItem = $.parseJSON(item);
                    content += `
                        <div class="p-1 col-xl-4 col-md-6 col-sm-12 mb-1">
                            <div class="card bg-black text-white">
                                <div id="${parsedItem.id}" class="carousel slide">
                                </div>
                                
                                <div class="card-body">
                                    <h5 class="card-title">
                                    ${parsedItem.id}. ${parsedItem.name}
                                    </h5>
                                    <p class="card-text line-clamp">
                                        ${parsedItem.description.replace(/\n/g, "<br>")}
                                    </p>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item bg-black text-white border-white">
                                            <b>Category:</b>
                                            ${parsedItem.cat}
                                        </li>
                                        <li class="list-group-item bg-black text-white border-white">
                                            <b>Sub-Category:</b>
                                            ${parsedItem.sub}
                                        </li>
                                        <li class="list-group-item bg-black text-white border-white">
                                            <b>Price:</b> ₹
                                            ${parsedItem.price}
                                        </li>
                                        <li class="list-group-item bg-black text-white border-white">
                                            <b>Discount:</b>
                                            ${parsedItem.discount}
                                        </li>
                                        <li class="list-group-item bg-black text-white border-white">
                                            <b>Quantity:</b>
                                            ${parsedItem.quantity}
                                        </li>
                                    </ul>
                                    <div class="card-body">
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
                $(".carousel").each(function (index, element) {
                    let id = element.id;
                    console.log(element.id)
                    $.ajax({
                        url: "api/fetch.php",
                        method: 'POST',
                        data: {
                            query: "SELECT * FROM product_images WHERE product_id=" + id
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data.length)
                            let content = `<div class="carousel-indicators">`
                            let class_active = "";
                            for (let i = 0; i < data.length; i++) {
                                if (i == 0) class_active = 'active'
                                else class_active = ""
                                content += `<button type="button" data-bs-target="#${id}" data-bs-slide-to="${i}" class="${class_active}"
                                        aria-current="true"></button>`
                            }
                            content += `</div><div class="carousel-inner">`

                            data.forEach((item, index) => {
                                let parsedItem = $.parseJSON(item);

                                if (index == 0)
                                    content += `<div class="carousel-item active">`
                                else content += `<div class="carousel-item">`

                                content += `<img src="../global/assets/images/${parsedItem.image}" alt="" class="card-img-top"
                                    style="object-fit: cover" height="300px">
                                </div>
                                `
                            })

                            content += `
                                </div><button class="carousel-control-prev" type="button" data-bs-target="#${id}"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#${id}"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            `
                            $(element).html(content)
                        }
                    })
                })
            }
        })

    }


</script>
<?php include("template/footer.html") ?>