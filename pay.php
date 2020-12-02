<!-- Razorpay standard checkout integration -->
<?php
    require_once 'razorpay-php/Razorpay.php'; 
    use Razorpay\Api\Api;

    $keyid = 'rzp_test_CS0vIhEmCMQJ1s';
    $secretkey = 'WfSibnFlHJI4ZQjmzXkvPNQD';
    $api = new Api($keyid, $secretkey);

    
    // create order
    $order = $api->order->create(array(
        'receipt' => '123',
        'amount' => 100,
        'payment_capture' => 1,
        'currency' => 'INR',
        'notes' => 
            array (
                'note_key' => 'shopping cart apparels',
            ),
        )
    );
?>

<!-- automatic checkout -->
<form action="verify.php" method="post">
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="<?php echo $keyid ?>" // Enter the Key ID generated from the Dashboard
        data-amount="<?php echo $order->Amount ?>" // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        data-currency="INR"
        data-order_id="<?php echo $order->id ?>"//This is a sample Order ID. Pass the `id` obtained in the response of the previous step.
        data-buttontext="Pay Now"
        data-name="Meghana"
        data-description="Shopping-Cart"
        data-image="logo.jpg"
        data-prefill.name="Meghana"
        data-prefill.email="test@gmail.com"
        data-prefill.contact="9876543210"
        data-theme.color="#4285f4">
    </script>
    <input type="hidden" custom="Hidden Element" name="hidden" >
</form>



<!-- Enable below code for manual checkout with handler function -->

<!-- <button id="rzp-button1">Pay Now</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<form name='razorpayform' action="verify.php" method="POST">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
    <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
</form>
<script>
var options = {
    "key": "<?php echo $keyid ?>", // Enter the Key ID generated from the Dashboard
    "amount": "<?php echo $order->Amount ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "Meghana",
    "description": "Shopping-cart",
    "image": "logo.jpg",
    "order_id": "<?php echo $order->id ?>", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){
        document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
        document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
        document.getElementById('razorpay_signature').value = response.razorpay_signature;
        document.razorpayform.submit();
    },
    "prefill": {
        "name": "Meghana",
        "email": "test@example.com",
        "contact": "9876543210"
    },
    "notes": {
        "address": "Online Shopping-cart"
    },
    "theme": {
        "color": "#F37254"
    }
};
var rzp1 = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script> -->



<!-- enable below code for manual checkout with callback URL -->

<!-- <button id="rzp-button1">Pay Now</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<form>
<script>
var options = {
    "key": "<?php echo $keyid ?>",
    "amount": "<?php echo $order->Amount ?>",
    "order_id": "<?php echo $order->id ?>", 
    "currency": "INR",
    "name": "Meghana",
    "description": "Shopping-cart",
    "image": "logo.jpg",
    "callback_url": "verify.php",
    "prefill": {
        "name": "Meghana",
        "email": "test@example.com",
        "contact": "9876543210"
    },
    "notes": {
        "details": "Online shopping"
    },
    "theme": {
        "color": "#4285f4"
    }
};
var rzp1 = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script> 
</form> -->

