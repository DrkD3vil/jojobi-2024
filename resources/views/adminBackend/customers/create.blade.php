<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
</head>
<body>
    <h1>Add New Customer</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        @error('name') <p style="color: red;">{{ $message }}</p> @enderror

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        @error('email') <p style="color: red;">{{ $message }}</p> @enderror

        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" required>
        @error('phone') <p style="color: red;">{{ $message }}</p> @enderror

        <label for="address">Address:</label>
        <textarea name="address" id="address" required></textarea>
        @error('address') <p style="color: red;">{{ $message }}</p> @enderror

        <label for="image">Image (optional):</label>
        <input type="file" name="image" id="image" accept="image/*">
        @error('image') <p style="color: red;">{{ $message }}</p> @enderror

        <button type="submit">Add Customer</button>
    </form>
</body>
</html>
