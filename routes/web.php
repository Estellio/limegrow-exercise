<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('home');
});

// Admin Controllers
Route::post('/register', [AdminController::class, 'register']);
Route::post('/logout', [AdminController::class, 'logout']);
Route::post('/login', [AdminController::class, 'login']);

// Product Controllers
Route::post('/addproduct', [ProductController::class, 'addproduct']);