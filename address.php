<?php
include("components/header.php");
if (isset($_SESSION['user'])) {
    $sql = 'SELECT * FROM address WHERE user_id=' . $_SESSION['user'] . '';
    $result = mysqli_query($conn, $sql);

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

    <!-- Addresses Section Begin -->
    <section class="address spad">
        <div class="container">
            <input type="hidden" id="user-id">
            <div class="row">
                <!-- Add address -->
                <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addressModalLabel">Address Details</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>

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
                                        <textarea rows="3" required id="address" name="address" autocomplete="address"
                                            class="checkout__input__add"></textarea>
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
                                    <div class="float-end">
                                        <input type="checkbox" name="default" id="default" class="me-2">
                                        Set as default?
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn-site primary-btn" data-bs-dismiss="modal">Close</button>
                                <button id="btnSubmit" type="submit" class="primary-btn">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="primary-btn mb-3" data-bs-toggle="modal" data-bs-target="#addressModal">ADD ADDRESS</button>

                <!-- Render Address -->
                <div id="addressList" class="p-0"></div>

            </div>
    </section>
    <script>
        const userId = "<?= $_SESSION['user'] ?>"

        $(document).ready(function () {
            fetch_address();


            $("#btnSubmit")


            $("#addressList").on("click", ".edit", function () {
                var id = $(this).attr("id").split("-")[1];
                $.ajax({
                    url: "api/fetch.php",
                    data: {
                        query: "SELECT * FROM address WHERE id=" + id
                    },
                    dataType: "json",
                    success: function (data) {
                        data.forEach(item => {
                            console.log(item)
                        })
                    }
                })
                $(".modal").modal("show")
            })
        })



        function fetch_address() {
            $.ajax({
                url: "api/fetch.php",
                data: {
                    query: "SELECT * FROM address WHERE user_id=" + userId
                },
                dataType: "json",
                success: function (data) {
                    let content = ``;
                    console.log(data.length)
                    if (data.length > 0) {
                        data.forEach(item => {
                            let address = $.parseJSON(item)
                            content += `<div class="card my-3">
                            <div class="card-body">
                                <h3 class="card-title">${address.addressname} `
                            content += (address.is_default) ? "<span>[DEFAULT]<span>" : ""
                            content += `</h3>
                                                    <p>${address.address}</p>
                                                    <p>${address.city}. ${address.state} - ${address.pincode}</p>
                                                    <button id="edit-${address.id}" class="edit primary-btn">EDIT</button>
                                                    <button id="delete-${address.id}" class="delete primary-btn">DELETE</button>`
                            content += (!address.is_default) ?
                                `<button id="default-${address.id}" class="default primary-btn">SET DEFAULT</button>` : ""
                            content += `</div>
                                                </div>
                                                `;
                        });
                    } else content = "<h2 class='text-center mt-6'>No saved addresses.</h2>"
                    $("#addressList").html(content)
                }
            })
        }
    </script>
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

<!-- Orders Section End -->

<?php include("components/footer.php"); ?>