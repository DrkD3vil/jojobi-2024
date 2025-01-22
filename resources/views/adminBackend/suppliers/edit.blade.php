@extends('adminBackend.adminLayout')


@section('content')
<div class="container">
    <h1>Edit Supplier</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('suppliers.update', $supplier->uuid) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="supplier_name">Supplier Name</label>
            <input type="text" name="supplier_name" id="supplier_name" class="form-control" value="{{ $supplier->supplier_name }}" required>
        </div>
        <div class="form-group">
            <label for="supplier_barcode">Barcode</label>
            <input type="text" name="supplier_barcode" id="supplier_barcode" class="form-control" value="{{ $supplier->supplier_barcode }}" required>
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" value="{{ $supplier->amount }}">
        </div>
        <div class="form-group">
            <label for="paid">Paid</label>
            <input type="number" name="paid" id="paid" class="form-control" value="{{ $supplier->paid }}">
        </div>
        <div class="form-group">
            <label for="due">Due</label>
            <input type="number" name="due" id="due" class="form-control" value="{{ $supplier->due }}">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="active" {{ $supplier->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $supplier->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
</div>
@endsection
