<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminApiController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public authentication routes
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Protected authentication routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/user', [AuthController::class, 'profile']);
    Route::put('/auth/user', [AuthController::class, 'updateProfile']);
    Route::get('/auth/profile', [AuthController::class, 'profile']);
    Route::put('/auth/profile', [AuthController::class, 'updateProfile']);
    Route::put('/auth/password', [AuthController::class, 'changePassword']);
    Route::delete('/auth/user', [AuthController::class, 'deleteAccount']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Admin API routes
    Route::prefix('admin')->group(function () {
        // Dashboard stats
        Route::get('/stats', [AdminApiController::class, 'getDashboardStats']);
        
        // Products CRUD
        Route::get('/products', [AdminApiController::class, 'getProducts']);
        Route::post('/products', [AdminApiController::class, 'storeProduct']);
        Route::put('/products/{id}', [AdminApiController::class, 'updateProduct']);
        Route::delete('/products/{id}', [AdminApiController::class, 'deleteProduct']);
        
        // Vendors CRUD
        Route::get('/vendors', [AdminApiController::class, 'getVendors']);
        Route::post('/vendors', [AdminApiController::class, 'storeVendor']);
        Route::put('/vendors/{id}', [AdminApiController::class, 'updateVendor']);
        Route::delete('/vendors/{id}', [AdminApiController::class, 'deleteVendor']);
        
        // Orders management
        Route::get('/orders', [AdminApiController::class, 'getOrders']);
        Route::put('/orders/{id}/status', [AdminApiController::class, 'updateOrderStatus']);
        
        // Reports
        Route::get('/reports/sales', [AdminApiController::class, 'getSalesReport']);
        Route::get('/reports/top-products', [AdminApiController::class, 'getTopProducts']);
    });
});

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // Orders API
    Route::apiResource('orders', OrderController::class);
    
    // Customers API (admin/vendor only)
    Route::middleware('role:admin,vendor')->apiResource('customers', CustomerController::class);
    
    // Products API - Read access for all, write access for vendors/admin
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::get('/products-images', [ProductController::class, 'getImages']);
    
    // Vendor/Admin only product operations
    Route::middleware('role:admin,vendor')->group(function () {
        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products/{id}', [ProductController::class, 'update']);
        Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    });
    
    // Cart API (customers only)
    Route::middleware('role:customer')->group(function () {
        Route::get('/cart', [CartController::class, 'index']);
        Route::post('/cart', [CartController::class, 'store']);
        Route::put('/cart/{id}', [CartController::class, 'update']);
        Route::delete('/cart/{id}', [CartController::class, 'destroy']);
        Route::delete('/cart', [CartController::class, 'clear']);
        Route::post('/checkout', [CartController::class, 'checkout']);
    });
});

// Additional product routes (if needed)
// Note: Products are already handled by apiResource above

// Default authenticated user route
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Health check route
Route::get('/health', function () {
    return response()->json([
        'status' => 'OK',
        'message' => 'API is running',
        'timestamp' => now()
    ]);
});
