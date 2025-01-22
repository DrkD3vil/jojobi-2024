@extends('adminBackend.adminLayout')

@section('content')
<div class="container">
    <h1>Supplier Details</h1>

    <table class="table">
        <tr>
            <th>ID:</th>
            <td>{{ $supplier->supplier_id }}</td>
        </tr>
        <tr>
            <th>Supplier Name:</th>
            <td>{{ $supplier->supplier_name }}</td>
        </tr>
        <tr>
            <th>Barcode:</th>
            <td>{{ $supplier->supplier_barcode }}</td>
        </tr>
        <tr>
            <th>Amount:</th>
            <td>{{ $supplier->amount }}</td>
        </tr>
        <tr>
            <th>Paid:</th>
            <td>{{ $supplier->paid }}</td>
        </tr>
        <tr>
            <th>Due:</th>
            <td>{{ $supplier->due }}</td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>{{ $supplier->status }}</td>
        </tr>
        <tr>
            <th>Created At:</th>
            <td>{{ $supplier->created_at }}</td>
        </tr>
        <tr>
            <th>Updated At:</th>
            <td>{{ $supplier->updated_at }}</td>
        </tr>
    </table>

    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
