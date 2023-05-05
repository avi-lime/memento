<?php include("components/header.php"); ?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option px-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h2>Shop</h2>
                    <div class="breadcrumb__links">
                        <a href="./index">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Filter Offcanvas -->
<div class="offcanvas bg-black offcanvas-end" tabindex="-1" id="offcanvasExample" data-bs-theme="dark"
    aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h3 class="offcanvas-title text-white">FILTERS</h3>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <a class="text-white text-decoration-underline ms-3" href="#">clear all</a>
    <hr>
    <div class="offcanvas-body">

        <div class="shop__sidebar__accordion">
            <div class="accordion" id="accordionExample">
                <div class="card bg-black">
                    <div class="card-heading">
                        <a data-bs-toggle="collapse" data-bs-target="#collapseThree">Filter Price</a>
                    </div>
                    <div id="collapseThree" class="collapse show">
                        <div class="price-input">
                            <div class="field">
                                <span>Min</span>
                                <input type="number" class="input-min"
                                    value="<?= isset($_GET['min']) ? $_GET['min'] : 0 ?>">
                            </div>
                            <div class="separator">-</div>
                            <div class="field">
                                <span>Max</span>
                                <input type="number" class="input-max"
                                    value="<?= isset($_GET['max']) ? $_GET['max'] : 3000 ?>">
                            </div>
                        </div>
                        <div class="slider">
                            <div class="progress"></div>
                        </div>
                        <div class="range-input">
                            <input type="range" class="range-min" id="min" name="min" min="0" max="3000"
                                value="<?= isset($_GET['min']) ? $_GET['min'] : 0 ?>" step="10">
                            <input type="range" class="range-max" id="max" name="max" min="0" max="3000"
                                value="<?= isset($_GET['max']) ? $_GET['max'] : 3000 ?>" step="10">
                        </div>
                    </div>
                </div>

                <!-- CSS for slider  -->

                <style>
                    .price-input {
                        width: 100%;
                        display: flex;
                        margin: 30px 0 35px;
                    }

                    .price-input .field {
                        display: flex;
                        width: 100%;
                        height: 45px;
                        align-items: center;
                    }

                    .field input {
                        width: 100%;
                        height: 100%;
                        outline: none;
                        font-size: 19px;
                        margin-left: 12px;
                        border-radius: 5px;
                        text-align: center;
                        border: 1px solid #999;
                        -moz-appearance: textfield;
                    }

                    input[type="number"]::-webkit-outer-spin-button,
                    input[type="number"]::-webkit-inner-spin-button {
                        -webkit-appearance: none;
                    }

                    .price-input .separator {
                        width: 130px;
                        display: flex;
                        font-size: 19px;
                        align-items: center;
                        justify-content: center;
                    }

                    .slider {
                        height: 5px;
                        position: relative;
                        background: #ddd;
                        border-radius: 5px;
                    }

                    .slider .progress {
                        height: 100%;
                        left: 25%;
                        right: 25%;
                        position: absolute;
                        border-radius: 5px;
                        background: #fff;
                    }

                    .range-input {
                        position: relative;
                    }

                    .range-input input {
                        position: absolute;
                        width: 100%;
                        height: 5px;
                        top: -5px;
                        background: none;
                        pointer-events: none;
                        -webkit-appearance: none;
                        -moz-appearance: none;
                    }

                    input[type="range"]::-webkit-slider-thumb {
                        height: 17px;
                        width: 17px;
                        border-radius: 50%;
                        background: #fff;
                        pointer-events: auto;
                        -webkit-appearance: none;
                        box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
                    }

                    input[type="range"]::-moz-range-thumb {
                        height: 17px;
                        width: 17px;
                        border: none;
                        border-radius: 50%;
                        background: #fff;
                        pointer-events: auto;
                        -moz-appearance: none;
                        box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
                    }
                </style>
            </div>
            <!-- <div class="card bg-black">
                <div class="card-heading">
                    <a data-bs-toggle="collapse" data-bs-target="#collapseFour">Size</a>
                </div>
                <div id="collapseFour" class="collapse show">
                    <div class="card-body">
                        <div class="shop__sidebar__size">
                            <label for="sm">s
                                <input type="checkbox" name="size" id="sm" value="sm">
                            </label>
                            <label for="md">m
                                <input type="checkbox" name="size" id="md" value="md">
                            </label>
                            <label for="l">l
                                <input type="checkbox" name="size" id="l" value="l">
                            </label>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="card bg-black">
                <div class="card-heading">
                    <a data-bs-toggle="collapse" data-bs-target="#collapseSix">Sub-Category</a>
                </div>
                <div id="collapseSix" class="collapse show" aria-expanded="true">
                    <div class="card-body">
                        <div class="shop__sidebar__tags">
                            <?php
                            if (isset($_REQUEST['cat_id']) && $_REQUEST['cat_id'] != null) {
                                $catid = $_REQUEST['cat_id'];
                                $subquery = 'SELECT * FROM subcat WHERE cat_id=' . $catid . '';
                                if ($result = mysqli_query($conn, $subquery)) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <a href="shop?sub_id=<?= $row['id'] ?>"><?= $row['name'] ?></a>
                                        <?php
                                    }
                                }
                            } else {
                                $query = 'SELECT * FROM subcat';
                                if ($result = mysqli_query($conn, $query)) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <a href="shop?sub_id=<?= $row['id'] ?>"><?= $row['name'] ?></a>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-black">
                <div class="card-body">
                    <div class="shop__sidebar__size">
                        <input type="button" class="primary-btn" id="btnFilterapply" name="btnFilterapply" value="Apply"
                            style="background-color: white; color: black">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container-fluid">
        <div class="shop__product__option">
            <div class="m-0 d-flex align-items-center justify-content-between">
                <div class="shop__product__option__right ms-auto">
                    <p>Sort by:</p>
                    <select name="sort" id="sort">
                        <option value="">Recommended </option>
                        <option value="ASC">Price Low To High</option>
                        <option value="DESC">Price High To Low</option>
                    </select>
                    <button class="filter primary-btn ms-3" style="font-size: 16px" id="btnfilter"
                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                        aria-controls="offcanvasExample">filter
                        <i class="fa-solid fa-filter"></i></button>
                </div>
            </div>
        </div>

        <!-- Product view Start -->
        <div class="row" id="productList">
        </div>
    </div>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Memento</strong>
                <small>Just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">

            </div>
        </div>
    </div>
</section>

<!-- Shop Section End -->
<script>
    $(document).ready(function () {
        fetch_filter_sort();
        const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");
        let priceGap = 100;
        priceInput.forEach(input => {
            input.addEventListener("input", e => {
                let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);

                if ((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
                    } else {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });
        rangeInput.forEach(input => {
            input.addEventListener("input", e => {
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);
                if ((maxVal - minVal) < priceGap) {
                    if (e.target.className === "range-min") {
                        rangeInput[0].value = maxVal - priceGap
                    } else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                }
            });
        });
    })

    //main code
    $("#sort").change(function () {
        fetch_filter_sort();
    })
    $("#btnFilterapply").click(function () {
        fetch_filter_sort();
    })
    function fetch_filter_sort() {
        let params = "";
        let subID = '<?= isset($_REQUEST['sub_id']) ? $_REQUEST['sub_id'] : "" ?>';
        let catID = '<?= isset($_REQUEST['cat_id']) ? $_REQUEST['cat_id'] : "" ?>';
        let search = '<?= isset($_REQUEST['q']) ? $_REQUEST['q'] : "" ?>';
        let min = $("#min").val();
        let max = $("#max").val();
        let sort_by = $("#sort").val();

        if (search) {
            console.log(search);
            params += ` WHERE name LIKE '%${search}%' OR cat_id = (SELECT id FROM category WHERE category.name LIKE '%${search}%' LIMIT 1) OR subcat_id = (SELECT id FROM subcat WHERE subcat.name LIKE '%${search}%' LIMIT 1)`
        } else if (subID) {
            params += " WHERE subcat_id=" + subID;
            if (min || max) {
                params += " AND price BETWEEN " + min + " AND " + max;
            }
        } else if (catID) {
            params += " WHERE cat_id=" + catID;
            if (min || max) {
                params += " AND price BETWEEN " + min + " AND " + max;
            }
        } else if (min || max) {
            params += " WHERE price BETWEEN " + min + " AND " + max;
        }

        if (sort_by) {
            params += " ORDER BY price " + sort_by;
        }
        console.log(`SELECT product.id, name,
                (SELECT name FROM category WHERE category.id=product.cat_id) AS cat,
                (SELECT name FROM subcat WHERE subcat.id=product.subcat_id) AS sub,
                price, quantity, discount FROM product
                ` + params);
        $.ajax({
            url: 'api/fetch.php',
            method: 'POST',
            data: {
                query: `SELECT product.id, name,
                (SELECT name FROM category WHERE category.id=product.cat_id) AS cat,
                (SELECT name FROM subcat WHERE subcat.id=product.subcat_id) AS sub,
                price, quantity, discount FROM product
                ` + params
            },
            dataType: "json",
            success: function (data) {
                let content = ""
                data.forEach(item => {
                    let parsedItem = $.parseJSON(item);
                    content += `<div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item sale">
                                        <a href="shop-details?product_id=${parsedItem.id}">
                                        <div class="product__item__pic set-bg carousel slide" id="${parsedItem.id}" data-setbg="global/assets/images/">
                                </div>
                            </a>
                            <div class="product__item__text">
                                <h5 style=" color: #36454F;
                                        font-weight:620;
                                        font-size: medium;
                                        margin-bottom:2px">
                                    ${parsedItem.name}
                                    </br>
                                    </h5>
                                    <p class="mb-1" >
                                    ${parsedItem.sub}</p>
                                <h5>₹${parseInt(parsedItem.price - parsedItem.price * parsedItem.discount / 100)}<span>₹${parsedItem.price}</span><h6>(${parsedItem.discount}% OFF)</h6></h5></div>
                        </div>
                    </div>
        </div>
    </div>
                        `;
                })
                $("#productList").html(content)
                $(".carousel").each(function (index, element) {
                    let id = element.id;
                    $.ajax({
                        url: "api/fetch.php",
                        method: 'POST',
                        data: {
                            query: "SELECT * FROM product_images WHERE product_id=" + id
                        },
                        dataType: "json",
                        success: function (data) {
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

                                content += `<img src="global/assets/images/${parsedItem.image}" alt="" class="card-img-top"
                                    style="object-fit: cover" height="260px">
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
<?php include("components/footer.php"); ?>