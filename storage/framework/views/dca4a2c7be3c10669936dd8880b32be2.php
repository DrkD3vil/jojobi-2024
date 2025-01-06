



<style>
    /* Global Styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #1f2428;
        /* Dark background for contrast */
        color: #ddd;
        /* Light text color for readability */
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .text_cat {
        margin-bottom: 20px;
        text-align: center;
        font-weight: 700;
        font-size: 2rem;
        color: #ddd;
    }

    /* Form Styles */
    form {
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        max-width: 600px;
        margin: 0 auto;
        background-color: #ffffff;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #ddd;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #d6d6d6;
        color: #fff;
        font-size: 1rem;
    }

    .form-group textarea {
        resize: vertical;
    }

    /* Button Styles */
    .btn-primary {
        color: #fff;
        background-color: #007bff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-size: 1rem;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Table Styles */
    .table-container {
        margin-top: 20px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .table-deg {
        width: 100%;
        border-collapse: collapse;
    }

    .table-deg th,
    .table-deg td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
        font-size: 1rem;
    }

    .table-deg th {
        background-color: #f2f2f2;
        font-weight: bold;
        color: #333;
    }

    .table-deg tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table-deg tr:hover {
        background-color: #9CDBA6;
        font-size: 1.1rem;
        font-weight: 700;
        color: #2d3035;
    }

    /* Pagination Styles */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        padding-left: 0;
        list-style: none;
    }

    .pagination>li {
        display: inline;
    }

    .pagination>li>a,
    .pagination>li>span {
        padding: 8px 12px;
        margin-left: -1px;
        line-height: 1.5;
        color: #007bff;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .pagination>.active>a,
    .pagination>.active>span {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .pagination>li>a:hover,
    .pagination>li>span:hover {
        background-color: #e9ecef;
        border-color: #ddd;
    }

    /* Calendar Icon */
    .calendar-icon {
        cursor: pointer;
        font-size: 1.5rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        form {
            max-width: 100%;
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
        }

        .table-deg th,
        .table-deg td {
            padding: 8px;
            font-size: 0.9rem;
        }

        .pagination>li>a,
        .pagination>li>span {
            font-size: 0.875rem;
        }
    }
</style>
<!-- Include flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1 class="text_cat">Add Category</h1>

        <!-- Add Category Form -->
        <form action="<?php echo e(route('add_category')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <!-- Category Name -->
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input id="category_name" type="text" name="category_name" value="<?php echo e(old('category_name')); ?>"
                    class="form-control" required autofocus autocomplete="category_name" />
                <?php if($errors->has('category_name')): ?>
                    <span class="text-danger"><?php echo e($errors->first('category_name')); ?></span>
                <?php endif; ?>
            </div>

            <!-- Barcode -->
            <div class="form-group">
                <label for="category_barcode">Barcode</label>
                <input id="category_barcode" type="text" name="category_barcode" value="<?php echo e(old('category_barcode')); ?>"
                    class="form-control" required autocomplete="category_barcode" />
                <?php if($errors->has('category_barcode')): ?>
                    <span class="text-danger"><?php echo e($errors->first('category_barcode')); ?></span>
                <?php endif; ?>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="category_description">Description</label>
                <textarea id="category_description" name="category_description" class="form-control" rows="3"
                    autocomplete="category_description"><?php echo e(old('category_description')); ?></textarea>
                <?php if($errors->has('category_description')): ?>
                    <span class="text-danger"><?php echo e($errors->first('category_description')); ?></span>
                <?php endif; ?>
            </div>

            <!-- Image Upload -->
            <div class="form-group">
                <label for="category_image">Category Image</label>
                <input id="category_image" type="file" name="category_image" class="form-control-file"
                    accept="image/*" />
                <?php if($errors->has('category_image')): ?>
                    <span class="text-danger"><?php echo e($errors->first('category_image')); ?></span>
                <?php endif; ?>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add Category</button>
            </div>
        </form>

<!-- Search Category Form -->
<h1 class="text_cat">Search Category</h1>
<form action="<?php echo e(route('category.search')); ?>" method="GET">
    <?php echo csrf_field(); ?>
    <div class="form-group input-group">
        <input type="text" name="search_term" id="searchTerm" class="form-control" placeholder="Search term">
        <div class="input-group-append">
            <span class="input-group-text">
                <i class="fa fa-search"></i> <!-- FontAwesome search icon -->
            </span>
        </div>
    </div>
    <div class="form-group input-group mt-2">
        <input type="text" name="search_date" id="searchDate" class="form-control"
            placeholder="Search date (dd/mm/yyyy)">
        <div class="input-group-append">
            <span class="input-group-text calendar-icon">
                <i class="fa fa-calendar"></i> <!-- FontAwesome calendar icon -->
            </span>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Search</button>
</form>
        <!-- Display the total number of results -->
        <?php if($data->total() > 0): ?>
            <p class="text-center">Total results found: <?php echo e($data->total()); ?></p>
        <?php endif; ?>

        <h1>PDF Actions</h1>
        <a href="<?php echo e(route('category.preview-pdf')); ?>" target="_blank">Preview Categories PDF</a>
        <br>
        <a href="<?php echo e(route('category.download-pdf')); ?>">Download Categories PDF</a>

        <!-- Category Table -->
        <div class="table-container">
            <table class="table-deg">
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
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->id); ?></td>
                            <td><?php echo e($item->categoryid); ?></td>
                            <td><?php echo e($item->category_name); ?></td>
                            <td><?php echo e($item->category_barcode); ?></td>

                            <!-- Category Image -->
                            <td>
                                <?php if($item->category_image): ?>
                                    <img src="<?php echo e(asset('baackend_images//' . $item->category_image)); ?>"
                                        alt="<?php echo e($item->category_name); ?>"
                                        style="width: 50px; height: 50px; object-fit: cover;">
                                <?php else: ?>
                                    No Image
                                <?php endif; ?>
                            </td>





                            <td><?php echo e(\Carbon\Carbon::parse($item->created_at)->format('F d, Y')); ?></td>
                            <td>
                                <a class="btn btn-success" href="<?php echo e(route('category.edit', $item->uuid)); ?>">Edit</a>
                                <a class="btn btn-danger" onclick="confirmation(event)"
                                    href="<?php echo e(route('category.delete', $item->uuid)); ?>">Delete</a>
                                <a class="btn btn-success" href="<?php echo e(route('category.singleView', $item->uuid)); ?>">View</a>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <ul class="pagination">
                <?php if($data->currentPage() > 1): ?>
                    <li class="page-item"><a class="page-link" href="<?php echo e($data->previousPageUrl()); ?>">Previous</a></li>
                <?php endif; ?>

                <?php for($i = 1; $i <= $data->lastPage(); $i++): ?>
                    <?php if($i == 1 || $i == $data->lastPage() || ($i >= $data->currentPage() - 2 && $i <= $data->currentPage() + 2)): ?>
                        <li class="<?php echo e($i == $data->currentPage() ? 'page-item active' : 'page-item'); ?>"><a
                                class="page-link" href="<?php echo e($data->url($i)); ?>"><?php echo e($i); ?></a></li>
                    <?php elseif($i == $data->currentPage() - 3 || $i == $data->currentPage() + 3): ?>
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if($data->hasMorePages()): ?>
                    <li class="page-item"><a class="page-link" href="<?php echo e($data->nextPageUrl()); ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<!-- Flatpickr JS -->
<!-- Include flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Date picker -->
<!-- Date picker -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Flatpickr for the date input
        flatpickr("#searchDate", {
            dateFormat: "Y-m-d", // Internal date format used in the request
            altInput: true, // Use an alternate input to display the selected date
            altFormat: "F d, Y", // Display format for the user
            enableTime: false, // Disable time selection
            clickOpens: true, // Allow the date picker to open on click
            allowInput: true // Allow typing in the input field
        });

        // Add event listener to open the date picker when clicking the calendar icon
        document.querySelector('.calendar-icon').addEventListener('click', function() {
            document.querySelector("#searchDate")._flatpickr.open(); // Open the date picker
        });
    });
</script>

<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Bijoy Dey\Laravel\jojobi\resources\views/adminBackend/categories/category.blade.php ENDPATH**/ ?>