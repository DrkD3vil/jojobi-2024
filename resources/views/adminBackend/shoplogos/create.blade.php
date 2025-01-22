@extends('adminBackend.adminLayout')

@section('content')
    <div class="container">
        <h1>Upload Shop Logo</h1>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('shop_logos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Shop Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="image">Logo Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>

            <!-- Hidden field for uploaded_by (autofilled with the logged-in user's name) -->
            <input type="hidden" name="uploaded_by" value="{{ Auth::user()->name }}">

            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea class="form-control" id="notes" name="notes">{{ old('notes') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Upload Logo</button>
        </form>
    </div>
@endsection