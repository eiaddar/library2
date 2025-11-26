<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
//Route::get('login', [UserController::class, 'login']);

// Public authentication routes
Route::post('signup', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('categories', [CategoryController::class, 'getCategories'])->middleware('auth:sanctum');
Route::get('book-info/{id}', [BookController::class, 'getbook'])->name('api-book-info');

