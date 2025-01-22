<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Product Expiry Notifications</h2>

    <!-- Expired Products -->
    <?php if($expiredProducts->isEmpty()): ?>
        <p>No products have expired yet.</p>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Expired Products:</strong> The following products have already expired.
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Expiry Date</th>
                        <th>Price</th>
                        <th>Details</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $expiredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($product->product_name); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($product->expire_date)->format('d M, Y')); ?></td>
                        <td><?php echo e($product->sell_price); ?></td>
                        <td>
                            <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#productDetails<?php echo e($product->id); ?>" aria-expanded="false" aria-controls="productDetails<?php echo e($product->id); ?>">
                                View Details
                            </button>
                        </td>
                        <td>
                            <form method="POST" action="<?php echo e(route('notifications.index')); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="done_product_id" value="<?php echo e($product->id); ?>">
                                <button type="submit" class="btn btn-success">Done</button>
                            </form>
                        </td>
                    </tr>
                    <tr id="productDetails<?php echo e($product->id); ?>" class="collapse">
                        <td colspan="6">
                            <div class="product-info">
                                <h5>Product Details</h5>
                                <ul>
                                    <li><strong>Product Name:</strong> <?php echo e($product->product_name); ?></li>
                                    <li><strong>Description:</strong> <?php echo e($product->description); ?></li>
                                    <li><strong>Price:</strong> $<?php echo e($product->sell_price); ?></li>
                                    <li><strong>Expiry Date:</strong> <?php echo e(\Carbon\Carbon::parse($product->expire_date)->format('d M, Y')); ?></li>
                                </ul>

                                <!-- Supplier Details -->
                                <h5>Supplier Information</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Supplier Name</th>
                                            <th>Supplier ID</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo e($product->supplier->supplier_name); ?></td>
                                            <td><?php echo e($product->supplier->supplier_id); ?></td>
                                            <td><?php echo e($product->supplier->status); ?></td>
                                            <td>$<?php echo e($product->supplier->amount); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <!-- Expiring Today Products -->
    <?php if($todayExpiringProducts->isEmpty()): ?>
        <p>No products are expiring today.</p>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            <strong>Expiring Today:</strong> The following products are expiring today.
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Expiry Date</th>
                        <th>Price</th>
                        <th>Details</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $todayExpiringProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($product->product_name); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($product->expire_date)->format('d M, Y')); ?></td>
                        <td><?php echo e($product->sell_price); ?></td>
                        <td>
                            <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#productDetails<?php echo e($product->id); ?>" aria-expanded="false" aria-controls="productDetails<?php echo e($product->id); ?>">
                                View Details
                            </button>
                        </td>
                        <td>
                            <form method="POST" action="<?php echo e(route('notifications.index')); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="done_product_id" value="<?php echo e($product->id); ?>">
                                <button type="submit" class="btn btn-success">Done</button>
                            </form>
                        </td>
                    </tr>
                    <tr id="productDetails<?php echo e($product->id); ?>" class="collapse">
                        <td colspan="6">
                            <div class="product-info">
                                <h5>Product Details</h5>
                                <ul>
                                    <li><strong>Product Name:</strong> <?php echo e($product->product_name); ?></li>
                                    <li><strong>Description:</strong> <?php echo e($product->description); ?></li>
                                    <li><strong>Price:</strong> $<?php echo e($product->sell_price); ?></li>
                                    <li><strong>Expiry Date:</strong> <?php echo e(\Carbon\Carbon::parse($product->expire_date)->format('d M, Y')); ?></li>
                                </ul>

                                <!-- Supplier Details -->
                                <h5>Supplier Information</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Supplier Name</th>
                                            <th>Supplier ID</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo e($product->supplier->supplier_name); ?></td>
                                            <td><?php echo e($product->supplier->supplier_id); ?></td>
                                            <td><?php echo e($product->supplier->status); ?></td>
                                            <td>$<?php echo e($product->supplier->amount); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <!-- Products Expiring in the Next 7 Days -->
    <?php if($productsExpiringSoon->isEmpty()): ?>
        <p>No products are expiring in the next 7 days.</p>
    <?php else: ?>
        <div class="alert alert-info" role="alert">
            <strong>Expiring Soon:</strong> The following products will expire in the next 7 days.
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Expiry Date</th>
                        <th>Price</th>
                        <th>Details</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $productsExpiringSoon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($product->product_name); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($product->expire_date)->format('d M, Y')); ?></td>
                        <td><?php echo e($product->sell_price); ?></td>
                        <td>
                            <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#productDetails<?php echo e($product->id); ?>" aria-expanded="false" aria-controls="productDetails<?php echo e($product->id); ?>">
                                View Details
                            </button>
                        </td>
                        <td>
                            <form method="POST" action="<?php echo e(route('notifications.index')); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="done_product_id" value="<?php echo e($product->id); ?>">
                                <button type="submit" class="btn btn-success">Done</button>
                            </form>
                        </td>
                    </tr>
                    <tr id="productDetails<?php echo e($product->id); ?>" class="collapse">
                        <td colspan="6">
                            <div class="product-info">
                                <h5>Product Details</h5>
                                <ul>
                                    <li><strong>Product Name:</strong> <?php echo e($product->product_name); ?></li>
                                    <li><strong>Description:</strong> <?php echo e($product->description); ?></li>
                                    <li><strong>Price:</strong> $<?php echo e($product->sell_price); ?></li>
                                    <li><strong>Expiry Date:</strong> <?php echo e(\Carbon\Carbon::parse($product->expire_date)->format('d M, Y')); ?></li>
                                </ul>

                                <!-- Supplier Details -->
                                <h5>Supplier Information</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Supplier Name</th>
                                            <th>Supplier ID</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo e($product->supplier->supplier_name); ?></td>
                                            <td><?php echo e($product->supplier->supplier_id); ?></td>
                                            <td><?php echo e($product->supplier->status); ?></td>
                                            <td>$<?php echo e($product->supplier->amount); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/notifications/index.blade.php ENDPATH**/ ?>