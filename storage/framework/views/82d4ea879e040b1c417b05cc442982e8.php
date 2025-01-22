<?php $__env->startSection('content'); ?>
    
        <h1>Invoices</h1>

        <!-- Display the invoices in a table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Invoice ID</th>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Paid Amount</th>
                    <th>Payment Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($invoice->invoice_id); ?></td>
                        <td><?php echo e($invoice->order_id); ?></td>
                        <td><?php echo e($invoice->customer->name); ?></td>
                        <td><?php echo e(number_format($invoice->total, 2)); ?></td>
                        <td><?php echo e(number_format($invoice->paid_amount, 2)); ?></td>
                        <td><?php echo e($invoice->payment_status); ?></td>
                        <td>
                            <a href="<?php echo e(route('invoices.show', $invoice->id)); ?>" class="btn btn-primary">View</a>
                            <!-- Add more action buttons as needed -->
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <!-- Pagination links -->
        <?php echo e($invoices->links()); ?>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/invoices/index.blade.php ENDPATH**/ ?>