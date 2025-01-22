<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">


<div class="invoice"
    style="display: flex; flex-direction: column; align-items: center; text-align: center; width: 80%; margin: auto; justify-content: center; height: 100vh; font-family: Arial, sans-serif; border: 1px solid #ddd; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">

    <!-- Logo Section -->
    <img src="<?php echo e(public_path($logo->image)); ?>" alt="Logo" class="invoice_logo" style="width: 120px; height: auto; margin-bottom: 20px;">

    <!-- Shop Details -->
    <div class="shop_details"
        style="margin-bottom: 20px;">
        <div class="shop_location"
            style="font-size: 16px; font-weight: bold; color: #333; margin-bottom: 8px;">
            JOJOBI Mart PVT LTD. <br>
            Krisna Nanda Dham, Ghonar Para, Cox's Bazar.
        </div>
        <div class="shop_number"
            style="font-size: 14px; color: #555;">
            <span style="font-weight: bold;">Mobile:</span> 01827004074 | 01307094887
        </div>
    </div>

    <!-- Customer Details -->
    <div class="customer_details"
        style="margin-bottom: 20px;">
        <div class="invoice-barcode"
            style="margin: auto; text-align: center;">
            <img src="<?php echo e(public_path($invoice->invoice_barcode_image)); ?>"
                alt="Invoice Barcode"
                style="width: 200px; height: auto;">
        </div>
    </div>
</div>

<!-- Invoice Information Section -->
<div style="display: grid; 
    grid-template-columns: 1fr 1fr; 
    gap: 30px; 
    width: 80%; 
    max-width: 1200px; 
    margin:  auto; 
    
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
    font-size: 16px; 
    color: #444; 
    background-color: #fafafa; 
    border-radius: 10px; 
    border: 1px solid #ddd; 
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);">

    <!-- Left Side: Customer Information -->
    <div style="display: flex; flex-direction: column;">
        <h3 style="font-size: 22px; font-weight: bold; color: #333; margin-bottom: 20px;">Customer Information</h3>
        <div style="margin-bottom: 16px;">
            <span style="font-weight: bold; color: #555;">Customer Name:</span>
            <span style="font-weight: normal; color: #777;"><?php echo e($customerName); ?></span>
        </div>
        <div style="margin-bottom: 16px;">
            <span style="font-weight: bold; color: #555;">Customer Number:</span>
            <span style="font-weight: normal; color: #777;"><?php echo e($customerPhone); ?></span>
        </div>
    </div>

    <!-- Right Side: Invoice Information -->
    <div style="display: flex; flex-direction: column;">
        <h3 style="font-size: 22px; font-weight: bold; color: #333; margin-bottom: 20px;">Invoice Information</h3>
        <div style="margin-bottom: 16px;">
            <span style="font-weight: bold; color: #555;">Invoice No:</span>
            <span style="font-weight: normal; color: #777;"><?php echo e($invoice->invoice_id); ?></span>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 16px;">
            <span style="font-weight: bold; color: #555;">Date:</span>
            <span style="font-weight: normal; color: #777;"><?php echo e($invoice->created_at); ?></span>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 16px;">
            <span style="font-weight: bold; color: #555;">Bill By:</span>
            <span style="font-weight: normal; color: #777;"><?php echo e($userName); ?></span>
        </div>
    </div>
</div>

<table class="invoice_table" style="margin: auto; border-collapse: collapse; width: 80%; text-align: center; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
    <thead>
        <tr style="background-color: #f4f7fc; color: #333; font-weight: bold; text-transform: uppercase;">
            <th style="padding: 12px; border: 1px solid #ddd; font-size: 16px;">#</th>
            <th style="padding: 12px; border: 1px solid #ddd; font-size: 16px;">Product</th>
            <th style="padding: 12px; border: 1px solid #ddd; font-size: 16px;">Qty</th>
            <th style="padding: 12px; border: 1px solid #ddd; font-size: 16px;">Unit Price</th>
            <th style="padding: 12px; border: 1px solid #ddd; font-size: 16px;">SubTotal</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $invoice->order->cartitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr style="background-color: #ffffff; color: #555;">
            <td style="padding: 12px; border: 1px solid #ddd; font-size: 14px;"><?php echo e($loop->iteration); ?></td>
            <td style="padding: 12px; border: 1px solid #ddd; font-size: 14px;"><?php echo e($item->product->name); ?></td>
            <td style="padding: 12px; border: 1px solid #ddd; font-size: 14px;"><?php echo e($item->quantity); ?></td>
            <td style="padding: 12px; border: 1px solid #ddd; font-size: 14px;">$<?php echo e(number_format($item->product->sell_price, 2)); ?></td>
            <td style="padding: 12px; border: 1px solid #ddd; font-size: 14px;">$<?php echo e(number_format($item->quantity * $item->product->sell_price, 2)); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    <tfoot>
        <tr style="background-color: #f4f7fc; font-weight: bold; text-transform: uppercase; color: #333;">
            <td colspan="4" style="text-align: right; padding: 10px; font-size: 16px;">Total Items</td>
            <td style="padding: 10px; font-size: 16px; text-align: center; color: #333;"><?php echo e($invoice->order->cartitems->count()); ?></td>
        </tr>
        <tr style="background-color: #f4f7fc; font-weight: bold; text-transform: uppercase; color: #333;">
            <td colspan="4" style="text-align: right; padding: 10px; font-size: 16px;">SubTotal</td>
            <td style="padding: 10px; font-size: 16px; text-align: center; color: #333;"><?php echo e($invoice->order->subtotal); ?></td>
        </tr>
        <!-- Discount -->
        <tr style="background-color: #f4f7fc; font-weight: bold; text-transform: uppercase; color: #333;">
            <?php if($invoice->order->tax > 0): ?>
            <td colspan="4" style="text-align: right; padding: 10px; font-size: 16px;">Vat.</td>
            <td style="padding: 10px; font-size: 16px; text-align: center; color: #333;"><?php echo e($invoice->order->tax); ?></td>
            <?php elseif($invoice->order->shipping_cost > 0): ?>
            <td colspan="4" style="text-align: right; padding: 10px; font-size: 16px;">Shipping Cost</td>
            <td style="padding: 10px; font-size: 16px; text-align: center; color: #333;"><?php echo e($invoice->order->shipping_cost); ?></td>
            <?php elseif($invoice->order->discount > 0): ?>
            <td colspan="4" style="text-align: right; padding: 10px; font-size: 16px;">Discount</td>
            <td style="padding: 10px; font-size: 16px; text-align: center; color: #333;"><?php echo e($invoice->order->discount); ?></td>
            <?php elseif($invoice->order->flat_discount > 0): ?>
            <td colspan="4" style="text-align: right; padding: 10px; font-size: 16px;">Flat Discount</td>
            <td style="padding: 10px; font-size: 16px; text-align: center; color: #333;"><?php echo e($invoice->order->flat_discount); ?></td>
            <?php endif; ?>
        </tr>

        <tr style="background-color: #f4f7fc; font-weight: bold; text-transform: uppercase; color: #333;">
            <?php if($invoice->payment->transaction->customer_due > 0): ?>
            <td colspan="4" style="text-align: right; padding: 10px; font-size: 16px;">Previous Due</td>
            <td style="padding: 10px; font-size: 16px; text-align: center; color: #333;"><?php echo e($invoice->payment->transaction->customer_due); ?></td>
            <?php elseif($invoice->payment->transaction->customer_advance > 0): ?>
            <td colspan="4" style="text-align: right; padding: 10px; font-size: 16px;">Previous Advance</td>
            <td style="padding: 10px; font-size: 16px; text-align: center; color: #333;"><?php echo e($invoice->payment->transaction->customer_advance); ?></td>
            <?php endif; ?>
        </tr>
        <tr style="background-color: #f4f7fc; font-weight: bold; text-transform: uppercase; color: #333;">
            <td colspan="4" style="text-align: right; padding: 10px; font-size: 16px;">Total</td>
            <td style="padding: 10px; font-size: 16px; text-align: center; color: #333;"><?php echo e($invoice->order->round_total); ?></td>
        </tr>
        <tr style="background-color: #f4f7fc; font-weight: bold; text-transform: uppercase; color: #333;">
            <td colspan="4" style="text-align: right; padding: 10px; font-size: 16px;">Cash</td>
            <td style="padding: 10px; font-size: 16px; text-align: center; color: #333;"><?php echo e($invoice->payment->payment_amount); ?></td>
        </tr>
        <tr style="background-color: #f4f7fc; font-weight: bold; text-transform: uppercase; color: #333;">
            <?php if($invoice->customer->due_amount != 0): ?>

            <td colspan="4" style="text-align: right; padding: 10px; font-size: 16px;"> Due</td>
            <td style="padding: 10px; font-size: 16px; text-align: center; color: #333;"><?php echo e($invoice->customer->due_amount); ?></td>
            <?php elseif($invoice->customer->advance_amount > 0): ?>
            <td colspan="4" style="text-align: right; padding: 10px; font-size: 16px;"> Change</td>
            <td style="padding: 10px; font-size: 16px; text-align: center; color: #333;"><?php echo e($invoice->payment->change_amount); ?></td>

            <td colspan="4" style="text-align: right; padding: 10px; font-size: 16px;"> Advance</td>
            <td style="padding: 10px; font-size: 16px; text-align: center; color: #333;"><?php echo e($invoice->customer->advance_amount); ?></td>
            <?php else: ?>
            <td colspan="4" style="text-align: right; padding: 10px; font-size: 16px;"> Change</td>
            <td style="padding: 10px; font-size: 16px; text-align: center; color: #333;"><?php echo e($invoice->payment->change_amount); ?></td>
            <?php endif; ?>
        </tr>
    </tfoot>
</table>






<div class="terms" style="display: flex; flex-direction: column; align-items: center; text-align: center; width: 80%; margin: auto; justify-content: center; height: 100vh; font-family: Arial, sans-serif; border: 1px solid #ddd; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); ">
    <p style="text-align:justify;">Products can be exchanged within 2 days of purchase if they are unused, in original packaging, and
        accompanied by the receipt. Custom or personalized items are not eligible for exchange. Shipping costs for
        returns are the customer’s responsibility.</p>
</div><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/invoices/generate-pdf.blade.php ENDPATH**/ ?>