<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::controller('SocialiteController')->group(function() {
//     Route::get('auth/google','googleLogin' )->name('auth.google');
//     Route::get('auth/google-callback','googleAuthentication' )->name('auth.google-callback');
// });


Route::prefix('auth')->name('auth.')->controller(SocialiteController::class)->group(function () {
    Route::get('google', 'googleLogin')->name('google');
    Route::get('google-callback', 'googleAuthentication')->name('google-callback');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    $user = Auth::user(); // Get the authenticated user
    return view('adminBackend.adminLayout', compact('user')); // Pass user data to the view
})->middleware(['auth', 'verified', 'role:admin'])->name('dashboard');

// Dashboard routes
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
// });

// Category routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('view_category', [CategoryController::class, 'view_category'])->name('category');
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
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('customers', [CustomerController::class, 'store'])->name('customers.store');
});


// Products Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
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

Route::middleware(['auth', 'role:admin'])->group(function () {



    Route::get('/pos', [PosController::class, 'showPos'])->name('pos.index');
    Route::post('/pos/add-product', [PosController::class, 'addProduct'])->name('pos.add');
    Route::get('/pos/remove-product/{id}', [PosController::class, 'removeProduct'])->name('pos.remove');
    Route::post('cart/add', [PosController::class, 'storeCartInDatabase'])->name('cart.add');
    Route::post('cart/update', [PosController::class, 'updateCart'])->name('pos.update');


    // Route::get('/pos/clear-cart', [PosController::class, 'clearCart'])->name('pos.clear');
    // Route::post('/pos/checkout', [PosController::class, 'checkout'])->name('pos.checkout');
    // Route::post('/pos/update-cart', [PosController::class, 'updateCart'])->name('pos.updateCart');
});

// order 
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    // Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    // Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    // Route::post('/orders/{orderId}/update', [OrderController::class, 'update'])->name('orders.update');
    // Route::post('/orders/{orderId}/add-product', [OrderController::class, 'addProduct'])->name('orders.addProduct');
    // Route::post('/orders/{id}/proceed', [OrderController::class, 'proceed'])->name('orders.proceed');

    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{orderId}/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions/{orderId}/store', [TransactionController::class, 'store'])->name('transactions.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
