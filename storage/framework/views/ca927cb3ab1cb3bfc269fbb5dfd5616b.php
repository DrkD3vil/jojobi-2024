


<?php $__env->startSection('title', 'Edit Product'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h2>Edit Product</h2>

        <form action="<?php echo e(route('products.update', $product->uuid)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('POST'); ?>
        
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo e($product->name); ?>" required>
            </div>
        
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4"><?php echo e($product->description); ?></textarea>
            </div>
        
            <div class="form-group">
                <label for="sell_price">Sell Price</label>
                <input type="number" name="sell_price" id="sell_price" class="form-control" value="<?php echo e($product->sell_price); ?>" step="0.01" required>
            </div>
        
            <div class="form-group">
                <label for="stock_quantity">Stock Quantity</label>
                <input type="number" name="stock_quantity" id="stock_quantity" class="form-control" value="<?php echo e($product->stock_quantity); ?>" required>
            </div>
        
            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" name="image" id="image" class="form-control-file">
                <?php if($product->image): ?>
                    <img src="<?php echo e(asset('baackend_images/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" style="width: 100px; height: 100px; margin-top: 10px;">
                <?php endif; ?>
            </div>
        
            <div class="form-group">
                <label for="product_barcode">Product Barcode</label>
                <input type="text" name="product_barcode" id="product_barcode" class="form-control" value="<?php echo e($product->product_barcode); ?>" required>
            </div>
        
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
        
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Bijoy Dey\Laravel\jojobi\resources\views/adminBackend/products/edit.blade.php ENDPATH**/ ?>