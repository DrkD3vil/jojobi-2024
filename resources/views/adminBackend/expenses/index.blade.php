@extends('adminBackend.adminLayout')

@section('title', 'Expenses')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Expenses</h1>
    <a href="{{ route('expenses.create') }}" class="btn btn-primary">Add Expense</a>
</div>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Note</th>
            <th>Category</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($expenses as $expense)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $expense->type }}</td>
            <td>{{ $expense->amount }}</td>
            <td>{{ $expense->date }}</td>
            <td>{{ $expense->note }}</td>
            <td>{{ $expense->category }}</td>
            <td>
                <img src="{{ asset($expense->image) }}" alt="Expense Image" class="expense-image" style="width:5rem; cursor: pointer;">
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">No expenses found.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Modal -->
<div id="imageModal" class="modal">
    <span class="close-modal">&times;</span>
    <div class="modal-content-wrapper">
        <img id="modalImage" src="" alt="Expense Image" class="zoomable-image">
    </div>
</div>

<style>
    /* Modal Styling */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        overflow: hidden;
    }

    .modal-content-wrapper {
        position: relative;
        width: 90%;
        height: 90%;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .zoomable-image {
        max-width: 100%;
        max-height: 100%;
        cursor: grab;
        transition: transform 0.2s ease-in-out;
    }

    .close-modal {
        position: absolute;
        top: 20px;
        right: 30px;
        font-size: 24px;
        font-weight: bold;
        color: white;
        cursor: pointer;
        z-index: 1100;
    }

    body.modal-open {
        overflow: hidden; /* Prevent page scroll when modal is open */
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        let zoomLevel = 1;
        let imageModal = $('#imageModal');
        let modalImage = $('#modalImage');
        let isDragging = false;
        let startX, startY, moveX = 0, moveY = 0;

        // Open modal on image click
        $('.expense-image').on('click', function () {
            let imageUrl = $(this).attr('src');
            modalImage.attr('src', imageUrl).css('transform', 'scale(1)').css('transform-origin', 'center');
            zoomLevel = 1; // Reset zoom level
            moveX = 0; moveY = 0; // Reset position
            modalImage.css('transform', `translate(0px, 0px) scale(1)`);
            $('body').addClass('modal-open'); // Prevent background scrolling
            imageModal.fadeIn();
        });

        // Close modal
        $('.close-modal').on('click', function () {
            imageModal.fadeOut();
            $('body').removeClass('modal-open'); // Restore background scrolling
        });

        // Zoom in/out on mouse scroll
        imageModal.on('wheel', function (event) {
            event.preventDefault();
            const delta = event.originalEvent.deltaY > 0 ? -0.1 : 0.1; // Zoom in or out
            zoomLevel = Math.max(1, zoomLevel + delta); // Minimum zoom level is 1
            modalImage.css('transform', `translate(${moveX}px, ${moveY}px) scale(${zoomLevel})`);
        });

        // Drag to pan
        modalImage.on('mousedown', function (e) {
            isDragging = true;
            startX = e.pageX - moveX;
            startY = e.pageY - moveY;
            modalImage.css('cursor', 'grabbing');
        });

        $(document).on('mousemove', function (e) {
            if (isDragging) {
                moveX = e.pageX - startX;
                moveY = e.pageY - startY;
                modalImage.css('transform', `translate(${moveX}px, ${moveY}px) scale(${zoomLevel})`);
            }
        });

        $(document).on('mouseup', function () {
            if (isDragging) {
                isDragging = false;
                modalImage.css('cursor', 'grab');
            }
        });

        // Close modal when clicking outside the image
        imageModal.on('click', function (e) {
            if ($(e.target).is('#imageModal')) {
                imageModal.fadeOut();
                $('body').removeClass('modal-open'); // Restore background scrolling
            }
        });
    });
</script>
@endsection