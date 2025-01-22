


<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Add Supplier</h1>

    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    <form action="<?php echo e(route('suppliers.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="supplier_name">Supplier Name</label>
            <input type="text" name="supplier_name" id="supplier_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="supplier_barcode">Barcode</label>
            <div class="input-group">
                <input type="text" name="supplier_barcode" id="supplier_barcode" class="form-control" required>
                <button type="button" id="generate_barcode" class="btn btn-secondary">Generate Barcode</button>
            </div>
            <small id="barcode_feedback" class="form-text text-muted"></small>
        </div>
        <div class="form-group">
    <label for="amount">Amount</label>
    <input type="number" name="amount" id="amount" class="form-control" min="0" step="0.01">
</div>
<div class="form-group">
    <label for="paid">Paid</label>
    <input type="number" name="paid" id="paid" class="form-control" min="0" step="0.01">
</div>
<div class="form-group">
    <label for="due">Due</label>
    <input type="number" name="due" id="due" class="form-control" readonly>
</div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <div class="form-group">
            <label for="note">Note</label>
            <textarea name="note" id="note" class="form-control" rows="3"><?php echo e(old('note', $supplier->note ?? '')); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Save</button>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const supplierBarcodeInput = document.getElementById('supplier_barcode');
    const generateButton = document.getElementById('generate_barcode');
    const feedback = document.getElementById('barcode_feedback');

    // Validate barcode existence
    supplierBarcodeInput.addEventListener('blur', function () {
        const barcode = supplierBarcodeInput.value;

        if (barcode) {
            fetch('/validate-barcode', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ barcode })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.valid) {
                        feedback.textContent = 'Barcode is valid and unique.';
                        feedback.style.color = 'green';
                    } else {
                        feedback.textContent = 'Barcode already exists in the system.';
                        feedback.style.color = 'red';
                    }
                })
                .catch(error => {
                    console.error('Error validating barcode:', error);
                    feedback.textContent = 'Error validating barcode. Please try again.';
                    feedback.style.color = 'red';
                });
        }
    });

    // Generate new barcode
    generateButton.addEventListener('click', function () {
        fetch('/generate-barcode')
            .then(response => response.json())
            .then(data => {
                supplierBarcodeInput.value = data.barcode;
                feedback.textContent = 'New barcode generated and inserted.';
                feedback.style.color = 'green';
            })
            .catch(error => {
                console.error('Error generating barcode:', error);
                feedback.textContent = 'Error generating barcode. Please try again.';
                feedback.style.color = 'red';
            });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const amountInput = document.getElementById('amount');
    const paidInput = document.getElementById('paid');
    const dueInput = document.getElementById('due');

    function calculateDue() {
        const amount = parseFloat(amountInput.value) || 0;
        const paid = parseFloat(paidInput.value) || 0;
        const due = Math.max(amount - paid, 0); // Ensure due doesn't go below zero
        dueInput.value = due.toFixed(2); // Display the due amount rounded to 2 decimal places
    }

    // Add event listeners for real-time calculation
    amountInput.addEventListener('input', calculateDue);
    paidInput.addEventListener('input', calculateDue);
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/suppliers/create.blade.php ENDPATH**/ ?>