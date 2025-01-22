<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
            color: #333;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 30px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            font-size: 14px;
        }

        .success-message {
            color: green;
            font-size: 16px;
            text-align: center;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>

    <h1>Add New Customer</h1>

    @if (session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <div class="container">
        <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
            @error('name') <p class="error-message">{{ $message }}</p> @enderror

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            @error('email') <p class="error-message">{{ $message }}</p> @enderror

            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" required>
            @error('phone') <p class="error-message">{{ $message }}</p> @enderror

            <label for="address">Address:</label>
            <textarea name="address" id="address" required></textarea>
            @error('address') <p class="error-message">{{ $message }}</p> @enderror

            <label for="image">Image (optional):</label>
            <input type="file" name="image" id="image" accept="image/*">
            @error('image') <p class="error-message">{{ $message }}</p> @enderror

            <button type="submit">Add Customer</button>
        </form>
    </div>

</body>
</html>
