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
<form action="{{ route('pos.addCartItem', $cart->cart_id) }}" method="POST" class="mb-3">
    @csrf
    <label for="barcode" class="form-label">Barcode or Product Name:</label>
    <input type="text" id="barcode" name="barcode" class="form-control" placeholder="Enter Barcode/Product Name" required>
    <button type="submit" class="btn btn-primary mt-2">Add Product</button>
</form>
<!-- Product Results Table -->
<div id="product-results"></div>

<!-- Suggestions will be displayed here -->
<div id="suggestions" class="mt-3"></div>

<h2>Product Table</h2>
<table class="table table-bordered">
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
    <tbody id="cartBody">
        @php $subtotal_price = 0; @endphp
        @forelse($cart->items as $item)
            @php $subtotal_price += $item->quantity * $item->price; @endphp
            <tr id="cartItem-{{ $item->id }}">
                <td>{{ $item->product_barcode }}</td>
                <td>
                    <img src="{{ asset('baackend_images/' . $item->product_image) }}" alt="Product Image" width="50">
                </td>
                <td>{{ $item->product_name }}</td>
                <td>
                    <input type="number" class="form-control form-control-sm" value="{{ $item->quantity }}" min="1" id="quantity-{{ $item->id }}" data-id="{{ $item->id }}" onchange="updateQuantity({{ $item->id }})">
                </td>
                <td>{{ $item->category_name ?? 'No Category' }}</td>
                <td>${{ number_format($item->price, 2) }}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-cart-item" data-id="{{ $item->id }}" onclick="removeItem({{ $item->id }})">Remove</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No products in the cart.</td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" class="text-end"><strong>Subtotal Price:</strong></td>
            <td colspan="2" id="subtotal"><strong>${{ number_format($subtotal_price, 2) }}</strong></td>
        </tr>
    </tfoot>
</table>

    <!-- Proceed Button -->
    <form action="{{ route('pos.proceedCart', $cart->cart_id) }}" method="POST" class="text-end">
        @csrf
        <button type="submit" class="btn btn-primary">Proceed</button>
    </form>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        $(document).ready(function () {
        // Search for products based on barcode or name
        $('#barcode').on('input', function () {
            let query = $(this).val();

            if (query.length > 0) {
                $.ajax({
                    url: "{{ route('pos.products.search') }}",
                    type: "GET",
                    data: { query: query },
                    success: function (data) {
                        let productTable = '';
                        if (data.length > 0) {
                            productTable += `
                                <table class="table table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Barcode</th>
                                            <th>Price</th>
                                            <th>Stock Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            `;

                            data.forEach(product => {
                                const stockStatus = product.out_of_stock ? 'Out of Stock' : 'In Stock';
                                const disabled = product.out_of_stock ? 'disabled' : '';

                                productTable += `
                                    <tr>
                                        <td>${product.name}</td>
                                        <td>${product.product_barcode}</td>
                                        <td>${product.sell_price}</td>
                                        <td class="${product.out_of_stock ? 'text-danger' : 'text-success'}">${stockStatus}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary add-to-cart" 
                                                    data-id="${product.id}" 
                                                    data-barcode="${product.product_barcode}" 
                                                    data-name="${product.name}" 
                                                    data-price="${product.sell_price}" 
                                                    ${disabled}>
                                                ${product.out_of_stock ? 'Unavailable' : 'Add to Cart'}
                                            </button>
                                        </td>
                                    </tr>
                                `;
                            });

                            productTable += `
                                    </tbody>
                                </table>
                            `;
                        } else {
                            productTable = '<p class="text-danger mt-3">No products found!</p>';
                        }
                        $('#product-results').html(productTable);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching products:', error);
                        $('#product-results').html('<p class="text-danger mt-3">An error occurred while fetching products.</p>');
                    }
                });
            } else {
                $('#product-results').html('');
            }
        });

        // Handle Add-to-Cart button click
        $(document).on('click', '.add-to-cart', function () {
            const productId = $(this).data('id');
            const productName = $(this).data('name');
            const productPrice = $(this).data('price');
            const productBarcode = $(this).data('barcode');

            // Check if the button is disabled (product out of stock)
            if ($(this).is(':disabled')) {
                toastr.error('Cannot add this product because it is out of stock.');
                return;
            }

            // Add the product via AJAX
            $.ajax({
                url: '{{ route('pos.addCartItem', $cart->cart_id) }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    barcode: productBarcode
                },
                success: function (response) {
                    // Display toaster message
                    toastr.success('Product added successfully');

                    // Reload the page after 0.5 seconds (500ms)
                    setTimeout(function () {
                        window.location.reload();
                    }, 500);
                },
                error: function (xhr, status, error) {
                    // Display an error message
                    toastr.error('Failed to add the product. Please try again.');

                    // Log error for debugging
                    console.error('Error adding product:', error);

                    // Optionally reload the page after an error (if necessary)
                    setTimeout(function () {
                        window.location.reload();
                    }, 500);
                }
            });
        });
    });
</script>
    

    <script>
        // Function to update quantity via AJAX
        // Function to update quantity via AJAX
function updateQuantity(id) {
    const quantity = document.getElementById(`quantity-${id}`).value;

    // Make sure quantity is a valid number
    if (quantity && quantity > 0) {
        $.ajax({
            url: '{{ route("pos.updateQuantity") }}',  // Route to update the cart
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                quantity: quantity
            },
            success: function(response) {
                // Update the subtotal dynamically
                $('#subtotal').text(`$${response.subtotal.toFixed(2)}`);
            },
            error: function() {
                alert('Failed to update the quantity.');
            }
        });
    }
}

    
        // Function to remove item from the cart via AJAX
        // Function to remove item from the cart via AJAX
function removeItem(id) {
    $.ajax({
        url: '{{ route('pos.removeCartItem') }}', // Route to remove the item
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            id: id
        },
        success: function(response) {
            // Remove the item row from the table
            $(`#cartItem-${id}`).remove();
            $('#subtotal').text(`$${response.subtotal.toFixed(2)}`);
        },
        error: function() {
            alert('Failed to remove the item.');
        }
    });
}

    </script>
@endsection

