 <!-- Menu -->

 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
     <div class="app-brand demo">
         <a href="{{ route('dashboard')}}" class="app-brand-link">
             <span class="app-brand-logo demo me-1">
                 <span style="color: var(--bs-primary)">

                 </span>
             </span>
             <span class="app-brand-text demo menu-text fw-semibold ms-2">JOJOBI mart</span>
         </a>

         <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
             <i class="menu-toggle-icon d-xl-block align-middle"></i>
         </a>
     </div>

     <div class="menu-inner-shadow"></div>

     <ul class="menu-inner py-1">
         <!-- Dashboards -->
         <li class="menu-item {{ Request::is('dashboards*') ? 'active open' : '' }}">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons ri-home-smile-line"></i>
                 <div data-i18n="Dashboards">Dashboards</div>
                 <div class="badge bg-danger rounded-pill ms-auto">5</div>
             </a>
             <ul class="menu-sub">
                 <li class="menu-item {{ Request::is('dashboard/admin') ? 'active' : '' }}">
                     <a href="{{route('dashboard')}}"
                         class="menu-link">
                         <div data-i18n="CRM">Dashboard</div>
                     </a>
                 </li>
                 <li class="menu-item {{ Request::is('dashboards/analytics') ? 'active' : '' }}">
                     <a href="{{ route('sales.getSalesReport') }}" class="menu-link">
                         <div data-i18n="Analytics">Analytics</div>
                     </a>
                 </li>
                 <li class="menu-item {{ Request::is('dashboards/ecommerce') ? 'active' : '' }}">
                     <a href=""
                         class="menu-link">
                         <div data-i18n="eCommerce">eCommerce</div>
                         <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>
                     </a>
                 </li>
                 <li class="menu-item {{ Request::is('dashboards/logistics') ? 'active' : '' }}">
                     <a href=""
                         class="menu-link">
                         <div data-i18n="Logistics">Logistics</div>
                         <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>
                     </a>
                 </li>
                 <li class="menu-item {{ Request::is('dashboards/academy') ? 'active' : '' }}">
                     <a href=""
                         class="menu-link">
                         <div data-i18n="Academy">Academy</div>
                         <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>
                     </a>
                 </li>
             </ul>
         </li>

         <!-- Category -->
         <li class="menu-item {{ Request::is('category') ? 'active open' : '' }}">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons ri-layout-2-line"></i>
                 <div data-i18n="Category">Category</div>
                 <i class="dropdown-toggle-icon"></i> <!-- Dropdown Icon -->
             </a>
             <ul class="menu-sub">
                 <li class="menu-item {{ Request::is('category') ? 'active' : '' }}">
                     <a href="{{ route('category.index') }}" class="menu-link">
                         <div data-i18n="Without menu">All Category List</div>
                     </a>
                 </li>
                 <li class="menu-item {{ Request::is('category') ? 'active' : '' }}">
                     <a href="{{ route('category.create') }}" class="menu-link">
                         <div data-i18n="Container">Add Category</div>
                     </a>
                 </li>
                 <li class="menu-item {{ Request::is('category') ? 'active' : '' }}">
                     <a href="{{ route('category.view') }}" class="menu-link">
                         <div data-i18n="Fluid">Search Category</div>
                     </a>
                 </li>
             </ul>
         </li>
         {{-- Expenses --}}
         <li class="menu-item {{ Request::is('expenses') ? 'active open' : '' }}">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons ri-layout-2-line"></i>
                 <div data-i18n="expenses">Expense</div>
                 <i class="dropdown-toggle-icon"></i> <!-- Dropdown Icon -->
             </a>
             <ul class="menu-sub">
                 <li class="menu-item {{ Request::is('expenses') ? 'active' : '' }}">
                     <a href="{{ route('expenses.index') }}" class="menu-link">
                         <div data-i18n="Without menu">All Expense List</div>
                     </a>
                 </li>
                 <li class="menu-item {{ Request::is('category') ? 'active' : '' }}">
                     <a href="{{ route('expenses.create') }}" class="menu-link">
                         <div data-i18n="Container">Create Expense</div>
                     </a>
                 </li>
             </ul>
         </li>
         <!-- Supplier -->
         <li class="menu-item {{ Request::is('supplier') ? 'active open' : '' }}">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons ri-layout-2-line"></i>
                 <div data-i18n="Supplier">Supplier</div>
                 <i class="dropdown-toggle-icon"></i> <!-- Dropdown Icon -->
             </a>
             <ul class="menu-sub">
                 <li class="menu-item {{ Request::is('category') ? 'active' : '' }}">
                     <a href="{{ route('suppliers.index') }}" class="menu-link">
                         <div data-i18n="Without menu">All Supplier List</div>
                     </a>
                 </li>
                 <li class="menu-item {{ Request::is('category') ? 'active' : '' }}">
                     <a href="{{ route('suppliers.create') }}" class="menu-link">
                         <div data-i18n="Container">Add Supplier</div>
                     </a>
                 </li>
             </ul>
         </li>
         <!-- Product -->
         <li class="menu-item {{ Request::is('products') ? 'active open' : '' }}">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons ri-layout-2-line"></i>
                 <div data-i18n="Category">Product</div>
                 <i class="dropdown-toggle-icon"></i> <!-- Dropdown Icon -->
             </a>
             <ul class="menu-sub">
                 <li class="menu-item {{ Request::is('products') ? 'active' : '' }}">
                     <a href="{{ route('products.create') }}" class="menu-link">
                         <div data-i18n="Without menu">Add Product</div>
                     </a>
                 </li>
                 <li class="menu-item {{ Request::is('layouts-container') ? 'active' : '' }}">
                     <a href="{{ route('products.index') }}" class="menu-link">
                         <div data-i18n="Container">View All Product</div>
                     </a>
                 </li>
                 <li class="menu-item {{ Request::is('layouts-fluid') ? 'active' : '' }}">
                     <a href="{{ route('products.preview-pdf') }}" class="menu-link">
                         <div data-i18n="Fluid">Products PDF</div>
                     </a>
                 </li>
             </ul>
         </li>
         <!-- POS -->
         <li class="menu-item {{ Request::is('pos') ? 'active open' : '' }}">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons ri-layout-2-line"></i>
                 <div data-i18n="Category">POS</div>
                 <i class="dropdown-toggle-icon"></i> <!-- Dropdown Icon -->
             </a>
             <ul class="menu-sub">
                 <li class="menu-item {{ Request::is('pos') ? 'active' : '' }}">
                     <a href="{{ route('pos.index') }}" class="menu-link">
                         <div data-i18n="Without menu">POS</div>
                     </a>
                 </li>
                 <li class="menu-item {{ Request::is('pos') ? 'active' : '' }}">
                     <a href="{{ route('pos.show') }}" class="menu-link">
                         <div data-i18n="Container">View All Cart</div>
                     </a>
                 </li>
                 <li class="menu-item {{ Request::is('pos') ? 'active' : '' }}">
                     <a href="{{ route('invoices.index') }}" class="menu-link">
                         <div data-i18n="Fluid"> View All Invoices</div>
                     </a>
                 </li>

                 <li class="menu-item {{ Request::is('layouts-blank') ? 'active' : '' }}">
                     <a href="{{ route('orders.index') }}" class="menu-link">
                         <div data-i18n="Blank">View All Orders</div>
                     </a>
                 </li>
             </ul>
         </li>

         <!-- {{-- Transection section --}} -->
         <li class="menu-item {{ Request::is('transection') ? 'active open' : '' }}">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons ri-layout-2-line"></i>
                 <div data-i18n="Category">Transections</div>
                 <i class="dropdown-toggle-icon"></i> <!-- Dropdown Icon -->
             </a>
             <ul class="menu-sub">
                 <li class="menu-item {{ Request::is('transection') ? 'active' : '' }}">
                     <a href="{{ route('transactions.index') }}" class="menu-link">
                         <div data-i18n="Without menu">View Transections</div>
                     </a>
                 </li>
                 <li class="menu-item {{ Request::is('transection') ? 'active' : '' }}">
                     <a href="{{ route('payments.index') }}" class="menu-link">
                         <div data-i18n="Container">View All Payments</div>
                     </a>
                 </li>
             </ul>
         </li>

         {{-- Other section --}}
         <li class="menu-item {{ Request::is('creation') ? 'active open' : '' }}">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons ri-layout-2-line"></i>
                 <div data-i18n="creation">Creation</div>
                 <i class="dropdown-toggle-icon"></i> <!-- Dropdown Icon -->
             </a>
             <ul class="menu-sub">
                 
                 <li class="menu-item {{ Request::is('creation') ? 'active' : '' }}">
                     <a href="{{ route('customers.create') }}" class="menu-link">
                         <div data-i18n="Fluid">Customer Create</div>
                     </a>
                 </li>

                 <li class="menu-item {{ Request::is('creation') ? 'active' : '' }}">
                     <a href="{{ route('shop_logos.index') }}" class="menu-link">
                         <div data-i18n="Fluid">Shop Logo Create</div>
                     </a>
                 </li>
                 <li class="menu-item {{ Request::is('creation') ? 'active' : '' }}">
                     <a href="{{ route('users.index') }}" class="menu-link">
                         <div data-i18n="Blank">View All User</div>
                     </a>
                 </li>
             </ul>
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
                 <a href="{{ route('notifications.index') }}" class="menu-link">
    <div data-i18n="Notifications">Notifications</div>
</a>
                 </li>
             </ul>
         </li>
 </aside>
 <!-- / Menu -->