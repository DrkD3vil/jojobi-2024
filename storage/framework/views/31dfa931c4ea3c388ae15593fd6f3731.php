<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #f8f9fa;
            padding: 10px 20px;
            text-align: center;
            font-size: 0.8rem;
            border-top: 1px solid #ddd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            /* Adjust font size for better fitting */
            table-layout: fixed;
            /* Ensure columns have equal widths */
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 6px;
            /* Reduce padding to fit content */
            text-align: center;
            vertical-align: middle;
            word-wrap: break-word;
            /* Wrap text within cells */
        }

        table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .product-image {
            max-width: 100px;
            /* Adjust width to your desired size */
            max-height: 80px;
            /* Adjust height to your desired size */
            object-fit: cover;
            /* Ensure the image maintains aspect ratio and fits within the bounds */
            /* border: 1px solid #ddd; */
            /* Optional: Add a border for better visibility */
            padding: 2px;
            /* Optional: Add padding for a cleaner look */
        }

        @page {
            size: A4 landscape;
            /* Set page size to landscape */
            margin: 20px;
            /* Reduce margin to maximize content area */
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <h1>Product Catalog</h1>
        <p>Generated on: <?php echo e(\Carbon\Carbon::now()->format('F j, Y, g:i a')); ?></p>
    </header>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo e(date('Y')); ?> Your Company Name. All rights reserved.</p>
    </footer>

    <!-- Table Content -->
    <div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Brand</th>
                    <th>Category Barcode</th>
                    <th>Product Type</th>
                    <th>Product Barcode</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($index + 1); ?></td>
                        <td>
                            <img src="<?php echo e($product->image_path); ?>" alt="<?php echo e($product->name); ?>" class="product-image">
                        </td>
                        <td><?php echo e($product->name); ?></td>
                        <td><?php echo e($product->description ?? 'N/A'); ?></td>
                        <td>$<?php echo e(number_format($product->sell_price, 2)); ?></td>
                        <td><?php echo e($product->stock_quantity); ?></td>
                        <td><?php echo e($product->brand); ?></td>
                        <td>
                            <img src="<?php echo e($product->category_barcode_image_path); ?>"
                                alt="<?php echo e($product->category_barcode); ?>" class="product-image">

                        </td>
                        <td><?php echo e($product->product_type); ?></td>
                        <td>
                            <img src="<?php echo e($product->barcode_image_path); ?>" alt="<?php echo e($product->product_barcode); ?>"
                                class="product-image">
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</body>

</html>
<?php /**PATH E:\Bijoy Dey\Laravel\jojobi\resources\views/adminBackend/products/pdf.blade.php ENDPATH**/ ?>