 <!-- Adjust the layout as per your project -->

<?php $__env->startSection('content'); ?>
    <h1>Orders</h1>

    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Products</th>
                <th>Subtotal Price</th>
                <th>Tax</th>
                <th>Shipping Cost</th>
                <th>Total Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($order->customer_name); ?></td>
                    <td>
                        <ul>
                            <?php
                                $products = json_decode($order->products_name, true); // Decode as associative array
                            ?>
                            <?php if(is_array($products)): ?>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <?php echo e($product['quantity']); ?> x <?php echo e($product['name']); ?> 
                                        - $<?php echo e(number_format($product['quantity'] * $product['price'], 2)); ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <li>N/A</li>
                            <?php endif; ?>
                        </ul>
                    </td>
                    <td>$<?php echo e(number_format($order->subtotal_price, 2)); ?></td>
                    <td>$<?php echo e(number_format($order->tax, 2)); ?></td>
                    <td>$<?php echo e(number_format($order->shipping_cost, 2)); ?></td>
                    <td>$<?php echo e(number_format($order->total_price, 2)); ?></td>
                    <td><?php echo e(ucfirst($order->status)); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Bijoy Dey\Laravel\jojobi\resources\views/adminBackend/orders/index.blade.php ENDPATH**/ ?>