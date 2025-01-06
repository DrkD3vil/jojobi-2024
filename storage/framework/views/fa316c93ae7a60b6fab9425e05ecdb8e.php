

<?php $__env->startSection('content'); ?>
    <div class="container" style="max-width:800px; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
        <h1 class="text_cat" style="margin-bottom: 30px; text-align: center; font-weight: 700; font-size: 28px; color: #333;">Edit Category</h1>
        <form action="<?php echo e(route('category.update', $data->uuid)); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
        
            <!-- Category Name -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="category_name" style="font-weight: bold;">Category Name</label>
                <input id="category_name" type="text" name="category_name" value="<?php echo e(old('category_name', $data->category_name)); ?>" class="form-control" required>
                <?php if($errors->has('category_name')): ?>
                    <span class="text-danger"><?php echo e($errors->first('category_name')); ?></span>
                <?php endif; ?>
            </div>
        
            <!-- Barcode -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="category_barcode" style="font-weight: bold;">Barcode</label>
                <input id="category_barcode" type="text" name="category_barcode" value="<?php echo e(old('category_barcode', $data->category_barcode)); ?>" class="form-control" required>
                <?php if($errors->has('category_barcode')): ?>
                    <span class="text-danger"><?php echo e($errors->first('category_barcode')); ?></span>
                <?php endif; ?>
            </div>
        
            <!-- Description -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="category_description" style="font-weight: bold;">Description</label>
                <textarea id="category_description" name="category_description" class="form-control" rows="3"><?php echo e(old('category_description', $data->category_description)); ?></textarea>
                <?php if($errors->has('category_description')): ?>
                    <span class="text-danger"><?php echo e($errors->first('category_description')); ?></span>
                <?php endif; ?>
            </div>
        
            <!-- Image Upload -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="category_image" style="font-weight: bold;">Category Image</label>
                <input id="category_image" type="file" name="category_image" class="form-control-file">
                <?php if($data->category_image): ?>
                    <p>Current Image:</p>
                    <img src="<?php echo e(asset('baackend_images/' . $data->category_image)); ?>" alt="Category Image" style="width: 100px; height: 100px; object-fit: cover; margin-top: 10px;">
                    <p>Uploading a new image will replace the current one.</p>
                <?php endif; ?>
                <?php if($errors->has('category_image')): ?>
                    <span class="text-danger"><?php echo e($errors->first('category_image')); ?></span>
                <?php endif; ?>
            </div>
        
            <!-- Submit Button -->
            <div class="form-group" style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary">Update Category</button>
            </div>
        </form>
        
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Bijoy Dey\Laravel\jojobi\resources\views/adminBackend/categories/edit_category.blade.php ENDPATH**/ ?>