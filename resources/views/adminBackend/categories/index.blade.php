@extends('adminBackend.adminLayout')

@section('content')
<div class="container">
    <h1 class="mb-4">All Categories</h1>
    <div class="mb-3 text-end">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add New Category</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        @if ($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="width: 50px;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No Categories Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $categories->links('pagination::bootstrap-4') }}
</div>
@endsection
