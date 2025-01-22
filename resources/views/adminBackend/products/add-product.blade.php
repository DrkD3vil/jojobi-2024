@extends('adminBackend.adminLayout')

@section('title', 'Add New Product')

@section('content')
<div class="container">
    <h2>Add New Product</h2>

    <!-- Form for adding a new product -->
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!--Product Barcode -->
        {{-- <div class="form-group">
    <label for="product_barcode">Barcode</label>
    <input id="product_barcode" type="text" name="product_barcode" value="{{ old('product_barcode') }}"
        class="form-control" required autocomplete="product_barcode" />
        @if ($errors->has('product_barcode'))
        <span class="text-danger">{{ $errors->first('product_barcode') }}</span>
        @endif
</div> --}}

<!-- Barcode -->
<div class="form-group">
    <label for="product_barcode" class="font-weight-bold">Barcode:</label>
    <input type="text" id="product_barcode" name="product_barcode"
        placeholder="Enter or generate barcode" class="form-control" value="{{ old('product_barcode') }}" required>
    <button type="button" id="generate-barcode-btn"
        class="btn btn-secondary mt-2">Generate</button>
    <small id="barcode-status" style="color: red;"></small>
</div>

<!-- Product Name -->
<div class="form-group">
    <label for="name">Product Name</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
    @error('name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Product Description -->
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
    @error('description')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Original Price -->
<div class="form-group">
    <label for="original_price">Original Price</label>
    <input type="number" name="original_price" id="original_price" class="form-control" value="{{ old('original_price') }}" step="0.01" required>
    @error('original_price')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Buy Price -->
<div class="form-group">
    <label for="buy_price">Buy Price</label>
    <input type="number" name="buy_price" id="buy_price" class="form-control" value="{{ old('buy_price') }}" step="0.01" required>
    @error('buy_price')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Sell Price -->
<div class="form-group">
    <label for="sell_price">Sell Price</label>
    <input type="number" name="sell_price" id="sell_price" class="form-control" value="{{ old('sell_price') }}" step="0.01" required>
    @error('sell_price')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Discount Percentage -->
<div class="form-group">
    <label for="discount_percentage">Discount Percentage</label>
    <input type="number" name="discount_percentage" id="discount_percentage" class="form-control" value="{{ old('discount_percentage') }}" step="0.01" max="100">
    @error('discount_percentage')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Discounted Price -->
<div class="form-group">
    <label for="discounted_price">Discounted Price</label>
    <input type="number" name="discounted_price" id="discounted_price" class="form-control" value="{{ old('discounted_price') }}" step="0.01">
    @error('discounted_price')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Category -->
<div class="form-group">
    <label for="category_id">Category</label>
    <select name="category_id" id="category_id" class="form-control" required>
        <option value="">Select Category</option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->category_name }}
        </option>
        @endforeach
    </select>
    @error('category_id')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Supplier -->
<div class="form-group">
    <label for="supplier_id">Supplier</label>
    <select name="supplier_id" id="supplier_id" class="form-control" required>
        <option value="">Select Supplier</option>
        @foreach($suppliers as $supplier)
        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
            {{ $supplier->supplier_name }}
        </option>
        @endforeach
    </select>
    @error('category_id')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Stock Quantity -->
<div class="form-group">
    <label for="stock_quantity">Stock Quantity</label>
    <input type="number" name="stock_quantity" id="stock_quantity" class="form-control" value="{{ old('stock_quantity') }}" required>
    @error('stock_quantity')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Brand -->
<div class="form-group">
    <label for="brand">Brand</label>
    <input type="text" name="brand" id="brand" class="form-control" value="{{ old('brand') }}">
    @error('brand')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Product Image -->
<div class="form-group">
    <label for="image">Product Image</label>
    <input type="file" name="image" id="image" class="form-control-file">
    @error('image')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Product Type -->
<div class="form-group">
    <label for="product_type">Product Type</label>
    <input type="text" name="product_type" id="product_type" class="form-control" value="{{ old('product_type') }}">
    @error('product_type')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Manufacture Date -->
<div class="form-group">
    <label for="manufacture_date">Manufacture Date</label>
    <input type="date" name="manufacture_date" id="manufacture_date" class="form-control" value="{{ old('manufacture_date') }}">
    @error('manufacture_date')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Expire Date -->
<div class="form-group">
    <label for="expire_date">Expire Date</label>
    <input type="date" name="expire_date" id="expire_date" class="form-control" value="{{ old('expire_date') }}">
    @error('expire_date')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Dimensions and Weight -->
<div class="form-row">
    <div class="form-group col-md-3">
        <label for="weight">Weight</label>
        <input type="number" name="weight" id="weight" class="form-control" value="{{ old('weight') }}" step="0.01">
    </div>
    <div class="form-group col-md-3">
        <label for="length">Length</label>
        <input type="number" name="length" id="length" class="form-control" value="{{ old('length') }}" step="0.01">
    </div>
    <div class="form-group col-md-3">
        <label for="width">Width</label>
        <input type="number" name="width" id="width" class="form-control" value="{{ old('width') }}" step="0.01">
    </div>
    <div class="form-group col-md-3">
        <label for="height">Height</label>
        <input type="number" name="height" id="height" class="form-control" value="{{ old('height') }}" step="0.01">
    </div>
</div>

<!-- Featured and Active Status -->
<div class="form-group">
    <label for="is_featured">Featured Product</label>
    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
</div>

<div class="form-group">
    <label for="is_active">Active</label>
    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
</div>

<!-- Submit Button -->
<button type="submit" class="btn btn-primary">Add Product</button>
</form>
</div>


<!-- Include jQuery and Toastr scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        // Generate Barcode
        $('#generate-barcode-btn').click(function() {
            $.ajax({
                url: '/generate-barcode', // Backend route for generating barcode
                method: 'GET',
                success: function(response) {
                    if (response.barcode) {
                        // Populate the barcode field with the generated value
                        $('#product_barcode').val(response.barcode);

                        // Display a success message using Toastr
                        toastr.success('Barcode generated successfully!');
                    } else {
                        // Handle unexpected errors with Toastr
                        toastr.error('Error: Barcode could not be generated');
                    }

                    // Optionally display a status message in the small element
                    $('#barcode-status')
                        .text('Barcode generated successfully')
                        .css('color', 'green');
                },
                error: function(xhr, status, error) {
                    // Display an error message using Toastr if the AJAX request fails
                    toastr.error('Error generating barcode: ' + xhr.responseText);

                    // Optionally display the error status message in the small element
                    $('#barcode-status')
                        .text('Error generating barcode: ' + xhr.responseText)
                        .css('color', 'red');
                }
            });
        });
    });
</script>


@endsection