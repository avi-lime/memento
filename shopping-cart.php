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
                            <a href="./index">Home</a>
                            <a href="./shop">Shop</a>
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
            <input type="hidden" id="user-id">
            <div class="row">
                <?php if (mysqli_num_rows($result) > 0) { ?>

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
                                                    <img src="global/assets/images/<?= $image['image'] ?>"
                                                        style="width: 90px;height: 160px; object-fit: cover" alt="">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h6>
                                                        <?= $product['name'] ?>
                                                    </h6>
                                                    <h5 id="price-<?= $details["id"] ?>">₹
                                                        <?php $originalprice = $product['price'];
                                                        $discountrate = $product['discount'];
                                                        $discountprice = $originalprice * ($discountrate / 100);
                                                        $price = $originalprice - $discountprice;
                                                        echo (int) $price; ?><span> ₹
                                                            <?= $product['price']; ?>
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="product__cart__item__text">
                                                    <div class="size">
                                                        <select class="nice-select" name="size" id="size-<?= $details["id"] ?>"
                                                            data-id="<?= $details["id"] ?>">
                                                            <option value="s" <?php if ($details['size'] == 's')
                                                                echo ' selected="selected"'; ?>>S</option>
                                                            <option value="m" <?php if ($details['size'] == 'm')
                                                                echo ' selected="selected"'; ?>>M</option>
                                                            <option value="l" <?php if ($details['size'] == 'l')
                                                                echo ' selected="selected"'; ?>>L</option>
                                                            <option value="xl" <?php if ($details['size'] == 'xl')
                                                                echo ' selected="selected"'; ?>>XL</option>
                                                        </select>
                                                    </div>
                                                    <?php // echo strtoupper($details['size']); 
                                                                ?>
                                                </div>
                                            </td>
                                            <td class="quantity__item">
                                                <div class="quantity">
                                                    <div class="pro-qty-2">
                                                        <input disabled type="text" class="product-quantity" name="quantity"
                                                            id="qty-<?= $details["id"] ?>" data-id="<?= $details['id'] ?>"
                                                            value="<?= $details['quantity'] ?>">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price" id="total-<?= $details["id"] ?>">₹
                                                <?php $quantity = $details['quantity'];
                                                $total = $price * $quantity;
                                                $prototal += $total;
                                                echo (int) $total; ?>
                                            </td>
                                            <td role="button" class="cart__close" id="<?= $details['id'] ?>"><i
                                                    class="fa fa-close"></i>
                                            </td>
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
                                    <a href="shop">Continue Shopping</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn update__btn">
                                    <a href="" id="empty_cart"><i class="fa fa-trash"></i> Empty cart</a>
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
                                <li>Subtotal <span>₹
                                        <?= (int) $prototal;
                                        $charges = 0 ?>
                                    </span></li>
                                <?php if ($prototal > 0) {
                                    if ($prototal < 749) { ?>
                                        <li>Delivery Charges <span>₹
                                                <?php $charges = 50;
                                                echo $charges ?>
                                            </span></li>
                                    <?php } else { ?>
                                        <li>Delivery Charges <span>Free</span></li>
                                        <?php
                                    }
                                } ?>
                                <li>Total <span>₹
                                        <?php $alltotal = $prototal + $charges;
                                        echo (int) $alltotal ?>
                                    </span></li>
                            </ul>
                            <a href="./checkout" class="primary-btn">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            <?php } else
                    echo "<h1 class='display-2 text-center'>CART EMPTY</h1>";
                ?>
        </div>
    </section>
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
                            <a href="./index">Home</a>
                            <a href="./shop">Shop</a>
                            <span>Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="shopping-cart spad">
        <div class="container text-center m-4">
            <h1 class="display-1">Login Please</h1>
            <p>Click <a href="login">here</a> to login</p>
        </div>
    </section>
    <?php
}
?>
<script>
    $(document).ready(function () {

        // Delete from cart
        $(".cart__close, #empty_cart").click(function (e) {
            let id = $(this).attr("id");
            $.ajax({
                url: "api/addtocart.php",
                method: "post",
                data: {
                    cartid: id
                },
                success: function (data) {
                    document.location.reload();
                }
            })
        })



        // Update on change of value
        $("input.product-quantity, .nice-select").change(function (e) {
            let id = $(this).data("id");
            let quantity = $(`#qty-${id}`).val();
            let size = $(`#size-${id}`).val();
            $.ajax({
                url: "api/addtocart.php",
                method: "post",
                data: {
                    update: true,
                    id: id,
                    quantity: quantity,
                    size: size
                },
                success: function (data) {
                    const toastLiveExample = document.getElementById('liveToast')

                    $(".toast-body").text(data)

                    const toast = new bootstrap.Toast($("#liveToast"))
                    toast.show()
                }
            })
        })
    })

    function fetch_filter_sort(table) {
        let params = "";
        let search = $("#search").val();
        let sort_by = $("#sort").val();
        if (search != "") params += ` WHERE name LIKE '%${search}%' OR id LIKE '${search}%'`;
        params += ` ${sort_by}`
        $.ajax({
            url: 'api/fetch.php',
            method: 'POST',
            data: {
                query: `SELECT id, name, image, (SELECT name FROM category WHERE category.id=subcat.cat_id) AS cat FROM subcat ` + params
            },
            dataType: "json",
            success: function (data) {
                let content = ""
                data.forEach(item => {
                    let parsedItem = $.parseJSON(item);
                    content += `
                        
                        `;
                })
                $("#list").html(content)
            }
        })
    }

</script>
<!-- Shopping Cart Section End -->
<?php include("components/footer.php"); ?>