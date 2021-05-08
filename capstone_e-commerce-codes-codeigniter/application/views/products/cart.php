<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- custom style -->
    <link rel="stylesheet" href="/user_guide/css/carts.css">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>
        $(document).ready(function(){
            $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'dots',
            autoAdjustHeight:true,
            transitionEffect:'fade',
            showStepURLhash: false,
            });
        });
        $(document).ready(function(){ 
            $('#same_as_shipping').click(function(){
                if($('#same_as_shipping').is(':checked')){
                    $('#first_name').val($('#shipping_first_name').val());
                    $('#last_name').val($('#shipping_last_name').val());
                    $('#address').val($('#shipping_address').val());
                    $('#address2').val($('#shipping_address2').val());
                    $('#city').val($('#shipping_city').val());
                    $('#state').val($('#shipping_state').val());
                    $('#zipcode').val($('#shipping_zipcode').val());
                } else { 
                    //Clear on uncheck
                    $('#first_name').val("");
                    $('#last_name').val("");
                    $('#address').val("");
                    $('#address2').val("");
                    $('#city').val("");
                    $('#state').val("");
                    $('#zipcode').val("");
                };
            });
        });
        //hide fadeout flashmessages
        $(document).ready(function(){
            var timeout = 2000; // in miliseconds
            $('.success').delay(timeout).fadeOut(300);
            $('.errors').delay(timeout).fadeOut(300);
        });
    </script>
</head>
<body>
<!-- links and scripts for modal -->
<link href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/smart_wizard.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/smart_wizard_theme_dots.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.smartWizard.min.js"></script>
<!-- nav -->
<?php include_once(APPPATH.'views\templates\nav-main-page.php') ?>
<!-- end nav -->
<div class="container">
<?php if($this->session->flashdata('success')) { ?>
        <?= $this->session->flashdata('success') ?>
<?php } else if($this->session->flashdata('errors')) {?>
        <?= $this->session->flashdata('errors') ?>
<?php } ?>
    <h1>Your Cart:</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Item</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
<?php   $total_price=0;
        foreach($this->session->userdata('cart') as $id => $qty){
        $total_price += $qty*$ordered_items[$id]['price'];
?>
            <tr>
                <td> <?= $ordered_items[$id]['product_name'] ?> </td>
                <td> ₱<?= $ordered_items[$id]['price'] ?> </td>
                <td>
                    <form action="carts/update_quantity" method="post">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                        <input type="hidden" name="product_id" value="<?= $ordered_items[$id]['id'] ?>">
                        <input type="number" name="quantity" value="<?= $qty ?>" min="1" max="<?= $ordered_items[$id]['quantity'] ?>">
                        <input type="submit" class="btn btn-info update-item" value="Update">
                    </form>
                </td>
                <td> ₱<?= $ordered_items[$id]['price'] * $qty ?> </td>
            <form action="/products/delete_item_in_cart" method="post">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                <input type="hidden" name="product_id" value="<?= $id ?>">
                <td><input class="btn btn-danger remove-item" type="submit" value="&times; Remove"></td>
            </form>
            </tr>
<?php   } ?>  
        </tbody>
    </table>
    <h3 class="total_price">Total: ₱<?= $total_price ?></h3>
    <div class="row d-flex justify-content-center">
        <a href="<?= base_url(); ?>" class="btn btn-danger mr-5">Go Back To Menu</a>
        <button type="button" class="btn btn-primary px-5" data-toggle="modal" data-target="#exampleModal">Check Out</button>
    </div>
    <!-- Payment Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Checkout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    <div id="smartwizard">
                        <ul>
                            <li><a href="#step-1">Step 1<br /><small>Delivery Information</small></a></li>
                            <li><a href="#step-2">Step 2<br /><small>Billing Information</small></a></li>
                            <li><a href="#step-3">Step 3<br /><small>Payment Information</small></a></li>
                        </ul>
                        <div>
                            <div id="step-1">
                            <form action="/carts/pay" method="POST" class="form-validation" data-cc-on-file="false" autocomplete='off'
        data-stripe-publishable-key="<?= $this->config->item('stripe_key') ?>" id="payment-form">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="shipping_first_name" id="shipping_first_name" placeholder="First Name">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="shipping_last_name" id="shipping_last_name" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="shipping_address" id="shipping_address" placeholder="Address">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="shipping_address2" id="shipping_address2" placeholder="Address2">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="shipping_city" id="shipping_city" placeholder="City">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="shipping_state" id="shipping_state" placeholder="State">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="shipping_zipcode" id="shipping_zipcode" placeholder="Zipcode">
                                    </div>
                                </div>
                            </div>
                            <div id="step-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="checkbox" id="same_as_shipping">
                                        <label for="same_as_shipping">Same as Delivery</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="address2" id="address2" placeholder="Address2">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="city" id="city" placeholder="City">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="state" id="state" placeholder="State">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Zipcode">
                                    </div>
                                </div>
                            </div>
                            <div id="step-3" class="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="card-holder-name" autocomplete='off' placeholder="Card Holder Name">
                                    </div>
                                    <div class="col-md-6">
                                        <input type='text' class='form-control card-number' name="card-number" id="card-number" autocomplete='off' maxlength="16" placeholder="0000 0000 0000 0000">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <input type='text' autocomplete='off' name="card-expiry-month" class='form-control card-expiry-month' placeholder='MM' maxlength="2">
                                    </div>
                                    <div class="col-md-6">
                                        <input type='text' class='form-control name="card-expiry-year" card-expiry-year' placeholder='YYYY' maxlength="4">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <input type='text' class='form-control card-cvc' name="card-cvc" maxlength="3" autocomplete='off' placeholder="CVC">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="submit" class="btn btn-primary nextBtn pull-right form-control" id="confirm-order" value="Proceed to Checkout">
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!--end container -->

    <!-- bootstrap scripts cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- stripe scripts cdn -->
    <script src="https://js.stripe.com/v2/"></script>
    <script src="https://polyfill.io/v2/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="/user_guide/js/client.js" defer></script>
</body>
</html>