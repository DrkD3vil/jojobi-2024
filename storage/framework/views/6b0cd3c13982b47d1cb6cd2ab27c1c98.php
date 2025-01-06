    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?php echo e(asset('adminFiles/assets/vendor/libs/jquery/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('adminFiles/assets/vendor/libs/popper/popper.js')); ?>"></script>
    <script src="<?php echo e(asset('adminFiles/assets/vendor/js/bootstrap.js')); ?>"></script>
    <script src="<?php echo e(asset('adminFiles/assets/vendor/libs/node-waves/node-waves.js')); ?>"></script>
    <script src="<?php echo e(asset('adminFiles/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(asset('adminFiles/assets/vendor/js/menu.js')); ?>"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?php echo e(asset('adminFiles/assets/vendor/libs/apex-charts/apexcharts.js')); ?>"></script>

    <!-- Main JS -->
    <script src="<?php echo e(asset('adminFiles/assets/js/main.js')); ?>"></script>

    <!-- Page JS -->
    <script src="<?php echo e(asset('adminFiles/assets/js/dashboards-analytics.js')); ?>"></script>

    <!-- Place this tag before closing body tag for GitHub widget button -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const links = document.querySelectorAll('.menu-item a'); // Select all menu links
            const currentLocation = window.location.href; // Get the current page URL
    
            links.forEach(link => {
                const linkHref = link.getAttribute('href'); // Get the href attribute of each link
    
                // Check if the current link's href matches the current URL
                if (currentLocation.includes(linkHref)) {
                    link.closest('.menu-item').classList.add('active'); // Add 'active' class to the parent menu item
                } else {
                    link.closest('.menu-item').classList.remove('active'); // Remove 'active' class from other menu items
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
    const path = window.location.pathname;
    const menuItems = document.querySelectorAll('.menu-item a');

    menuItems.forEach(item => {
        if (item.getAttribute('href') === path) {
            item.closest('.menu-item').classList.add('active');
            item.closest('.menu-item').classList.add('open'); // To ensure the menu is open
        }
    });
});

    </script>
    <?php /**PATH E:\Bijoy Dey\Laravel\jojobi\resources\views/adminBackend/components/scripts.blade.php ENDPATH**/ ?>