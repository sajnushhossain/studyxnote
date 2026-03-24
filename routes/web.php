<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NoteController as AdminNoteController;
use Illuminate\Support\Facades\Route;

// Public Notes
Route::get('/', [NoteController::class, 'index'])->name('notes.index');
Route::get('/notes/{note}', [NoteController::class, 'show'])->name('notes.show');

// Dashboard redirects to notes.index for users
Route::get('/dashboard', function () {
    if (auth()->user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('notes.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Auth Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/picture', [ProfileController::class, 'updatePicture'])->name('profile.picture.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::delete('/profile/recently-viewed/{note}', [ProfileController::class, 'removeRecentlyViewed'])->name('profile.recently-viewed.destroy');

    // Cart Routes
    Route::post('/cart/{note}', [\App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{note}', [\App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('notes', AdminNoteController::class);
});

require __DIR__.'/auth.php';
