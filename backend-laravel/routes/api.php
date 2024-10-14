<?php

use App\Http\Controllers\Admin\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategotyController;
use App\Http\Controllers\Api\SlideController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BankController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Support\Facades\Auth;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('')->middleware('api.key')->group(function () {
    Route::prefix('')->group(function () {
        Route::get('/products', [ProductController::class, 'index']);
        Route::get('/categories', [CategotyController::class, 'index']);
        Route::get('/slides', [SlideController::class, 'index']);
        Route::get('/tags', [TagController::class, 'index']);
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/orders/{id}', [OrderController::class, 'select']);
        Route::get('/QRcode', [OrderController::class, 'QRcode']);
        Route::get('/bank', [BankController::class, 'index']);

        Route::post('/discount', [CouponController::class, 'index']);
        Route::post('/checkdiscount', [CouponController::class, 'checkDiscount']);
        Route::post('/order/create', [OrderController::class, 'newOrder']);
        Route::post('/message', [MessageController::class, 'getMessage']);
        Route::post('/sendmessage', [MessageController::class, 'sendMessage'])->name('sendmessage');
    });
});
Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/check', [AuthController::class, 'check'])->name('auth.check');
});

Route::middleware('auth:api')->group(function () {
    Route::post('/me', [AuthController::class, 'me'])->name('auth.me');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('auth.refresh');



    Route::post('/messages', function () {
        $user = Auth::user();

        $message = new App\Models\Message();
        $message->message = request()->get('message', '');
        $message->user_id = $user->id;
        $message->save();

        return ['message' => $message->load('user')];
    });
});
