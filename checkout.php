<?php include("components/header.php");
if (!isset($_SESSION['user'])) {
    redirect("login");
}
$userid = $_SESSION['user'];
?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Check Out</h4>
                    <div class="breadcrumb__links">
                        <a href="./index">Home</a>
                        <a href="./shop">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<!-- Modal -->
<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
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
                                        <textarea rows="3" required id="address" name="address" autocomplete="address" class="checkout__input__add"></textarea>
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
                                <button type="button" id="btnClose" class="btn-site primary-btn" data-bs-dismiss="modal">Close</button>
                                <button id="btnSubmit" type="submit" class="primary-btn">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <button class="primary-btn mb-3" data-bs-toggle="modal" id="addAddress" data-bs-target="#addressModal">ADD ADDRESS</button> -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="" method="Post">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="checkout__title">Select an Address</h6>
                        <div class="row" id="addressList">

                        </div>
                        <!-- <div class="row">
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
                            <input type="text" placeholder="Street Address" required id="address" name="address"
                                class="checkout__input__add">
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
                        <input type="button" class="site-btn" id="saveaddress" name="saveaddress" value="Save Address"> -->
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4 class="order__title">Your order</h4>
                            <div class="checkout__order__products">Product <span>Total</span></div>
                            <ul class="checkout__total__products">
                                <?php
                                $sql = "SELECT * FROM cart WHERE user_id=$userid";
                                $result = mysqli_query($conn, $sql);
                                $totalprice = 0;
                                $charges = 0;
                                $proprice = 0;
                                $count = 1;
                                while ($details = mysqli_fetch_assoc($result)) {
                                    $productsql = 'SELECT * FROM product WHERE id=' . $details['product_id'] . '';
                                    $productrun = mysqli_query($conn, $productsql);
                                    $product = mysqli_fetch_assoc($productrun);
                                    $Originalprice = $product['price'];
                                    $discount = $product['discount'];
                                    $discountamount = $Originalprice * ($discount / 100);
                                    $quantity = $details['quantity'];
                                    $saleprice = ($Originalprice - $discountamount) * $quantity;
                                    $proprice += $saleprice;
                                    ?>
                                    <li>
                                        <?= $count . ".  " . $product['name'] . "(" . strtoupper($details['size']) . ")x" . $quantity; ?>
                                        <span>₹
                                            <?= (int) $saleprice ?>
                                        </span>
                                    </li>
                                    <?php
                                    $count++;
                                } ?>
                            </ul>
                            <ul class="checkout__total__all">
                                <li>Subtotal <span>₹
                                        <?= (int) $proprice; ?>
                                    </span></li>
                                <?php if ($proprice < 749) { ?>
                                    <li>Delivery Charges <span>₹
                                            <?php $charges = 50;
                                            echo $charges ?>
                                        </span></li>
                                <?php } else { ?>
                                    <li>Delivery Charges <span>Free</span></li>
                                <?php } ?>
                                <li>Total <span>₹
                                        <?php $totalprice = $proprice + $charges;
                                        $_SESSION['price'] = (int) $totalprice;
                                        echo (int) $totalprice ?>
                                    </span></li>
                            </ul>
                            <button type="button" name="rzp-button1" id="rzp-button1" class="primary-btn mb-2 w-100">pay
                                online</button></br>
                            <button type="button" name="btncod" id="btncod" class="primary-btn mb-2 w-100">pay on
                                delivery *</button>
                            <p>* (+50₹) when using pay on delivery</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
<script>
    
    const userId = "<?= $_SESSION['user'] ?>"
$(document).ready(function() {
            fetch_address();
            //insert or update address
            $("#btnSubmit").click(function() {
                let first = $('#firstname').val();
                let last = $('#lastname').val();
                let fullname=first+" "+last;
                let country = $('#country').val();
                let address = $('#address').val();
                let city = $('#city').val();
                let state = $('#state').val();
                let pincode = $('#pincode').val();
                let default1=0;
                let id = $('#id').val();
                if($('#default').is(':checked')){
                    default1=1;
                }
                $.ajax({
                    url:"api/saveaddress.php", 
                    method:"POST",
                    data: {
                        pincode:pincode,
                        state:state,
                        city:city,
                        country:country,
                        addressname:fullname,
                        address:address,
                        default:default1,
                        id:id
                    },
                    success: function(data){
                        console.log(data);
                        fetch_address();
                        remove_feild();
                    }   
                })

            })

            //clear field on close and click
            $("#btnClose,.btn-close,#addAddress").on("click", function() {
                remove_feild();
            })
            //address edit 
            $("#addressList").on("click", ".edit", function() {
                remove_feild();
                var id = $(this).attr("id").split("-")[1];
                $.ajax({
                    url: "api/fetch.php",
                    data: {
                        query: "SELECT * FROM address WHERE id=" + id
                    },
                    dataType: "json",
                    success: function(data) {
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
                            console.log(item)
                        })
                    }
                })
                $(".modal").modal("show")
            })
        })
        //remove function
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
        }
        //fetch address
        function fetch_address() {
            $.ajax({
                url: "api/fetch.php",
                data: {
                    query: "SELECT * FROM address WHERE user_id=" + userId
                },
                dataType: "json",
                success: function(data) {
                    let content = ``;
                    console.log(data.length)
                    if (data.length > 0) {
                        data.forEach(item => {
                            let address = $.parseJSON(item)
                            content += `  
                                        <div>
                                        <input type="radio" val="${address.id}" id="${address.id}" name="selectAddress" value="${address.id}">
                                        <label for="${address.id}"><p style=" font-weight;font-weight: bolder; display:inline"> ${address.addressname}:</p>  ${address.address},${address.city}:${address.pincode},${address.country}</label></br>
                                        </div>
                                        `;
                        });
                        content+=`</br><a href="#addressModal" data-bs-toggle="modal" style="none;" name="addAddress" id="addAddress" >+ Add a new address</p>`;
                    } else content = "<h2 class='text-center mt-6'>No saved addresses.</h2>"

                    $("#addressList").html(content)
                }
            })
        }

        //netbanking click product
    $("#rzp-button1").click(function () {
        <?php $_SESSION['addressid']="1"?>//radio add address id
        location.href = "payment";
    })





</script>

<?php

include("components/footer.php"); ?>