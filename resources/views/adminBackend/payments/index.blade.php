@extends('adminBackend.adminLayout') 

@section('content')
    <h1 class="text-center my-4">Payments</h1>

    <!-- Payments Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Transaction ID</th>
                    <th>Payment Method</th>
                    <th>Payment Amount</th>
                    <th>Payment Date</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $payment->transaction_id }}</td>
                        <td>{{ $payment->payment_method }}</td>
                        <td>${{ number_format($payment->payment_amount, 2) }}</td>
                        <td>{{ $payment->payment_date }}</td>
                        <td>
                            <!-- Button to toggle details -->
                            <button class="btn btn-info btn-sm" onclick="toggleDetails({{ $payment->transaction_id }})">
                                Show Details
                            </button>
                        </td>
                    </tr>

                    <!-- Hidden row with detailed information -->
                    <tr id="details-{{ $payment->transaction_id }}" class="payment-details" style="display: none;">
                        <td colspan="6">
                            <div class="row">
                                <!-- Order Information Section -->
                                <div class="col-md-6">
                                    <h5><strong>Order Information</strong></h5>
                                    <ul class="list-unstyled">
                                        <li><strong>Order ID:</strong> {{ $payment->transaction->order->order_id }}</li>
                                        <li><strong>Customer:</strong> {{ $payment->transaction->customer->name }}</li>
                                        <li><strong>Subtotal:</strong> ${{ number_format($payment->transaction->order->subtotal, 2) }}</li>
                                        <li><strong>Tax:</strong> ${{ number_format($payment->transaction->order->tax, 2) }}</li>
                                        <li><strong>Total:</strong> ${{ number_format($payment->transaction->order->total, 2) }}</li>
                                    </ul>
                                </div>

                                <!-- Customer Information Section -->
                                <div class="col-md-6">
                                    <h5><strong>Customer Information</strong></h5>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Barcode</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $payment->transaction->customer->name }}</td>
                                                <td>{{ $payment->transaction->customer->phone }}</td>
                                                <td>{{ $payment->transaction->customer->barcode_number }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Cart Items Section -->
                                <div class="col-md-12">
                                    <h5><strong>Cart Items</strong></h5>
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Product Barcode</th>
                                                <th>Product Name</th>
                                                <th>Image</th>
                                                <th>Category</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payment->transaction->order->cartitems as $item)
                                                <tr>
                                                    <td>{{ $item->product_barcode }}</td>
                                                    <td>{{ $item->product_name }}</td>
                                                    <td>
                                                        <img src="{{ asset('baackend_images/'. $item->product_image) }}" alt="{{ $item->product_name }}" width="50">
                                                    </td>
                                                    <td>{{ $item->category_name }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>${{ number_format($item->price, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Toggle Details Script -->
    <script>
        // Toggle the details for the payment
        function toggleDetails(transactionId) {
            const detailsRow = document.getElementById('details-' + transactionId);
            if (detailsRow.style.display === 'none') {
                detailsRow.style.display = 'table-row';
            } else {
                detailsRow.style.display = 'none';
            }
        }
    </script>

    <style>
        .table th, .table td {
            vertical-align: middle;
            padding: 10px;
        }

        .payment-details td {
            padding: 20px;
        }

        .payment-details .row {
            margin-top: 20px;
        }

        .payment-details h5 {
            margin-bottom: 15px;
            font-size: 1.2em;
        }

        .payment-details ul {
            padding-left: 20px;
        }

        .payment-details ul li {
            margin-bottom: 10px;
        }

        .payment-details button {
            margin-top: 10px;
        }

        .payment-details .table-sm td {
            padding: 5px 10px;
        }

        /* Improve table styling */
        .table-bordered {
            border: 1px solid #ddd;
        }

        .thead-dark th {
            background-color: #000000;
            color: rgb(255, 0, 0);
        }

        .table th, .table td {
            border: 1px solid #ddd;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #ffc6c6;
        }

        .btn-info {
            padding: 8px 12px;
            font-size: 14px;
        }
    </style>

@endsection
