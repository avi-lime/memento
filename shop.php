<?php include("components/header.php"); ?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option text-center">
    <div class="container">
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

<!-- filter product -->
<style>
    .filters__header {
        display: flex;

    }

    .cc-accordion-item {
        margin-bottom: 15px;
    }


    /*check box*/

    .sidenav {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
        color: #FFFFFF;
    }

    .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }

    .sidenav a:hover {
        color: #f1f1f1;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    @media screen and (max-height: 450px) {
        .sidenav {
            padding-top: 15px;
        }

        .sidenav a {
            font-size: 18px;
        }
    }



    .checkbox {
        margin-left: 5px;
        margin-right: 10px;
    }

    .sidenav {
        font-size: 17px;
    }

    .checkbox-wrapper-47 input[type="checkbox"] {
        display: none;
        visibility: hidden;
    }

    .checkbox-wrapper-47 label {
        position: relative;
        padding-left: 2em;
        padding-right: 1em;
        line-height: 2;
        cursor: pointer;
        display: inline-flex;
    }

    .checkbox-wrapper-47 label:before {
        box-sizing: border-box;
        content: " ";
        position: absolute;
        top: 0.3em;
        left: 0;
        display: block;
        width: 1.4em;
        height: 1.4em;
        border: 2px solid #9098A9;
        border-radius: 6px;
        z-index: -1;
    }

    .checkbox-wrapper-47 input[type=checkbox]:checked+label {
        padding-left: 1em;
        color: #0f5229;
    }

    .checkbox-wrapper-47 input[type=checkbox]:checked+label:before {
        top: 0;
        width: 100%;
        height: 2em;
        background: #b7e6c9;
        border-color: #2cbc63;
    }

    .checkbox-wrapper-47 label,
    .checkbox-wrapper-47 label::before {
        transition: 0.25s all ease;
    }

    /*price range*/

    header h2 {
        font-size: 24px;
        font-weight: 600;
    }

    header p {
        margin-top: 5px;
        font-size: 16px;
    }

    .price-input {
        width: 100%;
        display: flex;
        margin: 10px 0 30px;
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
        width: 50px;
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
        background: #17A2B8;
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
        background: #17A2B8;
        pointer-events: auto;
        -webkit-appearance: none;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
    }

    input[type="range"]::-moz-range-thumb {
        height: 17px;
        width: 17px;
        border: none;
        border-radius: 50%;
        background: #17A2B8;
        pointer-events: auto;
        -moz-appearance: none;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
    }
</style>


<button class="filter" id="btnfltr" onclick="openFil()"
    style="background-color: #111827; border: 1px solid transparent; border-radius: .75rem; box-sizing: border-box; color: #FFFFFF; font-size: 25px; width: 200px; float: right; margin-top: 15px; margin-right: 15px;">filter</button>


<div id="mySidenav" class="sidenav">
    <h2 class="js-hidden">Filter</h2>

    <div class="filters__header">
        <button type="button" class="closser" onclick="closefil()">
            <title>Close</title>


            <i class='fa fa-close'></i>

        </button>
        <a href="#" class="reset">Clear all</a>
    </div>

    <div class="checkbox-wrapper-47">
        <details class="cc-accordion-item" data-type="list" data-index="1">
            <summary class="cc-accordion-item__title filter-group__header">Availability</summary>
            <ul class="unstyled-list">
                <li>
                    <input type="checkbox" class="checkbox" id="filter-Availability-1" name="filter.v.availability"
                        value="1">
                    <label for="filter-Availability-1">
                        In stock (26)
                    </label>
                </li>
                <li>
                    <input type="checkbox" class="checkbox" id="filter-Availability-2" name="filter.v.availability"
                        value="0">
                    <label for="filter-Availability-2">
                        Out of stock (25)
                    </label>
                </li>
            </ul>
        </details>
    </div>


    <div class="wrapper" style="margin-right: 3px;">
        <details class="cc-accordion-item" data-type="price_range" data-index="2">
            <summary class="cc-accordion-item__title filter-group__header">Price</summary>

            <div class="price-input">
                <div class="field">
                    <span>Min</span>
                    <input type="number" class="input-min" value="2500" />
                </div>
                <div class="separator">-</div>
                <div class="field">
                    <span>Max</span>
                    <input type="number" class="input-max" value="7500" />
                </div>
            </div>
            <div class="slider">
                <div class="progress"></div>
            </div>
            <div class="range-input">
                <input type="range" class="range-min" min="0" max="10000" value="2500" step="100" />
                <input type="range" class="range-max" min="0" max="10000" value="7500" step="100" />
            </div>
        </details>
    </div>

    <div class="checkbox-wrapper-47">
        <details class="cc-accordion-item" data-type="list" data-index="3">
            <summary class="cc-accordion-item__title filter-group__header">Product type</summary>

            <div class="cc-accordion-item__content">
                <ul class="unstyled-list">
                    <li>
                        <input type="checkbox" class="checkbox" id="filter-Product type-1" name="filter.p.product_type"
                            value="Clothing Accessories">
                        <label for="filter-Product type-1">
                            Clothing Accessories (1)
                        </label>
                    </li>
                    <li>
                        <input type="checkbox" class="checkbox" id="filter-Product type-2" name="filter.p.product_type"
                            value="Gift Cards">
                        <label for="filter-Product type-2">
                            Gift Cards (1)
                        </label>
                    </li>
                    <li>
                        <input type="checkbox" class="checkbox" id="filter-Product type-3" name="filter.p.product_type"
                            value="Hats">
                        <label for="filter-Product type-3">
                            Hats (5)
                        </label>
                    </li>
                    <li>
                        <input type="checkbox" class="checkbox" id="filter-Product type-4" name="filter.p.product_type"
                            value="Hoodies">
                        <label for="filter-Product type-4">
                            Hoodies (8)
                        </label>
                    </li>
                    <li>
                        <input type="checkbox" class="checkbox" id="filter-Product type-5" name="filter.p.product_type"
                            value="Jackets">
                        <label for="filter-Product type-5">
                            Jackets (6)
                        </label>
                    </li>
                    <li>
                        <input type="checkbox" class="checkbox" id="filter-Product type-6" name="filter.p.product_type"
                            value="Joggers">
                        <label for="filter-Product type-6">
                            Joggers (10)
                        </label>
                    </li>
                    <li>
                        <input type="checkbox" class="checkbox" id="filter-Product type-7" name="filter.p.product_type"
                            value="Socks">
                        <label for="filter-Product type-7">
                            Socks (3)
                        </label>
                    </li>
                    <li>
                        <input type="checkbox" class="checkbox" id="filter-Product type-8" name="filter.p.product_type"
                            value="Tees">
                        <label for="filter-Product type-8">
                            Tees (4)
                        </label>
                    </li>
                </ul>
            </div>
        </details>
    </div>
</div>
</div>

<script>
    function openFil() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closefil() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>




<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="" method="POST">
                            <input type="text" placeholder="Search...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                </div>
                                <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__price">
                                            <ul>
                                                <li><a href="#">$0.00 - $50.00</a></li>
                                                <li><a href="#">$50.00 - $100.00</a></li>
                                                <li><a href="#">$100.00 - $150.00</a></li>
                                                <li><a href="#">$150.00 - $200.00</a></li>
                                                <li><a href="#">$200.00 - $250.00</a></li>
                                                <li><a href="#">250.00+</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                </div>
                                <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
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
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFive">Colors</a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseSix">Sub-Category</a>
                                </div>
                                <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__tags">
                                            <?php
                                            if ($catid = isset($_REQUEST['cat_id'])) {
                                                $subquery = 'SELECT * FROM subcat WHERE cat_id=' . $catid . '';
                                                if ($result = mysqli_query($conn, $subquery)) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        ?>
                                                        <a href="shop?cat_id=<?= $row['cat_id'] ?>&sub_id=<?= $row['id'] ?>"><?php
                                                            echo $row['name'] ?></a>
                                                        <?php
                                                    }
                                                }
                                            } else {
                                                $query = 'SELECT * FROM subcat';
                                                if ($result = mysqli_query($conn, $query)) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        ?>
                                                        <a href="shop?cat_id=<?= $row['cat_id'] ?>&sub_id=<?= $row['id'] ?>"><?php
                                                            echo $row['name'] ?></a>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
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
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
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
                        if ((isset($_REQUEST['sub_id'])) && ($subcat = $_REQUEST['sub_id'])) {
                            $pquery = 'SELECT * FROM product WHERE subcat_id=' . $subcat . '';
                            $presult = mysqli_query($conn, $pquery);
                        } else if ((isset($_REQUEST['cat_id'])) && ($catid = $_REQUEST['cat_id'])) {
                            $pquery = 'SELECT * FROM product WHERE cat_id=' . $catid . '';
                            $presult = mysqli_query($conn, $pquery);
                        } else {
                            $pquery = 'SELECT * FROM product';
                            $presult = mysqli_query($conn, $pquery);
                        }
                        while ($prow = mysqli_fetch_assoc($presult)) {
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
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
                                                <li id="<?= $prow['id'] ?>" class="<?= $class ?>"><?= $wishlist ?></li>
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
                                            echo $price;
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

<!-- script for price range-->
<script>
    const rangeInput = document.querySelectorAll(".range-input input"),
        priceInput = document.querySelectorAll(".price-input input"),
        range = document.querySelector(".slider .progress");
    let priceGap = 1000;

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
</script>
<!-- Shop Section End -->
<script>
    $(document).ready(function () {
        $('.wishlist, .delete').click(function (e) {
            e.preventDefault();
            var id = $(this).attr("id");
            let action = $(this).attr("class");
            console.log(action)
            $.ajax({
                url: 'api/wishlist.php',
                method: 'POST',
                data: {
                    id: id,
                    action: action
                },
                success: function (data) {
                    const toastLiveExample = document.getElementById('liveToast')

                    $(".toast-body").text(data)

                    const toast = new bootstrap.Toast($("#liveToast"))
                    toast.show()

                    $(`#${id}`).toggleClass("wishlist").toggleClass("delete")
                    $(`#${id}`).children("i.fa-heart").toggleClass("white-heart").toggleClass("red-heart")
                }
            })
        })
        $("")

        $('.login').click(function (e) {
            e.preventDefault();
            document.location.href = "login";
        })
    })
</script>
<?php include("components/footer.php"); ?>