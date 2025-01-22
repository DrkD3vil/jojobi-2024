@extends('adminBackend.adminLayout')

@section('content')
<div class="container">
    <h1>Edit User Data</h1>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $userdata->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name Field -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $userdata->name) }}" required>
        </div>

        <!-- Email Field -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $userdata->email) }}" required>
        </div>

        <!-- Phone Field -->
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $userdata->phone) }}">
        </div>

        <!-- Role Dropdown -->
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select id="role" name="role" class="form-select" required>
                <option value="admin" {{ old('role', $userdata->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role', $userdata->role) === 'user' ? 'selected' : '' }}>User</option>
                <option value="moderator" {{ old('role', $userdata->role) === 'moderator' ? 'selected' : '' }}>Moderator</option>
                <option value="guest" {{ old('role', $userdata->role) === 'guest' ? 'selected' : '' }}>Guest</option>
            </select>
        </div>

        <!-- Status Dropdown -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select" required>
                <option value="active" {{ old('status', $userdata->status) === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $userdata->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="suspended" {{ old('status', $userdata->status) === 'suspended' ? 'selected' : '' }}>Suspended</option>
                <option value="blocked" {{ old('status', $userdata->status) === 'blocked' ? 'selected' : '' }}>Blocked</option>
                <option value="unverified" {{ old('status', $userdata->status) === 'unverified' ? 'selected' : '' }}>Unverified</option>
                <option value="verified" {{ old('status', $userdata->status) === 'verified' ? 'selected' : '' }}>Verified</option>
            </select>
        </div>

        <!-- Update Button -->
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection