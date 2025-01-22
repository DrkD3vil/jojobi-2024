<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ShopLogoController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Route::controller('SocialiteController')->group(function() {
//     Route::get('auth/google','googleLogin' )->name('auth.google');
//     Route::get('auth/google-callback','googleAuthentication' )->name('auth.google-callback');
// });

// Role is Administrator Access for All Files
Route::middleware(['auth', 'role:admin' , 'notificationCount'])->group(function () {


});


Route::prefix('auth')->name('auth.')->controller(SocialiteController::class)->group(function () {
    Route::get('google', 'googleLogin')->name('google');
    Route::get('google-callback', 'googleAuthentication')->name('google-callback');
});

Route::get('/users', [UserController::class, 'index'])->name('users.index'); // List all users
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show'); // Show user details
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit'); // Edit user
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update'); // Update user

Route::middleware(['auth'])->group(function () {
    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
    Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::get('/expenses/suggest', [ExpenseController::class, 'suggest'])->name('expenses.suggest');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified', 'role:admin' , 'notificationCount'])->group(function () {
    Route::get('/dashboard', [AdminController::class,'adminDashboard'])->name('dashboard');
    Route::get('/api/sales-overview', [AdminController::class, 'getSalesOverview']);
    Route::get('/sales/category-data', [AdminController::class, 'getCategorySalesData'])->name('sales.getCategorySalesData');
    Route::get('/sales/report', [AdminController::class, 'getSalesReport'])->name('sales.getSalesReport');
    Route::get('/admin/sales-report', [AdminController::class, 'getSalesReport'])->name('admin.sales_report');
});

// Route::get('/dashboard', function () {
//     $user = Auth::user(); // Get the authenticated user
//     return view('adminBackend.adminDeshboard', compact('user')); // Pass user data to the view
// })->middleware(['auth', 'verified', 'role:admin' , 'notificationCount'])->name('dashboard');

// Dashboard routes
// Route::middleware(['auth', 'role:admin' , 'notificationCount'])->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
// });


Route::prefix('suppliers')->group(function () {
    Route::get('/', [SupplierController::class, 'index'])->name('suppliers.index'); // List suppliers
    Route::get('/create', [SupplierController::class, 'create'])->name('suppliers.create'); // Create supplier form
    Route::post('/store', [SupplierController::class, 'store'])->name('suppliers.store'); // Store supplier
    Route::get('/{uuid}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit'); // Edit supplier form
    Route::put('/{uuid}', [SupplierController::class, 'update'])->name('suppliers.update'); // Update supplier
    Route::delete('/{uuid}', [SupplierController::class, 'destroy'])->name('suppliers.destroy'); // Delete supplier
    Route::get('/{uuid}', [SupplierController::class, 'show'])->name('suppliers.show'); // View supplier details

});

Route::prefix('shop-logos')->group(function () {
    Route::get('/', [ShopLogoController::class, 'index'])->name('shop_logos.index');
    Route::post('/', [ShopLogoController::class, 'store'])->name('shop_logos.store');
    Route::get('create', [ShopLogoController::class, 'create'])->name('shop_logos.create');
    Route::get('{shop_logo}', [ShopLogoController::class, 'show'])->name('shop_logos.show');
    Route::get('{shop_logo}/edit', [ShopLogoController::class, 'edit'])->name('shop_logos.edit');
    Route::put('{shop_logo}', [ShopLogoController::class, 'update'])->name('shop_logos.update');
    Route::delete('{shop_logo}', [ShopLogoController::class, 'destroy'])->name('shop_logos.destroy');
});

// Category routes
Route::middleware(['auth', 'role:admin' , 'notificationCount'])->group(function () {

    // Generate Barcode
    Route::get('/generate-barcode', [PublicController::class, 'generateBarcode']);
    Route::post('/validate-barcode', [PublicController::class, 'validateBarcode']);



    Route::get('index', [CategoryController::class, 'indexCategory'])->name('category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('view_category', [CategoryController::class, 'view_category'])->name('category.view');


    Route::post('add_category', [CategoryController::class, 'add_category'])->name('add_category');
    Route::get('search_category', [CategoryController::class, 'search_category'])->name('category.search');
    Route::get('edit_category/{uuid}', [CategoryController::class, 'edit_category'])->name('category.edit');
    Route::post('update_category/{uuid}', [CategoryController::class, 'update_category'])->name('category.update');
    Route::get('delete_category/{uuid}', [CategoryController::class, 'delete_category'])->name('category.delete');
    Route::get('preview-pdf', [CategoryController::class, 'previewCategoriesPDF'])->name('category.preview-pdf');
    Route::get('download-pdf', [CategoryController::class, 'downloadCategoriesPDF'])->name('category.download-pdf');
    Route::get('singleView_category/{uuid}', [CategoryController::class, 'singleView_category'])->name('category.singleView');
});

// Customer
Route::middleware(['auth', 'role:admin' , 'notificationCount'])->group(function () {
    Route::get('customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/search', [CustomerController::class, 'customerSearch'])->name('customers.search');
});


// Products Routes
Route::middleware(['auth', 'role:admin' , 'notificationCount'])->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/notifications', [ProductController::class, 'checkProductExpiry'])->name('notifications.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{uuid}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('products/{uuid}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{uuid}', [ProductController::class, 'destroy'])->name('products.delete');
    Route::get('products/view/{uuid}', [ProductController::class, 'show'])->name('products.show');
    Route::get('products/preview-pdf', [ProductController::class, 'previewProductsPDF'])->name('products.preview-pdf');
    Route::get('products/export', [ProductController::class, 'exportToExcel'])->name('products.export');
    Route::post('products/import', [ProductController::class, 'importFromExcel'])->name('products.import');

    Route::get('products/import-format', [ProductController::class, 'downloadImportFormat'])->name('products.import-format');

    // Route::get('products/search', [ProductController::class,'search'])->name('products.search');
    // Route::get('products/csv', [ProductController::class, 'generateCSV'])->name('products.csv');
    // Route::get('products/export', [ProductController::class, 'exportToExcel'])->name('products.export');
    // Route::get('products/import', [ProductController::class, 'importFromExcel'])->name('products.import');
    // Route::get('products/view-pdf/{uuid}', [ProductController::class, 'viewPDF'])->name('products.view-pdf');

});

// POS Routes

Route::middleware(['auth', 'role:admin' , 'notificationCount'])->group(function () {
    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    Route::get('/api/products/search', [PosController::class, 'searchProducts'])->name('pos.products.search');
    Route::post('/pos/add', [PosController::class, 'addProduct'])->name('pos.add');
    Route::post('/pos/proceed', [PosController::class, 'proceedCart'])->name('pos.proceed');
    Route::delete('/pos/remove/{id}', [PosController::class, 'removeProduct'])->name('pos.remove');
    Route::post('pos/update-cart', [PosController::class, 'updateCart'])->name('pos.updateCart');
    Route::post('pos/remove-from-cart', [PosController::class, 'removeFromCart'])->name('pos.removeFromCart');
    Route::get('pos/carts', [PosController::class, 'showCarts'])->name('pos.show');
    // Edit position
    Route::get('/carts/{cart_id}/edit', [PosController::class, 'edit'])->name('carts.edit');
    Route::post('/carts/{cart_id}/addProduct', [PosController::class, 'addCartItem'])->name('pos.addCartItem');
    Route::post('/carts/updateQuantity', [PosController::class, 'updateQuantity'])->name('pos.updateQuantity');
    Route::post('/carts/removeCartItem', [PosController::class, 'removeCartItem'])->name('pos.removeCartItem');
    Route::post('/carts/{cart_id}/proceed', [PosController::class, 'proceedCartItem'])->name('pos.proceedCart');
    // Order Creation
    Route::get('/orders/create/{cart_id}', [PosController::class, 'orderCreation'])->name('orders.creation');
});

// order 
Route::middleware(['auth', 'role:admin' , 'notificationCount'])->group(function () {
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/carts/{cart_id}/edit', [PosController::class, 'edit'])->name('carts.edit');
});

Route::middleware(['auth', 'role:admin' , 'notificationCount'])->group(function () {
    // View Transection
    // Transaction routes
    Route::get('/admin/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create/{uuid}', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');
});
Route::middleware(['auth', 'role:admin' , 'notificationCount'])->group(function () {

    Route::get('payments/create/{transaction_id}', [PaymentController::class, 'paymentcreate'])->name('payments.create');
    // Store a new payment
    Route::post('payments/store', [PaymentController::class, 'paymentstore'])->name('payments.store');


    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/admin/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
    // Route::get('/invoice/{id}/pdf', [InvoiceController::class, 'invoicePDF'])->name('invoice.pdf');
    Route::get('invoice/{invoice_id}/pdf', [InvoiceController::class, 'generatePdf'])->name('invoice.pdf');
    Route::get('/print-invoice/{id}', [InvoiceController::class, 'invoiceprint'])->name('print.invoice');

    // Route to show all payments
    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');

    // Route::get('/invoice/{invoice}', [TransactionController::class, 'show'])->name('invoices.show');
    // Route::get('/invoices/{id}/pdf', [TransactionController::class, 'invoicePDF'])->name('invoices.pdf');


});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
