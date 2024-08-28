<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategotyController;
use App\Http\Controllers\Api\SlideController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;
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

    Route::post('order/create', [OrderController::class, 'newOrder']);
});
