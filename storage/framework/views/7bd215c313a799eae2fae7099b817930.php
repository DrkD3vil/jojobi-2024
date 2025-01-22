

<?php $__env->startSection('content'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* General Styling */
        body {
            font-family: 'Helvetica Neue', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        .justify_data {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 20px;
            background-color: transparent;
            border-radius: 10px;
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);
            color: rgb(0, 0, 0);
            font-weight: bold;
            font-size: 22px;
            text-align: center;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        .container h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #666;
            margin-bottom: 6px;
            text-align: left;
            width: 100%;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            padding: 14px;
            margin-bottom: 20px;
            width: 100%;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #3a99d9;
            outline: none;
            box-shadow: 0 0 8px rgba(58, 153, 217, 0.3);
        }

        button {
            padding: 14px;
            background-color: #3a99d9;
            color: #fff;
            font-size: 16px;
            width: 100%;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #258bbd;
        }

        button:active {
            background-color: #1b6f91;
        }

        .right_side {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        .search-bar {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 20px;
        }

        .search-bar input {
            padding: 12px;
            width: 75%;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        .search-bar button {
            padding: 12px;
            background-color: #3a99d9;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-bar button:hover {
            background-color: #258bbd;
        }

        .related_product_cards {
            margin-top: 20px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card img {
            width: 100%;
            border-radius: 8px;
            max-height: 150px;
            object-fit: cover;
        }

        .card h3 {
            font-size: 18px;
            color: #333;
            margin: 10px 0;
        }

        .card p {
            font-size: 14px;
            color: #888;
        }

        .card .price {
            font-size: 16px;
            color: #3a99d9;
            font-weight: bold;
            margin-top: 10px;
        }

        .table-data {
            margin: 40px auto;
            width: 80%;
            max-width: 1200px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #3a99d9;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #f9f9f9;
            border-bottom: 1px solid #ddd;
        }

        td button {
            padding: 8px 12px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        td button:hover {
            background-color: #d32f2f;
        }

        td button:active {
            background-color: #c62828;
        }
    </style>

<h1>All Carts</h1>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<h2>Cart Details</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Cart ID</th>
            <th>UUID</th>
            <th>Status</th>
            <th>Subtotal Price</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr id="cart-row-<?php echo e($cart->cart_id); ?>">
                <td><?php echo e($cart->cart_id); ?></td>
                <td><?php echo e($cart->uuid); ?></td>
                <td><?php echo e($cart->status); ?></td>
                <td>$<?php echo e(number_format($cart->subtotal_price, 2)); ?></td>
                <td><?php echo e($cart->created_at->format('Y-m-d H:i:s')); ?></td>
                <td>
                    <div class="btn-sty" style="display:flex; justify-content:space-around; gap:1rem; text-decoration:none;">
                        <button type="button" class="btn btn-info" onclick="toggleItems('<?php echo e($cart->cart_id); ?>')">Show Items</button>
                    <a href="<?php echo e(route('carts.edit', $cart->cart_id)); ?>"><button type="button" class="btn btn-primary">edit</button></a>
                    <button type="button" class="btn btn-primary">Proceed</button>
                    </div>
                </td>
            </tr>

            <!-- Cart Items Dropdown (Initially Hidden) -->
            <tr id="cart-items-<?php echo e($cart->cart_id); ?>" style="display: none;">
                <td colspan="6">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Barcode</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Category Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->product_id); ?></td>
                                    <td><?php echo e($item->product_barcode); ?></td>
                                    <td><?php echo e($item->product_name); ?></td>
                                    <td><img src="<?php echo e(asset('baackend_images/' . $item->product_image)); ?>" alt="<?php echo e($item->product_name); ?>" width="50"></td>
                                    <td><?php echo e($item->category_name ?? 'No Category'); ?></td>
                                    <td><?php echo e($item->quantity); ?></td>
                                    <td>$<?php echo e(number_format($item->price, 2)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<script>
    function toggleItems(cartId) {
        // Get the cart items row
        var itemsRow = document.getElementById('cart-items-' + cartId);
        
        // Toggle the display of the cart items row
        if (itemsRow.style.display === 'none' || itemsRow.style.display === '') {
            itemsRow.style.display = 'table-row';
        } else {
            itemsRow.style.display = 'none';
        }
    }
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/pos/show.blade.php ENDPATH**/ ?>