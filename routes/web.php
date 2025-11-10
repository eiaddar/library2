<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WelocmeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [WelocmeController::class,'index'])->name('home');
Route::get('/category/{category_id}', [CategoryController::class,'getBooksByCategory'])->name('books-by-category');


Route::prefix('admin')->middleware('auth')->group(function () {
	Route::get('/dashboard', [AdminController::class, 'index'])->name('admin-dashboard');

	// Category routes
	Route::get('/category', [CategoryController::class, 'index'])->name('admin-category');
	Route::get('/category/add', [CategoryController::class, 'create'])->name('add-category');
	Route::post('/category/add', [CategoryController::class, 'store'])->name('store-category');
	Route::get('/category/edit/{Id}', [CategoryController::class, 'edit'])->name('edit-category');
	Route::post('/category/edit', [CategoryController::class, 'update'])->name('update-category');

	// Toggle category status
	Route::get('/category/toggle-status/{id}', [CategoryController::class, 'toggleStatus'])->name('toggle-category-status');

	// Delete category (using DELETE method for RESTful practice)
	Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('destroy-category');
	// Keep the GET route for backward compatibility
	Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('destroy-category.get');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
