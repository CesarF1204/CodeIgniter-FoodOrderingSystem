<!-- admin nav -->
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">DASHBOARD</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="/dashboard/orders" class="nav-link">Orders</a>
                </li>
                <li class="nav-item">
                    <a href='/dashboard/products' class="nav-link">Products</a>
                </li>
            </ul>
            <ul class="m-0">
                <li class="nav-item dropdown d-block">
                    <a class="nav-link dropdown-toggle text-white"
                        href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                        <?= $this->session->userdata('admin_name'); ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a style="font-size: 13px" class="dropdown-item" href="/changepassword">Change Password</a>
                        <div class="dropdown-divider"></div>
                        <a style="font-size: 13px" class="dropdown-item" href="/admins/logout">Logout</a>
                    </div>
                </li>  
            </ul>
        </div>
    </nav>
    <br><br><br>
<!-- end nav -->