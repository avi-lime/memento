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
                                $prototal = 0;
                                $alltotal = 0;
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
                                            <div class="product__cart__item__text">
                                                <div class="sort">
                                                    <select class="nice-select" name="size" id="size">
                                                        <option value="s" <?php if ($details['size'] == 's') echo ' selected="selected"'; ?>>S</option>
                                                        <option value="m" <?php if ($details['size'] == 'm') echo ' selected="selected"'; ?>>M</option>
                                                        <option value="l" <?php if ($details['size'] == 'l') echo ' selected="selected"'; ?>>L</option>
                                                    </select>
                                                </div><?php // echo strtoupper($details['size']); 
                                                        ?>
                                            </div>
                                        </td>
                                        <td class="quantity__item">
                                            <div class="quantity">
                                                <div class="pro-qty-2">
                                                    <input type="text" id="quantity" name="quantity" value="<?php echo $details['quantity'] ?>">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart__price">₹<?php $quantity = $details['quantity'];
                                                                    $total = $price * $quantity;
                                                                    $prototal += $total;
                                                                    echo $total; ?></td>
                                        <td class="cart__close" id="<?php echo $details['id'] ?>"><i class="fa fa-close"></i></td>
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
                                <a href="shop.php">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="" class="update_Cart"><i class="fa fa-spinner"></i> Update cart</a>
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
                            <li>Subtotal <span>₹<?php echo $prototal;
                                                $charges = 0 ?></span></li>
                            <?php if ($prototal < 749) { ?>
                                <li>Delivery Charges <span>₹<?php $charges = 50;
                                                            echo $charges ?></span></li>
                            <?php }else{ ?>
                                <li>Delivery Charges <span>Free Free Free</span></li>
                            <?php
                            } ?><li>Total <span>₹ <?php $alltotal = $prototal + $charges;
                                                        echo $alltotal ?></span></li>
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
<script>
    $(".cart__close").click(function(e) {
        let id = $(this).attr("id");
        console.log(id);
        $.ajax({
            url: "api/addtocart.php",
            method: "post",
            data: {
                cartid: id
            },
            success: function(data) {
                document.location.reload();
            }
        })
    })
    $(".update_Cart").click(function() {
        let id = $(this).attr("id");
        let quantity = $("#quantity").val();
        console.log(id, quantity);
        if ($("input[name='size']").is(":checked")) {} else {
            alert("select size");
            return false;
        }
        let size = $("input[name='size']:checked").val();
        console.log(size);
        $.ajax({
            url: "api/addtocart.php", // saale addtocart.php kidhr h
            method: "post",
            data: {
                id: id,
                quantity: quantity,
                size: size
            },
            success: function(data) {
                console.log("added to cart") //idher bhi  // thik
                const toastLiveExample = document.getElementById('liveToast')

                $(".toast-body").text(data)

                const toast = new bootstrap.Toast($("#liveToast"))
                toast.show()
            }

        })
    })
</script>
<!-- Shopping Cart Section End -->
<?php include("components/footer.php"); ?>