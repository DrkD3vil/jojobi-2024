<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Shop Logo Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo e($logo->name); ?></h5>
                <p><strong>Uploaded By:</strong> <?php echo e($logo->uploaded_by); ?></p>
                <p><strong>Notes:</strong> <?php echo e($logo->notes); ?></p>
                <p><strong>Logo Image:</strong></p>
                <img src="<?php echo e(asset($logo->image)); ?>" alt="<?php echo e($logo->name); ?>" width="200">

                <a href="<?php echo e(route('shop_logos.index')); ?>" class="btn btn-secondary mt-3">Back to List</a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/shopLogos/show.blade.php ENDPATH**/ ?>