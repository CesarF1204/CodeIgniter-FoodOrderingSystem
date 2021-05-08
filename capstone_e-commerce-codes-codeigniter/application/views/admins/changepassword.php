<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/user_guide/css/changepassword.css">
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
<?php include_once(APPPATH.'views\templates\admin-navigation.php') ?>
<!-- end nav -->
<div class="container">
<?php if($this->session->flashdata('success')) { ?>
        <?= $this->session->flashdata('success') ?>
<?php } else if($this->session->flashdata('errors')) {?>
        <?= $this->session->flashdata('errors') ?>
<?php } ?>
    <form class="form-horizontal" action="admins/changepassword/<?= $this->session->userdata('admin_id')?>" method="POST">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
        <div class="form-group">
            <label for="new-password" class=" control-label">New Password</label>
            <input id="new-password" type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label for="confirm_password" class="control-label">Confirm New Password</label>
            <input id="confirm_password" type="password" class="form-control" name="confirm_password">

        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                    Change Password
            </button>
        </div>
    </form>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>