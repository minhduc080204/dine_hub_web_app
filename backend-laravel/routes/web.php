<?php

use App\Events\MessageEvent;
use App\Events\MessageSent;
use App\Http\Controllers\admin\MessageController;
use App\Http\Controllers\admin\TagController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\SlideController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('account')->middleware('CheckLoginAdmin')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('account.login');
    Route::post('/doLogin', [AuthController::class, 'doLogin'])->name('account.doLogin');
});
Route::get('/doLogout', [AuthController::class, 'doLogout'])->name('account.doLogout');

// ADMIN ==============================================
// Route::prefix('admin')->group(function () {
Route::prefix('admin/')->name('admin.')->middleware('Authentication')->group(function () {
    // DASHBOARD ----------------------------------------------
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });
    // USER ----------------------------------------------
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/remove/{id}', [UserController::class, 'remove'])->name('remove');
    });
    // PRODUCT ----------------------------------------------
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/remove/{id}', [ProductController::class, 'remove'])->name('remove');
    });
    // ORDER ----------------------------------------------
    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/detail/{id}', [OrderController::class, 'detail'])->name('detail');
        Route::delete('/remove/{id}', [ProductController::class, 'remove'])->name('remove');
    });
    // SLIDE ----------------------------------------------
    Route::prefix('slide')->name('slide.')->group(function () {
        Route::get('/slide', [SlideController::class, 'index'])->name('index');
        Route::get('/slide/edit/{id}', [SlideController::class, 'editView'])->name('edit.view');
        Route::put('/slide/edit/{id}', [SlideController::class, 'edit'])->name('edit');
        Route::delete('/slide/remove/{id}', [SlideController::class, 'remove'])->name('remove');
    });


    // CATEGORY ----------------------------------------------
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'editView'])->name('edit.view');
        Route::put('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::delete('/remove/{id}', [CategoryController::class, 'remove'])->name('remove');
    });
    // MESSAGES ----------------------------------------------
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('index');
        // Route::get('/message/{id}', [MessageController::class, 'index'])->name('messages');
        Route::post('/sendmessage', [MessageController::class, 'sendMessage'])->name('sendmessage');
    });
    // TAG ----------------------------------------------
    Route::prefix('tag')->name('tag.')->group(function () {
        Route::get('/', [TagController::class, 'index'])->name('index');
        Route::get('/create', [TagController::class, 'create'])->name('create');
        Route::post('/store', [TagController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [TagController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [TagController::class, 'update'])->name('update');
        Route::delete('/remove/{id}', [TagController::class, 'remove'])->name('remove');
    });

    // COUPON ----------------------------------------------
    Route::prefix('coupon')->name('coupon.')->group(function () {
        Route::get('/', [CouponController::class, 'index'])->name('index');
        Route::get('/reload', [CouponController::class, 'reload'])->name('reload');
        Route::get('/create', [CouponController::class, 'create'])->name('create');
        Route::post('/store', [CouponController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CouponController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CouponController::class, 'update'])->name('update');
        Route::delete('/remove/{id}', [CouponController::class, 'remove'])->name('remove');
    });
});