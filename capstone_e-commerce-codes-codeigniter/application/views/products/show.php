<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dojo eCommerce Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/user_guide/css/flexslider.css" type="text/css">
    <link rel="stylesheet" href="/user_guide/css/show-product.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>
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
<?php include_once(APPPATH.'views\templates\nav-main-page.php') ?>  
<!-- end nav -->
<div class="container">
    <section class="breakfast-menu">
    <?= $this->session->flashdata('errors') ?>
            <div class="row breakfast-row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="breakfast-menu-content">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="left-image">
                                    <img src="/user_guide/_images/products/<?= json_decode($product['images'])[0] ?>" alt="Breakfast">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <h2><?= $product['product_name'] ?></h2>
                                <div id="owl-breakfast" class="owl-carousel owl-theme">
                                    <div class="item col-md-12">
                                        <div class="food-item">
                                            <div class="flexslider">
                                                <ul class="slides">
<?php   $images = json_decode($product['images']) ?>
<?php   foreach($images as $image) { ?>
                                                    <li>
                                                        <img class="card-img-top" src="/user_guide/_images/products/<?= $image ?>">
                                                    </li>
<?php   } ?>
                                                </ul>
                                            </div>
                                            <div class="text-content">
                                                <h5>Description:</h5>
                                                <p><?= $product['description'] ?></p>
                                            </div>
                                            <div class="price">
                                                <form action="/products/add_to_cart" method="POST">
                                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                                    <h5>Price: ₱<?= $product['price'] ?></h5>
                                                    <label for="quantity">Quantity: </label>
                                                    <input type="number" name="quantity" id="quantity" min="1" max="<?= $product['quantity'] ?>" required>
                                                    <input type="submit" value="Buy">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <a href="<?= base_url(); ?>" class="btn btn-danger mr-5 go-back">Go Back To Menu</a>
</div> <!-- end container -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="/user_guide/js/jquery.flexslider.js"></script>
    <script>
        $(document).ready(function() {
            $('.flexslider').flexslider();
        });
    </script>
</body>
</html>