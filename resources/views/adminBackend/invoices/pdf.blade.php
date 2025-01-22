
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <style>
        /* General Styling */
        body {
            font-family: 'Open Sans', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .invoice {
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .invoice_logo {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
            background-color: red;
        }

        .jojobi {
            font-size: 24px;
            font-weight: 700;
            color: #333333;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .super_shop {
            font-size: 16px;
            font-weight: 400;
            color: #555555;
            margin: 5px 0 0;
            text-transform: capitalize;
        }

        .shop_details {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            border-bottom: 2px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
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

            .footer_item {
                font-weight: normal;
            }
        }

        
      
   

    .invoice_table {
        width: 80%; /* Adjust the width */
        margin: 20px auto; /* Center horizontally */
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }

    /* Optional: Adjust table headers and data for better alignment */
    .invoice_table th, .invoice_table td {
        padding: 12px;
        text-align: center; /* Center-align text */
    }

        

        .invoice_table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
        }

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

        .table_footer {
            display: flex;
            flex-direction: column;
            width: 50%;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .footer_item {
            display: flex;
            justify-content: space-between;
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
        }

        .qrcode {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .qrcode img {
            max-width: 200px;
            width: 50%;
            height: auto;
            border: 2px solid #0056b3;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 10px;
            background-color: #fff;
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

        @media (max-width: 768px) {
            .invoice_table {
                font-size: 12px;
            }

            .invoice_table td,
            .invoice_table th {
                padding: 8px;
                
            }
        }
    </style>

    <div class="invoice">
        <img src="" alt="Logo" class="invoice_logo">
        <p class="jojobi">JOJOBI</p>
        <p class="super_shop">Super Shop</p>
    </div>

    <div class="shop_details">
        <div class="shop_location">
            JOJOBI super shop PVT LTD.
            Krisna nanda Dham, Ghonar Para, Cox's Bazar.
        </div>
        <div class="shop_number">
            <span>Mobile:</span> 01827004074 | 01307094887
        </div>
    </div>

    <div class="customer_details" style="display: flex; align-items: center; justify-content:center;">
        <div class="invoice-barcode" style="width: 40%; display: flex; align-items: center; justify-content: center; margin: auto;">
            <img src="{{ $barcodeImagePath }}" alt="Invoice Barcode" style="max-width: 100%; height: auto;">
        </div>
        
        <div class="invoice_no" style="width: 40%; display: flex-box; align-items: center; justify-content: center; margin: auto; justify-items:space-between; justify-self: center;">
            <span class="entity" >
                Invoice No
            </span>
            <span class="data">
                {{ $invoice->invoice_id }}
            </span>
        </div>
        
        
        
        
        
        
        <div class="date"  style="width: 40%; display: flex; align-items: center; justify-content: center; margin: auto; justify-items:center; justify-self: center;">
            <span>Date</span> <span>{{ $invoice->created_at }}</span>
        </div>
        <div class="csutomer_name" style="width: 40%; display: flex; align-items: center; justify-content: center; margin: auto; justify-items:center; justify-self: center;">
            <span>Bill By</span> <span>{{ $userName }}</span>
        </div>
        <div class="csutomer_name" style="width: 40%; display: flex; align-items: center; justify-content: center; margin: auto; justify-items:center; justify-self: center;">
            <span>Customer Name</span> <span>{{ $customerName }}</span>
        </div>
        <div class="csutomer_number" style="width: 40%; display: flex; align-items: center; justify-content: center; margin: auto; justify-items:center; justify-self: center;">
            <span>Customer Number</span> <span>{{ $customerPhone }}</span>
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
            @foreach ($invoice->order->cartitems as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->product->sell_price, 2) }}</td>
                    <td>${{ number_format($item->quantity * $item->product->sell_price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="table_footer">
        <div class="footer_item">
            <span>Total Items</span> <span>{{ $invoice->order->cartitems->count() }}</span>
        </div>
        <div class="footer_item">
            <span>SubTotal</span> <span>${{ number_format($invoice->order->round_total, 2) }}</span>
        </div>
        <div class="footer_item">
            <span>Total</span> <span>${{ number_format($invoice->payment->total_amount, 2) }}</span>
        </div>
        <div class="footer_item">
            <span>Cash</span> <span>${{ number_format($invoice->payment->payment_amount, 2) }}</span>
        </div>
        <div class="footer_item">
            <span>Due</span> <span>${{ number_format($invoice->customer->due_amount, 2) }}</span>
        </div>
    </div>

    <div class="qrcode">
        <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="Invoice QR Code">
    </div>

    <div class="terms">
        <p>Products can be exchanged within 7 days of purchase if they are unused, in original packaging, and accompanied by
            the receipt. For more details, contact customer service.</p>
    </div>

    <div class="invoice-actions">
        <a href="{{ route('invoice.pdf', $invoice->id) }}" class="btn btn-primary" target="_blank">
            <i class="fas fa-file-pdf"></i> Download PDF
        </a>
        <button class="btn btn-secondary" onclick="printInvoice()">Print Invoice</button>
    </div>

    <script>
        function printInvoice() {
            var printContents = document.querySelector('.invoice').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>

