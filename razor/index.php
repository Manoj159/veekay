<?php
require 'vendor/autoload.php';

use Razorpay\Api\Api;

$api_key = 'rzp_test_cs4cA4XOjYhEdk';
$api_secret = '0kZcxaAzkxQzeNbyqWsj9VJh';

$api = new Api($api_key, $api_secret);

// Get payment form data
$name = "Anand";
$email = "anandsb333@gmail.com";
$amount = 1 * 100;
$currency = 'INR';

// Create order
$order = $api->order->create(array(
    'receipt' => 'order_rcptid_' . time(),
    'amount' => $amount,
    'currency' => $currency,
));

$order_id = $order->id;

// Prepare payment form data
$paymentData = array(
    'key' => $api_key,
    'amount' => $amount,
    'name' => 'Your Company Name',
    'description' => 'Payment for your product/service',
    'image' => 'https://example.com/logo.png',
    'order_id' => $order_id,
    'handler' => 'function(response) { // Handle success response }',
    'prefill' => array(
        'name' => $name,
        'email' => $email,
    ),
    'theme' => array(
        'color' => '#3399cc',
    ),
	'callback_url' => 'http://127.0.0.1/razorpay-php/verify.php',
	'redirect' =>  true
);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <h1>Pay with Razorpay</h1>
    <form action="submit.php" method="POST">
        <input type="hidden" name="name" value="<?= $name ?>">
        <input type="hidden" name="email" value="<?= $email ?>">
        <input type="hidden" name="amount" value="<?= $amount ?>">
        <button type="button" onclick="startPayment()">Pay Now</button>
    </form>

    <script>
		startPayment();
        function startPayment() {
            var options = <?= json_encode($paymentData) ?>;
            var rzp = new Razorpay(options);
            rzp.open();
        }
    </script>
</body>
</html>
