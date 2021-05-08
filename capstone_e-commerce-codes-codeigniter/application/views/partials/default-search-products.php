<!-- ***** Menu Area Starts ***** -->
<section class="section" id="products">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 text-center">
                <div class="section-heading">
                    <h6>Francisco's Restaurant</h6>
                    <h2>This Week’s Special Meal Offers</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <section class='tabs-content'>
                    <article>
                        <div class="row">
<?php   foreach($products as $product) { ?>
                            <div class="col-lg-6 product-list">
                                <div class="row">
                                    <div class="left-list">
                                        <div class="col-lg-12">
                                            <div class="tab-item">
                                                <img src="/user_guide/_images/products/<?= json_decode($product['images'])[0] ?>" alt="">
                                                <h4><?= $product['product_name'] ?></h4>
                                                <p><?= $product['description'] ?></p>
                                                <div class="price">
                                                    <h6>₱<?= $product['price'] ?></h6>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/products/show/<?= $product['product_id'] ?>">Order Now</a>
                            </div>    
<?php   } ?>
                        </div>
                    </article>  
                </section>
            </div>
        </div>
    </div>
</section>
<!-- ***** Menu Area Ends ***** -->