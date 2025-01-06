@extends('adminBackend.adminLayout')

@section('content')
    <div class="container" style="max-width:800px; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
        <h1 class="text_cat" style="margin-bottom: 30px; text-align: center; font-weight: 700; font-size: 28px; color: #333;">Edit Category</h1>
        <form action="{{ route('category.update', $data->uuid) }}" method="post" enctype="multipart/form-data">
            @csrf
        
            <!-- Category Name -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="category_name" style="font-weight: bold;">Category Name</label>
                <input id="category_name" type="text" name="category_name" value="{{ old('category_name', $data->category_name) }}" class="form-control" required>
                @if ($errors->has('category_name'))
                    <span class="text-danger">{{ $errors->first('category_name') }}</span>
                @endif
            </div>
        
            <!-- Barcode -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="category_barcode" style="font-weight: bold;">Barcode</label>
                <input id="category_barcode" type="text" name="category_barcode" value="{{ old('category_barcode', $data->category_barcode) }}" class="form-control" required>
                @if ($errors->has('category_barcode'))
                    <span class="text-danger">{{ $errors->first('category_barcode') }}</span>
                @endif
            </div>
        
            <!-- Description -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="category_description" style="font-weight: bold;">Description</label>
                <textarea id="category_description" name="category_description" class="form-control" rows="3">{{ old('category_description', $data->category_description) }}</textarea>
                @if ($errors->has('category_description'))
                    <span class="text-danger">{{ $errors->first('category_description') }}</span>
                @endif
            </div>
        
            <!-- Image Upload -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="category_image" style="font-weight: bold;">Category Image</label>
                <input id="category_image" type="file" name="category_image" class="form-control-file">
                @if ($data->category_image)
                    <p>Current Image:</p>
                    <img src="{{ asset('baackend_images/' . $data->category_image) }}" alt="Category Image" style="width: 100px; height: 100px; object-fit: cover; margin-top: 10px;">
                    <p>Uploading a new image will replace the current one.</p>
                @endif
                @if ($errors->has('category_image'))
                    <span class="text-danger">{{ $errors->first('category_image') }}</span>
                @endif
            </div>
        
            <!-- Submit Button -->
            <div class="form-group" style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary">Update Category</button>
            </div>
        </form>
        
@endsection
