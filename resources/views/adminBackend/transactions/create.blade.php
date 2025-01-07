{{-- @extends('adminBackend.adminLayout')


@section('content')
    <div class="container">
        <h1>Create New Transaction</h1>

        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" class="form-control" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="products">Products</label>
                <div id="product-fields">
                    <div class="product-field">
                        <select name="products[0][product_id]" class="form-control" required>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="products[0][quantity]" class="form-control mt-2" placeholder="Quantity" required>
                    </div>
                </div>
                <button type="button" id="add-product" class="btn btn-secondary mt-2">Add Product</button>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit Transaction</button>
        </form>
    </div>

    <script>
        document.getElementById('add-product').addEventListener('click', function() {
            const productFields = document.getElementById('product-fields');
            const productCount = productFields.querySelectorAll('.product-field').length;
            const newProductField = document.createElement('div');
            newProductField.classList.add('product-field');
            newProductField.innerHTML = `
                <select name="products[${productCount}][product_id]" class="form-control" required>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="products[${productCount}][quantity]" class="form-control mt-2" placeholder="Quantity" required>
            `;
            productFields.appendChild(newProductField);
        });
    </script>
@endsection --}}
