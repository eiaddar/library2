<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelocmeController;
use App\Http\Controllers\CategoryController;


Route::get('/', [WelocmeController::class,'index'])->name('home');
Route::get('/category/{category_id}', [CategoryController::class,'getBooksByCategory'])->name('books-by-category');


Route::prefix('super-management')->middleware('auth')->group(function () {
	Route::get('/dashboard', [AdminController::class, 'index'])->name('admin-dashboard');
	// Category routes
	Route::get('/category', [CategoryController::class, 'index'])->name('admin-category');
	Route::get('/category/add', [CategoryController::class, 'create'])->name('add-category');
	Route::post('/category/add', [CategoryController::class, 'store'])->name('store-category');
	Route::get('/category/edit/{Id}', [CategoryController::class, 'edit'])->name('edit-category');
	Route::post('/category/edit', [CategoryController::class, 'update'])->name('update-category');
	Route::get('/user', [UserController::class, 'index'])->name('admin-user');
	Route::get('/user/add', [UserController::class, 'create'])->name('add-user');
	Route::post('/user/add', [UserController::class, 'store'])->name('store-user');
	Route::get('/user/edit/{Id}', [UserController::class, 'edit'])->name('edit-user');
	Route::post('/user/edit', [UserController::class, 'update'])->name('update-user');
	Route::get('/user/toggle-status/{id}', [UserController::class, 'toggleStatus'])->name('toggle-category-status');
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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
