<?php include("components/header.php"); ?>
<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        <?php
        $sql = "SELECT * FROM slider limit 5";
        $result = mysqli_query($conn, $sql);
        while ($slider = mysqli_fetch_assoc($result)) {
            $catid = $slider['cat_id'];
            $subcatid = null;
            if ($slider['subcat_id'] != null) {
                $subcatid = $slider['subcat_id'];
            }
            ?>
            <div class="hero__items set-bg" data-setbg="global/assets/slider/<?= $slider['image'] ?>">
                <a class="stretched-link" href="shop?cat_id=<?= $catid ?>&sub_id=<?= $subcatid ?>">
                    <!-- <img src="" height="600px" width="100%" alt=""> -->
                </a>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <div class="hero__social">
                                    <!--<a href=""><i class="fa-brands fa-facebook"></i></a>-->
                                    <!--<a href="#"><i class="fa-brands fa-twitter"></i></a>-->
                                    <!--<a href="#"><i class="fa-brands fa-pinterest"></i></a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</section>
<!-- Hero Section End -->

<!-- Banner Section Begin -->
<section class="banner spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-4">
                <div class="banner__item">
                    <div class="banner__item__pic">
                        <img src="img/banner/banner-1.jpg" width="440" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>New Arrival Hoodies</h2>
                        <a href="shop?cat_id=12&sub_id=14">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="banner__item banner__item--middle">
                    <div class="banner__item__pic">
                        <img src="img/banner/banner-2.jpg" width="440" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Hot Sales T-Shirts</h2>
                        <a href="shop?cat_id=12&sub_id=11">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="banner__item banner__item--last">
                    <div class="banner__item__pic">
                        <img src="img/banner/banner-3.jpg" width="440" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>OverSize Spring 2023</h2>
                        <a href="shop?cat_id=12&sub_id=13">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">Best Sellers</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <?php
            $relateditemsql = 'SELECT * FROM product ORDER BY quantity LIMIT 4';
            $result = mysqli_query($conn, $relateditemsql);
            while ($relateditem = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="product__item">
                        <a href="shop-details?product_id=<?= $relateditem['id']; ?>">
                            <div class="product__item__pic set-bg" data-setbg="global/assets/images/<?php
                            $sql = 'SELECT image FROM product_images WHERE product_id = "' . $relateditem['id'] . '" LIMIT 1';
                            $image = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                            echo $image['image'];
                            // $checksql = 'SELECT * FROM wishlist WHERE user_id=' . $_SESSION['user'] . ' AND product_id=' . $relateditem['id'] . '';
                            // $check = mysqli_query($conn, $checksql);
                            // $num = mysqli_num_rows($check);
                            // if ($num > 0) {
                            //     $wishlist = '<i style="color:red;" class="fa-solid fa-heart"></i>';
                            //     $class = "";
                            //     $wishlisttext = "WISHLISTED";
                            // } else {
                            //     $class = "wishlist";
                            //     $wishlist = '<i style=" text-shadow: -1px 0 #000, 0 1px #000, 1px 0 #000, 0 -1px #000;" class="fa-solid fa-heart"></i>';
                            //     $wishlisttext = "ADD TO WISHLIST";
                            // }
                            ?>">
                                <!-- <span class="label">New</span> -->
                                <ul class="product__hover">
                                    <li class="<?php // echo $class ?>" id="<?= $relateditem['id'] ?>"><?php //echo $wishlist ?></li>
                                </ul>
                            </div>
                        </a>
                        <div class="product__item__text">
                            <h5 style=" color: #36454F;
                                font-weight:620;
                                font-size: medium;
                                margin-bottom:5px">
                                <?= $relateditem['name'] ?>
                            </h5>
                            <!-- <a href="#" class="add-cart">+ Add To Cart</a> -->
                            <h5>₹
                                <?php $originalprice = $relateditem['price'];
                                $discountrate = $relateditem['discount'];
                                $discountprice = $originalprice * ($discountrate / 100);
                                $price = $originalprice - $discountprice;
                                echo (int) $price;
                                ?><span>₹
                                    <?= (int) $relateditem['price'] ?>
                                </span>
                            </h5>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter=".new-arrivals">New Arrivals</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <?php
            $relateditemsql = 'SELECT * FROM product ORDER BY id DESC LIMIT 4';
            $result = mysqli_query($conn, $relateditemsql);
            while ($relateditem = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="product__item">
                        <a href="shop-details?product_id=<?= $relateditem['id']; ?>">
                            <div class="product__item__pic set-bg" data-setbg="global/assets/images/<?php
                            $sql = 'SELECT image FROM product_images WHERE product_id = "' . $relateditem['id'] . '" LIMIT 1';
                            $image = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                            echo $image['image'];
                            // $checksql = 'SELECT * FROM wishlist WHERE user_id=' . $_SESSION['user'] . ' AND product_id=' . $relateditem['id'] . '';
                            // $check = mysqli_query($conn, $checksql);
                            // $num = mysqli_num_rows($check);
                            // if ($num > 0) {
                            //     $wishlist = '<i style="color:red;" class="fa-solid fa-heart"></i>';
                            //     $class = "";
                            //     $wishlisttext = "WISHLISTED";
                            // } else {
                            //     $class = "wishlist";
                            //     $wishlist = '<i style=" text-shadow: -1px 0 #000, 0 1px #000, 1px 0 #000, 0 -1px #000;" class="fa-solid fa-heart"></i>';
                            //     $wishlisttext = "ADD TO WISHLIST";
                            // }
                            ?>">
                                <!-- <span class="label">New</span> -->
                                <ul class="product__hover">
                                    <li class="<?php // echo $class ?>" id="<?= $relateditem['id'] ?>"><?php //echo $wishlist ?></li>
                                </ul>
                            </div>
                        </a>
                        <div class="product__item__text">
                            <h5 style=" color: #36454F;
                                font-weight:620;
                                font-size: medium;
                                margin-bottom:5px">
                                <?= $relateditem['name'] ?>
                            </h5>
                            <!-- <a href="#" class="add-cart">+ Add To Cart</a> -->
                            <h5>₹
                                <?php $originalprice = $relateditem['price'];
                                $discountrate = $relateditem['discount'];
                                $discountprice = $originalprice * ($discountrate / 100);
                                $price = $originalprice - $discountprice;
                                echo (int) $price;
                                ?><span>₹
                                    <?= (int) $relateditem['price'] ?>
                                </span>
                            </h5>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter=".hot-sales">Hot Sales</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <?php
            $relateditemsql = 'SELECT * FROM product LIMIT 4';
            $result = mysqli_query($conn, $relateditemsql);
            while ($relateditem = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="product__item">
                        <a href="shop-details?product_id=<?= $relateditem['id']; ?>">
                            <div class="product__item__pic set-bg" data-setbg="global/assets/images/<?php
                            $sql = 'SELECT image FROM product_images WHERE product_id = "' . $relateditem['id'] . '" LIMIT 1';
                            $image = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                            echo $image['image'];
                            // $checksql = 'SELECT * FROM wishlist WHERE user_id=' . $_SESSION['user'] . ' AND product_id=' . $relateditem['id'] . '';
                            // $check = mysqli_query($conn, $checksql);
                            // $num = mysqli_num_rows($check);
                            // if ($num > 0) {
                            //     $wishlist = '<i style="color:red;" class="fa-solid fa-heart"></i>';
                            //     $class = "";
                            //     $wishlisttext = "WISHLISTED";
                            // } else {
                            //     $class = "wishlist";
                            //     $wishlist = '<i style=" text-shadow: -1px 0 #000, 0 1px #000, 1px 0 #000, 0 -1px #000;" class="fa-solid fa-heart"></i>';
                            //     $wishlisttext = "ADD TO WISHLIST";
                            // }
                            ?>">
                                <!-- <span class="label">New</span> -->
                                <ul class="product__hover">
                                    <li class="<?php // echo $class ?>" id="<?= $relateditem['id'] ?>"><?php //echo $wishlist ?></li>
                                </ul>
                            </div>
                        </a>
                        <div class="product__item__text">
                            <h5 style=" color: #36454F;
                                font-weight:620;
                                font-size: medium;
                                margin-bottom:5px">
                                <?= $relateditem['name'] ?>
                            </h5>
                            <!-- <a href="#" class="add-cart">+ Add To Cart</a> -->
                            <h5>₹
                                <?php $originalprice = $relateditem['price'];
                                $discountrate = $relateditem['discount'];
                                $discountprice = $originalprice * ($discountrate / 100);
                                $price = $originalprice - $discountprice;
                                echo (int) $price;
                                ?><span>₹
                                    <?= (int) $relateditem['price'] ?>
                                </span>
                            </h5>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>


    </div>
</section>

<!-- Instagram Section Begin -->
<section class="instagram spad" style="padding-bottom: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="instagram__pic">
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-1.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-2.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-3.jpg"></div>
                    <!-- <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-4.jpg"></div> -->
                    <!-- <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-5.jpg"></div> -->
                    <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-6.jpg"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="instagram__text">
                    <a href="https://www.instagram.com/memento.couture/" target="_blank">
                        <h2>Instagram<i style="font-size: 22px; margin-left: 6px;" class="fa-solid fa-link"></i></h2>
                    </a>
                    <p>||स्‍मृति-चिह्न||<br>
                        Merch aimed to amalgamate the zest of belongingness and dash of contemporary style
                        Own your identity with our affordable apparels.</p>
                    <h3>#memento</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Instagram Section End -->

<!-- Latest Blog Section Begin -->
<!-- <section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Latest News</span>
                    <h2>Fashion New Trends</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-1.jpg"></div>
                    <div class="blog__item__text">
                        <span><img src="img/icon/calendar.png" alt=""> 16 February 2020</span>
                        <h5>What Curling Irons Are The Best Ones</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-2.jpg"></div>
                    <div class="blog__item__text">
                        <span><img src="img/icon/calendar.png" alt=""> 21 February 2020</span>
                        <h5>Eternity Bands Do Last Forever</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-3.jpg"></div>
                    <div class="blog__item__text">
                        <span><img src="img/icon/calendar.png" alt=""> 28 February 2020</span>
                        <h5>The Health Benefits Of Sunglasses</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- Latest Blog Section End -->
<?php include("components/footer.php"); ?>