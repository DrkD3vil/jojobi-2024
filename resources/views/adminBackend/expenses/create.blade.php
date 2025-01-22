@extends('adminBackend.adminLayout')

@section('title', 'Add Expense')

@section('content')

<style>
    .suggestions-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
        border: 1px solid #ccc;
        max-height: 150px;
        overflow-y: auto;
    }

    .suggestion-item {
        padding: 8px;
        cursor: pointer;
    }

    .suggestion-item:hover {
        background-color: #f0f0f0;
    }

    .dropdown-container {
        position: relative;
    }
</style>

<h1>Add Expense</h1>

<form action="{{ route('expenses.store') }}" method="POST" id="expenseForm" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <div class="dropdown-container">
            <select name="type" id="typeDropdown" class="form-control">
                <option value="">Select Type</option>
                @foreach($types as $type) <!-- Assuming $types is passed from the controller -->
                    <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
            <input type="text" name="type_text" id="typeText" class="form-control mt-2" placeholder="Or enter new type" value="{{ old('type_text') }}">
        </div>
        <input type="hidden" name="type" id="finalType">
        @error('type') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="amount" class="form-label">Amount</label>
        <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount') }}" required>
        @error('amount') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
        @error('date') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <div class="dropdown-container">
            <select name="category" id="categoryDropdown" class="form-control">
                <option value="">Select Category</option>
                @foreach($categories as $category) <!-- Assuming $categories is passed from the controller -->
                    <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                @endforeach
            </select>
            <input type="text" name="category_text" id="categoryText" class="form-control mt-2" placeholder="Or enter new category" value="{{ old('category_text') }}">
        </div>
        <input type="hidden" name="category" id="finalCategory">
        @error('category') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="note" class="form-label">Note</label>
        <textarea name="note" id="note" class="form-control">{{ old('note') }}</textarea>
        @error('note') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*">
        @error('image') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Add Expense</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Update final type field on change
    $('#typeDropdown, #typeText').on('input', function() {
        const dropdownValue = $('#typeDropdown').val();
        const textValue = $('#typeText').val();

        if (textValue.trim() !== '') {
            $('#finalType').val(textValue);
            $('#typeDropdown').val(''); // Reset dropdown if text input is used
        } else {
            $('#finalType').val(dropdownValue);
        }
    });

    // Update final category field on change
    $('#categoryDropdown, #categoryText').on('input', function() {
        const dropdownValue = $('#categoryDropdown').val();
        const textValue = $('#categoryText').val();

        if (textValue.trim() !== '') {
            $('#finalCategory').val(textValue);
            $('#categoryDropdown').val(''); // Reset dropdown if text input is used
        } else {
            $('#finalCategory').val(dropdownValue);
        }
    });

    // Ensure at least one input is filled before submission
    $('#expenseForm').on('submit', function(e) {
        if (!$('#finalType').val() || !$('#finalCategory').val()) {
            alert('Please select or enter both Type and Category.');
            e.preventDefault();
        }
    });
});
</script>

@endsection