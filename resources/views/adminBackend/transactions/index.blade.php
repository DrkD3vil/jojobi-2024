@extends('adminBackend.adminLayout')

@section('content')
    <div class="container">
    <h1>Transactions</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Order Number</th>
                <th>Payment Method</th>
                <th>Amount Paid</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->order->order_number }}</td>
                    <td>{{ ucfirst($transaction->payment_method) }}</td>
                    <td>${{ number_format($transaction->amount_paid, 2) }}</td>
                    <td>{{ ucfirst($transaction->status) }}</td>
                    <td>{{ $transaction->created_at->format('d M Y, h:i A') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $transactions->links() }}
</div>

@endsection
