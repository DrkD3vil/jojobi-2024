@extends('adminBackend.adminLayout')

@section('content')
    <div class="container">
        <h1>Shop Logo Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $logo->name }}</h5>
                <p><strong>Uploaded By:</strong> {{ $logo->uploaded_by }}</p>
                <p><strong>Notes:</strong> {{ $logo->notes }}</p>
                <p><strong>Logo Image:</strong></p>
                <img src="{{ asset($logo->image) }}" alt="{{ $logo->name }}" width="200">

                <a href="{{ route('shop_logos.index') }}" class="btn btn-secondary mt-3">Back to List</a>
            </div>
        </div>
    </div>
@endsection