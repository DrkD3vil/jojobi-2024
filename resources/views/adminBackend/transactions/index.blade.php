@extends('adminBackend.adminLayout')

@section('content')
    <h1>All Transactions</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Amount History</th>
                <th>Total Amount</th>
                <th>Payment Status</th>
                <th>Transaction Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->transaction_id }}</td>
                    <td>{{ $transaction->order->order_id ?? 'N/A' }}</td>
                    <td>{{ $transaction->customer->name ?? 'N/A' }}</td>
                    <td>
                       Due:: {{ $transaction->customer_due }} <br>
                       Advance:: {{ $transaction->customer_advance }}
                    </td>
                    
                    <td>${{ number_format($transaction->total_amount, 2) }}</td>
                    <td>{{ ucfirst($transaction->payment_status) }}</td>
                    <td>{{ $transaction->transaction_date->format('Y-m-d H:i:s') }}</td>
                    <td>
                        <!-- Show Details button -->
                        <button class="btn btn-info" onclick="toggleDetails('{{ $transaction->id }}')">Details</button>

                        <!-- Show Proceed button only if payment status is Pending or Failed -->
                        @if ($transaction->payment_status == 'pending' || $transaction->payment_status == 'failed')
                        @if ($transaction->order)
    <a href="{{ route('carts.edit', $transaction->order->cart_id) }}">
        <button class="btn btn-primary">Proceed</button>
    </a>
@else
    <span class="text-danger">Order not found</span>
@endif
                        @else
                            <!-- Hide Proceed button if the payment status is Completed -->
                            <a style="display:none;" 
   href="{{ $transaction->order ? route('carts.edit', $transaction->order->cart_id) : '#' }}">
   Proceed
</a>
                        @endif
                    </td>

                </tr>

                <!-- Order and Customer Details Dropdown -->
                <tr id="details-{{ $transaction->id }}" style="display: none;">
                    <td colspan="7">
                        <h4>Order Details</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Order Total</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>
    @if ($transaction->order)
        {{ $transaction->order->order_id }}
    @else
        <span class="text-danger">Order not found</span>
    @endif
</td>
<td>
    @if ($transaction->order && $transaction->order->round_total)
        ${{ number_format($transaction->order->round_total, 2) }}
    @else
        <span class="text-danger">Amount not available</span>
    @endif
</td>
<td>
    @if ($transaction->order && $transaction->order->created_at)
        {{ $transaction->order->created_at->format('Y-m-d H:i:s') }}
    @else
        <span class="text-danger">Date not available</span>
    @endif
</td>
                                </tr>
                            </tbody>
                        </table>

                        <h4>Customer Details</h4>
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
                                    <td>{{ $transaction->customer->name }}</td>
                                    <td>{{ $transaction->customer->phone }}</td>
                                    <td>{{ $transaction->customer->barcode_number }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function toggleDetails(transactionId) {
            const detailsRow = document.getElementById(`details-${transactionId}`);
            detailsRow.style.display = detailsRow.style.display === 'none' ? 'table-row' : 'none';
        }
    </script>
@endsection
