@extends('adminBackend.adminLayout')

@section('content')
    <style>
        /* Card Styles */
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            border-radius: 10px;
            object-fit: cover;
        }

        /* Layout and Grid */
        .container {
            max-width: 1200px;
        }

        .row {
            margin-top: 20px;
        }

        /* Product Image */
        .product-image {
            max-height: 400px;
            object-fit: cover;
        }

        /* Product Details Section */
        .product-details .list-group-item {
            font-size: 1.1rem;
            padding: 10px 15px;
            color: #555;
            background-color: #f8f9fa;
            border: none;
            transition: background-color 0.3s ease;
        }

        .product-details .list-group-item:hover {
            background-color: #f1f1f1;
        }

        .product-details .list-group-item strong {
            color: #007bff;
        }

        /* Button Styles */
        .btn {
            padding: 10px 20px;
            font-size: 1.1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Responsive design */
        @media (max-width: 767px) {
            .product-image {
                max-height: 250px;
            }

            .row {
                display: block;
            }

            .product-details .list-group-item {
                font-size: 1rem;
            }
        }
    </style>

<div class="container mt-5">
    <div class="row">
        <!-- Product Main Image Section -->
        <div class="col-sm-12 col-md-4">
            <div class="card">
                <img src="{{ asset('baackend_images/' . ($product->image ?? 'default_product.png')) }}" 
                     alt="{{ $product->name }}" class="card-img-top product-image">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description ?? 'No description available.' }}</p>
                </div>
            </div>
        </div>

        <!-- Product Details Section -->
        <div class="col-sm-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Product Details</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <img src="{{ asset('baackend_images/' . ($product->product_barcode_image ?? 'default_barcode.png')) }}" 
                                 alt="{{ $product->product_barcode }}" class="card-img-top">
                        </li>
                        <li class="list-group-item"><strong>Barcode:</strong> {{ $product->product_barcode }}</li>
                        <li class="list-group-item"><strong>Price:</strong> ${{ number_format($product->sell_price, 2) }}</li>
                        <li class="list-group-item"><strong>Stock Quantity:</strong> {{ $product->stock_quantity }}</li>
                        <li class="list-group-item"><strong>Brand:</strong> {{ $product->brand }}</li>
                        <li class="list-group-item"><strong>Category Barcode:</strong> {{ $product->category_barcode }}</li>
                        <li class="list-group-item"><strong>Product Type:</strong> {{ $product->product_type }}</li>
                        <li class="list-group-item"><strong>Weight:</strong> {{ $product->weight }} kg</li>
                        <li class="list-group-item"><strong>Dimensions:</strong> 
                            {{ $product->length ?? '-' }} x {{ $product->width ?? '-' }} x {{ $product->height ?? '-' }} cm
                        </li>
                        <li class="list-group-item"><strong>Featured:</strong> {{ $product->is_featured ? 'Yes' : 'No' }}</li>
                        <li class="list-group-item"><strong>Active:</strong> {{ $product->is_active ? 'Yes' : 'No' }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Category Details Section -->
        <div class="col-sm-12 col-md-4">
            <div class="card">
                <!-- Category Image -->
                @if ($category->category_image)
                    <img src="{{ asset('baackend_images/' . $category->category_image) }}" 
                         alt="{{ $category->category_name }} Image" class="card-img-top category-image">
                @else
                    <p class="text-center p-3">No image available.</p>
                @endif
                <div class="card-body">
                    <h5 class="card-title text-center">Category Details</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <img src="{{ asset('baackend_images/' . ($product->category_barcode_image ?? 'default_category_barcode.png')) }}" 
                                 alt="{{ $category->category_barcode }}" class="card-img-top">
                        </li>
                        <li class="list-group-item"><strong>Category Barcode:</strong> {{ $category->category_barcode }}</li>
                        <li class="list-group-item"><strong>Category Name:</strong> {{ $category->category_name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="row mt-3">
        <div class="col-md-12 text-center">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Product List</a>
        </div>
    </div>
</div>

@endsection
