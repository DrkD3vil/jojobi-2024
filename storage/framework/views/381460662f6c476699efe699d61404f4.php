 <!-- Menu -->

 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
     <div class="app-brand demo">
         <a href="index.html" class="app-brand-link">
             <span class="app-brand-logo demo me-1">
                 <span style="color: var(--bs-primary)">
                     <svg width="30" height="24" viewBox="0 0 250 196" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M12.3002 1.25469L56.655 28.6432C59.0349 30.1128 60.4839 32.711 60.4839 35.5089V160.63C60.4839 163.468 58.9941 166.097 56.5603 167.553L12.2055 194.107C8.3836 196.395 3.43136 195.15 1.14435 191.327C0.395485 190.075 0 188.643 0 187.184V8.12039C0 3.66447 3.61061 0.0522461 8.06452 0.0522461C9.56056 0.0522461 11.0271 0.468577 12.3002 1.25469Z"
                             fill="currentColor" />
                         <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                             d="M0 65.2656L60.4839 99.9629V133.979L0 65.2656Z" fill="black" />
                         <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                             d="M0 65.2656L60.4839 99.0795V119.859L0 65.2656Z" fill="black" />
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M237.71 1.22393L193.355 28.5207C190.97 29.9889 189.516 32.5905 189.516 35.3927V160.631C189.516 163.469 191.006 166.098 193.44 167.555L237.794 194.108C241.616 196.396 246.569 195.151 248.856 191.328C249.605 190.076 250 188.644 250 187.185V8.09597C250 3.64006 246.389 0.027832 241.935 0.027832C240.444 0.027832 238.981 0.441882 237.71 1.22393Z"
                             fill="currentColor" />
                         <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                             d="M250 65.2656L189.516 99.8897V135.006L250 65.2656Z" fill="black" />
                         <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                             d="M250 65.2656L189.516 99.0497V120.886L250 65.2656Z" fill="black" />
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                             fill="currentColor" />
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                             fill="white" fill-opacity="0.15" />
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                             fill="currentColor" />
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                             fill="white" fill-opacity="0.3" />
                     </svg>
                 </span>
             </span>
             <span class="app-brand-text demo menu-text fw-semibold ms-2">Materio</span>
         </a>

         <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
             <i class="menu-toggle-icon d-xl-block align-middle"></i>
         </a>
     </div>

     <div class="menu-inner-shadow"></div>

     <ul class="menu-inner py-1">
         <!-- Dashboards -->
         <li class="menu-item <?php echo e(Request::is('dashboards*') ? 'active open' : ''); ?>">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons ri-home-smile-line"></i>
                 <div data-i18n="Dashboards">Dashboards</div>
                 <div class="badge bg-danger rounded-pill ms-auto">5</div>
             </a>
             <ul class="menu-sub">
                 <li class="menu-item <?php echo e(Request::is('dashboards/crm') ? 'active' : ''); ?>">
                     <a href="<?php echo e(route('dashboard')); ?>"
                         target="_blank" class="menu-link">
                         <div data-i18n="CRM">CRM</div>
                         <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>
                     </a>
                 </li>
                 <li class="menu-item <?php echo e(Request::is('dashboards/analytics') ? 'active' : ''); ?>">
                     <a href="index.html" class="menu-link">
                         <div data-i18n="Analytics">Analytics</div>
                     </a>
                 </li>
                 <li class="menu-item <?php echo e(Request::is('dashboards/ecommerce') ? 'active' : ''); ?>">
                     <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/vertical-menu-template/app-ecommerce-dashboard.html"
                         target="_blank" class="menu-link">
                         <div data-i18n="eCommerce">eCommerce</div>
                         <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>
                     </a>
                 </li>
                 <li class="menu-item <?php echo e(Request::is('dashboards/logistics') ? 'active' : ''); ?>">
                     <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/vertical-menu-template/app-logistics-dashboard.html"
                         target="_blank" class="menu-link">
                         <div data-i18n="Logistics">Logistics</div>
                         <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>
                     </a>
                 </li>
                 <li class="menu-item <?php echo e(Request::is('dashboards/academy') ? 'active' : ''); ?>">
                     <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/vertical-menu-template/app-academy-dashboard.html"
                         target="_blank" class="menu-link">
                         <div data-i18n="Academy">Academy</div>
                         <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>
                     </a>
                 </li>
             </ul>
         </li>

         <!-- Category -->
         <li class="menu-item <?php echo e(Request::is('category') ? 'active open' : ''); ?>">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons ri-layout-2-line"></i>
                 <div data-i18n="Category">Category</div>
                 <i class="dropdown-toggle-icon"></i> <!-- Dropdown Icon -->
             </a>
             <ul class="menu-sub">
                 <li class="menu-item <?php echo e(Request::is('category') ? 'active' : ''); ?>">
                     <a href="<?php echo e(route('category.index')); ?>" class="menu-link">
                         <div data-i18n="Without menu">All Category List</div>
                     </a>
                 </li>
                 <li class="menu-item <?php echo e(Request::is('category') ? 'active' : ''); ?>">
                     <a href="<?php echo e(route('category.create')); ?>" class="menu-link">
                         <div data-i18n="Container">Add Category</div>
                     </a>
                 </li>
                 <li class="menu-item <?php echo e(Request::is('category') ? 'active' : ''); ?>">
                     <a href="<?php echo e(route('category.view')); ?>" class="menu-link">
                         <div data-i18n="Fluid">Search Category</div>
                     </a>
                 </li>
             </ul>
         </li>
         
         <li class="menu-item <?php echo e(Request::is('expenses') ? 'active open' : ''); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-layout-2-line"></i>
                <div data-i18n="expenses">Expense</div>
                <i class="dropdown-toggle-icon"></i> <!-- Dropdown Icon -->
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php echo e(Request::is('expenses') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('expenses.index')); ?>" class="menu-link">
                        <div data-i18n="Without menu">All Category List</div>
                    </a>
                </li>
                <li class="menu-item <?php echo e(Request::is('category') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('category.create')); ?>" class="menu-link">
                        <div data-i18n="Container">Add Category</div>
                    </a>
                </li>
                <li class="menu-item <?php echo e(Request::is('category') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('category.view')); ?>" class="menu-link">
                        <div data-i18n="Fluid">Search Category</div>
                    </a>
                </li>
            </ul>
        </li>
         <!-- Supplier -->
         <li class="menu-item <?php echo e(Request::is('supplier') ? 'active open' : ''); ?>">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons ri-layout-2-line"></i>
                 <div data-i18n="Supplier">Supplier</div>
                 <i class="dropdown-toggle-icon"></i> <!-- Dropdown Icon -->
             </a>
             <ul class="menu-sub">
                 <li class="menu-item <?php echo e(Request::is('category') ? 'active' : ''); ?>">
                     <a href="<?php echo e(route('suppliers.index')); ?>" class="menu-link">
                         <div data-i18n="Without menu">All Supplier List</div>
                     </a>
                 </li>
                 <li class="menu-item <?php echo e(Request::is('category') ? 'active' : ''); ?>">
                     <a href="<?php echo e(route('suppliers.create')); ?>" class="menu-link">
                         <div data-i18n="Container">Add Supplier</div>
                     </a>
                 </li>
                 <li class="menu-item <?php echo e(Request::is('category') ? 'active' : ''); ?>">
                     <a href="<?php echo e(route('category.view')); ?>" class="menu-link">
                         <div data-i18n="Fluid">Search Category</div>
                     </a>
                 </li>
             </ul>
         </li>
         <!-- Product -->
         <li class="menu-item <?php echo e(Request::is('products') ? 'active open' : ''); ?>">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons ri-layout-2-line"></i>
                 <div data-i18n="Category">Product</div>
                 <i class="dropdown-toggle-icon"></i> <!-- Dropdown Icon -->
             </a>
             <ul class="menu-sub">
                 <li class="menu-item <?php echo e(Request::is('products') ? 'active' : ''); ?>">
                     <a href="<?php echo e(route('products.create')); ?>" class="menu-link">
                         <div data-i18n="Without menu">Add Product</div>
                     </a>
                 </li>
                 <li class="menu-item <?php echo e(Request::is('layouts-container') ? 'active' : ''); ?>">
                     <a href="<?php echo e(route('products.index')); ?>" class="menu-link">
                         <div data-i18n="Container">View All Product</div>
                     </a>
                 </li>
                 <li class="menu-item <?php echo e(Request::is('layouts-fluid') ? 'active' : ''); ?>">
                     <a href="<?php echo e(route('products.preview-pdf')); ?>" class="menu-link">
                         <div data-i18n="Fluid">Products PDF</div>
                     </a>
                 </li>
             </ul>
         </li>


         <!-- POS -->
         <li class="menu-item <?php echo e(Request::is('pos') ? 'active open' : ''); ?>">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons ri-layout-2-line"></i>
                 <div data-i18n="Category">POS</div>
                 <i class="dropdown-toggle-icon"></i> <!-- Dropdown Icon -->
             </a>
             <ul class="menu-sub">
                 <li class="menu-item <?php echo e(Request::is('pos') ? 'active' : ''); ?>">
                     <a href="<?php echo e(route('pos.index')); ?>" class="menu-link">
                         <div data-i18n="Without menu">POS</div>
                     </a>
                 </li>
                 <li class="menu-item <?php echo e(Request::is('pos') ? 'active' : ''); ?>">
                     <a href="<?php echo e(route('pos.show')); ?>" class="menu-link">
                         <div data-i18n="Container">View All Cart</div>
                     </a>
                 </li>
                 <li class="menu-item <?php echo e(Request::is('customer') ? 'active' : ''); ?>">
                     <a href="<?php echo e(route('customers.create')); ?>" class="menu-link">
                         <div data-i18n="Fluid">Customer Create</div>
                     </a>
                 </li>

                 <li class="menu-item <?php echo e(Request::is('layouts-blank') ? 'active' : ''); ?>">
                     <a href="<?php echo e(route('orders.index')); ?>" class="menu-link">
                         <div data-i18n="Blank">View All Orders</div>
                     </a>
                 </li>
             </ul>
         </li>

         
         <li class="menu-item <?php echo e(Request::is('transection') ? 'active open' : ''); ?>">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons ri-layout-2-line"></i>
                 <div data-i18n="Category">Transections</div>
                 <i class="dropdown-toggle-icon"></i> <!-- Dropdown Icon -->
             </a>
             <ul class="menu-sub">
                 <li class="menu-item <?php echo e(Request::is('transection') ? 'active' : ''); ?>">
                     <a href="<?php echo e(route('transactions.index')); ?>" class="menu-link">
                         <div data-i18n="Without menu">View Transections</div>
                     </a>
                 </li>
                 <li class="menu-item <?php echo e(Request::is('pos') ? 'active' : ''); ?>">
                     <a href="<?php echo e(route('payments.index')); ?>" class="menu-link">
                         <div data-i18n="Container">View All Payments</div>
                     </a>
                 </li>
                 <li class="menu-item <?php echo e(Request::is('customer') ? 'active' : ''); ?>">
                     <a href="<?php echo e(route('customers.create')); ?>" class="menu-link">
                         <div data-i18n="Fluid">Customer Create</div>
                     </a>
                 </li>

                 <li class="menu-item <?php echo e(Request::is('layouts-blank') ? 'active' : ''); ?>">
                     <a href="<?php echo e(route('orders.index')); ?>" class="menu-link">
                         <div data-i18n="Blank">View All Orders</div>
                     </a>
                 </li>
             </ul>
         </li>

         <!-- Front Pages -->
         <li class="menu-item">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons ri-file-copy-line"></i>
                 <div data-i18n="Front Pages">Front Pages</div>
                 <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>
             </a>
             <ul class="menu-sub">
                 <li class="menu-item">
                     <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/front-pages/landing-page.html"
                         class="menu-link" target="_blank">
                         <div data-i18n="Landing">Landing</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/front-pages/pricing-page.html"
                         class="menu-link" target="_blank">
                         <div data-i18n="Pricing">Pricing</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/front-pages/payment-page.html"
                         class="menu-link" target="_blank">
                         <div data-i18n="Payment">Payment</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/front-pages/checkout-page.html"
                         class="menu-link" target="_blank">
                         <div data-i18n="Checkout">Checkout</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/front-pages/help-center-landing.html"
                         class="menu-link" target="_blank">
                         <div data-i18n="Help Center">Help Center</div>
                     </a>
                 </li>
             </ul>
         </li>

         <li class="menu-header mt-7">
             <span class="menu-header-text">Apps & Pages</span>
         </li>

         <!-- Apps -->
         <li class="menu-item">
             <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/vertical-menu-template/app-email.html"
                 target="_blank" class="menu-link">
                 <i class="menu-icon tf-icons ri-mail-open-line"></i>
                 <div data-i18n="Email">Email</div>
                 <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>
             </a>
         </li>
         <li class="menu-item">
             <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/vertical-menu-template/app-chat.html"
                 target="_blank" class="menu-link">
                 <i class="menu-icon tf-icons ri-wechat-line"></i>
                 <div data-i18n="Chat">Chat</div>
                 <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>
             </a>
         </li>
         <li class="menu-item">
             <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/vertical-menu-template/app-calendar.html"
                 target="_blank" class="menu-link">
                 <i class="menu-icon tf-icons ri-calendar-line"></i>
                 <div data-i18n="Calendar">Calendar</div>
                 <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>
             </a>
         </li>
         <li class="menu-item">
             <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/vertical-menu-template/app-kanban.html"
                 target="_blank" class="menu-link">
                 <i class="menu-icon tf-icons ri-drag-drop-line"></i>
                 <div data-i18n="Kanban">Kanban</div>
                 <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>
             </a>
         </li>

         <!-- Pages -->
         <li class="menu-item">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons ri-layout-left-line"></i>
                 <div data-i18n="Account Settings">Account Settings</div>
             </a>
             <ul class="menu-sub">
                 <li class="menu-item">
                     <a href="pages-account-settings-account.html" class="menu-link">
                         <div data-i18n="Account">Account</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="pages-account-settings-notifications.html" class="menu-link">
                         <div data-i18n="Notifications">Notifications</div>
                     </a>
                 </li>
             </ul>
         </li>

         <!-- Misc -->
         <li class="menu-item">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons ri-question-line"></i>
                 <div data-i18n="Misc">Misc</div>
             </a>
             <ul class="menu-sub">
                 <li class="menu-item">
                     <a href="pages-misc-coming-soon.html" class="menu-link">
                         <div data-i18n="Coming Soon">Coming Soon</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="pages-misc-error.html" class="menu-link">
                         <div data-i18n="Error">Error</div>
                     </a>
                 </li>
             </ul>
         </li>
     </ul>

 </aside>
 <!-- / Menu -->
<?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/components/sideBar.blade.php ENDPATH**/ ?>