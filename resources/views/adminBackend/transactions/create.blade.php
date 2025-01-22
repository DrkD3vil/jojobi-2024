@extends('adminBackend.adminLayout') <!-- Adjust based on your layout -->

@section('content')
<div class="container">
    <h1>Create Transaction</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        <!-- Display order details -->
        <div class="mb-3">
            <h3>Order Details</h3>
            <p><strong>Order ID:</strong> {{ $order->order_id }}</p>
            <p><strong>UUID:</strong> {{ $order->uuid }}</p>
            <p><strong>Round Total:</strong> {{ number_format($order->round_total, 2) }}</p>
        </div>

        <!-- Display customer details -->
        <div class="mb-3">
            <h3>Customer Details</h3>
            <p><strong>Name:</strong> {{ $customer->name }}</p>
            <p><strong>Barcode:</strong> {{ $customer->barcode_number }}</p>
            <p><strong>Due Amount:</strong> {{ number_format($customer->due_amount, 2) }}</p>
            <p><strong>Advance Amount:</strong> {{ number_format($customer->advance_amount, 2) }}</p>
        </div>

        <!-- Hidden inputs for necessary data -->
        <input type="hidden" name="order_id" value="{{ $order->order_id }}">
        <input type="hidden" name="customer_barcode" value="{{ $customer->barcode_number }}">
        <input type="hidden" name="transaction_date" value="{{ now() }}">

        <!-- Total amount -->
        <div class="form-group mb-3">
            <label for="total_amount">Total Amount</label>
            <input type="number" step="0.01" name="total_amount" id="total_amount" class="form-control" value="{{ number_format($totalAmount, 2) }}" readonly>
        </div>

        <!-- Payment status -->
        <div class="form-group mb-3">
            <label for="payment_status">Payment Status</label>
            <select name="payment_status" id="payment_status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="failed">Failed</option>
            </select>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Create Transaction</button>
    </form>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the values from the PHP variables
        let orderTotal = parseFloat("{{ $order->round_total }}");
        let customerDueAmount = parseFloat("{{ $customer->due_amount }}");
        let customerAdvanceAmount = parseFloat("{{ $customer->advance_amount }}");

        // Calculate total amount based on conditions
        let totalAmount = orderTotal + customerDueAmount - customerAdvanceAmount;

        // Set the value in the total_amount input field
        document.getElementById('total_amount').value = totalAmount.toFixed(2);
    });
</script>
@endsection

