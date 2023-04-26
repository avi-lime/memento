<?php
session_start();

use Razorpay\Api\Api;

require "../global/api/conn.php";
require "vendor/autoload.php";

$keyId = "rzp_test_zJnbchZUMQeulT";
$keySecret = "kEKh6CGaqXhMcxNkkZkp1Lrn";
$user_id = $_SESSION['user'];
//email body start 
$sql = "SELECT * FROM user WHERE id=$user_id";
$result = mysqli_query($conn, $sql);
$userdetail = mysqli_fetch_assoc($result);
$email = $userdetail['email'];
$successmessage = '<div>'
    . 'You are now a member of our family.<br />'
    . 'Here are the product details'
    . '<table>'
    . '<tr>'
    // .'<th>Image</th>'
    . '<th>Product</th>'
    . '<th>quantity</th>'
    . '<th>size</th>'
    . '<th>amount</th>'
    . '</tr>';
$sql = 'SELECT * FROM cart WHERE user_id=' . $user_id . '';
$result = mysqli_query($conn, $sql);
$prototal = 0;
$alltotal = 0;
while ($details = mysqli_fetch_assoc($result)) {
    $productsql = 'SELECT * FROM product WHERE id=' . $details['product_id'] . '';
    $imagesql = 'SELECT * FROM product_images WHERE product_id=' . $details['product_id'] . ' LIMIT 1 ';
    $productresult = mysqli_query($conn, $productsql);
    $imageresult = mysqli_query($conn, $imagesql);
    $product = mysqli_fetch_assoc($productresult);
    $image = mysqli_fetch_assoc($imageresult);
    $successmessage .= '<tr>'
        // .'<td>'.'<img src="../global/assets/images/' .$image['image'].'" style="width: 100px;height: 100px; object-fit: cover" alt="">'.'</td>'
        . '<td>' . $product['name'] . '</td>'
        . '<td>' . $details['quantity'] . '</td>'
        . '<td>' . strtoupper($details['size']) . '</td>'
        . '<td>';
    $originalprice = $product['price'];
    $discountrate = $product['discount'];
    $discountprice = $originalprice * ($discountrate / 100);
    $price = $originalprice - $discountprice;
    $quantity = $details['quantity'];
    $total = $price * $quantity;
    $prototal += $total;
    $successmessage .= (int) $total . '</td>'
        . '</td>'
        . '</tr>';
}
$successmessage .= '<tr>'
    . '<td></td>'
    . '<td></td>'
    . '<td>Total:</td>'
    . '<td>' . $_SESSION['price'] . '</td>'
    . '</tr>'
    . '</table>'
    . '</div>';
//////order conform email body 
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
date_default_timezone_set("Asia/Calcutta");
$order_created_at = date('y-m-d H:i:s', $razorpayOrder['created_at']);
$_SESSION['razorpay_order_id'] = $order_id;
?>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"
    integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
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
            sendMail();
            payment(true);
            location.href = "../orders";
        },
        "modal": {
            "ondismiss": function () {
                location.href = "../checkout"
            }
        },
        "notes": {
            "address": "Memento"
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
        payment(false);
    });
    function payment(success) {
        let amount = <?= $actual_amount ?>;
        let addressid = <?= $_REQUEST['addressid'] ?>;
        let status = "NetBanking";
        let date = "<?= $order_created_at ?>";
        $.ajax({
            url: "../api/orderplaced.php",
            method: "POST",
            data: {
                amount: amount,
                addressid: addressid,
                status: status,
                date: date,
                success: success
            },
            success: function (data) {
                console.log(data)
            }
        })

    }
    function sendMail() {
        let email = "<?= $email ?>";
        let subject = "Order has been placed";
        let body = '<?= $successmessage ?>';
        let altbody = "mail for change Product Order";
        $.ajax({
            url: "../mail/",
            method: "post",
            data: {
                email: email,
                subject: subject,
                body: body,
                altbody: altbody,
                fromMail: "jigyasusharma2803@gmail.com",
                fromName: "Jigyasu Sharma"
            },
            success: function (data) {
            }
        })
    }
</script>