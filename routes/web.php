<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WelocmeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelocmeController::class,'index'])->name('home');
Route::get('/category/{category_id}', [CategoryController::class,'getBooksByCategory'])->name('books-by-category');


Route::get('/admin/dashboard', [AdminController::class,'index'])->name('admin-dashboard');
Route::get('/admin/category', [CategoryController::class,'index'])->name('admin-category');
Route::get('/admin/category/add', [CategoryController::class,'create'])->name('add-category');
Route::post('/admin/category/add', [CategoryController::class,'store'])->name('store-category');
Route::get('/admin/category/edit/{Id}', [CategoryController::class,'edit'])->name('edit-category');
Route::post('/admin/category/edit', [CategoryController::class,'update'])->name('update-category');
// Toggle category status
Route::get('/admin/category/toggle-status/{id}', [CategoryController::class,'toggleStatus'])->name('toggle-category-status');

// Delete category (using DELETE method for RESTful practice)
Route::delete('/admin/category/delete/{id}', [CategoryController::class,'destroy'])->name('destroy-category');
// Keep the GET route for backward compatibility
Route::get('/admin/category/delete/{id}', [CategoryController::class,'destroy'])->name('destroy-category.get');
