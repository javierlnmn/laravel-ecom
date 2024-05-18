<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
