<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\WebAuthController;

// Public routes
Route::get('/', [WebController::class, 'index'])->name('home');
Route::get('/login', [WebController::class, 'showLogin'])->name('login');
Route::get('/simple-login', function () { return view('simple-login'); })->name('simple-login');
Route::get('/register', [WebController::class, 'showRegister'])->name('register');
Route::get('/products', [WebController::class, 'products'])->name('products');
Route::get('/contact', [WebController::class, 'contact'])->name('contact');

// Authentication routes
Route::post('/login', [WebAuthController::class, 'login'])->name('login.submit');
Route::post('/register', [WebAuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');

// Category routes
Route::get('/spices', [WebController::class, 'spices'])->name('spices');
Route::get('/ayurvedic', [WebController::class, 'ayurvedic'])->name('ayurvedic');
Route::get('/handicraft', [WebController::class, 'handicraft'])->name('handicraft');

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [WebController::class, 'cart'])->name('cart');

    Route::middleware('role:admin,vendor')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Admin web routes for dashboard (bypass API authentication)
        Route::prefix('admin')->group(function () {
            Route::get('/stats', [App\Http\Controllers\AdminApiController::class, 'getDashboardStats']);
            Route::get('/products', [App\Http\Controllers\AdminApiController::class, 'getProducts']);
            Route::get('/products/{id}', [App\Http\Controllers\AdminApiController::class, 'getProduct']);
            Route::post('/products', [App\Http\Controllers\AdminApiController::class, 'storeProduct']);
            Route::put('/products/{id}', [App\Http\Controllers\AdminApiController::class, 'updateProduct']);
            Route::delete('/products/{id}', [App\Http\Controllers\AdminApiController::class, 'deleteProduct']);
            Route::get('/vendors', [App\Http\Controllers\AdminApiController::class, 'getVendors']);
            Route::get('/vendors/{id}', [App\Http\Controllers\AdminApiController::class, 'getVendor']);
            Route::post('/vendors', [App\Http\Controllers\AdminApiController::class, 'storeVendor']);
            Route::put('/vendors/{id}', [App\Http\Controllers\AdminApiController::class, 'updateVendor']);
            Route::delete('/vendors/{id}', [App\Http\Controllers\AdminApiController::class, 'deleteVendor']);
            Route::get('/orders', [App\Http\Controllers\AdminApiController::class, 'getOrders']);
            Route::get('/orders/{id}', [App\Http\Controllers\AdminApiController::class, 'getOrder']);
            Route::post('/orders', [App\Http\Controllers\AdminApiController::class, 'storeOrder']);
            Route::put('/orders/{id}', [App\Http\Controllers\AdminApiController::class, 'updateOrder']);
            Route::delete('/orders/{id}', [App\Http\Controllers\AdminApiController::class, 'deleteOrder']);
            Route::put('/orders/{id}/status', [App\Http\Controllers\AdminApiController::class, 'updateOrderStatus']);
        });
    });
});
