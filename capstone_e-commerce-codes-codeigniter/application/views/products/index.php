<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dojo eCommerce</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/user_guide/css/main-page.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>
        $(document).ready(function(){
            // we are getting all of the quotes so that when the user first requests the page the page 
            // will already be rendering the quotes
            $.get('/products/search_products', function(res) {
            // this url returns html string so we can dump that straight into div#quotes
            $('#default-products').html(res);
            });
            $('#search-product-form').change(function(){
            // there are three arguments that we are passing into $.post function
            //     1. the url we want to go to: '/quotes/create'
            //     2. what we want to send to this url: $(this).serialize()
            //            $(this) is the form and by calling .serialize() function on the form it will 
            //            send post data to the url with the names in the inputs as keys
            //     3. the function we want to run when we get a response:
            //            function(res) { $('#quotes').html(res) }
            $.post($(this).attr('action'), $(this).serialize(), function(res) {
                $('#default-products').html(res);
            });
            // We have to return false for it to be a single page application. Without it,
            // jQuery's submit function will refresh the page, which defeats the point of AJAX.
            // The form below still contains 'action' and 'method' attributes, but they are ignored.
            return false;
            });
        });
        //hide fadeout flashmessages
        $(document).ready(function(){
            var timeout = 2000; // in miliseconds
            $('.success').delay(timeout).fadeOut(300);
            $('.errors').delay(timeout).fadeOut(300);
        });
        $(document).ready(function(){       
            $('#successfulMessage').modal('show');
        });
    </script>
</head>
<body>
<!-- nav -->
<?php include_once(APPPATH.'views\templates\nav-main-page.php') ?>
<!-- end nav -->
<div class="container">
<?php if($this->session->flashdata('success')) { ?>
            <?= $this->session->flashdata('success'); ?>
<?php } else if($this->session->flashdata('success_payment')) {?>
    <!-- Payment Successful Modal -->
    <div class="modal fade text-dark mt-5" id="successfulMessage">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalTitle">Payment Message</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5><?= $this->session->flashdata('success_payment') ?></h5>
                    <a class="btn btn-info" href="<?= $charged_details['receipt_url'] ?>" target="_blank">View Your Receipt</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
<?php }  ?>
    <form id="search-product-form" action="/products/search_products" method="POST">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
        <input type="text" name="product_name" id="search_product_name" placeholder="Search product name...">
<?php foreach($categories as $category) { ?>
<?php if($category['category_name'] == 'Breakfast') { ?>
        <a href="#" id="breakfast"><input type="checkbox" name="category_name" value="<?= $category['category_name'] ?>"><?= $category['category_name'] ?>(<?= $category['category_quantity'] ?>)</a>
<?php   } else if($category['category_name'] == 'Lunch') { ?>
        <a href="#" id="lunch"><input type="checkbox" name="category_name" value="<?= $category['category_name'] ?>"><?= $category['category_name'] ?>(<?= $category['category_quantity'] ?>)</a>
<?php   } else { ?>
        <a href="#" id="dinner"><input type="checkbox" name="category_name" value="<?= $category['category_name'] ?>"><?= $category['category_name'] ?>(<?= $category['category_quantity'] ?>)</a>
<?php   } ?>
<?php } ?>
    </form>
    <!-- load partials -->
    <div id="default-products"></div>
</div> <!-- end container -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>