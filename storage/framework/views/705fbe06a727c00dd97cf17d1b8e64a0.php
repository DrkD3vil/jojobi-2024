


<?php $__env->startSection('content'); ?>


<div class="container">
    <h1>Transaction for Order #<?php echo e($order->order_number); ?></h1>

    <form action="<?php echo e(route('transactions.store', $order->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div>
            <label for="payment_method">Payment Method:</label>
            <select name="payment_method" id="payment_method" required>
                <option value="cash">Cash</option>
                <option value="credit_card">Credit Card</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>
        </div>

        <div>
            <label for="amount_paid">Amount Paid:</label>
            <input type="number" name="amount_paid" id="amount_paid" required step="0.01" min="0"
                   value="<?php echo e($order->total_price); ?>">
        </div>

        <button type="submit" class="btn btn-success">Complete Transaction</button>
    </form>

    <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-primary">Back to Orders</a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Bijoy Dey\Laravel\jojobi\resources\views/adminBackend/transactions/create.blade.php ENDPATH**/ ?>