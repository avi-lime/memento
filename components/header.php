<!DOCTYPE html>
<html lang="en">
<?php
include "global/api/conn.php";
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Memento Couture">
    <meta name="keywords" content="memento, fashion, designs, couture">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Memento | Apparels, Cool Designs & Everything In Between.</title>
    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="img/mxm-white.png" sizes="any">
    <link rel="shortcut icon" href="img/mxm-white.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="img/mxm-white.png">


    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/memento.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <?php
                if (!isset($_SESSION['user'])) {
                ?>
                    <a href="login.php">Sign in</a>
                <?php
                }
                ?>
                <a href="#">FAQs</a>
                <a href="#">Blog</a>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><i class="fa-solid fa-magnifying-glass"></i></a>
            <a href="./wishlist.php"><i class="fa-regular fa-heart"></i></a>
            <a href="./cart.php"><i class="fa-solid fa-bag-shopping"></i><span>0</span></a>
            <div class="price">₹0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                <?php
                                if (!isset($_SESSION['user'])) {
                                ?>
                                    <a href="login.php">Sign in</a>
                                <?php
                                }
                                ?>
                                <a href="#">FAQs</a>
                                <a href="./blog.php">Blog</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 col-lg-5">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="./index.php">Home</a></li>
                            <li><a href="./shop.php?sub_id=&cat_id=">Category</a>
                                <ul class="dropdown">
                                    <?php
                                    $query = "SELECT * FROM category";
                                    if ($result = mysqli_query($conn, $query)) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <div class="list">
                                                <li class="dropdown-item-m"><a href="shop.php?sub_id=&cat_id=<?php echo $row["id"] ?>">
                                                        <?php echo $row['name'] ?>
                                                    </a></li>
                                                <ul class="sub-dropdown">
                                                    <?php
                                                    $subquery = 'SELECT * FROM subcat WHERE cat_id=' . $row['id'] . ' ';
                                                    if ($subresult = mysqli_query($conn, $subquery)) {
                                                        while ($subrow = mysqli_fetch_assoc($subresult)) {
                                                    ?>
                                                            <li class="sub-dropdown-item"><a href="shop.php?cat_id=<?php echo $subrow["cat_id"] ?>&sub_id=<?php echo $subrow["id"] ?>">
                                                                    <?php echo $subrow['name'] ?>
                                                                </a></li>
                                            <?php
                                                        }
                                                    }
                                                    echo "</ul></div>";
                                                }
                                            }
                                            ?>
                                                </ul>
                            </li>
                            <li><a href="./contact.php">Contact Us</a></li>
                            <li><a href="./about.php">About Us</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-xl-4 col-lg-2 text-center">
                    <div class="header__logo">
                        <a href="./index.php"><img height="84px" src="img/mxm-white.png" alt=""></a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><i class="fa-solid fa-magnifying-glass"></i></a>
                        <?php
                        if (isset($_SESSION['user'])) {
                        ?>
                          <a href="#"><?php echo $_SESSION['username'] ?></a>
                        <?php
                        } ?>
                        <a href="wishlist.php?userid=<?php if(isset($_SESSION['user'])){echo $_SESSION["user"];} ?>"><i class="fa-regular fa-heart"></i></a>
                        <a href="./shopping-cart.php?userid=<?php if(isset($_SESSION['user'])){echo $_SESSION["user"];} ?>"><i class="fa-solid fa-bag-shopping"></i><span>0</span></a>
                        <div class="price">₹0.00</div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa-solid fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->