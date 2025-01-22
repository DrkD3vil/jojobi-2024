@extends('adminBackend.adminLayout')

@section('content')
    <div class="container">
        <h1>Create Payment for Transaction: {{ $transaction->transaction_id }}</h1>

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

        <form action="{{ route('payments.store') }}" method="POST">
            @csrf

            <!-- Hidden input for transaction_id -->
            <input type="hidden" name="transaction_id" value="{{ $transaction->transaction_id }}">

            <!-- Payment Method -->
            <div class="form-group mb-3">
                <label for="payment_method">Payment Method</label>
                <select name="payment_method" id="payment_method" class="form-control" required>
                    <option value="cash">Cash</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="bank_transfer">Bank Transfer</option>
                    <option value="mobile_money">Mobile Money</option>
                </select>
            </div>

            <!-- Total Amount -->
            <div class="form-group mb-3">
                <label for="total_amount">Total Amount</label>
                <input type="number" name="total_amount" id="total_amount" class="form-control" value="{{ $totalAmount }}"
                    readonly>
            </div>

            <!-- Payment Amount -->
            <div class="form-group mb-3">
                <label for="payment_amount">Amount Paid</label>
                <input type="number" name="payment_amount" id="payment_amount" class="form-control" required>
            </div>

            <!-- Change Amount -->
            <div class="form-group mb-3">
                <label for="change_amount">Change Amount</label>
                <input type="number" name="change_amount" id="change_amount" class="form-control">
            </div>

            <!-- Payment Status -->
            <div class="form-group mb-3">
                <label for="payment_status">Payment Status</label>
                <select name="payment_status" id="payment_status" class="form-control" required>
                    <option value="pending">Pending</option>
                    <option value="completed" selected>Completed</option>
                    <option value="failed">Failed</option>
                </select>
            </div>


            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit Payment</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // When the payment amount is updated
            $('#payment_amount').on('input', function() {
                // Get the total amount and payment amount
                var totalAmount = parseFloat($('#total_amount').val());
                var paymentAmount = parseFloat($('#payment_amount').val());

                // Ensure valid inputs
                if (!isNaN(totalAmount) && !isNaN(paymentAmount)) {
                    // Calculate the change
                    var changeAmount = paymentAmount - totalAmount;

                    // Convert to positive if negative
                    changeAmount = Math.abs(changeAmount);

                    // Set the calculated change in the change amount input field
                    $('#change_amount').val(changeAmount.toFixed(0)); // Format to 0 decimal places
                } else {
                    // If invalid input, reset the change amount
                    $('#change_amount').val(0);
                }

            });
        });
    </script>
@endsection
