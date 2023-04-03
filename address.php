<?php
include("components/header.php");

if (!isset($_SESSION["user"])) {
    redirect("login");
} else
    $userid = $_SESSION["user"];

?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Account</h4>
                    <div class="breadcrumb__links">
                        <a href="./index">Home</a>
                        <a href="account">Account</a>
                        <span>Addresses</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->


<?php include("components/footer.php"); ?>