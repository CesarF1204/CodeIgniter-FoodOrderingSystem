<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <link rel="stylesheet" href="/user_guide/css/login.css">
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
    <div class="container-login100">
        <div class="wrap-login100 p-t-85 p-b-20">
        <?= $this->session->flashdata('errors'); ?>
            <form class="form-signin" action="/admins/login" method="POST">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                <span class="login100-form-title p-b-70">
                    Admin Login Page
                </span>
                <span class="login100-form-avatar">
                    <img src="/user_guide/_images/login.png" alt="AVATAR">
                </span>
                <div class="wrap-input100 m-t-85 m-b-35">
                    <input class="input100" type="text" name="email">
                    <span class="focus-input100" data-placeholder="Email Address"></span>
                </div>
                <div class="wrap-input100 m-b-50">
                    <input class="input100" type="password" name="password">
                    <span class="focus-input100" data-placeholder="Password"></span>
                </div>
                <br>
                <div class="container-login100-form-btn">
                    <input class="login100-form-btn" type="submit" value="Login">
                </div>
            </form>
        </div>
    </div>
</body>
</html>