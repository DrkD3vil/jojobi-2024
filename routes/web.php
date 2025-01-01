<?php

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
    return view('dashboard', compact('user')); // Pass user data to the view
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
