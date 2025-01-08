 <!-- Adjust the layout as per your project -->

<?php $__env->startSection('content'); ?>

    <h1>All Orders</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Order Number</th>
                <th>Customer Name</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($order->order_number); ?></td>
                    <td><?php echo e($order->customer_name ?? 'N/A'); ?></td>
                    <td>$<?php echo e(number_format($order->total_price, 2)); ?></td>
                    <td>
                        <span class="badge bg-<?php echo e($order->status === 'processed' ? 'success' : 'warning'); ?>">
                            <?php echo e(ucfirst($order->status)); ?>

                        </span>
                    </td>
                    <td>
                        <a href="<?php echo e(route('orders.edit', $order->id)); ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="#" 
                           class="btn btn-success btn-sm"
                           onclick="return confirm('Are you sure you want to proceed this order?');">
                           Proceed
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center">No orders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        <?php echo e($orders->links()); ?>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Bijoy Dey\Laravel\jojobi\resources\views/adminBackend/orders/index.blade.php ENDPATH**/ ?>