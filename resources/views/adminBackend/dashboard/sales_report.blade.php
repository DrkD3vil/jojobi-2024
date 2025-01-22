@extends('adminBackend.adminLayout')

@section('content')
<div class="container">
    <h1>Sales Report</h1>

    <!-- Date Filter Form -->
    <form method="GET" action="{{ route('admin.sales_report') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <!-- Sales Report Table -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Product Name</th>
                    <th>Total Quantity Sold</th>
                    <th>Total Due</th>
                    <th>Total Advance</th>
                    <th>Total Sales</th>
                    <th>Total Profit</th>
                    <th>Total Completed Payment</th>
                </tr>
            </thead>
            <tbody>
                @forelse($salesData as $data)
                    <tr>
                        <td>{{ \App\Models\Product::find($data->product_id)->name ?? 'N/A' }}</td>
                        <td>{{ $data->total_quantity }}</td>
                        <td>{{ number_format($data->total_due, 2) }}</td>
                        <td>{{ number_format($data->total_advance, 2) }}</td>
                        <td>{{ number_format($data->total_sales, 2) }}</td>
                        <td>{{ number_format($data->total_profit, 2) }}</td>
                        <td>{{ number_format($data->total_completed_payment, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No data available for the selected filters.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $salesData->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection