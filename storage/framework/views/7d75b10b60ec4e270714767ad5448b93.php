<!doctype html>
<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free" data-style="light">

<head>
    <?php echo $__env->make('adminBackend.components.head_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Navigation -->
            <?php echo $__env->make('adminBackend.components.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- Layout container -->
            <div class="layout-page">

                <?php echo $__env->make('adminBackend.components.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>

                    <?php echo $__env->make('adminBackend.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="content-backdrop fade"></div>
                </div>


            </div>

        </div>
    </div>
    <?php echo $__env->make('adminBackend.components.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>
<?php /**PATH E:\Bijoy Dey\Laravel\jojobi\resources\views/adminBackend/adminLayout.blade.php ENDPATH**/ ?>