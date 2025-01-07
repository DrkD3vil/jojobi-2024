@extends('adminBackend.adminLayout')


@section('title', 'Edit Product')

@section('content')
    <div class="container">
        <h2>Edit Product</h2>

        <form action="{{ route('products.update', $product->uuid) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
        
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
            </div>
        
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ $product->description }}</textarea>
            </div>
        
            <div class="form-group">
                <label for="sell_price">Sell Price</label>
                <input type="number" name="sell_price" id="sell_price" class="form-control" value="{{ $product->sell_price }}" step="0.01" required>
            </div>
        
            <div class="form-group">
                <label for="stock_quantity">Stock Quantity</label>
                <input type="number" name="stock_quantity" id="stock_quantity" class="form-control" value="{{ $product->stock_quantity }}" required>
            </div>
        
            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" name="image" id="image" class="form-control-file">
                @if ($product->image)
                    <img src="{{ asset('baackend_images/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100px; height: 100px; margin-top: 10px;">
                @endif
            </div>
        
            <div class="form-group">
                <label for="product_barcode">Product Barcode</label>
                <input type="text" name="product_barcode" id="product_barcode" class="form-control" value="{{ $product->product_barcode }}" required>
            </div>
        
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
        
    </div>
@endsection
