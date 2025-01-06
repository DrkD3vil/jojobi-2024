<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::controller('SocialiteController')->group(function() {
//     Route::get('auth/google','googleLogin' )->name('auth.google');
//     Route::get('auth/google-callback','googleAuthentication' )->name('auth.google-callback');
// });


Route::prefix('auth')->name('auth.')->controller(SocialiteController::class)->group(function() {
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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
