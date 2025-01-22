


<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Edit Supplier</h1>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('suppliers.update', $supplier->uuid)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="form-group">
            <label for="supplier_name">Supplier Name</label>
            <input type="text" name="supplier_name" id="supplier_name" class="form-control" value="<?php echo e($supplier->supplier_name); ?>" required>
        </div>
        <div class="form-group">
            <label for="supplier_barcode">Barcode</label>
            <input type="text" name="supplier_barcode" id="supplier_barcode" class="form-control" value="<?php echo e($supplier->supplier_barcode); ?>" required>
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" value="<?php echo e($supplier->amount); ?>">
        </div>
        <div class="form-group">
            <label for="paid">Paid</label>
            <input type="number" name="paid" id="paid" class="form-control" value="<?php echo e($supplier->paid); ?>">
        </div>
        <div class="form-group">
            <label for="due">Due</label>
            <input type="number" name="due" id="due" class="form-control" value="<?php echo e($supplier->due); ?>">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="active" <?php echo e($supplier->status == 'active' ? 'selected' : ''); ?>>Active</option>
                <option value="inactive" <?php echo e($supplier->status == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/suppliers/edit.blade.php ENDPATH**/ ?>