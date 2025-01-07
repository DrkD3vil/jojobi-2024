@extends('adminBackend.adminLayout')

@section('content')
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

    <h1>Point of Sale</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Add Product Form -->
    <form action="{{ route('pos.add') }}" method="POST">
        @csrf
        <label for="barcode">Barcode or Product Name:</label>
        <input type="text" id="barcode" name="barcode" placeholder="Enter Barcode/Product Name" required>
        <button type="submit">Add Product</button>
    </form>

    <!-- Cart Table -->
    <h2>Product Table</h2>
    <form id="cartForm">
        @csrf
        <table border="1">
            <thead>
                <tr>
                    <th>Barcode</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $subtotal_price = 0; @endphp

                @forelse(session('cart', []) as $id => $item)
                    @php $subtotal_price += $item['quantity'] * $item['price']; @endphp

                    <tr>
                        <td>{{ $item['barcode'] }}</td>
                        <td><img src="{{ asset('baackend_images/' . $item['image']) }}" alt="Product Image" width="50">
                        </td>
                        <td>{{ $item['name'] }}</td>
                        <td>
                            <input type="number" name="cart[{{ $id }}][quantity]" class="quantity-input"
                                data-id="{{ $id }}" value="{{ $item['quantity'] }}" min="1"
                                style="width: 60px;">
                        </td>
                        <td>{{ $item['category'] }}</td>
                        <td>${{ number_format($item['price'], 2) }}</td>
                        <td>
                            <a href="{{ route('pos.remove', $id) }}">Remove</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No products in the cart.</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align: right;">Subtotal Price:</td>
                    <td id="subtotal">${{ number_format($subtotal_price, 2) }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: right;">Tax:</td>
                    <td>
                        <input type="number" name="tax" id="tax" class="update-field" value="0"
                            step="0.01" style="width: 80px;">%
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: right;">Shipping Cost:</td>
                    <td>
                        <input type="number" name="shipping_cost" id="shipping_cost" class="update-field" value="0"
                            step="0.01" style="width: 80px;">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: right;">Discount:</td>
                    <td>
                        <input type="number" name="discount" id="discount" class="update-field" value="0"
                            step="0.01" style="width: 80px;">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: right;">Total Price:</td>
                    <td id="total_price">${{ number_format($subtotal_price, 2) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </form>



    <form action="{{ route('pos.checkout') }}" method="POST" style="text-align:right;">
        @csrf
        <button type="submit">Proceed</button>
    </form>

    <script>
        // Function to update cart totals using AJAX
        function updateCart() {
            let cartData = $('#cartForm').serialize(); // Collect form data

            $.ajax({
                url: "{{ route('pos.updateCart') }}",
                method: "POST",
                data: cartData,
                success: function(response) {
                    // Update the subtotal, tax, shipping cost, discount, and total price
                    $('#subtotal').text(`$${response.subtotal.toFixed(2)}`);
                    $('#total_price').text(`$${response.total.toFixed(2)}`);
                },
                error: function(xhr) {
                    alert('Something went wrong. Please try again.');
                }
            });
        }

        // Attach event listeners for real-time updates
        $(document).on('change', '.update-field, .quantity-input', function() {
            updateCart();
        });
    </script>
@endsection
