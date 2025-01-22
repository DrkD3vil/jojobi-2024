

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Supplier List</h1>
    <a href="<?php echo e(route('suppliers.create')); ?>" class="btn btn-primary mb-3">Add Supplier</a>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Supplier Name</th>
                <th>Barcode</th>
                <th>Amount</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($supplier->supplier_id); ?></td>
                    <td><?php echo e($supplier->supplier_name); ?></td>
                    <td><?php echo e($supplier->supplier_barcode); ?></td>
                    <td><?php echo e($supplier->amount); ?></td>
                    <td><?php echo e($supplier->paid); ?></td>
                    <td><?php echo e($supplier->due); ?></td>
                    <td><?php echo e($supplier->status); ?></td>
                    <td>
                        <a href="<?php echo e(route('suppliers.show', $supplier->uuid)); ?>" class="btn btn-info btn-sm">View</a>
                        <a href="<?php echo e(route('suppliers.edit', $supplier->uuid)); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?php echo e(route('suppliers.destroy', $supplier->uuid)); ?>" method="POST" style="display: inline-block;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <?php echo e($suppliers->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/suppliers/index.blade.php ENDPATH**/ ?>