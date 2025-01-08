@extends('adminBackend.adminLayout')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f7fa;
        margin: 0;
        padding: 0;
        color: #333;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        font-size: 28px;
        margin-bottom: 20px;
        color: #3a99d9;
    }

    h2, h3 {
        margin-top: 20px;
        margin-bottom: 10px;
        color: #333;
    }

    p {
        font-size: 16px;
        line-height: 1.6;
    }

    p strong {
        font-weight: bold;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    table thead th {
        background-color: #3a99d9;
        color: #fff;
        padding: 12px;
        text-align: left;
        font-size: 16px;
    }

    table tbody tr {
        background-color: #f9f9f9;
        border-bottom: 1px solid #ddd;
    }

    table tbody tr:nth-child(even) {
        background-color: #f1f1f1;
    }

    table td, table th {
        padding: 12px;
        text-align: left;
        font-size: 14px;
    }

    table tfoot td {
        font-weight: bold;
        padding: 12px;
    }

    .btn-primary {
        display: inline-block;
        background-color: #3a99d9;
        color: #fff;
        padding: 10px 20px;
        font-size: 16px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        text-align: center;
    }

    .btn-primary:hover {
        background-color: #258bbd;
    }

    .btn-primary:active {
        background-color: #1b6f91;
    }
</style>


    <div class="container">
        <h1>Order Details</h1>

        <!-- Order Information -->
        <div>
            <h2>Order #{{ $order->order_number }}</h2>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
            <p><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
        </div>

        <!-- Product Details -->
        <h3>Products</h3>
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Barcode</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php $subtotal = 0; @endphp
                @foreach ($products as $product)
                    @php
                        $productTotal = $product['quantity'] * $product['price'];
                        $subtotal += $productTotal;
                    @endphp
                    <tr>
                        <td>{{ $product['barcode'] }}</td>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['category'] }}</td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>${{ number_format($product['price'], 2) }}</td>
                        <td>${{ number_format($productTotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Summary -->
        <h3>Order Summary</h3>
        <table>
            <tr>
                <td><strong>Subtotal:</strong></td>
                <td>${{ number_format($order->subtotal_price, 2) }}</td>
            </tr>
            <tr>
                <td><strong>Tax:</strong></td>
                <td>${{ number_format($order->tax, 2) }}</td>
            </tr>
            <tr>
                <td><strong>Shipping Cost:</strong></td>
                <td>${{ number_format($order->shipping_cost, 2) }}</td>
            </tr>
            <tr>
                <td><strong>Discount:</strong></td>
                <td>-${{ number_format($order->discount, 2) }}</td>
            </tr>
            <tr>
                <td><strong>Total Price:</strong></td>
                <td>${{ number_format($order->total_price, 2) }}</td>
            </tr>
        </table>

        <!-- Back Button -->
        <div class="buton_set" style="display: flex; justify-content: space-between">
            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary">Back to Orders</a>
            <form action="{{ route('orders.proceed', $order->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Proceed</button>
            </form>
            
        </div>
    </div>
@endsection
