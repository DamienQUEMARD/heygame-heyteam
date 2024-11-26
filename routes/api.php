<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SanctumController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/sanctum/me', [SanctumController::class, 'me'])->name('api.sanctum.me');
    Route::get('/sanctum/logout', [SanctumController::class, 'logout'])->name('api.sanctum.logout');
    Route::get('/sanctum/tokens', [SanctumController::class, 'tokens'])->name('api.sanctum.tokens');

    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'list')->name('api.products.list');
        Route::post('/products', 'create')->name('api.products.create');
        Route::put('/products/{id}', 'update')->name('api.products.update');
        Route::delete('/products/{id}', 'delete')->name('api.products.delete');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::post('/orders', 'create')->name('api.orders.create');
        Route::put('/orders/{id}/status', 'update')->name('api.orders.status.update');
    });

});

Route::post('/sanctum/register', [SanctumController::class, 'register'])->name('api.sanctum.register');
Route::post('/sanctum/login', [SanctumController::class, 'login'])->name('api.sanctum.login');
