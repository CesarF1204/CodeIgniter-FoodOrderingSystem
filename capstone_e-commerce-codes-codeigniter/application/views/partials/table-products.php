<table class="mb-5">
    <thead>
        <tr>
            <th>Picture</th>
            <th>ID</th>
            <th>Name</th>
            <th>Inventory Count</th>
            <th>Quantity Sold</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php foreach($products as $product) { ?>
        <tr>
            <td><img class="product-image" src="/user_guide/_images/products/<?= json_decode($product['images'])[0] ?>"></td>
            <td><?= $product['id'] ?></td>
            <td><?= $product['product_name'] ?></td>
            <td><?= $product['quantity'] ?></td>
            <td><?= $product['quantity_sold'] ?></td>
            <td>
                <a href="#" class='btn btn-success' data-toggle="modal" data-target="#editModal<?= $product['id']?>">Edit</a>
                <a href="#" class='btn btn-danger' data-toggle="modal" data-target="#deleteModal<?= $product['id']?>">Delete</a>
            </td>
        </tr>
<?php } ?>
    </tbody>
</table>
<p class='pagination'><?= $this->pagination->create_links(); ?></p>

<?php foreach($products as $product) { ?>
<!-- Edit Product Modal -->
<div class="modal fade text-dark" id="editModal<?= $product['id']?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle">Edit Product - ID <?= $product['id'] ?></h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admins/update/<?= $product['id'] ?>" method="POST">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" id="name" name="product_name" class="form-control" placeholder="Product Name" value="<?= $product['product_name'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" cols="30" rows="5" placeholder="Type product description here..." value="<?= $product['description'] ?>" required><?= $product['description'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price" class="form-control" placeholder="Price" value="<?= $product['price'] ?>" step='0.01' required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Quantity" value="<?= $product['quantity'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="categories">Categories</label>
                        <select class="form-control" name="category_id" id="categories" required>
                            <option value="">--Select a Category--</option>
<?php   foreach($categories as $category) { ?>
                            <option value="<?= $category['id'] ?>"><?= $category['category_name'] ?></option>
<?php   } ?>
                        </select>
                    </div>
                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addCategoryModal">Add New Category</a>
                    <br>
                    <br>
                    <div class="form-group">
                        <label for="images">Images</label>  
                        <input type="file" name="images[]" id="images" class="form-control" multiple>
                        <!-- <div id="image_preview"></div> -->
                    </div>
                    <!-- edit form buttons -->
                    <!-- cancel -->
                    <div class="form-group">
                        <a href="#" data-dismiss="modal" class="btn btn-danger btn-block">Cancel</a>
                    </div>
                    <!-- preview -->
                    <div class="form-group">
                        <a href="/products/show/<?= $product['id'] ?>" class="btn btn-success btn-block">Preview</a>
                    </div>
                    <!-- update -->
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
<!-- Delete Product Modal -->
<div class="modal fade text-dark" id="deleteModal<?= $product['id']?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle">Delete Product - ID <?= $product['id'] ?></h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <h3>Are you sure you want to delete "<?= $product['product_name'] ?>"?</h3>
                <form action="/admins/delete/<?= $product['id']?>" method="post">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                    <input type="submit" class='btn btn-danger btn-block' value="Yes! I want to delete this">
                    <a href="#" data-dismiss="modal" class="btn btn-info btn-block">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
<?php } ?>