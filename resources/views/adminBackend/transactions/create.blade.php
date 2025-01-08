
@extends('adminBackend.adminLayout')

@section('content')


<div class="container">
    <h1>Transaction for Order #{{ $order->order_number }}</h1>

    <form action="{{ route('transactions.store', $order->id) }}" method="POST">
        @csrf
        <div>
            <label for="payment_method">Payment Method:</label>
            <select name="payment_method" id="payment_method" required>
                <option value="cash">Cash</option>
                <option value="credit_card">Credit Card</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>
        </div>

        <div>
            <label for="amount_paid">Amount Paid:</label>
            <input type="number" name="amount_paid" id="amount_paid" required step="0.01" min="0"
                   value="{{ $order->total_price }}">
        </div>

        <button type="submit" class="btn btn-success">Complete Transaction</button>
    </form>

    <a href="{{ route('orders.index') }}" class="btn btn-primary">Back to Orders</a>
</div>
@endsection