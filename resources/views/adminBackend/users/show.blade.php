@extends('adminBackend.adminLayout')

@section('content')
<div class="container">
    <h1>{{ $userdata->name }} Details</h1>

    <div class="card">
        <div class="card-header">
            {{ $userdata->name }}
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> {{ $userdata->email }}</p>
            <p><strong>Phone:</strong> {{ $userdata->phone ?? 'N/A' }}</p>
            <p><strong>Role:</strong> {{ ucfirst($userdata->role ?? 'N/A') }}</p>
            <p><strong>Status:</strong> {{ $userdata->status ? 'Active' : 'Inactive' }}</p>
            <p><strong>Address:</strong> {{ $userdata->address ?? 'N/A' }}</p>
            <p><strong>Profile Image:</strong></p>
            <img src="{{ asset($userdata->profile_image) }}" alt="Profile Image" width="150">

            <a href="{{ route('users.index') }}" class="btn btn-primary mt-3">Back</a>
        </div>
    </div>
</div>
@endsection