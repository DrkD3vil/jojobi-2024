<tr id="cartItem-<?php echo e($id); ?>">
    <!-- Debugging with dd($item) if needed -->
    

    <td><?php echo e($item['product_barcode']); ?></td> <!-- Use [] for arrays -->
    <td><img src="<?php echo e(asset('baackend_images/' . $item['product_image'])); ?>" alt="Product Image" width="50"></td>
    <td><?php echo e($item['product_name']); ?></td>
    <td>
        <input type="number" class="form-control quantity-input" data-id="<?php echo e($id); ?>" value="<?php echo e($item['quantity']); ?>" min="1">
    </td>
    <td><?php echo e($item['category_name']); ?></td>
    <td>$<?php echo e(number_format($item['price'], 2)); ?></td>
    <td>
        <button type="button" class="btn btn-danger remove-cart-item" data-id="<?php echo e($id); ?>">Remove</button>
    </td>
</tr><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/pos/cart_row.blade.php ENDPATH**/ ?>