<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Shop Logos</h1>

        <!-- Button to add a new logo -->
        <a href="<?php echo e(route('shop_logos.create')); ?>" class="btn btn-success mb-3">Add Logo</a>

        <!-- Display success message -->
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Display the shop logos in a table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>UUID</th>
                    <th>Name</th>
                    <th>Logo Image</th>
                    <th>Uploaded By</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $shopLogos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($logo->uuid); ?></td>
                        <td><?php echo e($logo->name); ?></td>
                        <td><img src="<?php echo e(asset($logo->image)); ?>" alt="<?php echo e($logo->name); ?>" width="100"></td>
                        <td><?php echo e($logo->uploaded_by); ?></td>
                        <td><?php echo e($logo->notes); ?></td>
                        <td>
                            <!-- View Button -->
                            <a href="<?php echo e(route('shop_logos.show', $logo->uuid)); ?>" class="btn btn-primary">View</a>
                            
                            <!-- Edit Button -->
                            <a href="<?php echo e(route('shop_logos.edit', $logo->uuid)); ?>" class="btn btn-warning">Edit</a>
                            
                            <!-- Delete Button with Confirmation -->
                            <form action="<?php echo e(route('shop_logos.destroy', $logo->uuid)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this logo?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <!-- Pagination links -->
        <?php echo e($shopLogos->links()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/shoplogos/index.blade.php ENDPATH**/ ?>