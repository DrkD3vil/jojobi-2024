
    ;
    <?php $__env->startSection('content'); ?>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', Arial, sans-serif;
            /* Clean and professional font */
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            /* Light background for professionalism */
        }

        .invoice {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            /* White background for clarity */
            border: 1px solid #e0e0e0;
            /* Subtle border for structure */
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            /* Soft shadow for elevation */
            text-align: center;
            /* Center-align the content */
        }

        .invoice_logo {
            width: 100px;
            /* Scaled logo size */
            height: auto;
            /* Maintain aspect ratio */
            /* margin-bottom: 10px; */
            /* background-color: red; */
            margin-top: 0;
            
        }

        .jojobi {
            font-size: 24px;
            font-weight: 700;
            /* Bold for emphasis */
            color: #333333;
            /* Dark gray for a professional look */
            margin: 0;
            text-transform: uppercase;
            /* Make it stand out */
            letter-spacing: 2px;
            /* Slight spacing for style */
        }

        .super_shop {
            font-size: 16px;
            font-weight: 400;
            /* Lighter than the main title */
            color: #555555;
            /* Subtle gray */
            margin: 5px 0 0;
            letter-spacing: 1px;
            /* Consistent design with the title */
            text-transform: capitalize;
        }

        .shop_details {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            border-bottom: 2px solid #ddd;
            /* padding: 15px; */
            /* margin-bottom: 20rem; */

        }

        .shop_location {
            font-weight: bold;
            text-align: center;
            margin-bottom: 8px;
            font-size: 16px;
            color: #000;
        }

        .shop_number {
            text-align: center;
            font-size: 14px;
            color: #555;
        }

        .shop_number span {
            font-weight: 900;
            color: #000;
        }

        /* Optional styling for print */
        @media print {
            .shop_details {
                border-bottom: 2px solid #000;
                color: #000;
            }
        }

        .invoice-barcode {
            max-width: 20% !important;
        }

        .invoice-barcode img {
            display: flex;
            justify-self: center;
            width: 100%;
        }

        .customer_details {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
        }

        /* General styling for each section */
        .customer_details div {
            display: flex;
            justify-content: space-between;
            width: 50%;
            padding: 5px 0;
            /* margin: 5px 0; */
            font-size: 16px;
            color: #333;
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-weight: 500;
        }

        /* Label styling for each section */
        .customer_details span:nth-child(odd) {
            font-weight: bold;
            color: #0056b3;
        }

        /* Value styling for each section */
        .customer_details span:nth-child(even) {
            font-weight: normal;
            color: #000;
        }

        /* Hover effect for rows */
        .customer_details div:hover {
            background-color: #e0e0e0;
            cursor: pointer;
        }

        /* Optional styling for print */
        @media print {
            .customer_details div {
                width: 100%;
                background-color: #fff;
                box-shadow: none;
                margin: 5px 0;
            }
        }

        /* Table Styling */
        .invoice_table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
            justify-self: center;
        }

        /* Table Header Styling */
        .invoice_table thead {
            background-color: #0056b3;
            color: #fff;
        }

        .invoice_table th {
            padding: 12px;
            text-align: left;
            font-size: 16px;
            font-weight: bold;
            border-bottom: 2px solid #ddd;
        }

        /* Table Body Styling */
        .invoice_table tbody tr {
            background-color: #f9f9f9;
        }

        .invoice_table td {
            padding: 12px;
            text-align: left;
            font-size: 14px;
            color: #333;
            border-bottom: 1px solid #ddd;
        }

        /* Hover Effect for Rows */
        .invoice_table tbody tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        /* Optional Styling for Table Borders */
        .invoice_table th,
        .invoice_table td {
            border-right: 1px solid #ddd;
        }

        .invoice_table td:last-child,
        .invoice_table th:last-child {
            border-right: none;
        }

        /* Optional Responsive Adjustment */
        @media (max-width: 768px) {
            .invoice_table {
                font-size: 12px;
            }

            .invoice_table td,
            .invoice_table th {
                padding: 8px;
            }
        }

        .table_footer {
            display: flex;
            flex-direction: column;
            /* margin: 20px 0; */
            width: 50%;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px;
            justify-self: center;

        }

        .footer_item {
            display: flex;
            justify-content: space-between;
            /* padding: 10px 0; */
            font-size: 16px;
            color: #333;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .footer_item span:nth-child(odd) {
            font-weight: bold;
            color: #0056b3;
        }

        .footer_item span:nth-child(even) {
            font-weight: normal;
            color: #000;
        }

        .footer_item:last-child {
            font-weight: bold;
            color: #e63946;
            /* Red for the last item (Due/Advance) */
        }

        /* Hover effect for interactivity */
        .footer_item:hover {
            background-color: #e0e0e0;
            cursor: pointer;
        }

        /* Print-friendly adjustments */
        @media print {
            .table_footer {
                width: 100%;
                background-color: #fff;
                box-shadow: none;
                margin: 5px 0;
            }
        }

        .qrcode {
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
            /* Full height of the viewport */
            text-align: center;
        }

        .qrcode img {
            max-width: 100px;
            /* Limit the size of the QR code */
            width: 25%;
            height: auto;
            border: 2px solid #0056b3;
            /* Add a border around the QR code */
            border-radius: 8px;
            /* Rounded corners for the border */
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            /* Add a subtle shadow */
            padding: 10px;
            background-color: #fff;
            /* White background behind QR code */
        }

        /* Optional: Adjust for mobile responsiveness */
        @media (max-width: 300px) {
            .qrcode img {
                max-width: 75px;
                /* Reduce the size on smaller screens */
            }
        }

        .terms {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: justify;
            padding: 20px;
            margin: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 50%;
            margin-left: auto;
            margin-right: auto;
            font-size: 16px;
            color: #333;
        }

        .terms p {
            line-height: 1.6;
            font-weight: 400;
        }

        /* Optional: Adjust for mobile responsiveness */
        @media (max-width: 600px) {
            .terms {
                max-width: 95%;
                padding: 15px;
            }
        }
    </style>

    <div class="invoice">
    <img src="<?php echo e(asset($logo->image)); ?>" alt="Logo" class="invoice_logo">
        <!-- <p class="jojobi">JOJOBI</p>
        <p class="super_shop">Super Shop</p> -->
    </div>
    <div class="shop_details">
        <div class="shop_location">
            JOJOBI mart PVT LTD.
            Krisna nanda Dham, Ghonar Para, Cox's Bazar.
        </div>
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
        <div class="csutomer_name">
            <span>Bill By</span> <span><?php echo e($userName); ?></span>
        </div>
        <div class="csutomer_name">
            <span>Customer Name</span> <span><?php echo e($customerName); ?></span>
        </div>
        <div class="csutomer_number">
            <span>Customer Number</span> <span><?php echo e($customerPhone); ?></span>
        </div>
    </div>
    <table class="invoice_table" style="margin: auto; border-collapse: collapse; width: 80%; text-align: center;">
    <thead>
        <tr>
            <th style="padding: 8px; border: 1px solid #ddd;">#</th>
            <th style="padding: 8px; border: 1px solid #ddd;">Product</th>
            <th style="padding: 8px; border: 1px solid #ddd;">Qty</th>
            <th style="padding: 8px; border: 1px solid #ddd;">Unit Price</th>
            <th style="padding: 8px; border: 1px solid #ddd;">SubTotal</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $invoice->order->cartitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;"><?php echo e($loop->iteration); ?></td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?php echo e($item->product->name); ?></td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?php echo e($item->quantity); ?></td>
                <td style="padding: 8px; border: 1px solid #ddd;">$<?php echo e(number_format($item->product->sell_price, 2)); ?></td>
                <td style="padding: 8px; border: 1px solid #ddd;">$<?php echo e(number_format($item->quantity * $item->product->sell_price, 2)); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<div style="display: flex; justify-content: flex-end; width: 80%;">
    <div class="table_footer" style="width: 30%; font-family: Arial, sans-serif; display: flex; flex-direction: column;">
        <div class="footer_item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span>Total Items</span>
            <span><?php echo e($invoice->order->cartitems->count()); ?></span>
        </div>
        <div class="footer_item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span>SubTotal</span>
            <span><?php echo e($invoice->order->subtotal); ?></span>
        </div>
        
        <div class="footer_items" style="margin-bottom: 10px;">
        <?php if($invoice->order->tax > 0): ?>
                <div class="footer_item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Vat.</span>
                    <span><?php echo e($invoice->order->tax); ?></span>
                </div>
                <?php elseif($invoice->order->shipping_cost > 0): ?>
                <div class="footer_item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Shipping Cost</span>
                    <span><?php echo e($invoice->order->shipping_cost); ?></span>
                </div>
                <?php elseif($invoice->order->discount > 0): ?>
                <div class="footer_item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Discount</span>
                    <span><?php echo e($invoice->order->discount); ?> %</span>
                </div>
                <?php elseif($invoice->order->flat_discount > 0): ?>
                <div class="footer_item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Flat Discount</span>
                    <span><?php echo e($invoice->order->flat_discount); ?></span>
                </div>
            <?php endif; ?>
        </div>



        <div class="footer_items" style="margin-bottom: 10px;">
            <?php if($invoice->payment->transaction->customer_due > 0): ?>
                <div class="footer_item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Previous Due</span>
                    <span><?php echo e($invoice->payment->transaction->customer_due); ?></span>
                </div>
            <?php elseif($invoice->payment->transaction->customer_advance > 0): ?>
                <div class="footer_item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Previous Advance</span>
                    <span><?php echo e($invoice->payment->transaction->customer_advance); ?></span>
                </div>
            <?php endif; ?>
        </div>
        <div class="footer_item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span>Total</span>
            <span><?php echo e($invoice->payment->total_amount); ?></span>
        </div>
        <div class="footer_item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span>Cash</span>
            <span><?php echo e($invoice->payment->payment_amount); ?></span>
        </div>
        <div class="footer_items">
            <?php if($invoice->customer->due_amount != 0): ?>
                <div class="footer_item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Due</span>
                    <span><?php echo e($invoice->customer->due_amount); ?></span>
                </div>
            <?php elseif($invoice->customer->advance_amount > 0): ?>
                <div class="footer_item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Change</span>
                    <span><?php echo e($invoice->payment->change_amount); ?></span>
                </div>
                <div class="footer_item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Advance</span>
                    <span><?php echo e($invoice->customer->advance_amount); ?></span>
                </div>
            <?php else: ?>
                <div class="footer_item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Change</span>
                    <span><?php echo e($invoice->payment->change_amount); ?></span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
    <p style="text-align: center;">Scan the QR Code below to access this invoice:</p>
    <div class="qrcode">
        
        <img src="data:image/png;base64,<?php echo e($qrCodeBase64); ?>" alt="Invoice QR Code" />


    </div>
    <div class="terms" style="position:relative;">
        <p>Products can be exchanged within 2 days of purchase if they are unused, in original packaging, and
            accompanied by the receipt. Custom or personalized items are not eligible for exchange. Shipping costs for
            returns are the customer’s responsibility.</p>
    </div>
    <div class="invoice-actions">
        <a href="<?php echo e(route('invoice.pdf', $invoice->invoice_id)); ?>" class="btn btn-primary" target="_blank">
            <i class="fas fa-file-pdf"></i> Download PDF
        </a>
        <!-- Print Button -->
        <a href="<?php echo e(route('print.invoice', $invoice->id)); ?>" class="btn btn-primary">
            <i class="fas fa-file-pdf"></i> print Invoice
        </a>

    </div>

<!-- 
    <script>
        function printInvoice() {
            var printContents = document.querySelector('.invoice').innerHTML; // Select the invoice section
            var originalContents = document.body.innerHTML; // Store the original contents of the page
    
            // Replace the content of the body with the invoice content for printing
            document.body.innerHTML = printContents;
    
            // Trigger the print dialog
            window.print();
    
            // Restore the original contents of the page after printing
            document.body.innerHTML = originalContents;
        }
    </script> -->
    
    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/invoices/show.blade.php ENDPATH**/ ?>