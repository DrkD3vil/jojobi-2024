@extends('adminBackend.adminLayout')

@section('content')
    <!-- Bootstrap CSS (for styling and the collapse component) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS and Popper (required for collapse functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        #create-customer-btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #create-customer-btn:hover {
            background-color: #218838;
        }

        .form-container {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .collapse {
            transition: all 0.3s ease-in-out;
        }

        .form-group label {
            font-weight: bold;
        }
    </style>


    <div class="container">
        <!-- Button to Show/Hide Create Customer Form (Dropdown) -->

        <!-- Button to Show the Create Customer Form -->
        <button id="create-customer-btn" class="btn btn-success mb-4" type="button">
            Create a New Customer
        </button>

        <!-- Search Form -->
        <form action="javascript:void(0)" method="GET" class="form-inline mb-4" id="search-form">
            <input type="text" name="search" class="form-control" placeholder="Search by name, email, phone, or barcode"
                id="search-input">
            <button type="submit" class="btn btn-primary ml-2">Search</button>
        </form>

        <!-- Customers Table -->
        <table class="table table-striped" id="customers-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Barcode Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- The customer rows will be populated here by AJAX -->
            </tbody>
        </table>

        <!-- Create Customer Form (Initially Hidden) -->
        <div id="create-customer-form" style="display: none;">
            <h1 class="text-center mb-4">Create Customer</h1>
        
            <form method="POST" enctype="multipart/form-data" id="create-customer-form-element" class="form-container">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
        
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
        
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>
        
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea name="address" id="address" class="form-control" required></textarea>
                </div>
        
                <div class="form-group">
                    <label for="image">Image (optional):</label>
                    <input type="file" name="image" id="image" accept="image/*" class="form-control">
                </div>
        
                <button type="submit" class="btn btn-primary btn-block">Add Customer</button>
            </form>
        </div>
        
        <!-- Button to Show/Hide Create Customer Form (Dropdown) -->


        <h1 class="text-center mt-5 mb-4">Create Order</h1>

        <form action="{{ route('orders.store') }}" method="POST" class="form-container">
            @csrf

            <div class="form-group">
                <label for="customer_id">Customer:</label>
                <select name="customer_id" id="customer_id" class="form-control" required>
                    <option value="">Select Customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->email }})</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="cart_id">Cart ID:</label>
                <input type="text" name="cart_id" id="cart_id" class="form-control" value="{{ $cart->cart_id }}"
                    readonly>
            </div>

            <div class="form-group">
                <label for="subtotal">Subtotal Price:</label>
                <input type="number" name="subtotal" id="subtotal" class="form-control"
                    value="{{ $cart->subtotal_price }}" readonly>
            </div>

            <div class="form-group">
                <label for="tax">Tax (%):</label>
                <input type="number" name="tax" id="tax" class="form-control" step="0.01"
                    placeholder="Enter Tax Percentage" required>
            </div>

            <div class="form-group">
                <label for="shipping_cost">Shipping Cost:</label>
                <input type="number" name="shipping_cost" id="shipping_cost" class="form-control" step="0.01"
                    placeholder="Enter Shipping Cost" required>
            </div>

            <div class="form-group">
                <label for="discount">Discount:</label>
                <input type="number" name="discount" id="discount" class="form-control" step="0.01"
                    placeholder="Enter Discount Amount or Percentage" required>
                <small class="text-muted">Enter as a fixed amount or percentage (e.g., 10 for 10%).</small>
            </div>

            <div class="form-group">
                <label for="flat_discount">Flat Discount:</label>
                <input type="number" name="flat_discount" id="flat_discount" class="form-control" step="0.01"
                    placeholder="Enter Flat Discount">
            </div>

            <div class="form-group">
                <label for="total">Total Price:</label>
                <input type="number" name="total" id="total" class="form-control"
                    value="{{ $cart->subtotal_price }}" readonly>
            </div>

            <div class="form-group">
                <label for="round_total">Round Total:</label>
                <input type="number" name="round_total" id="round_total" class="form-control"
                    value="{{ round($cart->subtotal_price, 2) }}" readonly>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="pending">Pending</option>
                    <option value="complete">Complete</option>
                    <option value="suspended">Suspended</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success btn-block">Create Order</button>
        </form>

        <div class="action mt-4" style="text-align: center;">
            <a href="{{ route('carts.edit', $cart->cart_id) }}" class="btn btn-warning btn-block">Add More Product</a>
        </div>
    </div>


    {{-- Customer Search --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // AJAX search function
        // AJAX search function for customers
        $(document).ready(function() {
            $('#search-form').on('submit', function(e) {
                e.preventDefault();

                let searchValue = $('#search-input').val();

                $.ajax({
                    url: '{{ route('customers.search') }}',
                    method: 'GET',
                    data: {
                        search: searchValue
                    },
                    success: function(response) {
                        let customers = response.customers;
                        let tableBody = $('#customers-table tbody');
                        let customerSelect = $('#customer_id');
                        tableBody.empty();
                        customerSelect.empty();

                        // Add a default option for the customer select
                        customerSelect.append('<option value="">Select Customer</option>');

                        // If there are customers, display them in the table and dropdown
                        if (customers.length > 0) {
                            customers.forEach(function(customer) {
                                // Add each customer to the table
                                tableBody.append(
                                    `<tr>
                                <td>${customer.name}</td>
                                <td>${customer.email}</td>
                                <td>${customer.phone}</td>
                                <td>${customer.barcode_number}</td>
                                <td>
                                    <button class="btn btn-info select-customer-btn" data-id="${customer.id}" data-name="${customer.name}" data-email="${customer.email}">Select</button>
                                </td>
                            </tr>`
                                );
                                // Add each customer to the dropdown
                                customerSelect.append(
                                    `<option value="${customer.id}">${customer.name} (${customer.email})</option>`
                                );
                            });
                        } else {
                            tableBody.append(
                                '<tr><td colspan="5" class="text-center">No customers found</td></tr>'
                            );
                        }
                    }
                });
            });

            // Handle customer selection from the search results
            $(document).on('click', '.select-customer-btn', function() {
                let customerId = $(this).data('id');
                let customerName = $(this).data('name');
                let customerEmail = $(this).data('email');

                // Set the customer in the dropdown
                $('#customer_id').val(customerId).change();
                // Optionally, you can also fill in other fields, such as name and email, if needed.
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const createCustomerBtn = document.getElementById('create-customer-btn');
            const createCustomerForm = document.getElementById('create-customer-form');

            // Toggle the form visibility when the button is clicked
            createCustomerBtn.addEventListener('click', function() {
                if (createCustomerForm.style.display === 'none' || createCustomerForm.style.display ===
                    '') {
                    createCustomerForm.style.display = 'block'; // Show the form
                } else {
                    createCustomerForm.style.display = 'none'; // Hide the form
                }
            });
        });
    </script>
<script>
    $(document).ready(function () {
        $('#create-customer-form-element').on('submit', function (e) {
            e.preventDefault();

            // Gather form data
            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('customers.store') }}", // Adjust this to your actual route name
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        alert('Customer added successfully!');

                        // Optionally update customer dropdown or table dynamically
                        $('#customer_id').append(
                            `<option value="${response.customer.id}" selected>
                                ${response.customer.name} (${response.customer.email})
                            </option>`
                        );

                        // Reset the form
                        $('#create-customer-form-element')[0].reset();
                        $('#create-customer-form').hide();
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error adding customer:', xhr.responseText);
                    alert('Failed to add customer. Please check the form and try again.');
                },
            });
        });

        // Button to toggle the customer form (optional)
        $('#create-customer-button').on('click', function () {
            $('#create-customer-form').toggle();
        });
    });
</script>



    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const subtotalInput = document.getElementById('subtotal');
            const taxInput = document.getElementById('tax');
            const shippingInput = document.getElementById('shipping_cost');
            const discountInput = document.getElementById('discount');
            const flatDiscountInput = document.getElementById('flat_discount');
            const totalPriceInput = document.getElementById('total');
            const roundTotalInput = document.getElementById('round_total');

            taxInput.value = 0;
            shippingInput.value = 0;
            discountInput.value = 0;
            flatDiscountInput.value = 0;

            function calculateTotal() {
                const subtotal = parseFloat(subtotalInput.value) || 0;
                const tax = parseFloat(taxInput.value) || 0;
                const shippingCost = parseFloat(shippingInput.value) || 0;
                const discount = parseFloat(discountInput.value) || 0;
                const flatDiscount = parseFloat(flatDiscountInput.value) || 0;

                const taxAmount = (subtotal * tax) / 100;
                const discountParcentage = (subtotal * discount) /100;
                let total = subtotal + taxAmount + shippingCost - discountParcentage;


                total -= flatDiscount;

                totalPriceInput.value = total.toFixed(2);
                roundTotalInput.value = Math.round(total).toFixed(2);
            }

            taxInput.addEventListener('input', calculateTotal);
            shippingInput.addEventListener('input', calculateTotal);
            discountInput.addEventListener('input', calculateTotal);
            flatDiscountInput.addEventListener('input', calculateTotal);

            calculateTotal();
        });
    </script>
@endsection
