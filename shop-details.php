<?php include("components/header.php");
if (($id = $_REQUEST['product_id']) && (isset($_REQUEST['product_id']))) {
    $sql = 'SELECT * FROM product WHERE id=' . $id . '';
    $result = mysqli_query($conn, $sql);
    $detail = mysqli_fetch_assoc($result);
} else {
}
?>

<!-- Shop Details Section Begin -->
<section class="shop-details">
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <a href="./index.php">Home</a>
                        <a href="./shop.php">Shop</a>
                        <span>Product Details</span>
                    </div>
                </div>
            </div>
            <!-- Image Start -->
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <ul class="nav nav-tabs" role="tablist">
                        <?php
                        $sqlimage = 'SELECT * FROM product_images WHERE product_id=' . $id . '';
                        $imageresult = mysqli_query($conn, $sqlimage);
                        $count = 0;
                        while ($image = mysqli_fetch_assoc($imageresult)) {
                        ?>
                            <li class="nav-item">
                                <?php
                                $count++;
                                if ($count == 1) {
                                ?>
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-<?php echo $count; ?>" role="tab">
                                        <div class="product__thumb__pic set-bg" data-setbg="global/assets/images/<?php echo $image['image'] ?>">
                                        </div>
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <a class="nav-link" data-toggle="tab" href="#tabs-<?php echo $count; ?>" role="tab">
                                        <div class="product__thumb__pic set-bg" data-setbg="global/assets/images/<?php echo $image['image'] ?>">
                                        </div>
                                    </a>
                                <?php
                                }
                                ?>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-9">
                    <div class="tab-content">
                        <?php
                        $sqlimage = 'SELECT * FROM product_images WHERE product_id=' . $id . '';
                        $imageresult = mysqli_query($conn, $sqlimage);
                        $count = 0;
                        while (($image = mysqli_fetch_assoc($imageresult))) {
                            $count++;
                            if ($count == 1) {
                        ?>
                                <div class="tab-pane active" id="tabs-<?php echo $count; ?>" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img src="global/assets/images/<?php echo $image['image'] ?>" style="width: 450px; height: 600px;" alt="">
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="tab-pane" id="tabs-<?php echo $count; ?>" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img src="global/assets/images/<?php echo $image['image'] ?>" style="width: 450px; height: 600px;" alt="">
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- Image End -->
        </div>
    </div>
    <div class="product__details__content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="product__details__text">
                        <h4><?php echo $detail['name']; ?></h4>
                        <!-- rating -->
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-full"></i>
                            <span> - 10 Reviews</span>
                        </div>
                        <!-- rating -->
                        <h3>-<?php $discountrate = $detail['discount'];
                                echo $discountrate
                                ?>% &nbsp &nbsp &nbsp ₹<?php $originalprice = $detail['price'];
                                                        $discountprice = $originalprice * ($discountrate / 100);
                                                        $price = $originalprice - $discountprice;
                                                        echo $price;
                                                        ?><span>₹<?php echo $detail['price']; ?></span></h3>
                        <h5 style="font-weight: lighter; padding-bottom:10px">Please Select a Size</h5>
                        <div class="product__details__option">
                            <div class="product__details__option__size">
                                <span>Size:</span>
                                <label class="active" for="xl">xl
                                    <input type="radio" id="xl">
                                </label>
                                <label for="l">l
                                    <input type="radio" id="l">
                                </label>
                                <label for="m">m
                                    <input type="radio" id="m">
                                </label>
                                <label for="sm">s
                                    <input type="radio" id="sm">
                                </label>
                            </div>
                        </div>
                        <div class="product__details__cart__option">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                </div>
                            </div>
                            <a href="#" class="primary-btn">add to cart</a>
                        </div>
                        <div class="product__details__btns__option">
                            <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                            <div class="product__details__last__option">
                                <ul>
                                    <li><span>Categories:</span> <?php
                                                                    $categoryid = $detail['cat_id'];
                                                                    $catnamesql = 'SELECT name FROM category WHERE id=' . $categoryid . '';
                                                                    $result = mysqli_query($conn, $catnamesql);
                                                                    $catname = mysqli_fetch_assoc($result);
                                                                    echo $catname['name'];
                                                                    ?></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                    Reviews(5)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                    information</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <div class="product__details__tab__content__item">
                                        <h5>Product Details:</h5>
                                        <h5 style="font-size: medium;">Material used:</h5>
                                        <p>100% Cotton</br>
                                            Machine Wash</p>
                                    </div>
                                    <div class="product__details__tab__content__item">
                                        <h5>Products Description:</h5>
                                        <p><?php echo $detail['description']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-6" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <div class="product__details__tab__content__item">
                                        <h5>Products Infomation</h5>
                                        <p>Country of Origin: India (and proud)</br>
                                            Manufactured & Sold By:</br>
                                            The Souled Store Pvt. Ltd.</br>
                                            224, Tantia Jogani Industrial Premises</br>
                                            J.R. Boricha Marg</br>
                                            Lower Parel (E)</br>
                                            Mumbai - 11</p>
                                    </div>
                                    <div class="product__details__tab__content__item">
                                        <h5>Material used</h5>
                                        <!-- Review area -->
                                        <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                            from synthetic materials, not natural like wool. Polyester suits become
                                            creased easily and are known for not being breathable. Polyester suits
                                            tend to have a shine to them compared to wool and cotton suits, this can
                                            make the suit look cheap. The texture of velvet is luxurious and
                                            breathable. Velvet is a great choice for dinner party jacket and can be
                                            worn all year round.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-7" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <div class="product__details__tab__content__item">
                                        <h5>Products Infomation</h5>
                                        <p>Country of Origin: India (and proud)</br>
                                            Manufactured & Sold By:</br>
                                            The Souled Store Pvt. Ltd.</br>
                                            224, Tantia Jogani Industrial Premises</br>
                                            J.R. Boricha Marg</br>
                                            Lower Parel (E)</br>
                                            Mumbai - 11</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Details Section End -->

<!-- Related Section Begin -->
<section class="related spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title">Related Product</h3>
            </div>
        </div>
        <div class="row">
            <?php 
            
            ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-1.jpg">
                        <span class="label">New</span>
                        <ul class="product__hover">
                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>Piqué Biker Jacket</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>$67.24</h5>
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
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-2.jpg">
                        <ul class="product__hover">
                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>Piqué Biker Jacket</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>$67.24</h5>
                        <div class="product__color__select">
                            <label for="pc-4">
                                <input type="radio" id="pc-4">
                            </label>
                            <label class="active black" for="pc-5">
                                <input type="radio" id="pc-5">
                            </label>
                            <label class="grey" for="pc-6">
                                <input type="radio" id="pc-6">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item sale">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-3.jpg">
                        <span class="label">Sale</span>
                        <ul class="product__hover">
                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
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
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-4.jpg">
                        <ul class="product__hover">
                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
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
        </div>
    </div>
</section>
<!-- Related Section End -->
<?php include("components/footer.php"); ?>