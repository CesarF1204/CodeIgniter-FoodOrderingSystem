<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">Dojo eCommerce</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
        </ul>
        <ul class="shopping-cart">
            <li class="nav-item dropdown">
                <a href="/carts" ><i class="fas fa-cart-arrow-down fa-2x"></i> Shopping Cart<span>(<?= $this->session->userdata('total_order') ?>)</span></a>
            </li>  
        </ul>
    </div>
</nav>