@extends('adminBackend.adminLayout') <!-- Adjust the layout as per your project -->

@section('content')
    <h1>Orders</h1>

    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Products</th>
                <th>Subtotal Price</th>
                <th>Tax</th>
                <th>Shipping Cost</th>
                <th>Total Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->customer_name }}</td>
                    <td>
                        <ul>
                            @php
                                $products = json_decode($order->products_name, true); // Decode as associative array
                            @endphp
                            @if(is_array($products))
                                @foreach($products as $product)
                                    <li>
                                        {{ $product['quantity'] }} x {{ $product['name'] }} 
                                        - ${{ number_format($product['quantity'] * $product['price'], 2) }}
                                    </li>
                                @endforeach
                            @else
                                <li>N/A</li>
                            @endif
                        </ul>
                    </td>
                    <td>${{ number_format($order->subtotal_price, 2) }}</td>
                    <td>${{ number_format($order->tax, 2) }}</td>
                    <td>${{ number_format($order->shipping_cost, 2) }}</td>
                    <td>${{ number_format($order->total_price, 2) }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
