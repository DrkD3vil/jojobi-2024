 <!-- Adjust based on your layout -->

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Create Transaction</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('transactions.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <!-- Display order details -->
        <div class="mb-3">
            <h3>Order Details</h3>
            <p><strong>Order ID:</strong> <?php echo e($order->order_id); ?></p>
            <p><strong>UUID:</strong> <?php echo e($order->uuid); ?></p>
            <p><strong>Round Total:</strong> <?php echo e(number_format($order->round_total, 2)); ?></p>
        </div>

        <!-- Display customer details -->
        <div class="mb-3">
            <h3>Customer Details</h3>
            <p><strong>Name:</strong> <?php echo e($customer->name); ?></p>
            <p><strong>Barcode:</strong> <?php echo e($customer->barcode_number); ?></p>
            <p><strong>Due Amount:</strong> <?php echo e(number_format($customer->due_amount, 2)); ?></p>
            <p><strong>Advance Amount:</strong> <?php echo e(number_format($customer->advance_amount, 2)); ?></p>
        </div>

        <!-- Hidden inputs for necessary data -->
        <input type="hidden" name="order_id" value="<?php echo e($order->order_id); ?>">
        <input type="hidden" name="customer_barcode" value="<?php echo e($customer->barcode_number); ?>">
        <input type="hidden" name="transaction_date" value="<?php echo e(now()); ?>">

        <!-- Total amount -->
        <div class="form-group mb-3">
            <label for="total_amount">Total Amount</label>
            <input type="number" step="0.01" name="total_amount" id="total_amount" class="form-control" value="<?php echo e(number_format($totalAmount, 2)); ?>" readonly>
        </div>

        <!-- Payment status -->
        <div class="form-group mb-3">
            <label for="payment_status">Payment Status</label>
            <select name="payment_status" id="payment_status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="failed">Failed</option>
            </select>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Create Transaction</button>
    </form>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the values from the PHP variables
        let orderTotal = parseFloat("<?php echo e($order->round_total); ?>");
        let customerDueAmount = parseFloat("<?php echo e($customer->due_amount); ?>");
        let customerAdvanceAmount = parseFloat("<?php echo e($customer->advance_amount); ?>");

        // Calculate total amount based on conditions
        let totalAmount = orderTotal + customerDueAmount - customerAdvanceAmount;

        // Set the value in the total_amount input field
        document.getElementById('total_amount').value = totalAmount.toFixed(2);
    });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/transactions/create.blade.php ENDPATH**/ ?>