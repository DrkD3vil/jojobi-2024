<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
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

Route::middleware(['auth', 'role:admin'])->group(function (){

    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    Route::post('/pos/add-product', [PosController::class, 'addProduct'])->name('pos.add');
    Route::get('/pos/remove-product/{id}', [PosController::class, 'removeProduct'])->name('pos.remove');
    Route::get('/pos/clear-cart', [PosController::class, 'clearCart'])->name('pos.clear');
    Route::post('/pos/checkout', [PosController::class, 'checkout'])->name('pos.checkout');
    Route::post('/pos/update-cart', [PosController::class, 'updateCart'])->name('pos.updateCart');
// Route::post('/transactions/checkout', [TransactionController::class, 'checkout'])->name('transactions.checkout');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    // Route::post('/transactions/add-product', [TransactionController::class, 'addProduct'])->name('transactions.add');
    // Route::get('/transactions/remove-product/{id}', [TransactionController::class, 'removeProduct'])->name('transactions.remove');
    // Route::get('/transactions/clear-cart', [TransactionController::class, 'clearCart'])->name('transactions.clear');
    // Route::post('/transactions/checkout', [TransactionController::class, 'checkout'])->name('transactions.checkout');



    // Route::get('/pos', [TransactionController::class, 'index'])->name('pos.index');
    // Route::post('/pos/add-product', [TransactionController::class, 'addProduct'])->name('pos.add-product');
    // Route::post('/pos/remove-product/{rowId}', [TransactionController::class,'removeProduct'])->name('pos.remove-product');
    // Route::post('/pos/update-quantity/{rowId}', [TransactionController::class,'updateQuantity'])->name('pos.update-quantity');
    // Route::post('/pos/update-total', [TransactionController::class,'updateTotal'])->name('pos.update-total');
    // Route::post('/pos/submit-transaction', [TransactionController::class,'submitTransaction'])->name('pos.submit-transaction');
    // Route::get('/pos/view-transaction/{uuid}', [TransactionController::class,'viewTransaction'])->name('pos.view-transaction');
    // Route::get('/pos/print-transaction/{uuid}', [TransactionController::class,'printTransaction'])->name('pos.print-transaction');
    // Route::get('/pos/pdf/{uuid}', [TransactionController::class,'generatePDF'])->name('pos.pdf');
    // Route::get('/pos/export', [TransactionController::class,'exportToExcel'])->name('pos.export');
    // Route::get('/pos/csv', [TransactionController::class,'generateCSV'])->name('pos.csv');
    // Route::get('/pos/search', [TransactionController::class,'search'])->name('pos.search');
    // Route::get('/pos/view-pdf/{uuid}', [TransactionController::class,'viewPDF'])->name('pos.view-pdf');
    // Route::get('/pos/download-pdf/{uuid}', [TransactionController::class,'downloadPDF'])->name('pos.download-pdf');
    // Route::get('/pos/preview-pdf', [TransactionController::class,'previewTransactionsPDF'])->name('pos.preview-pdf');
    // Route::get('/pos/download-pdf', [TransactionController::class,'downloadTransactionsPDF'])->name('pos.download-pdf');
    // Route::get('/pos/singleView_transaction/{uuid}', [TransactionController::class,'singleView_transaction'])->name('pos.singleView');
    // Route::get('/pos/preview-pdf', [TransactionController::class,'previewTransactionsPDF'])->name('pos.preview-pdf');
    // Route::get('/pos/download-pdf', [TransactionController::class,'downloadTransactionsPDF'])->name('pos.download-pdf');
    // Route::get('/pos/singleView_transaction/{uuid}', [TransactionController::class,'singleView_transaction'])->name('pos.singleView');
    // Route::get('/pos/preview-pdf', [TransactionController::class,'previewTransactionsPDF'])->name('pos.preview-pdf');
    // Route::get('/pos/download-pdf', [TransactionController::class,'downloadTransactionsPDF'])->name('pos.download-pdf');
    // Route::get('/pos/singleView_transaction/{uuid}', [TransactionController::class,'singleView_transaction'])->name('pos.singleView');
    // Route::get('/pos/preview-pdf', [TransactionController::class,'previewTransactionsPDF'])->name('pos.preview-pdf');
    // Route::get('/pos/download-pdf', [TransactionController::class,'downloadTransactionsPDF'])->name('pos.download-pdf');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
