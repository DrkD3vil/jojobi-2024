                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                            <i class="ri-menu-fill ri-24px"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <i class="ri-search-line ri-22px me-2"></i>
                                <input type="text" class="form-control border-0 shadow-none"
                                    placeholder="Search..." aria-label="Search..." />
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Place this tag where you want the button to render. -->
                            <li class="nav-item lh-1 me-4">
                                <a class="github-button"
                                    href="https://github.com/themeselection/materio-bootstrap-html-admin-template-free"
                                    data-icon="octicon-star" data-size="large" data-show-count="true"
                                    aria-label="Star themeselection/materio-bootstrap-html-admin-template-free on GitHub">Star</a>
                            </li>


                            <!-- Notifications -->
                            <li class="nav-item lh-1 me-4">
    <a href="#" class="nav-link" id="notification-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Expiring Products">
        <i class="fa fa-bell" style="font-size: 24px; position: relative;">
            <?php if($notificationCount > 0): ?>
                <span class="badge rounded-pill bg-danger position-absolute top-0 start-100 translate-middle" style="font-size: 12px;">
                    <?php echo e($notificationCount); ?>

                </span>
            <?php endif; ?>
        </i>
    </a>
</li>

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="<?php echo e(asset('adminFiles/assets/img/avatars/1.png')); ?>" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <div class="avatar avatar-online">
                                                        <img src="<?php echo e(asset('adminFiles/assets/img/avatars/1.png')); ?>" alt
                                                            class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0 small"><?php echo e($user->name); ?></h6>
                                                    <small class="text-muted"><?php echo e($user->role); ?></small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="ri-user-3-line ri-22px me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="ri-settings-4-line ri-22px me-2"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <span class="d-flex align-items-center align-middle">
                                                <i class="flex-shrink-0 ri-file-text-line ri-22px me-3"></i>
                                                <span class="flex-grow-1 align-middle">Billing</span>
                                                <span
                                                    class="flex-shrink-0 badge badge-center rounded-pill bg-danger h-px-20 d-flex align-items-center justify-content-center">4</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <div class="d-grid px-4 pt-2 pb-1" style="text-align: center;">
                                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <button 
                                                    type="submit" 
                                                    class="btn btn-danger d-flex align-items-center justify-content-center w-100" 
                                                    style="padding: 12px; font-size: 16px; font-weight: bold; border-radius: 6px; transition: background-color 0.3s ease, transform 0.2s ease;"
                                                    onmouseover="this.style.backgroundColor='#c82333'; this.style.transform='scale(1.05)';"
                                                    onmouseout="this.style.backgroundColor='#dc3545'; this.style.transform='scale(1)';">
                                                    <small class="align-middle">Logout</small>
                                                    <i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                                                </button>
                                            </form>
                                        </div>
                                        
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->


<!-- Modal for Expiring Products -->
<!-- Modal for Expiring Products -->
<div class="modal fade" id="expiringProductsModal" tabindex="-1" aria-labelledby="expiringProductsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="expiringProductsModalLabel">Products Expiring Soon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Products Table -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Expiry Date</th>
                            <th>Price</th>
                            <th>Supplier</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody id="expiring-products-list">
                        <!-- Dynamically filled with products -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notificationIcon = document.getElementById('notification-icon');
        const expiringProductsList = document.getElementById('expiring-products-list');

        // Pass the data from the PHP controller
        const todayExpiringProducts = <?php echo json_encode($todayExpiringProducts, 15, 512) ?>;
        const productsExpiringSoon = <?php echo json_encode($productsExpiringSoon, 15, 512) ?>;

        const allExpiringProducts = [...todayExpiringProducts, ...productsExpiringSoon];

        // Notification Icon Click Handler
        notificationIcon.addEventListener('click', function() {
            if (allExpiringProducts.length > 0) {
                // Clear previous list items
                expiringProductsList.innerHTML = '';

                // Add rows to the table in modal
                allExpiringProducts.forEach(function(product, index) {
                    const productRow = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${product.name}</td>
                            <td>${new Date(product.expire_date).toLocaleDateString()}</td>
                            <td>${product.sell_price}</td>
                            <td>${product.supplier_name}</td>
                            <td>
                                <a href="#" class="btn btn-info" onclick="redirectToProductDetails(${product.id})">View Details</a>
                            </td>
                        </tr>
                    `;
                    expiringProductsList.innerHTML += productRow;
                });

                // Show modal
                var myModal = new bootstrap.Modal(document.getElementById('expiringProductsModal'), {
                    keyboard: false
                });
                myModal.show();
            } else {
                alert('No products are expiring soon.');
            }
        });
    });

    function redirectToProductDetails(productId) {
        // Redirect to the notifications page and pass the product ID as a query parameter
        window.location.href = "<?php echo e(route('notifications.index')); ?>?product_id=" + productId;
    }
</script><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/components/navbar.blade.php ENDPATH**/ ?>