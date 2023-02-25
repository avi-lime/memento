<?php include("components/header.php"); ?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h2>Shop</h2>
                    <div class="breadcrumb__links">
                        <a href="./index.php">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

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
                                                        <a
                                                            href="shop.php?cat_id=<?php echo $row['cat_id'] ?>&sub_id=<?php echo $row['id'] ?>"><?php
                                                                  echo $row['name'] ?></a>
                                                        <?php
                                                    }
                                                }
                                            } else {
                                                $query = 'SELECT * FROM subcat';
                                                if ($result = mysqli_query($conn, $query)) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        ?>
                                                        <a
                                                            href="shop.php?cat_id=<?php echo $row['cat_id'] ?>&sub_id=<?php echo $row['id'] ?>"><?php
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
                                    <?php echo $totalproduct['totalproduct'] ?> results
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Sort:</p>
                                <select>
                                    <option value="">Price, Low To High</option>
                                    <option value="">Price, High To Low</option>
                                    <option value="">Trending</option>
                                    <option value="">Title, A-Z</option>
                                    <option value="">Title, Z-A</option>
                                </select>
                            </div>
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
                            if ($presult = mysqli_query($conn, $pquery)) {
                                while ($prow = mysqli_fetch_assoc($presult)) {
                                    ?>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item sale">
                                            <a href="shop-details.php?product_id=<?php echo $prow['id']; ?>">
                                                <div class="product__item__pic set-bg" data-setbg="global/assets/images/<?php
                                                $sql = 'SELECT image FROM product_images WHERE product_id = "' . $prow['id'] . '" LIMIT 1';
                                                $image = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                                                echo $image['image'];
                                                ?>">
                                                    <!-- <span class="label">Sale</span> -->
                                                    <ul class="product__hover">
                                                        <li id="<?php echo $prow['id'] ?>" class="wishlist"><img
                                                                src="img/icon/heart.png" alt=""></li>
                                                    </ul>
                                                </div>
                                            </a>
                                            <div class="product__item__text">
                                                <h6>
                                                    <?php echo $prow['name']; ?>
                                                </h6>
                                                <a href="#" class="add-cart">+ Add To Cart</a>
                                                <div class="rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <h5>₹
                                                    <?php echo $prow['price']; ?>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        } else if ((isset($_REQUEST['cat_id'])) && ($catid = $_REQUEST['cat_id'])) {
                            $pquery = 'SELECT * FROM product WHERE cat_id=' . $catid . '';
                            if ($presult = mysqli_query($conn, $pquery)) {
                                    while ($prow = mysqli_fetch_assoc($presult)) {
                                        ?>
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="product__item sale">
                                                <a href="shop-details.php?product_id=<?php echo $prow['id']; ?>">
                                                    <div class="product__item__pic set-bg" data-setbg="global/assets/images/<?php
                                                    $sql = 'SELECT image FROM product_images WHERE product_id = "' . $prow['id'] . '" LIMIT 1';
                                                    $image = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                                                    echo $image['image'];
                                                    ?>">
                                                        <!-- <span class="label">Sale</span> -->
                                                        <ul class="product__hover">
                                                            <li id="<?php echo $prow['id'] ?>" class="wishlist"><img
                                                                    src="img/icon/heart.png" alt=""></li>
                                                        </ul>
                                                    </div>
                                                </a>
                                                <div class="product__item__text">
                                                    <h6>
                                                    <?php echo $prow['name']; ?>
                                                    </h6>
                                                    <a href="#" class="add-cart">+ Add To Cart</a>
                                                    <div class="rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <h5>₹
                                                    <?php echo $prow['price']; ?>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    <?php

                                }
                            }
                        } else {
                            $pquery = 'SELECT * FROM product';
                            if ($presult = mysqli_query($conn, $pquery)) {
                                while ($prow = mysqli_fetch_assoc($presult)) {
                                    ?>
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="product__item sale">
                                                <a href="shop-details.php?product_id=<?php echo $prow['id']; ?>">
                                                    <div class="product__item__pic set-bg" data-setbg="global/assets/images/<?php
                                                    $sql = 'SELECT image FROM product_images WHERE product_id = "' . $prow['id'] . '" LIMIT 1';
                                                    $image = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                                                    echo $image['image'];
                                                    ?>">
                                                        <!-- <span class="label">Sale</span> -->
                                                        <ul class="product__hover">
                                                            <li id="<?php echo $prow['id'] ?>" class="wishlist"><img
                                                                    src="img/icon/heart.png" alt=""></li>
                                                        </ul>
                                                    </div>
                                                </a>
                                                <div class="product__item__text">
                                                    <h6>
                                                    <?php echo $prow['name']; ?>
                                                    </h6>
                                                    <a href="#" class="add-cart">+ Add To Cart</a>
                                                    <div class="rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <h5>₹
                                                    <?php echo $prow['price']; ?>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
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
</section>
<!-- Shop Section End -->
<script>
    $(document).ready(function () {
        $('.wishlist').click(function (e) {
            e.preventDefault();
            var id = $(this).attr("id");
                $.ajax({
                    url: 'api/wishlist.php',
                    method: 'POST',
                    data: {
                       id:id
                    },
                    success: function (data) {
                        console.log("hehehe")
                    }
                })
            })
        })
    </script>
<?php include("components/footer.php"); ?>