<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($item->id); ?></td>
        <td><?php echo e($item->categoryid); ?></td>
        <td><?php echo e($item->category_name); ?></td>
        <td><?php echo e($item->category_barcode); ?></td>
        <td>
            <?php if($item->category_image): ?>
                <img src="<?php echo e(asset('baackend_images//' . $item->category_image)); ?>"
                     alt="<?php echo e($item->category_name); ?>"
                     style="width: 50px; height: 50px; object-fit: cover;">
            <?php else: ?>
                No Image
            <?php endif; ?>
        </td>
        <td><?php echo e(\Carbon\Carbon::parse($item->created_at)->format('F d, Y')); ?></td>
        <td>
            <a class="btn btn-success" href="<?php echo e(route('category.edit', $item->uuid)); ?>">Edit</a>
            <a class="btn btn-danger" onclick="confirmation(event)"
               href="<?php echo e(route('category.delete', $item->uuid)); ?>">Delete</a>
            <a class="btn btn-success" href="<?php echo e(route('category.singleView', $item->uuid)); ?>">View</a>
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/categories/table_rows.blade.php ENDPATH**/ ?>