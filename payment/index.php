<?php
session_start();

use Razorpay\Api\Api;

require "../global/api/conn.php";
require "vendor/autoload.php";

$keyId = "rzp_test_zJnbchZUMQeulT";
$keySecret = "kEKh6CGaqXhMcxNkkZkp1Lrn";
$user_id = $_SESSION['user'];
$api = new Api($keyId, $keySecret);

$actual_amount = $_SESSION['price'];
$currency = "INR";
$receipt = str_replace('.', '', microtime(true)) . rand(1, 10000) . $user_id;

$orderData = [
    'receipt' => $receipt,
    'amount' => $actual_amount * 100,
    // passing in paise
    'currency' => $currency
];

$razorpayOrder = $api->order->create($orderData);
$order_id = $razorpayOrder['id'];
$order_receipt = $razorpayOrder['receipt'];
$order_amount = $razorpayOrder['amount'];
$order_currency = $razorpayOrder['currency'];
$order_created_at = date('d-m-y h:i:s a', $razorpayOrder['created_at']);
$_SESSION['razorpay_order_id'] = $order_id;
?>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

    var options = {
        "key": "rzp_test_zJnbchZUMQeulT",
        "amount": "<?= $actual_amount ?>",
        "currency": "<?= $currency ?>",
        "name": "Memento",
        "description": "Test Transaction",
        "image": "../img/mxm-black.png",
        "order_id": "<?= $order_id ?>",
        "handler": function (response) {
            location.href = "../shopping-cart.php";
        },
        "modal": {
            "ondismiss": function () {
                location.href = "../checkout.php"
            }
        },
        "notes": {
            "address": "Mera Ghar"
        },
        "theme": {
            "color": "#3399cc"
        }
    };
    var rzp1 = new Razorpay(options);

    rzp1.open();

    rzp1.on('payment.failed', function (response) {
        alert(response.error.code);
        alert(response.error.description);
        alert(response.error.source);
        alert(response.error.step);
        alert(response.error.reason);
        alert(response.error.metadata.order_id);
        alert(response.error.metadata.payment_id);
    });

</script>