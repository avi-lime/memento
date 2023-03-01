<?php include("components/header.php");
if (isset($_SESSION['user'])) {
    $sql = 'SELECT * FROM cart WHERE user_id=' . $_SESSION['user'] . '';
    $result = mysqli_query($conn, $sql);
?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.php">Home</a>
                            <a href="./shop.php">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($details = mysqli_fetch_assoc($result)) {
                                    $productsql = 'SELECT * FROM product WHERE id=' . $details['product_id'] . '';
                                    $imagesql = 'SELECT * FROM product_images WHERE product_id=' . $details['product_id'] . ' LIMIT 1 ';
                                    $productresult = mysqli_query($conn, $productsql);
                                    $imageresult = mysqli_query($conn, $imagesql);
                                    $product = mysqli_fetch_assoc($productresult);
                                    $image = mysqli_fetch_assoc($imageresult);
                                ?>
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                <img src="global/assets/images/<?php echo $image['image']  ?>" style="width: 90px;height: 90px;" alt="">
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6><?php echo $product['name'] ?></h6>
                                                <h5>₹<?php $originalprice = $product['price'];
                                                        $discountrate = $product['discount'];
                                                        $discountprice = $originalprice * ($discountrate / 100);
                                                        $price = $originalprice - $discountprice;
                                                        echo $price; ?><span>₹<?php echo $product['price']; ?></span></h5>
                                            </div>
                                        </td>
                                        <td>
                                        <div class="product__cart__item__text"><?php echo strtoupper($details['size']); ?></div>
                                        </td>
                                        <td class="quantity__item">
                                            <div class="quantity">
                                                <div class="pro-qty-2">
                                                    <input type="text" value="<?php echo $details['quantity'] ?>">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart__price">₹<?php $quantity=$details['quantity'];$total=$price*$quantity;echo $total; ?></td>
                                        <td class="cart__close"><i class="fa fa-close"></i></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="#">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span>$ 169.50</span></li>
                            <li>Total <span>$ 169.50</span></li>
                        </ul>
                        <a href="./checkout.php" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
} else {
?>

    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.php">Home</a>
                            <a href="./shop.php">Shop</a>
                            <span>Where the heck am I</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    Login Please
                </div>
            </div>
        </div>
    </section>
<?php
}
?>

<!-- Shopping Cart Section End -->
<?php include("components/footer.php"); ?>