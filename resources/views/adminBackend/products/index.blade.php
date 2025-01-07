@extends('adminBackend.adminLayout')
@section('title', 'All Products')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>

        /* Container for the Tab */
        .tabs-container {
            /* display: flex; */
            justify-content: center;
            align-items: center;
            /* margin-top: 50px; */
            /* width: 100%; */
        }

        /* Tab Navigation */
        .tabs {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .tabs a {
            display: flex;
            justify-content: center;
            align-items: center;
            color: #555;
            text-decoration:none;
            font-size: 1.5rem;
            transition: background-color 0.3s ease, color 0.3s ease;
            width: 100%;
            height: 60px;
            border-radius: 20px;
            margin: 5px;
            background-color: #f8f8f8;
        }

        /* Hover and Active States */
        .tabs a:hover {
            background-color: #007bff;
            color: #ffffff;
        }

        .tabs a.active {
            background-color: #007bff;
            color: #ffffff;
        }

        /* Icons */
        .tabs a i {
            font-size: 1.5rem;
        }
        .fas{
            font-family: 'Font Awesome 5 Free', sans-serif;

        }
</style>
<!-- Tab Section -->
<div class="tabs-container">
    <div class="tabs">
        <a href="{{ route('products.index' )}}" class="active"><i class="">Products List</i></a>
        <a href="{{ route('products.preview-pdf')}}" class="btn btn-primary">
            <i class="fas fa-file-pdf"></i> PDF
        </a>
        <a href="{{ route('products.export') }}" class="btn btn-primary">
            <i class="fa-sharp fa-solid fa-file-csv"></i> Export
        </a>
        <a href="{{ route('products.import-format')}}"><i class="fas fa-cogs"></i>Tamplate</a>
        <a href="#contact"><i class="fas fa-phone-alt"></i>content</a>
    </div>
</div>

<form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="file">Upload Excel File</label>
        <input type="file" name="file" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Import Products</button>
</form>


    <div class="container">
        <h2>All Products</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Barcode</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>
                            @if ($product->product_barcode_image)
                                <img src="{{ asset('baackend_images/' . $product->product_barcode_image) }}" alt="Barcode"
                                    style="width: 150px; height: 50px;">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $product->category->category_name ?? 'N/A' }}</td>
                        <td>{{ $product->sell_price }}</td>
                        <td>{{ $product->stock_quantity }}</td>
                        <td>
                            @if ($product->image)
                                <img src="{{ asset('baackend_images/' . $product->image) }}" alt="{{ $product->name }}"
                                    style="width: 50px; height: 50px;">
                            @else
                                N/A
                            @endif
                        </td>

                        <td>
                            {{-- Edit --}}
                            <a href="{{ route('products.edit', $product->uuid) }}" class="btn btn-warning btn-sm">Edit</a>
                            {{-- Delete Form --}}
                            <form action="{{ route('products.delete', $product->uuid) }}" method="POST"
                                style="display:inline;" id="delete-form-{{ $product->uuid }}">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-danger" href="javascript:void(0);"
                                    onclick="confirmation(event, '{{ $product->uuid }}')">Delete</a>
                            </form>
                            {{-- End Delete Form --}}
                            <a class="btn btn-success" href="{{ route('products.show', $product->uuid) }}">View</a>
                            {{-- <a class="btn" href="{{ route('products.preview-pdf', $product->uuid) }}"><i class="fas fa-file-pdf"></i>PDF</a> --}}


                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination">
            {{ $products->links() }}
        </div>
    </div>
@endsection

<script>
    function confirmation(event, uuid) {
        event.preventDefault(); // Prevent the default anchor click behavior

        // Show a confirmation dialog
        if (confirm('Are you sure you want to delete this product?')) {
            // If confirmed, submit the corresponding form
            document.getElementById('delete-form-' + uuid).submit();
        }
    }
</script>
<script>
    // Optional JavaScript to highlight the active tab when clicked
    const tabs = document.querySelectorAll('.tabs a');

    tabs.forEach(tab => {
        tab.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default anchor behavior

            // Remove 'active' class from all tabs
            tabs.forEach(t => t.classList.remove('active'));

            // Add 'active' class to clicked tab
            tab.classList.add('active');
        });
    });
</script>