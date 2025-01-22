

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Supplier Details</h1>

    <table class="table">
        <tr>
            <th>ID:</th>
            <td><?php echo e($supplier->supplier_id); ?></td>
        </tr>
        <tr>
            <th>Supplier Name:</th>
            <td><?php echo e($supplier->supplier_name); ?></td>
        </tr>
        <tr>
            <th>Barcode:</th>
            <td><?php echo e($supplier->supplier_barcode); ?></td>
        </tr>
        <tr>
            <th>Amount:</th>
            <td><?php echo e($supplier->amount); ?></td>
        </tr>
        <tr>
            <th>Paid:</th>
            <td><?php echo e($supplier->paid); ?></td>
        </tr>
        <tr>
            <th>Due:</th>
            <td><?php echo e($supplier->due); ?></td>
        </tr>
        <tr>
            <th>Status:</th>
            <td><?php echo e($supplier->status); ?></td>
        </tr>
        <tr>
            <th>Created At:</th>
            <td><?php echo e($supplier->created_at); ?></td>
        </tr>
        <tr>
            <th>Updated At:</th>
            <td><?php echo e($supplier->updated_at); ?></td>
        </tr>
    </table>

    <a href="<?php echo e(route('suppliers.index')); ?>" class="btn btn-secondary">Back</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/suppliers/show.blade.php ENDPATH**/ ?>