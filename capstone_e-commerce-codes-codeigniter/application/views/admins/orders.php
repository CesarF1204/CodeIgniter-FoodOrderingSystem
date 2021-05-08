<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/user_guide/css/admin-products.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>
        $(document).ready(function(){
            // we are getting all of the quotes so that when the user first requests the page the page 
            // will already be rendering the quotes
            $.get('/admins/search_customers', function(res) {
            // this url returns html string so we can dump that straight into div#quotes
            $('#customers-table').html(res);
            });

            $('#search-customer-form').change(function(){
            // there are three arguments that we are passing into $.post function
            //     1. the url we want to go to: '/quotes/create'
            //     2. what we want to send to this url: $(this).serialize()
            //            $(this) is the form and by calling .serialize() function on the form it will 
            //            send post data to the url with the names in the inputs as keys
            //     3. the function we want to run when we get a response:
            //            function(res) { $('#quotes').html(res) }
            $.post($(this).attr('action'), $(this).serialize(), function(res) {
                $('#customers-table').html(res);
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
    </script>
</head>
<body>
<!-- nav -->
<?php include_once(APPPATH.'views\templates\admin-navigation.php') ?>
<!-- end nav -->
<div class="container">
        <form class="search-customer" id="search-customer-form" action="/admins/search_customers" method="post">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
            <input type="text" name="customer_name" id="search" placeholder="Search Order...">
            <?= $this->session->flashdata('success') ?>
            <select name="order_status">
                <option value="" selected>Select All</option>
                <option value="1">Order in process</option>
                <option value="2">Delivered</option>
                <option value="3">Canceled</option>
            </select>
        </form>
    <!-- load partials -->
    <div id="customers-table"></div>
</div>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('li.active').removeClass('active');
            $('a[href="' + location.pathname + '"]').closest('li').addClass('active'); 
        });
</script>
</body>
</html>