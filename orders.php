<?php
include("components/header.php");
if (isset($_SESSION['user'])) {
    $sql = 'SELECT * FROM orders WHERE user_id=' . $_SESSION['user'] . '';
    $result = mysqli_query($conn, $sql);

    ?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Orders</h4>
                        <div class="breadcrumb__links">
                            <a href="./index">Home</a>
                            <a href="account">Account</a>
                            <span>Orders</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Orders Section Begin -->
    <section class="orders spad">
        <div class="container">
            <input type="hidden" id="user-id">
            <div class="row">
                <?php if (mysqli_num_rows($result) > 0) { ?>
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
                                            <a href="shop-details?product_id=<?= $product['id'] ?>">
                                                <div class="product__cart__item__pic">
                                                    <img src="global/assets/images/<?= $image['image'] ?>"
                                                        style="width: 90px;height: 160px; object-fit: cover" alt="">
                                                </div>
                                            </a>
                                            <div class="product__cart__item__text">
                                                <h6>
                                                    <?= $product['name'] ?>
                                                </h6>
                                                <h5 id="price-<?= $details["id"] ?>">₹

                                                    <?= $details["amount"] ?>
                                                </h5>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product__cart__item__text">
                                                <div class="size">
                                                    <b>
                                                        <?= strtoupper($details['size']) ?>
                                                    </b>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="quantity__item">
                                            <div class="quantity">
                                                <?= $details['quantity'] ?>
                                            </div>
                                        </td>
                                        <td class="cart__price" id="total-<?= $details["id"] ?>">₹
                                            <?php $quantity = $details['quantity'];
                                            $total = $details["amount"] * $quantity;
                                            $prototal += $total;
                                            echo (int) $total; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else
                    echo "<h1 class='display-2 text-center'>NO ORDERS</h1>";
                ?>
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
                        <h4>Orders</h4>
                        <div class="breadcrumb__links">
                            <a href="./index">Home</a>
                            <a href="./shop">Account</a>
                            <span>Orders</span>
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

<!-- Orders Section End -->

<?php include("components/footer.php"); ?>