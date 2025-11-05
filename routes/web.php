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
Route::get('/admin/category/edit/{Id}', [CategoryController::class,'show'])->name('edit-category');
Route::post('/admin/category/edit', [CategoryController::class,'update'])->name('update-category');
Route::get('/admin/category/delete/{id}', [CategoryController::class,'destroy'])->name('destroy-category');