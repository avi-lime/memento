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
                                                <input type="hidden" name="id" id="id">
                                                <p>First Name<span>*</span></p>
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
                                <button type="button" id="btnClose" class="btn-site primary-btn"
                                    data-bs-dismiss="modal">Close</button>
                                <button id="btnSubmit" type="submit" class="primary-btn">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="primary-btn mb-3" data-bs-toggle="modal" id="addAddress" data-bs-target="#addressModal">ADD
                    ADDRESS</button>

                <!-- Render Address -->
                <div id="addressList" class="p-0"></div>

            </div>
    </section>
    <script>
        const userId = "<?= $_SESSION['user'] ?>"

        $(document).ready(function () {
            fetch_address();


            $("#btnSubmit").click(function () {
                let first = $('#firstname').val();
                let last = $('#lastname').val();
                let fullname = first + " " + last;
                let country = $('#country').val();
                let address = $('#address').val();
                let city = $('#city').val();
                let state = $('#state').val();
                let pincode = $('#pincode').val();
                let default1 = 0;
                let id = $('#id').val();
                if ($('#default').is(':checked')) {
                    default1 = 1;
                }
                $.ajax({
                    url: "api/saveaddress.php",
                    method: "POST",
                    data: {
                        pincode: pincode,
                        state: state,
                        city: city,
                        country: country,
                        addressname: fullname,
                        address: address,
                        default: default1,
                        id: id
                    },
                    success: function (data) {
                        console.log(data);
                        fetch_address();
                        remove_feild();
                    }
                })

            })
            $("#btnClose,.btn-close,#addAddress").on("click", function () {
                remove_feild();
                $('#btnSubmit').text("Save");

            })
            $('#addressList').on("click", ".delete", function () {
                var id = $(this).attr("id").split("-")[1];
                console.log(id);
                $.ajax({
                    url: "api/delete.php",
                    method: "POST",
                    data: {
                        id: id,
                        table: 'address'
                    },
                    success: function (data) {
                        console.log(data);
                        alert('Deleted address');
                        fetch_address()
                    }
                })
            })
            $("#addressList").on("click", ".edit", function () {
                remove_feild();
                var id = $(this).attr("id").split("-")[1];
                $.ajax({
                    url: "api/fetch.php",
                    data: {
                        query: "SELECT * FROM address WHERE id=" + id
                    },
                    dataType: "json",
                    success: function (data) {
                        data.forEach(item => {
                            let parsedData = $.parseJSON(data[0]);
                            let name = parsedData.addressname;
                            let ret = name.split(" ");
                            $('#id').val(parsedData.id);
                            $('#firstname').val(ret[0]);
                            $('#lastname').val(ret[1]);
                            $('#country').val(parsedData.country);
                            $('#address').val(parsedData.address);
                            $('#city').val(parsedData.city);
                            $('#state').val(parsedData.state);
                            $('#pincode').val(parsedData.pincode);
                            $('#btnSubmit').text("Update");
                            console.log(item)
                        })
                    }
                })
                $(".modal").modal("show")
            })
        })
        function remove_feild() {
            $('#id').val("");
            $('#firstname').val("");
            $('#lastname').val("");
            $('#country').val("");
            $('#address').val("");
            $('#city').val("");
            $('#state').val("");
            $('#pincode').val("");
            $('#default').prop('checked', false);
            $("#addressModal").modal("toggle")
        }

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
                            content += (address.is_default != "0") ? "<span>[DEFAULT]<span>" : ""
                            content += `</h3>
                                                            <p>${address.address}</p>
                                                            <p>${address.city}. ${address.state} - ${address.pincode}</p>
                                                            <button id="edit-${address.id}" class="edit primary-btn">EDIT</button>
                                                            <button id="delete-${address.id}" class="delete primary-btn">DELETE</button>`
                            // content += (address.is_default == "0") ?
                            //     `<button id="default-${address.id}" class="default primary-btn mx-1">SET DEFAULT</button>` : ""
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
                            <a href="./account">Account</a>
                            <span>Address</span>
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