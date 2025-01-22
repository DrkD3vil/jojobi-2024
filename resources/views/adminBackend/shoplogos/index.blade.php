@extends('adminBackend.adminLayout')

@section('content')
    <div class="container">
        <h1>Shop Logos</h1>

        <!-- Button to add a new logo -->
        <a href="{{ route('shop_logos.create') }}" class="btn btn-success mb-3">Add Logo</a>

        <!-- Display success message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display the shop logos in a table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>UUID</th>
                    <th>Name</th>
                    <th>Logo Image</th>
                    <th>Uploaded By</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shopLogos as $logo)
                    <tr>
                        <td>{{ $logo->uuid }}</td>
                        <td>{{ $logo->name }}</td>
                        <td><img src="{{ asset($logo->image) }}" alt="{{ $logo->name }}" width="100"></td>
                        <td>{{ $logo->uploaded_by }}</td>
                        <td>{{ $logo->notes }}</td>
                        <td>
                            <!-- View Button -->
                            <a href="{{ route('shop_logos.show', $logo->uuid) }}" class="btn btn-primary">View</a>
                            
                            <!-- Edit Button -->
                            <a href="{{ route('shop_logos.edit', $logo->uuid) }}" class="btn btn-warning">Edit</a>
                            
                            <!-- Delete Button with Confirmation -->
                            <form action="{{ route('shop_logos.destroy', $logo->uuid) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this logo?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination links -->
        {{ $shopLogos->links() }}
    </div>
@endsection