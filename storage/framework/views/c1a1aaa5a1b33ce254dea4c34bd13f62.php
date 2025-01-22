
<style>
    .text_cat {
        text-align: center;
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 1.5rem;
        font-weight: 600;
    }

    .table-container {
        margin-top: 20px;
        overflow-x: auto;
    }

    .table-deg {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        text-align: left;
        font-size: 0.9rem;
    }

    .table-deg thead {
        background-color: #007bff;
        color: #fff;
    }

    .table-deg th, .table-deg td {
        border: 1px solid #ddd;
        padding: 10px;
    }

    .table-deg tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table-deg tbody tr:hover {
        background-color: #f1f1f1;
    }

    .pagination {
        margin-top: 20px;
        text-align: center;
    }

    .pagination .page-item {
        display: inline-block;
        margin: 0 5px;
    }

    .pagination .page-link {
        color: #007bff;
        text-decoration: none;
        padding: 5px 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .pagination .page-link:hover {
        background-color: #007bff;
        color: #fff;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    .btn {
        padding: 8px 12px;
        font-size: 0.9rem;
        margin-right: 5px;
    }

    .btn-success, .btn-danger {
        color: #fff;
    }

    .btn-success:hover {
        background-color: #28a745;
    }

    .btn-danger:hover {
        background-color: #dc3545;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        border-radius: 4px;
        padding: 10px;
    }

    .input-group-text {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
    }

    .calendar-icon {
        cursor: pointer;
    }
</style>


<?php $__env->startSection('content'); ?>
<!-- Include flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<div class="container">
    <!-- Search Category Form -->
    <h1 class="text_cat">Search Category</h1>
    <div class="form-group input-group">
        <input type="text" name="search_term" id="searchTerm" class="form-control" placeholder="Search term">
        <div class="input-group-append">
            <span class="input-group-text">
                <i class="fa fa-search"></i> <!-- FontAwesome search icon -->
            </span>
        </div>
    </div>
    <div class="form-group input-group mt-2">
        <input type="text" name="search_date" id="searchDate" class="form-control" placeholder="Search date (dd/mm/yyyy)">
        <div class="input-group-append">
            <span class="input-group-text calendar-icon">
                <i class="fa fa-calendar"></i> <!-- FontAwesome calendar icon -->
            </span>
        </div>
    </div>

    <!-- Display search results -->
    <div id="categoryResults" class="mt-4"></div>
</div>

<!-- Include flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Flatpickr
        flatpickr("#searchDate", {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "F d, Y",
            enableTime: false,
            clickOpens: true,
            allowInput: true
        });

        document.querySelector('.calendar-icon').addEventListener('click', function () {
            document.querySelector("#searchDate")._flatpickr.open();
        });

       

        $('#searchTerm, #searchDate').on('input', function () {
    let searchTerm = $('#searchTerm').val().trim(); // Get trimmed search term value
    let searchDate = $('#searchDate').val().trim(); // Get trimmed search date value

    // If both fields are empty, clear the results and return
    if (searchTerm === '' && searchDate === '') {
        $('#categoryResults').html('<p class="text-center text-warning">No search criteria provided.</p>');
        return;
    }

    $.ajax({
        url: "<?php echo e(route('category.search')); ?>",
        type: "GET",
        data: {
            search_term: searchTerm,
            search_date: searchDate,
        },
        success: function (response) {
            let resultsHtml = '';

            if (response.data.length > 0) {
                resultsHtml += `
                    <p class="text-center">Total results found: ${response.data.length}</p>
                    <div class="table-container">
                        <table class="table-deg">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category ID</th>
                                    <th>Category Name</th>
                                    <th>Category BarCode</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                `;

                response.data.forEach(category => {
                    resultsHtml += `
                        <tr>
                            <td>${category.id}</td>
                            <td>${category.categoryid}</td>
                            <td>${category.category_name}</td>
                            <td>${category.category_barcode}</td>
                            <td>${category.created_at}</td>
                            <td>
                                <a class="btn btn-success" href="${category.edit_url}">Edit</a>
                                <a class="btn btn-danger" onclick="confirmation(event)" href="${category.delete_url}">Delete</a>
                            </td>
                        </tr>
                    `;
                });

                resultsHtml += `
                            </tbody>
                        </table>
                    </div>
                `;
            } else {
                resultsHtml = '<p class="text-center text-danger">No categories found!</p>';
            }

            $('#categoryResults').html(resultsHtml);
        },
        error: function (xhr, status, error) {
            console.error('Error fetching categories:', error);
            $('#categoryResults').html('<p class="text-danger text-center">An error occurred. Please try again later.</p>');
        }
    });
});

    });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/categories/view_category.blade.php ENDPATH**/ ?>