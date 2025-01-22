<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Open Sans', Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #fff;
    }

    .invoice {
        width: 80mm;
        /* Set width to 80mm */
        padding: 10px;
        background-color: #fff;
        border: none;
        text-align: left;
        font-size: 10px;
        /* Adjust font size to fit */
        color: #333;
        box-sizing: border-box;
        /* Ensure padding doesn't affect width */
    }

    .invoice_logo {
        width: 60px;
        height: auto;
        margin-bottom: 5px;
        display: block;
        /* change to block to avoid any potential inline-block issues */
        margin-left: auto;
        /* this and the next line ensure the centering */
        margin-right: auto;
    }

    .qrcode {
        display: flex;
        justify-content: center;
        /* Centers the content horizontally */
        align-items: center;
        /* Centers the content vertically */
        margin-top: 10px;
        /* Adjust this value if you need more space above the QR code */
        margin-bottom: 10px;
        /* Adjust for spacing below the QR code */
    }

    .qrcode img {
        max-width: 20%;
        /* Ensures the image doesn't overflow the container */
        height: auto;
        /* Maintains the aspect ratio of the QR code */
    }

    .jojobi {
        font-size: 16px;
        font-weight: 700;
        color: #333;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .super_shop {
        font-size: 10px;
        font-weight: 400;
        color: #555;
        margin: 2px 0;
    }

    .shop_details {
        font-family: Arial, sans-serif;
        font-size: 10px;
        line-height: 1.4;
        color: #333;
        margin: 5px 0;
    }

    .shop_location,
    .shop_number {
        font-size: 10px;
        color: #000;
        text-align: center;
    }

    .invoice-barcode img {
        max-width: 40%;
        display: block;
        margin: 10px auto;
    }

    .customer_details {
        font-size: 10px;
        margin: 10px 0;
    }

    .customer_details div {
        display: flex;
        justify-content: space-between;
        width: 100%;
        padding: 3px 0;
    }

    .customer_details span:nth-child(odd) {
        font-weight: bold;
        color: #333;
    }

    .customer_details span:nth-child(even) {
        font-weight: normal;
        color: #555;
    }

    /* Table Styling */
    .invoice_table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .invoice_table th,
    .invoice_table td {
        padding: 5px;
        border: 1px solid #ddd;
        font-size: 10px;
        text-align: left;
    }

    .invoice_table thead {
        background-color: #f0f0f0;
    }

    .invoice_table tbody tr:hover {
        background-color: #f9f9f9;
    }

    .table_footer {
        display: flex;
        flex-direction: column;
        margin-top: 10px;
    }

    .footer_item {
        display: flex;
        justify-content: space-between;
        font-size: 10px;
        margin-bottom: 5px;
    }

    .footer_item span:nth-child(odd) {
        font-weight: bold;
        color: #333;
    }

    .footer_item span:nth-child(even) {
        font-weight: normal;
        color: #555;
    }

    .footer_item:last-child {
        font-weight: bold;
        color: #e63946;
        /* Red for the last item (Total) */
    }

    .footer {
    text-align: center;
    margin-top: 20px;
}

.footer-line {
    border: 0;
    border-top: 1px solid #ddd; /* Creates the horizontal line */
    margin-bottom: 10px; /* Adjust the space between the line and the message */
    width: 100%;
}

.thank-you-message {
    font-size: 14px;
    font-weight: bold;
    color: #333;
}

    /* Optional: Adjust for mobile responsiveness */
    @media print {
        body {
            margin: 0;
        }

        .invoice {
            width: 80mm;
            /* Ensure 80mm width for printing */
            padding: 10px;
            font-size: 10px;
        }

        .invoice_logo {
            width: 60px;
            margin-bottom: 5px;
        }

        .shop_details,
        .customer_details,
        .invoice_table,
        .table_footer {
            width: 100%;
            margin-bottom: 10px;
        }

        .footer_item {
            font-size: 10px;
            margin-bottom: 3px;
        }

        .footer_item span:nth-child(odd) {
            font-weight: bold;
        }
    }
</style>

<div class="invoice">
    <img src="<?php echo e(asset($logo->image)); ?>" alt="Logo" class="invoice_logo">
    <div class="shop_details">
        <div class="shop_location">JOJOBI mart PVT LTD.</div>
        <div class="shop_location">Krisna nanda Dham, Ghonar Para, Cox's Bazar.</div>
        <div class="shop_number">
            <span>Mobile:</span> 01827004074 | 01307094887
        </div>
    </div>

    <div class="customer_details">
        <div class="invoice-barcode">
            <img src="<?php echo e(asset($invoice->invoice_barcode_image)); ?>" alt="barcode">
        </div>
        <div class="invoice_no">
            <span>Invoice No</span> <span><?php echo e($invoice->invoice_id); ?></span>
        </div>
        <div class="date">
            <span>Date</span> <span><?php echo e($invoice->created_at); ?></span>
        </div>
        <div class="customer_name">
            <span>Bill By</span> <span><?php echo e($userName); ?></span>
        </div>
        <div class="customer_name">
            <span>Customer Name</span> <span><?php echo e($customerName); ?></span>
        </div>
        <div class="customer_number">
            <span>Customer Number</span> <span><?php echo e($customerPhone); ?></span>
        </div>
    </div>

    <table class="invoice_table">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $invoice->order->cartitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($item->product->name); ?></td>
                <td><?php echo e($item->quantity); ?></td>
                <td><?php echo e(number_format($item->product->sell_price, 2)); ?></td>
                <td><?php echo e(number_format($item->quantity * $item->product->sell_price, 2)); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="table_footer">
        <div class="footer_item">
            <span>Total Items</span>
            <span><?php echo e($invoice->order->cartitems->count()); ?></span>
        </div>
        <div class="footer_item">
            <span>SubTotal</span>
            <span>&#2547;<?php echo e($invoice->order->subtotal); ?></span>
        </div>

        <?php if($invoice->order->tax > 0): ?>
        <div class="footer_item">
            <span>Vat</span>
            <span>&#2547;<?php echo e($invoice->order->tax); ?></span>
        </div>
        <?php elseif($invoice->order->shipping_cost > 0): ?>
        <div class="footer_item">
            <span>Shipping Cost</span>
            <span>&#2547;<?php echo e($invoice->order->shipping_cost); ?></span>
        </div>
        <?php elseif($invoice->order->discount > 0): ?>
        <div class="footer_item">
            <span>Discount</span>
            <span><?php echo e($invoice->order->discount); ?> %</span>
        </div>
        <?php elseif($invoice->order->flat_discount > 0): ?>
        <div class="footer_item">
            <span>Flat Discount</span>
            <span>&#2547;<?php echo e($invoice->order->flat_discount); ?></span>
        </div>
        <?php endif; ?>

        <div class="footer_item">
            <span>Total</span>
            <span>&#2547;<?php echo e($invoice->payment->total_amount); ?></span>
        </div>
        <div class="footer_item">
            <span>Cash</span>
            <span>&#2547;<?php echo e($invoice->payment->payment_amount); ?></span>
        </div>

        <?php if($invoice->customer->due_amount != 0): ?>
        <div class="footer_item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span>Due</span>
            <span>&#2547;<?php echo e($invoice->customer->due_amount); ?></span>
        </div>
    <?php elseif($invoice->customer->advance_amount > 0): ?>
        <div class="footer_item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span>Change</span>
            <span>&#2547;<?php echo e($invoice->payment->change_amount); ?></span>
        </div>
        <div class="footer_item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span>Advance</span>
            <span>&#2547;<?php echo e($invoice->customer->advance_amount); ?></span>
        </div>
    <?php else: ?>
        <div class="footer_item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span>Change</span>
            <span>&#2547;<?php echo e($invoice->payment->change_amount); ?></span>
        </div>
    <?php endif; ?>

    </div>
    <div class="qrcode">
        <img src="data:image/png;base64,<?php echo e($qrCodeBase64); ?>" alt="Invoice QR Code" />
    </div>
    <div class="footer">
        <hr class="footer-line">
        <p class="thank-you-message">Thank you for your purchase!</p>
    </div>
</div><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/invoices/invoice_print.blade.php ENDPATH**/ ?>