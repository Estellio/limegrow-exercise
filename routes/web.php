<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('home');
});

Route::post('/register', [AdminController::class, 'register']);
Route::post('/logout', [AdminController::class, 'logout']);
Route::post('/login', [AdminController::class, 'login']);