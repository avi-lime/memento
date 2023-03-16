<?php include("components/header.php"); ?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Account</h4>
                    <div class="breadcrumb__links">
                        <a href="./index">Home</a>
                        <span>Account</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Account Section Begin -->
<section class="account spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2>Account Details</h2>
                <hr>
                <div class="checkout__form">
                    <form action="" method="Post">
                        <div class="">
                            <div class="">
                                <div class="checkout__input">
                                    <p>E-Mail</p>
                                    <input type="email" id="email" name="email" required disabled>
                                </div>
                                <div class="checkout__input">
                                    <p>Phone Number:</p>
                                    <input type="tel" required id="phno" name="phno" disabled>
                                </div>
                            </div>
                        </div>
                    </form>
                    <button class="primary-btn" id="btnEdit" onclick="edit();">EDIT</button>
                    <button class="primary-btn" id="btnEdit" onclick="edit();">change password</button>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-3" role="button">
                    <div class="card-body">
                        <div class="card-title h4">
                            MY ORDERS
                        </div>
                        <p>View, Track or Manage Orders</p>
                    </div>
                </div>
                <div class="card" role="button">
                    <div class="card-body">
                        <div class="card-title h4">
                            MANAGE ADDRESSES

                        </div>
                        <p>Edit, Add or Remove your delivery addresses</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function edit() {
        $("input").attr("disabled", false);
        $("input")[0].focus();
        $("#btnEdit").text("SAVE")
    }
    $(".card").hover(function () {
        $(this).toggleClass("border-dark")
    })
</script>


<?php include("components/footer.php"); ?>