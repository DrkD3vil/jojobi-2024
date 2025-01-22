

<?php $__env->startSection('content'); ?>
    <h1>All Transactions</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Amount History</th>
                <th>Total Amount</th>
                <th>Payment Status</th>
                <th>Transaction Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($transaction->transaction_id); ?></td>
                    <td><?php echo e($transaction->order->order_id ?? 'N/A'); ?></td>
                    <td><?php echo e($transaction->customer->name ?? 'N/A'); ?></td>
                    <td>
                       Due:: <?php echo e($transaction->customer_due); ?> <br>
                       Advance:: <?php echo e($transaction->customer_advance); ?>

                    </td>
                    
                    <td>$<?php echo e(number_format($transaction->total_amount, 2)); ?></td>
                    <td><?php echo e(ucfirst($transaction->payment_status)); ?></td>
                    <td><?php echo e($transaction->transaction_date->format('Y-m-d H:i:s')); ?></td>
                    <td>
                        <!-- Show Details button -->
                        <button class="btn btn-info" onclick="toggleDetails('<?php echo e($transaction->id); ?>')">Details</button>

                        <!-- Show Proceed button only if payment status is Pending or Failed -->
                        <?php if($transaction->payment_status == 'pending' || $transaction->payment_status == 'failed'): ?>
                        <?php if($transaction->order): ?>
    <a href="<?php echo e(route('carts.edit', $transaction->order->cart_id)); ?>">
        <button class="btn btn-primary">Proceed</button>
    </a>
<?php else: ?>
    <span class="text-danger">Order not found</span>
<?php endif; ?>
                        <?php else: ?>
                            <!-- Hide Proceed button if the payment status is Completed -->
                            <a style="display:none;" 
   href="<?php echo e($transaction->order ? route('carts.edit', $transaction->order->cart_id) : '#'); ?>">
   Proceed
</a>
                        <?php endif; ?>
                    </td>

                </tr>

                <!-- Order and Customer Details Dropdown -->
                <tr id="details-<?php echo e($transaction->id); ?>" style="display: none;">
                    <td colspan="7">
                        <h4>Order Details</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Order Total</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>
    <?php if($transaction->order): ?>
        <?php echo e($transaction->order->order_id); ?>

    <?php else: ?>
        <span class="text-danger">Order not found</span>
    <?php endif; ?>
</td>
<td>
    <?php if($transaction->order && $transaction->order->round_total): ?>
        $<?php echo e(number_format($transaction->order->round_total, 2)); ?>

    <?php else: ?>
        <span class="text-danger">Amount not available</span>
    <?php endif; ?>
</td>
<td>
    <?php if($transaction->order && $transaction->order->created_at): ?>
        <?php echo e($transaction->order->created_at->format('Y-m-d H:i:s')); ?>

    <?php else: ?>
        <span class="text-danger">Date not available</span>
    <?php endif; ?>
</td>
                                </tr>
                            </tbody>
                        </table>

                        <h4>Customer Details</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Barcode</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo e($transaction->customer->name); ?></td>
                                    <td><?php echo e($transaction->customer->phone); ?></td>
                                    <td><?php echo e($transaction->customer->barcode_number); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <script>
        function toggleDetails(transactionId) {
            const detailsRow = document.getElementById(`details-${transactionId}`);
            detailsRow.style.display = detailsRow.style.display === 'none' ? 'table-row' : 'none';
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/transactions/index.blade.php ENDPATH**/ ?>