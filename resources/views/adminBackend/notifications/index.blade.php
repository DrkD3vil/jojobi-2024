@extends('adminBackend.adminLayout')

@section('content')
<div class="container">
    <h2>Product Expiry Notifications</h2>

    <!-- Expired Products -->
    @if($expiredProducts->isEmpty())
        <p>No products have expired yet.</p>
    @else
        <div class="alert alert-danger" role="alert">
            <strong>Expired Products:</strong> The following products have already expired.
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Expiry Date</th>
                        <th>Price</th>
                        <th>Details</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expiredProducts as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($product->expire_date)->format('d M, Y') }}</td>
                        <td>{{ $product->sell_price }}</td>
                        <td>
                            <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#productDetails{{ $product->id }}" aria-expanded="false" aria-controls="productDetails{{ $product->id }}">
                                View Details
                            </button>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('notifications.index') }}">
                                @csrf
                                <input type="hidden" name="done_product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-success">Done</button>
                            </form>
                        </td>
                    </tr>
                    <tr id="productDetails{{ $product->id }}" class="collapse">
                        <td colspan="6">
                            <div class="product-info">
                                <h5>Product Details</h5>
                                <ul>
                                    <li><strong>Product Name:</strong> {{ $product->product_name }}</li>
                                    <li><strong>Description:</strong> {{ $product->description }}</li>
                                    <li><strong>Price:</strong> ${{ $product->sell_price }}</li>
                                    <li><strong>Expiry Date:</strong> {{ \Carbon\Carbon::parse($product->expire_date)->format('d M, Y') }}</li>
                                </ul>

                                <!-- Supplier Details -->
                                <h5>Supplier Information</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Supplier Name</th>
                                            <th>Supplier ID</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $product->supplier->supplier_name }}</td>
                                            <td>{{ $product->supplier->supplier_id }}</td>
                                            <td>{{ $product->supplier->status }}</td>
                                            <td>${{ $product->supplier->amount }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Expiring Today Products -->
    @if($todayExpiringProducts->isEmpty())
        <p>No products are expiring today.</p>
    @else
        <div class="alert alert-warning" role="alert">
            <strong>Expiring Today:</strong> The following products are expiring today.
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Expiry Date</th>
                        <th>Price</th>
                        <th>Details</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($todayExpiringProducts as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($product->expire_date)->format('d M, Y') }}</td>
                        <td>{{ $product->sell_price }}</td>
                        <td>
                            <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#productDetails{{ $product->id }}" aria-expanded="false" aria-controls="productDetails{{ $product->id }}">
                                View Details
                            </button>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('notifications.index') }}">
                                @csrf
                                <input type="hidden" name="done_product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-success">Done</button>
                            </form>
                        </td>
                    </tr>
                    <tr id="productDetails{{ $product->id }}" class="collapse">
                        <td colspan="6">
                            <div class="product-info">
                                <h5>Product Details</h5>
                                <ul>
                                    <li><strong>Product Name:</strong> {{ $product->product_name }}</li>
                                    <li><strong>Description:</strong> {{ $product->description }}</li>
                                    <li><strong>Price:</strong> ${{ $product->sell_price }}</li>
                                    <li><strong>Expiry Date:</strong> {{ \Carbon\Carbon::parse($product->expire_date)->format('d M, Y') }}</li>
                                </ul>

                                <!-- Supplier Details -->
                                <h5>Supplier Information</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Supplier Name</th>
                                            <th>Supplier ID</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $product->supplier->supplier_name }}</td>
                                            <td>{{ $product->supplier->supplier_id }}</td>
                                            <td>{{ $product->supplier->status }}</td>
                                            <td>${{ $product->supplier->amount }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Products Expiring in the Next 7 Days -->
    @if($productsExpiringSoon->isEmpty())
        <p>No products are expiring in the next 7 days.</p>
    @else
        <div class="alert alert-info" role="alert">
            <strong>Expiring Soon:</strong> The following products will expire in the next 7 days.
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Expiry Date</th>
                        <th>Price</th>
                        <th>Details</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productsExpiringSoon as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($product->expire_date)->format('d M, Y') }}</td>
                        <td>{{ $product->sell_price }}</td>
                        <td>
                            <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#productDetails{{ $product->id }}" aria-expanded="false" aria-controls="productDetails{{ $product->id }}">
                                View Details
                            </button>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('notifications.index') }}">
                                @csrf
                                <input type="hidden" name="done_product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-success">Done</button>
                            </form>
                        </td>
                    </tr>
                    <tr id="productDetails{{ $product->id }}" class="collapse">
                        <td colspan="6">
                            <div class="product-info">
                                <h5>Product Details</h5>
                                <ul>
                                    <li><strong>Product Name:</strong> {{ $product->product_name }}</li>
                                    <li><strong>Description:</strong> {{ $product->description }}</li>
                                    <li><strong>Price:</strong> ${{ $product->sell_price }}</li>
                                    <li><strong>Expiry Date:</strong> {{ \Carbon\Carbon::parse($product->expire_date)->format('d M, Y') }}</li>
                                </ul>

                                <!-- Supplier Details -->
                                <h5>Supplier Information</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Supplier Name</th>
                                            <th>Supplier ID</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $product->supplier->supplier_name }}</td>
                                            <td>{{ $product->supplier->supplier_id }}</td>
                                            <td>{{ $product->supplier->status }}</td>
                                            <td>${{ $product->supplier->amount }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection