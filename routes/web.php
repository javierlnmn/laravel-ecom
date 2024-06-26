<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/{productSlug}', [ProductController::class, 'show'])->name('product.show');

// Categories
Route::get('/categories', [ProductCategoryController::class, 'index'])->name('category.index');
Route::get('/categories/{categorySlug}', [ProductCategoryController::class, 'show'])->name('category.show');

// Brands
Route::get('/brands', [BrandController::class, 'index'])->name('brand.index');
Route::get('/brands/{brandSlug}', [BrandController::class, 'show'])->name('brand.show');

// Shopping Cart
Route::middleware('auth')->post('/add-to-cart/{productId}', [ShoppingCartController::class, 'store'])->name('cart.store');
Route::middleware('auth')->delete('/remove-from-cart/{cartProductId}', [ShoppingCartController::class, 'delete'])->name('cart.delete');
Route::get('/cart', [ShoppingCartController::class, 'show'])->name('cart.show');

// Orders
Route::middleware('auth')->get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::middleware('auth')->get('/orders', [OrderController::class, 'index'])->name('order.index');
Route::middleware('auth')->delete('/orders/destroy/{orderId}', [OrderController::class, 'destroy'])->name('order.destroy');

// Stripe
Route::middleware('auth')->post('/payment', [StripeController::class, 'payment'])->name('stripe.payment');
Route::middleware('auth')->get('/payment/success', [StripeController::class, 'success'])->name('payment.success');
Route::middleware('auth')->get('/payment/cancelled', [StripeController::class, 'cancel'])->name('payment.cancel');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
