@extends('adminBackend.adminLayout')

@section('content')
<div class="container">
    <h1>Supplier List</h1>
    <a href="{{ route('suppliers.create') }}" class="btn btn-primary mb-3">Add Supplier</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Supplier Name</th>
                <th>Barcode</th>
                <th>Amount</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->supplier_id }}</td>
                    <td>{{ $supplier->supplier_name }}</td>
                    <td>{{ $supplier->supplier_barcode }}</td>
                    <td>{{ $supplier->amount }}</td>
                    <td>{{ $supplier->paid }}</td>
                    <td>{{ $supplier->due }}</td>
                    <td>{{ $supplier->status }}</td>
                    <td>
                        <a href="{{ route('suppliers.show', $supplier->uuid) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('suppliers.edit', $supplier->uuid) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('suppliers.destroy', $supplier->uuid) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $suppliers->links() }}
</div>
@endsection
