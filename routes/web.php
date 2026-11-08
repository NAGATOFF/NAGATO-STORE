
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;

// ==============================
// PUBLIC STORE
// ==============================

Route::get('/', [ProductController::class, 'index'])
    ->name('home');

Route::get('/products/{slug}', [ProductController::class, 'show'])
    ->name('products.show');


// ==============================
// ADMIN
// ==============================

Route::prefix('admin')->name('admin.')->group(function () {

    // Login
    Route::get('/login', [AdminController::class, 'loginForm'])
        ->name('login');

    Route::post('/login', [AdminController::class, 'login'])
        ->name('login.submit');


    // Protected Admin Routes
    Route::middleware([AdminMiddleware::class])->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        // Logout
        Route::post('/logout', [AdminController::class, 'logout'])
            ->name('logout');


        // ==============================
        // PRODUCTS MANAGEMENT
        // ==============================

        Route::get('/products', [AdminController::class, 'products'])
            ->name('products');

        Route::get('/products/create', [AdminController::class, 'createProduct'])
            ->name('products.create');

        Route::post('/products', [AdminController::class, 'storeProduct'])
            ->name('products.store');

        Route::get('/products/{product}/edit', [AdminController::class, 'editProduct'])
            ->name('products.edit');

        Route::put('/products/{product}', [AdminController::class, 'updateProduct'])
            ->name('products.update');

        Route::delete('/products/{product}', [AdminController::class, 'deleteProduct'])
            ->name('products.delete');


        // ==============================
        // STORE SETTINGS
        // ==============================

        Route::get('/settings', [AdminController::class, 'settings'])
            ->name('settings');

        Route::put('/settings', [AdminController::class, 'updateSettings'])
            ->name('settings.update');

    });

});
