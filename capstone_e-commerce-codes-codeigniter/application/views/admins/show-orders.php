<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Orders</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/user_guide/css/show-orders.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>
<body>
<!-- nav -->
<?php include_once(APPPATH.'views\templates\admin-navigation.php') ?>
<!-- end nav -->
<div class="container">
    <h3>Order ID: <?= $customers['customer_id'] ?></h3>
    <div class='customer-info'>
        <div class="delivery-info">
            <h4>Customer Delivery Info:</h4>
            <p>Name: <?= $customers['shipping_fullname'] ?></p>
            <p>Address: <?= $customers['shipping_address'] ?></p>
            <p>City: <?= $customers['shipping_city'] ?></p>
            <p>State: <?= $customers['shipping_state'] ?></p>
            <p>Zipcode: <?= $customers['shipping_zipcode'] ?></p>
        </div>
        <div class="billing-info">
            <h4>Customer Billing Info:</h4>
            <p>Name: <?= $customers['billings_fullname'] ?></p>
            <p>Address: <?= $customers['address'] ?></p>
            <p>City: <?= $customers['city'] ?></p>
            <p>State: <?= $customers['state'] ?></p>
            <p>Zipcode: <?= $customers['zipcode'] ?></p>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
<?php foreach($orders as $order) { ?>
            <tr>
                <td><?= $order['ordered_id'] ?></td>
                <td><?= $order['product_name'] ?></td>
                <td>₱<?= $order['price'] ?></td>
                <td><?= $order['ordered_quantity'] ?></td>
                <td>₱<?= $order['total_price'] ?></td>
            </tr>
<?php } ?>
        </tbody>
    </table>
    <h3 class="total-price">Total Price: ₱<?= $customers['total_price'] ?></h4>
<?php if($customers['status_name'] == 'Order in process') { ?>
    <h4 class='status-process'>Status: <?= $customers['status_name'] ?></h3>
<?php } else if($customers['status_name'] == 'Delivered') { ?>
    <h4 class='status-delivered'>Status: <?= $customers['status_name'] ?></h3>
<?php } else {?>
    <h4 class='status-cancelled'>Status: <?= $customers['status_name'] ?></h3>
<?php } ?>

</div> <!-- end container -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>