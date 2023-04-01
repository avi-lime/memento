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

        <div class="shop__sidebar__search">
            <form action="" method="POST">
                <input type="text" placeholder="Search...">
                <button type="submit"><span class="icon_search"></span></button>
            </form>
        </div>
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
                                <input type="number" class="input-min" value="0">
                            </div>
                            <div class="separator">-</div>
                            <div class="field">
                                <span>Max</span>
                                <input type="number" class="input-max" value="2000">
                            </div>
                        </div>
                        <div class="slider">
                            <div class="progress"></div>
                        </div>
                        <div class="range-input">
                            <input type="range" class="range-min" min="0" max="2000" value="0" step="10">
                            <input type="range" class="range-max" min="0" max="2000" value="2000" step="10">
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
            <div class="card bg-black">
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
            </div>
            <div class="card bg-black">
                <div class="card-heading">
                    <a data-bs-toggle="collapse" data-bs-target="#collapseSix">Sub-Category</a>
                </div>
                <div id="collapseSix" class="collapse show" aria-expanded="true">
                    <div class="card-body">
                        <div class="shop__sidebar__tags">
                            <?php
                            if (isset($_REQUEST['cat_id']) && $_REQUEST['cat_id']!=null) {
                                $catid=$_REQUEST['cat_id']; 
                                $subquery = 'SELECT * FROM subcat WHERE cat_id=' . $catid . '';
                                echo $subquery ;
                                if ($result = mysqli_query($conn, $subquery)) {
                                    print_r($result);
                                    while($row = mysqli_num_rows($result)){
                                        ?>
                                        <a href="shop?sub_id=<?=$row['id'] ?>"><?=$row['name'] ?></a>
                                        <?php
                                    }
                                }
                            } else {
                                $query = 'SELECT * FROM subcat';
                                if ($result = mysqli_query($conn, $query)) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <a href="shop?sub_id=<?= $row['id'] ?>"><?=$row['name'] ?></a>
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
                        <input type="button" class="primary-btn" id="btnFilter" name="btnFilter" value="Apply">
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
                <div class="shop__product__option__left">
                    <?php

                    if ((isset($_REQUEST['sub_id'])) && ($subcat = $_REQUEST['sub_id'])) {
                        $titlequery = 'SELECT COUNT(id)as totalproduct FROM product WHERE subcat_id=' . $subcat . '';
                        if ($result = mysqli_query($conn, $titlequery)) {
                            $totalproduct = mysqli_fetch_assoc($result);
                        }
                    } else if ((isset($_REQUEST['cat_id'])) && ($catid = $_REQUEST['cat_id'])) {
                        $titlequery = 'SELECT COUNT(id)as totalproduct FROM product WHERE cat_id=' . $catid . '';
                        if ($result = mysqli_query($conn, $titlequery)) {
                            $totalproduct = mysqli_fetch_assoc($result);
                        }
                    } else {
                        $titlequery = 'SELECT COUNT(id)as totalproduct FROM product';
                        if ($result = mysqli_query($conn, $titlequery)) {
                            $totalproduct = mysqli_fetch_assoc($result);
                        }
                    }
                    ?>
                    <p>Showing
                        <?php if ($totalproduct['totalproduct'] < 1) {
                            echo "0";
                        } else {
                            echo "1";
                        } ?>–
                        <?php
                        if ($totalproduct['totalproduct'] >= 12) {
                            echo "12";
                        } else {
                            echo $totalproduct['totalproduct'];
                        } ?> of
                        <?= $totalproduct['totalproduct'] ?> results
                    </p>
                </div>

                <div class="shop__product__option__right">
                    <p>Sort by Price:</p>
                    <select name="sort" id="sort">
                        <?php
                        $selected = null;
                        if ((isset($_REQUEST['order'])) && ($order = $_REQUEST['order'])) {
                            if ($order == "ASC") {
                                $selected = "ASC";
                            } elseif ($order == "DESC") {
                                $selected = "DESC";
                            }
                        }
                        ?>
                        <option value="" <?php if ($selected == null)
                            echo 'selected="selected"'; ?>>Recommended </option>
                        <option value="ASC" <?php if ($selected == "ASC")
                            echo ' selected="selected"'; ?>>Low To High
                        </option>
                        <option value="DESC" <?php if ($selected == "DESC")
                            echo ' selected="selected"'; ?>>High To Low
                        </option>
                    </select>
                    <button class="filter primary-btn ms-3" style="font-size: 16px" id="btnfilter"
                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                        aria-controls="offcanvasExample">filter
                        <i class="fa-solid fa-filter"></i></button>
                </div>
            </div>
        </div>

        <!-- Product view Start -->
        <div class="row">
            <?php

            if ($totalproduct['totalproduct'] < 1) {
                ?>
                <div class="box__description-container" style="padding-left: 250px">
                    <div class="box__description-title">Whoops!</div>
                    <div class="box__description-text">It seems like we don't have the product you were looking for
                    </div>
                </div>
                <?php
            } else {
                if ($selected != null) {
                    $ordersql = 'ORDER BY price ' . $selected;
                }
                if ((isset($_REQUEST['sub_id'])) && ($subcat = $_REQUEST['sub_id'])) {
                    $pquery = 'SELECT * FROM product WHERE subcat_id=' . $subcat . '';
                } else if ((isset($_REQUEST['cat_id'])) && ($catid = $_REQUEST['cat_id'])) {
                    $pquery = 'SELECT * FROM product WHERE cat_id=' . $catid . '';
                } else {
                    $pquery = 'SELECT * FROM product';
                }
                if ($selected != null) {
                    $pquery .= ' ' . $ordersql;
                }
                $presult = mysqli_query($conn, $pquery);
                while ($prow = mysqli_fetch_assoc($presult)) {
                    ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item sale">
                            <a href="shop-details?product_id=<?= $prow['id']; ?>">
                                <div class="product__item__pic set-bg" data-setbg="global/assets/images/<?php
                                $sql = 'SELECT image FROM product_images WHERE product_id = "' . $prow['id'] . '" LIMIT 1';
                                $image = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                                echo $image['image'];
                                if (isset($_SESSION['user'])) {
                                    $checksql = 'SELECT * FROM wishlist WHERE user_id=' . $_SESSION['user'] . ' AND product_id=' . $prow['id'] . '';
                                    $check = mysqli_query($conn, $checksql);
                                    $num = mysqli_num_rows($check);
                                    if ($num > 0) {
                                        $wishlist = '<i class="fa-solid fa-heart red-heart"></i>';
                                        $class = "delete";
                                    } else {
                                        $class = "wishlist";
                                        $wishlist = '<i class="fa-solid fa-heart white-heart"></i>';
                                    }
                                } else {
                                    $class = "login";
                                    $wishlist = '<i class="fa-solid fa-heart white-heart"></i>';
                                }
                                ?>">
                                    <!-- <span class="label">Sale</span> -->
                                    <ul class="product__hover">
                                        <li id="wish-<?= $prow['id'] ?>" class="<?= $class ?>"><?= $wishlist ?></li>
                                    </ul>
                                </div>
                            </a>
                            <div class="product__item__text">
                                <h5 style=" color: #36454F;
                                        font-weight:620;
                                        font-size: medium;
                                        margin-bottom:2px">
                                    <?= $prow['name']; ?>
                                </h5>
                                <!-- <a href="#" class="add-cart">+ Add To Cart</a> -->
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>₹
                                    <?php $originalprice = $prow['price'];
                                    $discountrate = $prow['discount'];
                                    $discountprice = $originalprice * ($discountrate / 100);
                                    $price = $originalprice - $discountprice;
                                    echo (int) $price;
                                    ?><span>₹
                                        <?= $prow['price']; ?>
                                    </span>
                                </h5>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            }
            ?>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="product__pagination">
                    <a class="active" href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <span>...</span>
                    <a href="#">21</a>
                </div>
            </div>
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
        $('.login').click(function (e) {
            e.preventDefault();
            location.href = "login";
        })

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
        $('#sort').change(function () {
            let order = $('#sort').val();
            let change;
            if (order == "ASC") {
                change = "DESC";
            } else {
                change = "ASC"
            }
            let url = window.location.href;
            let n = url.indexOf('&order');
            url = url.substring(0, n != -1 ? n : url.length);
            if (order != "") {
                url += "&order=" + order;
            }
            console.log(url);
            location.href = url;
        })
    })
</script>
<?php include("components/footer.php"); ?>