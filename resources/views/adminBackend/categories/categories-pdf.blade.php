<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            padding: 20px;
            max-width: 1100px;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
            margin-bottom: 40px;
        }
        header {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            font-size: 24px;
        }
        footer {
            background-color: #4CAF50;
            color: #fff;
            text-align: center;
            padding: 10px 20px;
            position: absolute;
            bottom: 0;
            width: 100%;
            font-size: 14px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #e9e9e9;
        }
        .category-image {
            max-width: 100px;
            max-height: 100px;
            display: block;
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <header>
        <h1>Categories Report</h1>
    </header>

    <div class="container">
        <h1>Categories List</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category ID</th>
                    <th>Category Barcode</th>
                    <th>Category Name</th>
                    <th>Category Image</th>
                    <th>Created Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->categoryid }}</td>
                    <td>
                        @if ($category->category_barcode_image)
                            <img src="file://{{ $category->barcode_image_path }}" alt="Barcode for {{ $category->category_name }}" class="barcode-image">
                        @else
                            <p>No barcode available.</p>
                        @endif
                    </td>
                    <td>{{ $category->category_name }}</td>
                    <td>
                        @if ($category->category_image)
                            <img src="file://{{ $category->image_path }}" alt="{{ $category->category_name }}" class="category-image">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($category->created_at)->format('F d, Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
    </footer>

</body>
</html>
