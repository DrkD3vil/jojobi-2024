@extends('adminBackend.adminLayout')

@section('content')
    <!-- Add Category Form -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg rounded">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Add Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('add_category') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <!-- Category Name -->
                            <div class="form-group">
                                <label for="category_name" class="font-weight-bold">Category Name</label>
                                <input id="category_name" type="text" name="category_name"
                                    value="{{ old('category_name') }}" class="form-control" required autofocus
                                    autocomplete="category_name" />
                                @if ($errors->has('category_name'))
                                    <span class="text-danger">{{ $errors->first('category_name') }}</span>
                                @endif
                            </div>

                            <!-- Barcode -->
                            <div class="form-group">
                                <label for="category_barcode" class="font-weight-bold">Barcode:</label>
                                <input type="text" id="category_barcode" name="category_barcode"
                                    placeholder="Enter or generate barcode" class="form-control" required>
                                <button type="button" id="generate-barcode-btn"
                                    class="btn btn-secondary mt-2">Generate</button>
                                <small id="barcode-status" style="color: red;"></small>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="category_description" class="font-weight-bold">Description</label>
                                <textarea id="category_description" name="category_description" class="form-control" rows="3"
                                    autocomplete="category_description">{{ old('category_description') }}</textarea>
                                @if ($errors->has('category_description'))
                                    <span class="text-danger">{{ $errors->first('category_description') }}</span>
                                @endif
                            </div>

                            <!-- Category Image -->
                            <div class="form-group">
                                <label for="category_image" class="font-weight-bold">Category Image</label>
                                <input id="category_image" type="file" name="category_image" class="form-control-file"
                                    accept="image/*" />
                                @if ($errors->has('category_image'))
                                    <span class="text-danger">{{ $errors->first('category_image') }}</span>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success btn-lg btn-block">Add Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery and Toastr scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            // Generate Barcode
            $('#generate-barcode-btn').click(function() {
                $.ajax({
                    url: '/generate-barcode', // Backend route for generating barcode
                    method: 'GET',
                    success: function(response) {
                        if (response.barcode) {
                            // Populate the barcode field with the generated value
                            $('#category_barcode').val(response.barcode);

                            // Display a success message using Toastr
                            toastr.success('Barcode generated successfully!');
                        } else {
                            // Handle unexpected errors with Toastr
                            toastr.error('Error: Barcode could not be generated');
                        }

                        // Optionally display a status message in the small element
                        $('#barcode-status')
                            .text('Barcode generated successfully')
                            .css('color', 'green');
                    },
                    error: function(xhr, status, error) {
                        // Display an error message using Toastr if the AJAX request fails
                        toastr.error('Error generating barcode: ' + xhr.responseText);

                        // Optionally display the error status message in the small element
                        $('#barcode-status')
                            .text('Error generating barcode: ' + xhr.responseText)
                            .css('color', 'red');
                    }
                });
            });
        });
    </script>
@endsection
