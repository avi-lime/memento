<?php
include("components/header.php");

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
            <?php
            if (isset($_SESSION["user"])) {
                $userid = $_SESSION["user"];
                ?>
                <div class="col-lg-6">
                    <h2>Personal Details</h2>
                    <hr>
                    <div class="checkout__form">
                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM user WHERE id=$userid");
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <form action="" method="Post">
                                <div class="">
                                    <div class="">
                                        <div class="checkout__input">
                                            <p>Name</p>
                                            <input type="text" id="name" name="name" value="<?= $row['name'] ?>" required
                                                disabled>
                                        </div>
                                        <div class="checkout__input">
                                            <p>E-Mail</p>
                                            <input type="email" id="email" name="email" value="<?= $row['email'] ?>" required
                                                disabled>
                                        </div>
                                        <div class="checkout__input">
                                            <p>Phone Number:</p>
                                            <input type="tel" required id="phno" name="phno" value="<?= $row['mobileno'] ?>"
                                                pattern="[0-9]{10}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php } ?>
                        <button class="primary-btn btnEdit" id="<?= $userid ?>" onclick="edit(this);">EDIT</button>
                        <button class="primary-btn" id="btnPass">change password</button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <a class="card mb-3 account__link" role="button" href="orders">
                        <div class="card-body">
                            <div class="card-title h4 d-flex">
                                MY ORDERS <i class="fa-solid fa-boxes-stacked ms-auto me-2"></i>
                            </div>
                            <p>View, Track or Manage Orders</p>
                        </div>
                    </a>
                    <a class="card account__link" role="button" href="address">
                        <div class="card-body">
                            <div class="card-title h4 d-flex">
                                MANAGE ADDRESSES <i class="fa-solid fa-address-book ms-auto me-2"></i>
                            </div>
                            <p>Edit, Add or Remove your delivery addresses</p>
                        </div>
                    </a>
                </div>
            </div>
        <?php } else { ?>
            <h1><a class="account__link text-decoration-underline" href="login">Login</a> to see your account</h1>
        <?php } ?>
    </div>
</section>
<!-- toast -->
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

<script>
    function edit(e) {
        $("input").attr("disabled", false);
        $("input")[0].focus();
        $(e).text("SAVE")

        if (!$(".btnEdit").hasClass("btnUpdate")) $(".btnEdit").addClass("btnUpdate")
        else {
            let id = $(e).attr("id");
            $.ajax({
                url: "api/account.php",
                method: "POST",
                data: {
                    name: $("#name").val(),
                    phno: $("#phno").val(),
                    email: $("#email").val(),
                    id: id
                },
                success: function (data) {
                    // Show toast
                    const toastLiveExample = document.getElementById('liveToast')
                    $(".toast-body").text(data)
                    const toast = new bootstrap.Toast($("#liveToast"))
                    toast.show()
                    // Disable inputs and change text
                    $(".btnEdit").removeClass("btnUpdate")
                    $("input").attr("disabled", true);
                    $(e).text("EDIT")
                }
            })
        }
    }
    $(document).ready(() => {

        $('input[type="tel"]').keypress(function (e) {
            var charCode = (e.which) ? e.which : event.keyCode
            if (String.fromCharCode(charCode).match(/[^0-9]/g))
                return false;
            if ($(this).val().length >= 10) return false;
        });
    })
</script>


<?php include("components/footer.php"); ?>