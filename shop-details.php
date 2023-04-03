<?php include("components/header.php");
if ((isset($_REQUEST['product_id']) && ($id = $_REQUEST['product_id']))) {
    $sql = 'SELECT * FROM product WHERE id=' . $id . '';
    $result = mysqli_query($conn, $sql);
    $detail = mysqli_fetch_assoc($result);
    $wishlisttext = "ADD TO WISHLIST";
    if (isset($_SESSION['user'])) {
        $checksql = 'SELECT * FROM wishlist WHERE user_id=' . $_SESSION['user'] . ' AND product_id=' . $detail['id'];
        $check = mysqli_query($conn, $checksql);
        $num = mysqli_num_rows($check);
        if ($num > 0) {
            $wishlist = '<i class="fa-solid fa-heart red-heart"></i>';
            $class = "delete";
            $wishlisttext = "ADDED TO WISHLIST";

        } else {
            $class = "wishlist";
            $wishlist = '<i class="fa-solid fa-heart white-heart"></i>';
        }
    } else {
        $class = "login";
        $wishlist = '<i class="fa-solid fa-heart white-heart"></i>';
    }

    ?>

    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="./index">Home</a>
                            <a href="./shop">Shop</a>
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
                                    if ($count == 1)
                                        $active = "active";
                                    else
                                        $active = "";
                                    ?>
                                    <a class="nav-link <?= $active ?>" data-bs-toggle="tab" href="#tabs-<?= $count; ?>"
                                        data-bs-target="#tabs-<?= $count; ?>" role="tab">
                                        <div class="product__thumb__pic set-bg img-cover"
                                            data-setbg="global/assets/images/<?= $image['image'] ?>">
                                        </div>
                                    </a>
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
                                if ($count == 1)
                                    $active = "active";
                                else
                                    $active = "";
                                ?>
                                <div class="tab-pane  <?= $active ?>" href="" id="tabs-<?= $count; ?>" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img src="global/assets/images/<?= $image['image'] ?>"
                                            style="width: 450px; height: 600px;object-fit: cover" alt="">
                                    </div>
                                </div>
                                <?php
                            } ?>
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
                            <h4>
                                <?= $detail['name']; ?>
                            </h4>
                            <h3><span>(-
                                    <?php $discountrate = $detail['discount'];
                                    echo $discountrate
                                        ?>% OFF)
                                </span>₹
                                <?php $originalprice = $detail['price'];
                                $discountprice = $originalprice * ($discountrate / 100);
                                $price = $originalprice - $discountprice;
                                echo (int) $price;
                                ?><span>₹
                                    <?= $detail['price']; ?>
                                </span>
                            </h3>
                            <h5 style="font-weight: lighter; padding-bottom:10px">Please Select a Size</h5>
                            <div class="product__details__option">
                                <div class="product__details__option__size">
                                    <span>Size:</span>
                                    <label for="s">s
                                        <input type="radio" name="size" id="s" value="s">
                                    </label>
                                    <label for="m">m
                                        <input type="radio" name="size" id="m" value="m">
                                    </label>
                                    <label for="l">l
                                        <input type="radio" name="size" id="l" value="l">
                                    </label>
                                    <label for="xl">xl
                                        <input type="radio" name="size" id="xl" value="xl" required>
                                    </label>
                                </div>
                            </div>
                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" name="quantity" id="quantity" value="1">
                                    </div>
                                </div>
                                <input type="button" class="primary-btn" id="<?= $detail['id'] ?>" value="add to cart">
                                <input type="button" class="primary-btn" id="<?= $detail['id'] ?>" name="buynow"
                                    value="Buy Now">
                            </div>
                            <div class="product__details__btns__option">
                                <a href="#" class="<?= $class ?>" id="wish-<?= $detail['id'] ?>"><?= $wishlist ?>

                                    <p>
                                        <?= $wishlisttext ?>
                                    </p>
                                </a>
                                <div class="product__details__last__option">
                                    <ul>
                                        <li><span>Categories:</span>
                                            <?php
                                            $categoryid = $detail['cat_id'];
                                            $catnamesql = 'SELECT name FROM category WHERE id=' . $categoryid . '';
                                            $result = mysqli_query($conn, $catnamesql);
                                            $catname = mysqli_fetch_assoc($result);
                                            echo $catname['name'];
                                            ?>
                                        </li>
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
                                    <a class="nav-link active" data-bs-toggle="tab" role="tab" href="#tabs-5"
                                        data-bs-target="#tabs-5">Description</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabs-5" data-bs-target="#tabs-6" role="tab">Customer
                                        Reviews(5)</a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabs-5" data-bs-target="#tabs-7"
                                        role="tab">Additional
                                        information</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">

                                        <div class="product__details__tab__content__item">
                                            <h5>Products Description:</h5>
                                            <p>
                                                <?= nl2br($detail['description']); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="tab-pane" id="tabs-6" role="tabpanel">
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
                                             Review area 
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                                worn all year round.</p>
                                        </div>
                                    </div> 
                                </div>  -->
                                <div class="tab-pane" id="tabs-7" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <h5>Product Details:</h5>
                                            <h5 style="font-size: medium;">Material used:</h5>
                                            <p>100% Cotton</br>
                                                Machine Wash</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>Country of Origin: India (and proud)</br>
                                                Manufactured & Sold By:</br>
                                                Memento Couture</br>
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
                    <h3 class="related-title" style="text-align: left">Related Products</h3>
                </div>
            </div>
            <div class="row">
                <?php
                $relateditemsql = 'SELECT * FROM product WHERE cat_id=' . $detail['cat_id'] . ' AND NOT id=' . $id . ' ORDER BY id DESC LIMIT 4';
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

                                if (isset($_SESSION['user'])) {
                                    $checksql = 'SELECT * FROM wishlist WHERE user_id=' . $_SESSION['user'] . ' AND product_id=' . $relateditem['id'] . '';
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
                                    <!-- <span class="label">New</span> -->
                                    <ul class="product__hover">
                                        <li class="<?= $class ?>" id="wish-<?= $relateditem['id'] ?>"><?= $wishlist ?></li>
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
                                <!-- <a href="" class="add-cart" data-bs-toggle="modal" data-bs-target="#modal">+ Add To Cart</a> -->

                                <h5>₹
                                    <?php $originalprice = $relateditem['price'];
                                    $discountrate = $relateditem['discount'];
                                    $discountprice = $originalprice * ($discountrate / 100);
                                    $price = $originalprice - $discountprice;
                                    echo (int) $price;
                                    ?><span>₹
                                        <?= $relateditem['price'] ?>
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

        <!-- <div class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>  -->
        <!--modal part commant for now-->
    </section>
    <?php
} else {
    ?>
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="./index">Home</a>
                            <a href="./shop">Shop</a>
                            <span>Where the heck am I</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
} ?>
<!-- script -->
<script>
    $(document).ready(function () {

        $(".login").click(function (e) {
            e.preventDefault();
            document.location.href = "login";
        })
        $(".primary-btn").click(function () {
            let id = $(this).attr("id");
            let quantity = $("#quantity").val();
            if ($("input[name='size']").is(":checked")) { } else {
                alert("select size");
                return false;
            }
            let size = $("input[name='size']:checked").val();
            $.ajax({
                url: "api/addtocart.php",
                method: "post",
                data: {
                    id: id,
                    quantity: quantity,
                    size: size
                },
                success: function (data) {
                    const toastLiveExample = document.getElementById('liveToast')
                    $(".toast-body").html(data)
                    const toast = new bootstrap.Toast($("#liveToast"))
                    toast.show()
                }

            })
        })
        $('[name="buynow"]').click(function (e) {
            e.preventDefault();
            location.href = "shopping-cart";
        })
    })
</script>
<!-- Related Section End -->
<?php include("components/footer.php"); ?>