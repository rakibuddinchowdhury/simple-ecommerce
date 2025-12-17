<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. Custom Authentication Routes ---
Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'postRegister')->name('register.post');
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'postLogin')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});

// --- 2. Public Frontend Routes ---
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/shop', 'shop');
    Route::get('/collections/{category_slug}', 'viewCategory');
    Route::get('/collections/{category_slug}/{product_slug}', 'viewProduct');
    Route::get('/search', 'searchProducts'); // Search
});

// --- 3. Authenticated Routes (Requires Login) ---
Route::middleware(['auth'])->group(function () {
    
    // Cart System
    Route::controller(CartController::class)->group(function () {
        Route::post('add-to-cart', 'addToCart');
        Route::get('cart', 'viewCart');
        Route::post('delete-cart-item', 'deleteProduct');
    });

    // Checkout & Payment
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('checkout', 'index');
        Route::post('place-order', 'placeOrder');
        
        // Stripe Payment Callback Routes
        Route::get('payment-success', 'paymentSuccess')->name('payment.success');
        Route::get('payment-cancel', 'paymentCancel')->name('payment.cancel');
    });

    // User Orders & Invoices
    Route::controller(UserController::class)->group(function () {
        Route::get('my-orders', 'index');
        Route::get('my-orders/{order_id}', 'view');
        Route::get('my-orders/{order_id}/invoice', 'generateInvoice'); // Download PDF
    });

    // User Profile & Settings
    Route::controller(UserProfileController::class)->group(function () {
        Route::get('/profile', 'index');
        Route::post('/profile', 'updateUserDetails');
        Route::get('/change-password', 'changePassword');
        Route::post('/change-password', 'updatePassword');
    });
});

// --- 4. Admin Routes (Protected by Auth & isAdmin) ---
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Category Management
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{id}/edit', 'edit');
        Route::put('/category/{id}', 'update');
        Route::delete('/category/{id}', 'destroy');
    });

    // Product Management
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::post('/products', 'store');
        Route::get('/products/{product_id}/edit', 'edit');
        Route::put('/products/{product_id}', 'update');
        Route::get('/products/{product_id}/delete', 'destroy');
    });

    // Order Management
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/orders/{id}', 'view');
        Route::put('/orders/{id}', 'updateStatus');
        // Optional: Admin Invoice Download
        Route::get('/orders/{orderId}/generate', 'generateInvoice'); 
    });

});