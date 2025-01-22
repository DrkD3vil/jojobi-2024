@extends('adminBackend.adminLayout')

@section('content')


    <h1>PDF Actions</h1>
    <a href="{{ route('category.preview-pdf') }}" target="_blank">Preview Categories PDF</a>
    <br>
    <a href="{{ route('category.download-pdf') }}">Download Categories PDF</a>
    <!-- Category Table -->
    <div class="container-xxl flex-grow-1 container-p-y w-full me-auto">
        <!-- Responsive Table Container -->
        <div class="card">
            <h5 class="card-header">Category Table</h5>
            <hr class="my-0">
            <div class="card-datatable table-responsive">
                <div class="dataTables_wrapper dt-bootstrap5">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="DataTables_Table_3_length">
                                <label>Show
                                    <select id="entriesPerPage" name="DataTables_Table_3_length"
                                        aria-controls="DataTables_Table_3" class="form-select form-select-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> entries
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                            <!-- No search input needed here -->
                        </div>
                    </div>

                    <table class="dt-responsive table table-bordered dataTable dtr-column collapsed"
                        id="DataTables_Table_3">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category ID</th>
                                <th>Category Name</th>
                                <th>Category BarCode</th>
                                <th>Category Image</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableData">
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
                                        <a class="btn btn-success"
                                            href="{{ route('category.edit', $item->uuid) }}">Edit</a>
                                        <a class="btn btn-danger" onclick="confirmation(event)"
                                            href="{{ route('category.delete', $item->uuid) }}">Delete</a>
                                        <a class="btn btn-success"
                                            href="{{ route('category.singleView', $item->uuid) }}">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_info" id="DataTables_Table_3_info" role="status" aria-live="polite">
                                Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }}
                                entries
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_paginate paging_simple_numbers" id="paginationLinks">
                                {{ $data->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Responsive Table Container -->

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        // Function to load data with AJAX
        function loadData(page = 1, entriesPerPage = 10) {
            $.ajax({
                url: '{{ route('category.index') }}',
                type: 'GET',
                data: {
                    page: page,
                    entries_per_page: entriesPerPage
                },
                success: function(response) {
                    // Update table body with fetched data
                    $('#tableData').html(response.data);
                    $('#paginationLinks').html(response.pagination);
                    $('#DataTables_Table_3_info').text(response.info);
                }
            });
        }

        // Load data initially when the page loads
        $(document).ready(function() {
            loadData();

            // Entries per page functionality
            $('#entriesPerPage').on('change', function() {
                loadData(1, $(this).val()); // Load page 1 on entries change
            });
        });

        // Handle pagination click event
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            loadData(page, $('#entriesPerPage').val());
        });
    </script>
@endsection
