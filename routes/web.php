<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Models\Category;

Route::get('/', function () {
    $products = Product::all();
    $categories = Category::all();
    return view('home', ['products' => $products, 'categories' => $categories]);
});

// Admin Controllers
Route::post('/register', [AdminController::class, 'register']);
Route::post('/logout', [AdminController::class, 'logout']);
Route::post('/login', [AdminController::class, 'login']);

// Product Controllers
Route::post('/addproduct', [ProductController::class, 'addproduct']);
Route::get('/show-product/{product}', [ProductController::class, 'showProductView']);
Route::get('/edit-product/{product}', [ProductController::class, 'showEditScreen']);
Route::put('/edit-product/{product}', [ProductController::class, 'updateProduct']);
Route::delete('/delete-product/{product}', [ProductController::class, 'deleteProduct']);
//Route::get('/filter-price', [ProductController::class, 'filterByPrice']);
//Route::get('/filter-category', [ProductController::class, 'filterByCategory']);
Route::get('/filter', [ProductController::class, 'filter']);