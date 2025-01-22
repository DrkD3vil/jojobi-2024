<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Edit Shop Logo</h1>

        <form action="<?php echo e(route('shop_logos.update', $logo->uuid)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group">
                <label for="name">Shop Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name', $logo->name)); ?>" required>
            </div>

            <div class="form-group">
                <label for="image">Logo Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea class="form-control" id="notes" name="notes"><?php echo e(old('notes', $logo->notes)); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Logo</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/shopLogos/edit.blade.php ENDPATH**/ ?>