<?php
include("template/header.php");
include("../global/api/conn.php");
?>

<script>

    function fetch_filter_sort() {
        let params = "";
        let search = $("#search").val();
        let sort_by = $("#sort").val();
        if (search != "") params += ` WHERE name LIKE '%${search}%' OR id LIKE '${search}%'`;
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