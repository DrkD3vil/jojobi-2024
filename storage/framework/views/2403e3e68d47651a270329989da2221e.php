<?php $__env->startSection('content'); ?>
<div class="container">
    <h1><?php echo e($userdata->name); ?> Details</h1>

    <div class="card">
        <div class="card-header">
            <?php echo e($userdata->name); ?>

        </div>
        <div class="card-body">
            <p><strong>Email:</strong> <?php echo e($userdata->email); ?></p>
            <p><strong>Phone:</strong> <?php echo e($userdata->phone ?? 'N/A'); ?></p>
            <p><strong>Role:</strong> <?php echo e(ucfirst($userdata->role ?? 'N/A')); ?></p>
            <p><strong>Status:</strong> <?php echo e($userdata->status ? 'Active' : 'Inactive'); ?></p>
            <p><strong>Address:</strong> <?php echo e($userdata->address ?? 'N/A'); ?></p>
            <p><strong>Profile Image:</strong></p>
            <img src="<?php echo e(asset($userdata->profile_image)); ?>" alt="Profile Image" width="150">

            <a href="<?php echo e(route('users.index')); ?>" class="btn btn-primary mt-3">Back</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/users/show.blade.php ENDPATH**/ ?>