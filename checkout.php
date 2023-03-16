<?php include("components/header.php");
if (!isset($_SESSION['user'])) {
    redirect("login");
}
$userid = $_SESSION['user'];
?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Check Out</h4>
                    <div class="breadcrumb__links">
                        <a href="./index">Home</a>
                        <a href="./shop">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="" method="Post">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="checkout__title">Billing Details</h6>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Fist Name<span>*</span></p>
                                    <input type="text" id="firstname" name="firstname" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Last Name<span>*</span></p>
                                    <input type="text" id="lastname" name="lastname" required>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Country<span>*</span></p>
                            <input type="text" id="country" name="country" required>
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" placeholder="Street Address" required id="address" name="address"
                                class="checkout__input__add">
                        </div>
                        <div class="checkout__input">
                            <p>Town/City<span>*</span></p>
                            <input type="text" id="city" name="city" required>
                        </div>
                        <div class="checkout__input">
                            <p>State<span>*</span></p>
                            <input type="text" id="state" name="state" required>
                        </div>
                        <div class="checkout__input">
                            <p>Postcode / ZIP<span>*</span></p>
                            <input type="text" id="pincode" name="pincode" required>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4 class="order__title">Your order</h4>
                            <div class="checkout__order__products">Product <span>Total</span></div>
                            <ul class="checkout__total__products">
                                <?php
                                $sql = "SELECT * FROM cart WHERE user_id=$userid";
                                $result = mysqli_query($conn, $sql);
                                $totalprice = 0;
                                $charges = 0;
                                $proprice = 0;
                                $count = 1;
                                while ($details = mysqli_fetch_assoc($result)) {
                                    $productsql = 'SELECT * FROM product WHERE id=' . $details['product_id'] . '';
                                    $productrun = mysqli_query($conn, $productsql);
                                    $product = mysqli_fetch_assoc($productrun);
                                    $Originalprice = $product['price'];
                                    $discount = $product['discount'];
                                    $discountamount = $Originalprice * ($discount / 100);
                                    $quantity = $details['quantity'];
                                    $saleprice = ($Originalprice - $discountamount) * $quantity;
                                    $proprice += $saleprice;
                                    ?>
                                    <li>
                                        <?= $count . ".  " . $product['name'] . "(" . strtoupper($details['size']) . ")x" . $quantity; ?>
                                        <span>₹
                                            <?= $saleprice ?>
                                        </span>
                                    </li>
                                    <?php
                                    $count++;
                                } ?>
                            </ul>
                            <ul class="checkout__total__all">
                                <li>Subtotal <span>₹
                                        <?= $proprice; ?>
                                    </span></li>
                                <?php if ($proprice < 749) { ?>
                                    <li>Delivery Charges <span>₹
                                            <?php $charges = 50;
                                            echo $charges ?>
                                        </span></li>
                                <?php } else { ?>
                                    <li>Delivery Charges <span>Free Free Free</span></li>
                                <?php } ?>
                                <li>Total <span>₹
                                        <?php $totalprice = $proprice + $charges;
                                        $_SESSION['price'] = $totalprice;
                                        echo $totalprice ?>
                                    </span></li>
                            </ul>
                            <button type="button" name="btnnet" id="rzp-button1" class="primary-btn mb-2 w-100">pay
                                online</button></br>
                            <button type="button" name="btncod" id="site-btn" class="primary-btn mb-2 w-100">pay on
                                delivery *</button>
                            <p>* (+50₹) when using pay on delivery</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
<script>
    $("#site-btn").click(function () {
        let firstname = $("#firstname").val();
        let lastName = $("#lastname").val();
        let addressname = firstname.concat(" ", lastName);
        let country = $("#country").val();
        let address = $("#address").val();
        let city = $("#city").val();
        let state = $("#state").val();
        let pincode = $("#pincode").val();
        $.ajax({
            url: "api/order.php",
            method: "post",
            data: {
                addressname: addressname,
                country: country,
                address: address,
                city: city,
                state: state,
                pincode: pincode
            },
            success: function (data) {

            }
        })
    })

    $("#rzp-button1").click(function () {
        location.href = "payment";
    })
</script>
<?php include("components/footer.php"); ?>