<?php include("components/header.php"); ?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
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
    <div class="container">
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
                                                <input type="radio" id="sm">
                                            </label>
                                            <label for="md">m
                                                <input type="radio" id="md">
                                            </label>
                                            <label for="l">l
                                                <input type="radio" id="l">
                                            </label>
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
                                            if ($catid = $_REQUEST['cat_id']) {
                                                $subquery = 'SELECT * FROM subcat WHERE cat_id=' . $catid . '';
                                                if ($result = mysqli_query($conn, $subquery)) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                        <a href="shop.php?cat_id=<?php echo $row['cat_id'] ?>&sub_id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a>
                                                    <?php
                                                    }
                                                }
                                            } else {
                                                $query = 'SELECT * FROM subcat';
                                                if ($result = mysqli_query($conn, $query)) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                        <a href="shop.php?cat_id=<?php echo $row['cat_id'] ?>&sub_id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a>
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
                                if ($subcat = $_REQUEST['sub_id']) {
                                    $titlequery = 'SELECT COUNT(id)as totalproduct FROM product WHERE subcat_id=' . $subcat . '';
                                    if ($result = mysqli_query($conn, $titlequery)) {
                                        $totalproduct = mysqli_fetch_assoc($result);
                                    }
                                } else if ($catid = $_REQUEST['cat_id']) {
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
                                    }  ?>–<?php
                                            if ($totalproduct['totalproduct'] >= 12) {
                                                echo "12";
                                            } else {
                                                echo $totalproduct['totalproduct'];
                                            } ?> of <?php echo $totalproduct['totalproduct'] ?> results</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Sort by Price:</p>
                                <select>
                                    <option value="">Low To High</option>
                                    <option value="">$0 - $55</option>
                                    <option value="">$55 - $100</option>
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
                        <div class="box__description-container" style="padding-left: 250px" >
                            <div class="box__description-title">Whoops!</div>
                            <div class="box__description-text">It seems like we don't have the product you were looking for</div>
                        </div>
                        <?php
                    } else {
                        if ($subcat = $_REQUEST['sub_id']) {
                            $pquery = 'SELECT * FROM product WHERE subcat_id=' . $subcat . '';
                            if ($presult = mysqli_query($conn, $pquery)) {
                                while ($prow = mysqli_fetch_assoc($presult)) {
                        ?>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item sale">
                                            <div class="product__item__pic set-bg" data-setbg="img/product/<?php echo $prow['img'] ?>">
                                                <!-- <span class="label">Sale</span> -->
                                                <ul class="product__hover">
                                                    <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                                </ul>
                                            </div>
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
                        } else if ($catid = $_REQUEST['cat_id']) {
                            $pquery = 'SELECT * FROM product WHERE cat_id=' . $catid . '';
                            if ($presult = mysqli_query($conn, $pquery)) {
                                while ($prow = mysqli_fetch_assoc($presult)) {
                                ?>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item sale">
                                            <div class="product__item__pic set-bg" data-setbg="img/product/<?php echo $prow['img'] ?>">
                                                <!-- <span class="label">Sale</span> -->
                                                <ul class="product__hover">
                                                    <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                                </ul>
                                            </div>
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
                                            <div class="product__item__pic set-bg" data-setbg="img/product/<?php echo $prow['img'] ?>">
                                                <!-- <span class="label">Sale</span> -->
                                                <ul class="product__hover">
                                                    <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                                </ul>
                                            </div>
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
                    <!-- <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item sale">
                            <div class="product__item__pic set-bg" data-setbg="img/product/product-3.jpg">
                                <span class="label">Sale</span>
                                <ul class="product__hover">
                                    <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                    <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                                    </li>
                                    <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>Multi-pocket Chest Bag</h6>
                                <a href="#" class="add-cart">+ Add To Cart</a>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>$43.48</h5>
                                <div class="product__color__select">
                                    <label for="pc-7">
                                        <input type="radio" id="pc-7">
                                    </label>
                                    <label class="active black" for="pc-8">
                                        <input type="radio" id="pc-8">
                                    </label>
                                    <label class="grey" for="pc-9">
                                        <input type="radio" id="pc-9">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/product/product-4.jpg">
                                <ul class="product__hover">
                                    <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                    <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                                    </li>
                                    <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>Diagonal Textured Cap</h6>
                                <a href="#" class="add-cart">+ Add To Cart</a>
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>$60.9</h5>
                                <div class="product__color__select">
                                    <label for="pc-10">
                                        <input type="radio" id="pc-10">
                                    </label>
                                    <label class="active black" for="pc-11">
                                        <input type="radio" id="pc-11">
                                    </label>
                                    <label class="grey" for="pc-12">
                                        <input type="radio" id="pc-12">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item sale">
                            <div class="product__item__pic set-bg" data-setbg="img/product/product-6.jpg">
                                <span class="label">Sale</span>
                                <ul class="product__hover">
                                    <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                    <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                                    </li>
                                    <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>Ankle Boots</h6>
                                <a href="#" class="add-cart">+ Add To Cart</a>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>$98.49</h5>
                                <div class="product__color__select">
                                    <label for="pc-16">
                                        <input type="radio" id="pc-16">
                                    </label>
                                    <label class="active black" for="pc-17">
                                        <input type="radio" id="pc-17">
                                    </label>
                                    <label class="grey" for="pc-18">
                                        <input type="radio" id="pc-18">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/product/product-7.jpg">
                                <ul class="product__hover">
                                    <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                    <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                                    </li>
                                    <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>T-shirt Contrast Pocket</h6>
                                <a href="#" class="add-cart">+ Add To Cart</a>
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>$49.66</h5>
                                <div class="product__color__select">
                                    <label for="pc-19">
                                        <input type="radio" id="pc-19">
                                    </label>
                                    <label class="active black" for="pc-20">
                                        <input type="radio" id="pc-20">
                                    </label>
                                    <label class="grey" for="pc-21">
                                        <input type="radio" id="pc-21">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div> -->
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
<?php include("components/footer.php"); ?>