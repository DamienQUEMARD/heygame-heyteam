<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SanctumController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/sanctum/me', [SanctumController::class, 'me'])->name('api.sanctum.me');
    Route::get('/sanctum/logout', [SanctumController::class, 'logout'])->name('api.sanctum.logout');
    Route::get('/sanctum/tokens', [SanctumController::class, 'tokens'])->name('api.sanctum.tokens');
    Route::get('/products', [ProductController::class, 'list'])->name('api.orders.list');
    Route::post('/products', [ProductController::class, 'create'])->name('api.orders.create');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('api.orders.update');
    Route::delete('/products/{id}', [ProductController::class, 'delete'])->name('api.orders.delete');
});

Route::post('/sanctum/register', [SanctumController::class, 'register'])->name('api.sanctum.register');
Route::post('/sanctum/login', [SanctumController::class, 'login'])->name('api.sanctum.login');
