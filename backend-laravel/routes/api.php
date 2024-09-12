<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategotyController;
use App\Http\Controllers\Api\SlideController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AuthController;
use App\Models\Tag;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/categories', [CategotyController::class, 'index']);
    Route::get('/slides', [SlideController::class, 'index']);
    Route::get('/tags', [Tag::class, 'index']);
    Route::get('/users', [UserController::class, 'index']);
    // ORDER
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'select']);
    Route::get('/QRcode', [OrderController::class, 'QRcode']);
    Route::post('/order/create', [OrderController::class, 'newOrder']);
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
});

Route::middleware('auth:api')->group(function () {
    Route::post('/me', [AuthController::class, 'me'])->name('auth.me');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('auth.refresh');
});