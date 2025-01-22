<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Sales Report</h1>

    <!-- Date Filter Form -->
    <form method="GET" action="<?php echo e(route('admin.sales_report')); ?>" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo e(request('start_date')); ?>">
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="<?php echo e(request('end_date')); ?>">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <!-- Sales Report Table -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Product Name</th>
                    <th>Total Quantity Sold</th>
                    <th>Total Due</th>
                    <th>Total Advance</th>
                    <th>Total Sales</th>
                    <th>Total Profit</th>
                    <th>Total Completed Payment</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $salesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e(\App\Models\Product::find($data->product_id)->name ?? 'N/A'); ?></td>
                        <td><?php echo e($data->total_quantity); ?></td>
                        <td><?php echo e(number_format($data->total_due, 2)); ?></td>
                        <td><?php echo e(number_format($data->total_advance, 2)); ?></td>
                        <td><?php echo e(number_format($data->total_sales, 2)); ?></td>
                        <td><?php echo e(number_format($data->total_profit, 2)); ?></td>
                        <td><?php echo e(number_format($data->total_completed_payment, 2)); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center">No data available for the selected filters.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-4">
        <?php echo e($salesData->links('pagination::bootstrap-5')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/dashboard/sales_report.blade.php ENDPATH**/ ?>