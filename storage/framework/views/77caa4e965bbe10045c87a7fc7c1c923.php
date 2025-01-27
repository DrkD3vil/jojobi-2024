

<?php $__env->startSection('title', 'Add New Product'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Add New Product</h2>

    <!-- Form for adding a new product -->
    <form action="<?php echo e(route('products.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <!--Product Barcode -->
        

<!-- Barcode -->
<div class="form-group">
    <label for="product_barcode" class="font-weight-bold">Barcode:</label>
    <input type="text" id="product_barcode" name="product_barcode"
        placeholder="Enter or generate barcode" class="form-control" value="<?php echo e(old('product_barcode')); ?>" required>
    <button type="button" id="generate-barcode-btn"
        class="btn btn-secondary mt-2">Generate</button>
    <small id="barcode-status" style="color: red;"></small>
</div>

<!-- Product Name -->
<div class="form-group">
    <label for="name">Product Name</label>
    <input type="text" name="name" id="name" class="form-control" value="<?php echo e(old('name')); ?>" required>
    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Product Description -->
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" class="form-control" rows="4"><?php echo e(old('description')); ?></textarea>
    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Original Price -->
<div class="form-group">
    <label for="original_price">Original Price</label>
    <input type="number" name="original_price" id="original_price" class="form-control" value="<?php echo e(old('original_price')); ?>" step="0.01" required>
    <?php $__errorArgs = ['original_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Buy Price -->
<div class="form-group">
    <label for="buy_price">Buy Price</label>
    <input type="number" name="buy_price" id="buy_price" class="form-control" value="<?php echo e(old('buy_price')); ?>" step="0.01" required>
    <?php $__errorArgs = ['buy_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Sell Price -->
<div class="form-group">
    <label for="sell_price">Sell Price</label>
    <input type="number" name="sell_price" id="sell_price" class="form-control" value="<?php echo e(old('sell_price')); ?>" step="0.01" required>
    <?php $__errorArgs = ['sell_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Discount Percentage -->
<div class="form-group">
    <label for="discount_percentage">Discount Percentage</label>
    <input type="number" name="discount_percentage" id="discount_percentage" class="form-control" value="<?php echo e(old('discount_percentage')); ?>" step="0.01" max="100">
    <?php $__errorArgs = ['discount_percentage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Discounted Price -->
<div class="form-group">
    <label for="discounted_price">Discounted Price</label>
    <input type="number" name="discounted_price" id="discounted_price" class="form-control" value="<?php echo e(old('discounted_price')); ?>" step="0.01">
    <?php $__errorArgs = ['discounted_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Category -->
<div class="form-group">
    <label for="category_id">Category</label>
    <select name="category_id" id="category_id" class="form-control" required>
        <option value="">Select Category</option>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>>
            <?php echo e($category->category_name); ?>

        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Supplier -->
<div class="form-group">
    <label for="supplier_id">Supplier</label>
    <select name="supplier_id" id="supplier_id" class="form-control" required>
        <option value="">Select Supplier</option>
        <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($supplier->id); ?>" <?php echo e(old('supplier_id') == $supplier->id ? 'selected' : ''); ?>>
            <?php echo e($supplier->supplier_name); ?>

        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Stock Quantity -->
<div class="form-group">
    <label for="stock_quantity">Stock Quantity</label>
    <input type="number" name="stock_quantity" id="stock_quantity" class="form-control" value="<?php echo e(old('stock_quantity')); ?>" required>
    <?php $__errorArgs = ['stock_quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Brand -->
<div class="form-group">
    <label for="brand">Brand</label>
    <input type="text" name="brand" id="brand" class="form-control" value="<?php echo e(old('brand')); ?>">
    <?php $__errorArgs = ['brand'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Product Image -->
<div class="form-group">
    <label for="image">Product Image</label>
    <input type="file" name="image" id="image" class="form-control-file">
    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Product Type -->
<div class="form-group">
    <label for="product_type">Product Type</label>
    <input type="text" name="product_type" id="product_type" class="form-control" value="<?php echo e(old('product_type')); ?>">
    <?php $__errorArgs = ['product_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Manufacture Date -->
<div class="form-group">
    <label for="manufacture_date">Manufacture Date</label>
    <input type="date" name="manufacture_date" id="manufacture_date" class="form-control" value="<?php echo e(old('manufacture_date')); ?>">
    <?php $__errorArgs = ['manufacture_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Expire Date -->
<div class="form-group">
    <label for="expire_date">Expire Date</label>
    <input type="date" name="expire_date" id="expire_date" class="form-control" value="<?php echo e(old('expire_date')); ?>">
    <?php $__errorArgs = ['expire_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Dimensions and Weight -->
<div class="form-row">
    <div class="form-group col-md-3">
        <label for="weight">Weight</label>
        <input type="number" name="weight" id="weight" class="form-control" value="<?php echo e(old('weight')); ?>" step="0.01">
    </div>
    <div class="form-group col-md-3">
        <label for="length">Length</label>
        <input type="number" name="length" id="length" class="form-control" value="<?php echo e(old('length')); ?>" step="0.01">
    </div>
    <div class="form-group col-md-3">
        <label for="width">Width</label>
        <input type="number" name="width" id="width" class="form-control" value="<?php echo e(old('width')); ?>" step="0.01">
    </div>
    <div class="form-group col-md-3">
        <label for="height">Height</label>
        <input type="number" name="height" id="height" class="form-control" value="<?php echo e(old('height')); ?>" step="0.01">
    </div>
</div>

<!-- Featured and Active Status -->
<div class="form-group">
    <label for="is_featured">Featured Product</label>
    <input type="checkbox" name="is_featured" id="is_featured" value="1" <?php echo e(old('is_featured') ? 'checked' : ''); ?>>
</div>

<div class="form-group">
    <label for="is_active">Active</label>
    <input type="checkbox" name="is_active" id="is_active" value="1" <?php echo e(old('is_active') ? 'checked' : ''); ?>>
</div>

<!-- Submit Button -->
<button type="submit" class="btn btn-primary">Add Product</button>
</form>
</div>


<!-- Include jQuery and Toastr scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        // Generate Barcode
        $('#generate-barcode-btn').click(function() {
            $.ajax({
                url: '/generate-barcode', // Backend route for generating barcode
                method: 'GET',
                success: function(response) {
                    if (response.barcode) {
                        // Populate the barcode field with the generated value
                        $('#product_barcode').val(response.barcode);

                        // Display a success message using Toastr
                        toastr.success('Barcode generated successfully!');
                    } else {
                        // Handle unexpected errors with Toastr
                        toastr.error('Error: Barcode could not be generated');
                    }

                    // Optionally display a status message in the small element
                    $('#barcode-status')
                        .text('Barcode generated successfully')
                        .css('color', 'green');
                },
                error: function(xhr, status, error) {
                    // Display an error message using Toastr if the AJAX request fails
                    toastr.error('Error generating barcode: ' + xhr.responseText);

                    // Optionally display the error status message in the small element
                    $('#barcode-status')
                        .text('Error generating barcode: ' + xhr.responseText)
                        .css('color', 'red');
                }
            });
        });
    });
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/products/add-product.blade.php ENDPATH**/ ?>