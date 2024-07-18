<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;


// In web.php
use App\Http\Controllers\HomeController;


// Route definition (web.php)
Route::post('products/{product}/purchase', [ProductController::class, 'purchase'])->name('products.purchase');
Route::get('products/{product}/confirmation', [ProductController::class, 'confirmation'])->name('products.confirmation');


Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Product routes
Route::resource('products', ProductController::class);

// Order routes
Route::resource('orders', OrderController::class);

// Company routes
Route::resource('companies', CompanyController::class);

// User routes
Route::resource('users', UserController::class);

// Admin routes
Route::resource('admins', AdminController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
