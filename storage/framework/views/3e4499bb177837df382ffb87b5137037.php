<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Upload Shop Logo</h1>

        <!-- Display validation errors -->
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('shop_logos.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="name">Shop Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name')); ?>" required>
            </div>

            <div class="form-group">
                <label for="image">Logo Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>

            <!-- Hidden field for uploaded_by (autofilled with the logged-in user's name) -->
            <input type="hidden" name="uploaded_by" value="<?php echo e(Auth::user()->name); ?>">

            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea class="form-control" id="notes" name="notes"><?php echo e(old('notes')); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Upload Logo</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/shoplogos/create.blade.php ENDPATH**/ ?>