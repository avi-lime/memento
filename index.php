<?php include("components/header.php"); ?>
<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="img/hero/hero-1.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Winter Collection</h6>
                            <h2>Fall - Winter Collections 2022</h2>
                            <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                commitment to exceptional quality.</p>
                            <a href="#" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <!--<a href=""><i class="fa-brands fa-facebook"></i></a>-->
                                <!--<a href="#"><i class="fa-brands fa-twitter"></i></a>-->
                                <!--<a href="#"><i class="fa-brands fa-pinterest"></i></a>-->
                                <a href="https://www.instagram.com/memento.couture/" target="_blank"><i
                                        class="fa-brands fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero__items set-bg" data-setbg="img/hero/hero-2.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Summer Collection</h6>
                            <h2>Fall - Winter Collections 2030</h2>
                            <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                commitment to exceptional quality.</p>
                            <a href="#" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <!--
                                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                    <a href="#"><i class="fa-brands fa-pinterest"></i></a>
                                -->
                                <a href="https://www.instagram.com/memento.couture/" target="_blank"><i
                                        class="fa-brands fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Clothing Collections 2030</h2>
                        <a href="#">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="banner__item banner__item--middle">
                    <div class="banner__item__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Accessories</h2>
                        <a href="#">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="banner__item banner__item--last">
                    <div class="banner__item__pic">
                        <img src="img/banner/banner-3.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Shoes Spring 2023</h2>
                        <a href="#">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->



<!-- Instagram Section Begin -->

<?php
$table = "product";
$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);
?>

<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">Best Sellers</li>
                    <li data-filter=".new-arrivals">New Arrivals</li>
                    <li data-filter=".hot-sales">Hot Sales</li>
                </ul>
            </div>
        </div>

        <div class="row">
            <?php
            $relateditemsql = 'SELECT * FROM product';
            $result = mysqli_query($conn, $relateditemsql);
            while ($relateditem = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="product__item">
                        <a href="shop-details.php?product_id=<?php echo $relateditem['id']; ?>">
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
                                    <li class="<?php // echo $class ?>" id="<?php echo $relateditem['id'] ?>"><?php //echo $wishlist ?></li>
                                </ul>
                            </div>
                        </a>
                        <div class="product__item__text">
                            <h6>
                                <?php echo $relateditem['name'] ?>
                            </h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>₹
                                <?php $originalprice = $relateditem['price'];
                                $discountrate = $relateditem['discount'];
                                $discountprice = $originalprice * ($discountrate / 100);
                                $price = $originalprice - $discountprice;
                                echo $price;
                                ?><span>₹
                                    <?php echo $relateditem['price'] ?>
                                </span>
                            </h5>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>

            <div class="row product__filter">
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                    <div class="product__item">
                        <div class="product__item__pic set-bg">
                            <img src="../global/assets/images/<?php echo $row["img"] ?>" alt="" class="card-img-top"
                                style="object-fit: cover" height="300px">
                            <span class="label">New</span>
                            <ul class="product__hover">
                                <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h5 class="card-title">
                                <?php echo $row["name"] ?>
                            </h5>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <b>Price:</b> ₹
                            <?php echo $row["price"] ?>
                            <div class="product__color__select">
                                <label for="pc-1">
                                    <input type="radio" id="pc-1">
                                </label>
                                <label class="active black" for="pc-2">
                                    <input type="radio" id="pc-2">
                                </label>
                                <label class="grey" for="pc-3">
                                    <input type="radio" id="pc-3">
                                </label>
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
<!-- Instagram Section End -->

<!-- Latest Blog Section Begin -->
<section class="latest spad">
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
</section>
<!-- Latest Blog Section End -->
<?php include("components/footer.php"); ?>