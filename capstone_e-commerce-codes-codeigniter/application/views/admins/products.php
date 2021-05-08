<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/user_guide/css/admin-products.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function(){
            // we are getting all of the quotes so that when the user first requests the page the page 
            // will already be rendering the quotes
            $.get('/admins/search_products', function(res) {
            // this url returns html string so we can dump that straight into div#quotes
            $('#products-table').html(res);
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
                $('#products-table').html(res);
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
        // upload images
        $(document).ready(function(){
            $('#images').change(function(){
                $("#image_preview").html('');
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    $("#image_preview").append('<div id="img-drag"><i id="img-bars" class="fas fa-bars fa-2x"></i><img id="image_to_be_upload" src="'+window.URL.createObjectURL(this.files[i])+'"/><i id="delete-icon" class="fas fa-trash-alt"></i ><input type="checkbox">main</div><br>');
                }
            });
        });
        $(document).ready(function(){
            $('#image_preview').on('mouseenter', '#img-drag', function(){
                $(this).css("cursor", "move");
                $(this).draggable();
                $(this).find("#delete-icon").show('slow');
                $(this).find("#delete-icon").css('color', 'red');
                $(this).find("#delete-icon").css('cursor', 'pointer');
                $(this).find("#delete-icon").remove('cursor', 'pointer');
            });
            $('#image_preview').on('mouseleave', '#img-drag', function(){
                $(this).find("#delete-icon").hide('slow');
            });
            $('#image_preview').on('click', '#img-drag', function(){
                $(this).remove();
            });
        });
        //categories edit/delete
        // $(document).ready(function(){
        //     $('option').on('mouseenter', '', function(){
        //         console.log('in');
        //         $(this).find("#category_option").html('<button>Remove</button>');
        //     });
            
        // });
    </script>
</head>
<body>
<!-- nav -->
<?php include_once(APPPATH.'views\templates\admin-navigation.php') ?>
<!-- end nav -->
<div class="container">
    <?php if($this->session->flashdata('success')) {?>
        <?= $this->session->flashdata('success'); ?>
<?php } else if($this->session->flashdata('errors')) { ?>
        <?= $this->session->flashdata('errors'); ?>
<?php } ?>
    <div class="search-add-product">
        <form id="search-product-form" action="/admins/search_products" method="post">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
            <input type="text" name="product_name" id="product_name" placeholder="Search...">
        </form>
        <!-- add new product button -->
        <a href="#" class="btn btn-primary btn-new-product" data-toggle="modal" data-target="#addModal">Add New Product</a>
    </div>
    <!-- load partials -->
    <div id="products-table"></div>
</div><!-- end container -->

<!-- Add New Product Modal -->
<div class="modal fade text-dark" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalTitle">Add New Product</h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admins/add_product" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="product_name" id="name" class="form-control" placeholder="Product Name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" cols="30" rows="5" placeholder="Type product description here..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control" placeholder="Type product price here..." step='0.01' required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Type product quantity here..." required>
                    </div>
                    <div class="form-group">
                        <label for="categories">Categories</label>
                        <select class="form-control" name="category" id="categories" required>
                            <option value="">--Select a Category--</option>
<?php   foreach($categories as $category) { ?>
                            <option id="category_option" value="<?= $category['id'] ?>"><?= $category['category_name'] ?></option>
<?php   } ?>
                        </select>
                    </div>
                    <!-- add new category -->
                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addCategoryModal">Add New Category</a>
                    <br>
                    <br>
                    <div class="form-group">
                        <label for="images">Images</label>  
                        <input type="file" name="images[]" id="images" class="form-control" multiple required>
                        <div id="image_preview"></div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
<!-- Add New Category Modal -->
<div class="modal fade text-dark" id="addCategoryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalTitle">Add New Category</h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admins/add_category" method="POST">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                    <div class="form-group">
                        <label for="category_name">Name</label>
                        <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Category Name" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

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