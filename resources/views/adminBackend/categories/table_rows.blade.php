@foreach ($data as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->categoryid }}</td>
        <td>{{ $item->category_name }}</td>
        <td>{{ $item->category_barcode }}</td>
        <td>
            @if ($item->category_image)
                <img src="{{ asset('baackend_images//' . $item->category_image) }}"
                     alt="{{ $item->category_name }}"
                     style="width: 50px; height: 50px; object-fit: cover;">
            @else
                No Image
            @endif
        </td>
        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</td>
        <td>
            <a class="btn btn-success" href="{{ route('category.edit', $item->uuid) }}">Edit</a>
            <a class="btn btn-danger" onclick="confirmation(event)"
               href="{{ route('category.delete', $item->uuid) }}">Delete</a>
            <a class="btn btn-success" href="{{ route('category.singleView', $item->uuid) }}">View</a>
        </td>
    </tr>
@endforeach
