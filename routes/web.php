<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WelocmeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelocmeController::class,'index'])->name('home');
Route::get('/category/{category_id}', [CategoryController::class,'getBooksByCategory'])->name('books-by-category');
