<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Edit User Data</h1>

    <!-- Display Validation Errors -->
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('users.update', $userdata->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Name Field -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo e(old('name', $userdata->name)); ?>" required>
        </div>

        <!-- Email Field -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo e(old('email', $userdata->email)); ?>" required>
        </div>

        <!-- Phone Field -->
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" id="phone" name="phone" class="form-control" value="<?php echo e(old('phone', $userdata->phone)); ?>">
        </div>

        <!-- Role Dropdown -->
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select id="role" name="role" class="form-select" required>
                <option value="admin" <?php echo e(old('role', $userdata->role) === 'admin' ? 'selected' : ''); ?>>Admin</option>
                <option value="user" <?php echo e(old('role', $userdata->role) === 'user' ? 'selected' : ''); ?>>User</option>
                <option value="moderator" <?php echo e(old('role', $userdata->role) === 'moderator' ? 'selected' : ''); ?>>Moderator</option>
                <option value="guest" <?php echo e(old('role', $userdata->role) === 'guest' ? 'selected' : ''); ?>>Guest</option>
            </select>
        </div>

        <!-- Status Dropdown -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select" required>
                <option value="active" <?php echo e(old('status', $userdata->status) === 'active' ? 'selected' : ''); ?>>Active</option>
                <option value="inactive" <?php echo e(old('status', $userdata->status) === 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                <option value="suspended" <?php echo e(old('status', $userdata->status) === 'suspended' ? 'selected' : ''); ?>>Suspended</option>
                <option value="blocked" <?php echo e(old('status', $userdata->status) === 'blocked' ? 'selected' : ''); ?>>Blocked</option>
                <option value="unverified" <?php echo e(old('status', $userdata->status) === 'unverified' ? 'selected' : ''); ?>>Unverified</option>
                <option value="verified" <?php echo e(old('status', $userdata->status) === 'verified' ? 'selected' : ''); ?>>Verified</option>
            </select>
        </div>

        <!-- Update Button -->
        <button type="submit" class="btn btn-success">Update</button>
        <a href="<?php echo e(route('users.index')); ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/users/edit.blade.php ENDPATH**/ ?>