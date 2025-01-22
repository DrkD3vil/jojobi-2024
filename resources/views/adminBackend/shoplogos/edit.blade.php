@extends('adminBackend.adminLayout')

@section('content')
    <div class="container">
        <h1>Edit Shop Logo</h1>

        <form action="{{ route('shop_logos.update', $logo->uuid) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Shop Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $logo->name) }}" required>
            </div>

            <div class="form-group">
                <label for="image">Logo Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea class="form-control" id="notes" name="notes">{{ old('notes', $logo->notes) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Logo</button>
        </form>
    </div>
@endsection