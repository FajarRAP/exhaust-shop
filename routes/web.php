<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect(route('customer.dashboard')))
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)
        ->name('customer.dashboard');
    Route::get('products/{slug}', ProductDetailController::class)
        ->name('customer.products.show');

    Route::get('cart', [CartController::class, 'index'])
        ->name('customer.cart.index');
    Route::post('cart', [CartController::class, 'store'])
        ->name('customer.cart.store');
    Route::delete('cart/{cart}', [CartController::class, 'destroy'])
        ->name('customer.cart.destroy');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {
        Route::get('dashboard', DashboardAdminController::class)
            ->name('dashboard');
        Route::get('categories', [CategoryController::class, 'index'])
            ->name('categories.index');
        Route::get('categories/create', [CategoryController::class, 'create'])
            ->name('categories.create');
        Route::post('categories', [CategoryController::class, 'store'])
            ->name('categories.store');
        Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])
            ->name('categories.edit');
        Route::put('categories/{category}', [CategoryController::class, 'update'])
            ->name('categories.update');
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])
            ->name('categories.destroy');

        Route::get('products', [ProductController::class, 'index'])
            ->name('products.index');
        Route::get('products/create', [ProductController::class, 'create'])
            ->name('products.create');
        Route::post('products', [ProductController::class, 'store'])
            ->name('products.store');
        Route::get('products/{product}/edit', [ProductController::class, 'edit'])
            ->name('products.edit');
        Route::put('products/{product}', [ProductController::class, 'update'])
            ->name('products.update');
        Route::delete('products/{product}', [ProductController::class, 'destroy'])
            ->name('products.destroy');
    });

require __DIR__ . '/auth.php';
